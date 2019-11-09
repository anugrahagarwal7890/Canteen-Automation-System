<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {

    function __construct() {
        parent::__construct();
        Modules::run("admin/admin_ini/admin_ini");
    }

    private function get_data() {
        $return['total_users'] = $this->db->query("select count(id) as total from users where status=1 and user_type=2")->row()->total;
        $return['total_food'] = $this->db->query("select count(id) as total from food where status=1")->row()->total;
		$return['not_confirm_cart'] = $this->db->query("select count(id) as total from cart where status=1 and transaction=2")->row()->total;
		$return['confirm_cart'] = $this->db->query("select count(id) as total from cart where status=1 and transaction=1")->row()->total;
		$return['total_today_cart'] = $this->db->query("select count(id) as total from cart where status=1 and from_unixtime(modify, '%Y-%d-%m')='". date("Y-d-m")."'")->row()->total;
		$return['category'] = $this->db->query("select count(id) as total from category where status=1")->row()->total;
        $return['feedback'] = $this->db->query("select count(id) as total from feedback where status=1")->row()->total;
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
