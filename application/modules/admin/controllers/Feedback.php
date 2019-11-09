<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends MX_Controller {

    function __construct() {
        parent::__construct();
        Modules::run("admin/admin_ini/admin_ini");
        $this->load->model("Feedback_model");
    }
    public function index()
    {
        $view_data['result'] = $this->Feedback_model->get_feedback();
        $view_data['tab'] = "feedback";
        $data['page_data'] = $this->load->view('feedback/feedback', $view_data, TRUE);
        $data['page_title'] = "Feedback";
        echo Modules::run(ANUGRAH_TEMPLATE, $data);
    }

    function ajax_feedback_list()
    {
        $this->Feedback_model->ajax_feedback_list();
    }
}
