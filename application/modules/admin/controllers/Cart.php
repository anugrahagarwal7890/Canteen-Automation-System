<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MX_Controller {

    function __construct() {
        parent::__construct();
        Modules::run("admin/admin_ini/admin_ini");
        $this->load->model("Cart_model");
    }

    public function index()
    {
        $view_data['tab'] = "cart_management";
        $view_data['page'] = "cart";
        $view_data['cart'] = $this->Cart_model->get_cart();
        $data['page_data'] = $this->load->view('cart/cart', $view_data, TRUE);
        $data['page_title'] = "Without Confirm Orders";
        echo Modules::run(ANUGRAH_TEMPLATE, $data);
    }

    function ajax_cart_list() {
        $this->Cart_model->ajax_cart_list(1);
    }

    public function today_cart()
    {
        $view_data['tab'] = "cart_management";
        $view_data['page'] = "today_cart";
        $view_data['cart'] = $this->Cart_model->get_cart();
        $data['page_data'] = $this->load->view('cart/today_cart', $view_data, TRUE);
        $data['page_title'] = "Today Orders";
        echo Modules::run(ANUGRAH_TEMPLATE, $data);
    }

    function ajax_today_cart_list()
    {
        $this->Cart_model->ajax_cart_list(2);
    }

    public function cart_with_payment()
    {
        $view_data['tab'] = "cart_management";
        $view_data['page'] = "cart_with_payment";
        $view_data['cart'] = $this->Cart_model->get_cart();
        $data['page_data'] = $this->load->view('cart/cart_with_payment', $view_data, TRUE);
        $data['page_title'] = "Confirm Orders";
        echo Modules::run(ANUGRAH_TEMPLATE, $data);
    }

    function ajax_cart_with_payment()
    {
        $this->Cart_model->ajax_cart_list(3);
    }
}
