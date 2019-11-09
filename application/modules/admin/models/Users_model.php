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
                    'universityrollno'=>htmlentities($input['university_roll']),
                    'name' => htmlentities($input['name']),
                    'email' => htmlentities($input['email']),
                    'mobile' => htmlentities($input['mobile']),
                    'year_id' =>htmlentities($input['year_id']),
                    'device_token'=>htmlentities("jjjj"),
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
                    'universityrollno'=>htmlentities($input['university_roll']),
                    'name' => htmlentities($input['name']),
                    'email' => htmlentities($input['email']),
                    'password'=>htmlentities(md5($input['password'])),
                    'mobile' => htmlentities($input['mobile']),
                    'year_id' => htmlentities($input['year_id']),
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
            1 => 'universityrollno',
            2=>'name',
            3 => 'email',
            4 => 'mobile',
            5=>'year.name'
        );
        $query = "SELECT count(id) as total FROM users where status=1 and user_type=2";
        $query = $this->db->query($query)->row_array();
        $totalData = (count($query) > 0) ? $query['total'] : 0;

        $where = " AND user_type=" . $type;
        if (!empty($requestData['columns'][1]['search']['value'])) {   //name
            $where .= " AND universityrollno LIKE'" . $requestData['columns'][1]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][2]['search']['value'])) {   //name
            $where .= " AND name =" . $requestData['columns'][3]['search']['value'];
        }
        if (!empty($requestData['columns'][3]['search']['value'])) {   //name
            $where .= " AND email LIKE'" . $requestData['columns'][4]['search']['value'] . "%' ";
        }

        if (!empty($requestData['columns'][4]['search']['value'])) {   //name
            $where .= " AND mobile LIKE'" . $requestData['columns'][5]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][5]['search']['value'])) {   //name
            $where .= " AND year.name LIKE'" . $requestData['columns'][8]['search']['value'] . "%' ";
        }

        $sql = "SELECT users.*,year.name as year_name FROM users join year on users.year_id=year.id where 1 and users.user_type=2" . $where . " order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'] . " limit " . $requestData['start'] . " , " . $requestData['length'];
        $result = $this->db->query($sql)->result();
        $totalFiltered = (count($result) > 0) ? count($result) : 0;

        $data = array();
        foreach ($result as $r) {  // preparing an array
            $nestedData = array();
            $nestedData[] = ++$requestData['start'];
            $nestedData[] = $r->universityrollno;
            $nestedData[] = "<a href='#'>$r->name</a>";
            $nestedData[] = $r->email;
            $nestedData[] = $r->mobile;
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
	function get_year()
	{
		$sql='select * from year where 1';
		return $this->db->query($sql)->result_array();
	}
	function year()
	{
		$input = $this->input->post();
		if (isset($_GET["id"]) && $_GET["id"]) {
			$this->db->where('id', $_GET["id"]);
			return $this->db->get("year")->row_array();
		}
		if ($input)
		{
			if (isset($input["id"]))
			{
				$year_info = array(
					'name' => $input['name']
				);
				$this->db->where("id", $input["id"]);
				$this->db->update("year", $year_info);
			}
			else
			{
				$year_info = array(
					'name' => $input['name'],
					'created'=>time(),
					'status' => 1
				);
				$this->db->insert('year', $year_info);
			}
		}
		return [];
	}

	function ajax_year_list() {
		$requestData = $_REQUEST;
		$columns = array(
			0 => 'id',
			1 => 'name',
			2=>'status'
		);
		$query = "SELECT count(id) as total FROM year where status=1";
		$query = $this->db->query($query)->row_array();
		$totalData = (count($query) > 0) ? $query['total'] : 0;

		$where = "";
		if (!empty($requestData['columns'][1]['search']['value'])) {   //name
			$where .= " AND name LIKE'" . $requestData['columns'][1]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][2]['search']['value'])) {   //name
			$where .= " AND status LIKE'" . $requestData['columns'][2]['search']['value'] . "%' ";
		}

		$sql = "SELECT * FROM year where 1 " . $where . " order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'] . " limit " . $requestData['start'] . " , " . $requestData['length'];
		$result = $this->db->query($sql)->result();
		$totalFiltered = (count($result) > 0) ? count($result) : 0;

		$data = array();
		foreach ($result as $r) {  // preparing an array
			$nestedData = array();
			$nestedData[] = ++$requestData['start'];
			$nestedData[] = $r->name;
			$nestedData[] = "<a class='btn btn-success btn-xs' href='" . ANUGRAH_URL . "users/year?id=" . $r->id . "'>Edit</a>";
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
