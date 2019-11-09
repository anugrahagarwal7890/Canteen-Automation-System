<?php

class Cart_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_cart()
    {
        $this->db->where('status', 1);
        return $this->db->get('cart')->result_array();
    }

    function ajax_cart_list($type)
    {
        if ($type==3)
        {
            $transaction=1;
        }
        else
        {
            $transaction=2;
        }

        $requestData = $_REQUEST;

        $columns = array(
            0 => 'id',
            1 => 'users.name',
            2 => 'food.name',
            3 => 'quantity',
            4 => 'total_price'
        );

        $query = "SELECT count(id) as total FROM cart where status=1 and transaction=".$transaction;
        $query = $this->db->query($query)->row_array();
        $totalData = (count($query) > 0) ? $query['total'] : 0;

        $where = "";
        if($type==2)
        {
            $where .=" AND from_unixtime(cart.modify, '%Y-%d-%m')='". date('Y-d-m')."'";
            $transaction=1;
        }
        if (!empty($requestData['columns'][1]['search']['value'])) {   //name
            $where .= " AND users.name LIKE'" . $requestData['columns'][1]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][2]['search']['value'])) {   //name
            $where .= " AND food.name =" . $requestData['columns'][2]['search']['value'];
        }

        $sql = "SELECT cart.*,users.name as user_name,food.name as food_name FROM cart join users on cart.user_id=users.id join food on cart.food_id=food.id where 1 and cart.transaction ='$transaction'". $where. " order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'] . " limit " . $requestData['start'] . " , " . $requestData['length'];

        $result = $this->db->query($sql)->result();
        $totalFiltered = (count($result) > 0) ? count($result) : 0;

        $data = array();
        foreach ($result as $r) {  // preparing an array
            $nestedData = array();
            $nestedData[] = ++$requestData['start'];
            $nestedData[] = $r->user_name;
            $nestedData[] = $r->food_name;
            $nestedData[] = $r->quantity;
            $nestedData[] = $r->total_price;
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
