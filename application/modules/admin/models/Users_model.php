<?php

class Users_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function index($type)
    {
        $input = $this->input->post();
        if (isset($_GET["id"]) && $_GET["id"]) {
            $this->db->where('id', $_GET["id"]);
            $return['users'] = $this->db->get("users")->row_array();
            return $return;
        }
        if ($input)
        {
            if (isset($input["id"]))
            {

                $user_info = array(
                    'university_roll'=>htmlentities($input['university_roll']),
                    'name' => htmlentities($input['name']),
                    'email' => htmlentities($input['email']),
                    'mobile' => htmlentities($input['mobile']),
                    'year_id' =>htmlentities($input['year_id']),
                    'member_id' =>htmlentities($input['member_id']),
                    'device_token'=>htmlentities("jjjj"),
                    'course_id' => htmlentities($input['course_id']),
                    'branch_id' => htmlentities($input['branch_id']),
                    'user_type' => $type,
                    'modify'=>time()
                );
                if (isset($input["password"]) && $input["password"]) {
                    $user_info["password"] = htmlentities(md5($input["password"]));
                }
                $this->db->where("id", $input["id"]);
                $this->db->update("users", $user_info);
            }
            else
            {
                $user_info = array(
                    'university_roll'=>htmlentities($input['university_roll']),
                    'name' => htmlentities($input['name']),
                    'email' => htmlentities($input['email']),
                    'password'=>htmlentities(md5($input['password'])),
                    'mobile' => htmlentities($input['mobile']),
                    'year_id' => htmlentities($input['year_id']),
                    'member_id'=>htmlentities($input['member_id']),
                    'course_id' => htmlentities($input['course_id']),
                    'branch_id' => htmlentities($input['branch_id']),
                    'device_token'=>htmlentities("jjjj"),
                    'user_type' => $type,
                    'created'=>time(),
                    'status' => 1
                );
                $this->db->insert('users', $user_info);
            }
        }
        return [];
    }

    function ajax_user_list($type) {
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'id',
            1 => 'university_roll',
            2=>'member.name',
            3 => 'name',
            4 => 'email',
            5 => 'mobile',
            6=>'branch.branch',
            7=>'course.branch',
            8=>'year.name'
        );
        $query = "SELECT count(id) as total FROM users where status=1 and user_type=2";
        $query = $this->db->query($query)->row_array();
        $totalData = (count($query) > 0) ? $query['total'] : 0;

        $where = " AND user_type=" . $type;
        if (!empty($requestData['columns'][1]['search']['value'])) {   //name
            $where .= " AND university_roll LIKE'" . $requestData['columns'][1]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][2]['search']['value'])) {   //name
            $where .= " AND member.name LIKE'" . $requestData['columns'][2]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][3]['search']['value'])) {   //name
            $where .= " AND name =" . $requestData['columns'][3]['search']['value'];
        }
        if (!empty($requestData['columns'][4]['search']['value'])) {   //name
            $where .= " AND email LIKE'" . $requestData['columns'][4]['search']['value'] . "%' ";
        }

        if (!empty($requestData['columns'][5]['search']['value'])) {   //name
            $where .= " AND mobile LIKE'" . $requestData['columns'][5]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][6]['search']['value'])) {   //name
            $where .= " AND branch.branch LIKE'" . $requestData['columns'][6]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][7]['search']['value'])) {   //name
            $where .= " AND course.course LIKE'" . $requestData['columns'][7]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][8]['search']['value'])) {   //name
            $where .= " AND year.name LIKE'" . $requestData['columns'][8]['search']['value'] . "%' ";
        }

        $sql = "SELECT users.*,year.name as year_name,member.name as member_name,course.course as course_name,branch.branch as branch_name FROM users join course on users.course_id=course.id join branch on users.branch_id=branch.id join year on users.year_id=year.id join member on users.member_id=member.id where 1 and users.user_type=2" . $where . " order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'] . " limit " . $requestData['start'] . " , " . $requestData['length'];
        $result = $this->db->query($sql)->result();
        $totalFiltered = (count($result) > 0) ? count($result) : 0;

        $data = array();
        foreach ($result as $r) {  // preparing an array
            $nestedData = array();
            $nestedData[] = ++$requestData['start'];
            $nestedData[] = $r->university_roll;
            $nestedData[] = $r->member_name;
            $nestedData[] = "<a href='#'>$r->name</a>";
            $nestedData[] = $r->email;
            $nestedData[] = $r->mobile;
            $nestedData[] = $r->branch_name;
            $nestedData[] = $r->course_name;
            $nestedData[] = $r->year_name;
            $nestedData[] = "<a class='btn btn-success btn-xs' href='" . ANUGRAH_URL . "users/index?id=" . $r->id . "'>Edit</a>";
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
