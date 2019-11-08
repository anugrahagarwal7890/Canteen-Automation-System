<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {

    function __construct() {
        parent::__construct();
        Modules::run("admin/admin_ini/admin_ini");
    }

    private function get_data() {
        $return['total_users'] = $this->db->query("select count(id) as total from users where status=1 and user_type=2")->row()->total;
//        $return['total_club'] = $this->db->query("select count(id) as total from club where status=1")->row()->total;
//        $return['total_event'] = $this->db->query("select count(id) as total from event where status=1")->row()->total;
//        $return['total_team'] = $this->db->query("select count(id) as total from team where status=1")->row()->total;
//        $return['total_course'] = $this->db->query("select count(id) as total from course where status=1")->row()->total;
//        $return['total_branch'] = $this->db->query("select count(id) as total from branch where status=1")->row()->total;
//        $return['feedback'] = $this->db->query("select count(id) as total from feedback where status=1")->row()->total;
        return $return;
    }

    public function index() {
        $view_data['tab'] = "dashboard";
        $view_data['result'] = $this->get_data();
        $data['page_data'] = $this->load->view('dashboard/dashboard', $view_data, TRUE);
        $data['page_title'] = "Dashboard";
        echo Modules::run(ANUGRAH_TEMPLATE, $data);
    }

}
