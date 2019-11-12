<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model("Home_model");
    }

    public function get_home_user() {
        $input = $this->validate_get_home_user();
        if ($input) {
            $this->Home_model->get_home_user($input);
        }
    }
    function validate_get_home_user() {
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            return_data(FALSE, array_values($this->form_validation->get_all_errors()), []);
        }
        return $this->input->post();
    }
	function validate_food() {
		$this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
		$this->form_validation->set_rules('category_id', 'category_id', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			return_data(FALSE, array_values($this->form_validation->get_all_errors()), []);
		}
		return $this->input->post();
	}
    public function category()
    {
        $input = $this->validate_get_home_user();
        if ($input) {
            $result = $this->Home_model->category($input);
            if ($result) {
                return_data(TRUE, "Category Displayed", $result);
            }
            return_data(FALSE, "Category Not Found", array());
        }
    }
	public function food()
	{
		$input = $this->validate_food();
		if ($input) {
			$result = $this->Home_model->food($input);
			if ($result) {
				return_data(TRUE, "Category Displayed", $result);
			}
			return_data(FALSE, "Category Not Found", array());
		}
	}
	public function feedback() {
		if ($input = $this->validate_feedback()) {
			$result = $this->Home_model->feedback($input);
			if ($result) {
				return_data(TRUE, "Feedback Submitted", array());
			}
			return_data(FALSE, "Feedback Failed", array());
		}
	}
	function validate_feedback()
	{
		$this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
		$this->form_validation->set_rules('feedback', 'feedback', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			return_data(FALSE, array_values($this->form_validation->get_all_errors()), []);
		}
		return $this->input->post();
	}
	public function myorder()
	{
		$input = $this->validate_get_home_user();
		if ($input) {
			$result = $this->Home_model->myorder($input);
			if ($result) {
				return_data(TRUE, "My Order List Displayed", $result);
			}
			return_data(FALSE, "No Order Found", array());
		}
	}
	public function today_order()
	{
		if ($input = $this->validate_get_home_user()) {
			$this->Home_model->today_order($input);
		}
	}
	public function cart()
	{
		$input=$this->validate_cart();
		if ($input)
		{
			$this->Home_model->cart($input);
		}
	}
	function validate_cart()
	{
		$this->form_validation->set_rules('cart_id', 'cart_id', 'trim|required');
		$this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
		$this->form_validation->set_rules('food_id', 'food_id', 'trim|required');
		$this->form_validation->set_rules('quantity', 'quantity', 'trim|required');
		$this->form_validation->set_rules('transaction', 'transaction', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			return_data(FALSE, array_values($this->form_validation->get_all_errors()), []);
		}
		return $this->input->post();
	}
    public function remove()
    {
        $input=$this->validate_cart_id();
        if ($input)
        {
            $this->Home_model->get_remove_cart($input);
        }
    }
    function validate_cart_id()
    {
        $this->form_validation->set_rules('cart_id','cart_id','trim|required');
        if ($this->form_validation->run()==FALSE)
        {
            return_data(FALSE,array_values($this->form_validation->get_all_erros()),[]);
        }
        return $this->input->post();
    }

}


