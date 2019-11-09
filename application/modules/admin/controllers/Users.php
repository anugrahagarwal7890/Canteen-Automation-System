<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        Modules::run("admin/admin_ini/admin_ini");
        $this->load->model("Users_model");
    }

    public function index()
    {
        $view_data['result'] = $this->Users_model->index(2);
        $view_data['tab'] = "user management";
		$view_data['year']=$this->Users_model->get_year();
        $view_data['page'] = "users";
        $data['page_data'] = $this->load->view('users/users', $view_data, TRUE);
        $data['page_title'] = "CUSTOMER";
        echo Modules::run(ANUGRAH_TEMPLATE, $data);
    }
	function ajax_student_list()
	{
		$this->Users_model->ajax_user_list(2);
	}

	public function year()
	{
		$view_data['result'] = $this->Users_model->year();
		$view_data['tab'] = "activity management";
		$view_data['page'] = "year";
		$data['page_data'] = $this->load->view('users/year', $view_data, TRUE);
		$data['page_title'] = "Year";
		echo Modules::run(ANUGRAH_TEMPLATE, $data);
	}
	function ajax_year_list()
	{
		$this->Users_model->ajax_year_list();
	}
}
