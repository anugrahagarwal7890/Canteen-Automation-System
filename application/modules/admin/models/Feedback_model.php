<?php

class Feedback_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_feedback()
    {
        $this->db->where('status', 1);
        return $this->db->get('feedback')->result_array();
    }

    function ajax_feedback_list()
    {
        $requestData = $_REQUEST;

        $columns = array(
            0 => 'id',
            1 => 'users.name',
            2 => 'feedback.feedback'
        );

        $query = "SELECT count(id) as total FROM feedback where status=1";
        $query = $this->db->query($query)->row_array();
        $totalData = (count($query) > 0) ? $query['total'] : 0;

        $where = "";
        if (!empty($requestData['columns'][1]['search']['value'])) {   //name
            $where .= " AND users.name LIKE'" . $requestData['columns'][1]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][2]['search']['value'])) {   //name
            $where .= " AND materials.name =" . $requestData['columns'][2]['search']['value'];
        }

        $sql = "SELECT feedback.*,users.name as user_name FROM feedback join users on feedback.user_id=users.id where 1". $where. " order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'] . " limit " . $requestData['start'] . " , " . $requestData['length'];
//SELECT feedback.*,users.name as user_name FROM feedback join users on feedback.user_id=users.id where 1
        $result = $this->db->query($sql)->result();
        $totalFiltered = (count($result) > 0) ? count($result) : 0;

        $data = array();
        foreach ($result as $r) {  // preparing an array
            $nestedData = array();
            $nestedData[] = ++$requestData['start'];
            $nestedData[] = $r->user_name;
            $nestedData[] = $r->feedback;
            $data[] = $nestedData;
        }
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalData), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   //total data array
        );
        echo json_encode($json_data);  // send data as json format

    }
}
