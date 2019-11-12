<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MX_Controller
{
	function __construct() {
		parent::__construct();
		Modules::run("admin/admin_ini/admin_ini");
	}

	public function index() {
		$data['page_data'] = $this->load->view('api/api', array(), TRUE);
		$data['page_title'] = "Api Panel";
		echo Modules::run(ANUGRAH_TEMPLATE, $data);
	}
}
