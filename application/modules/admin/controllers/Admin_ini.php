<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_ini extends MX_Controller {

    function __construct() {
        parent::__construct();
//        $this->output->delete_cache();
//        $this->db->cache_delete();
        $this->db->cache_delete_all();

    }

    public function admin_ini() {
        if (!$this->session->userdata('active_admin_id')) {
            redirect('admin/login');
        }
        $this->login_ini();
    }

    public function login_ini() {
        
        if (!defined('ANUGRAH_ASSESTS'))
            define('ANUGRAH_ASSESTS', base_url() . 'anugrah_assests/');

        if (!defined('ANUGRAH_IMAGES'))
            define('ANUGRAH_IMAGES', base_url() . 'uploads/');

        if (!defined('ANUGRAH_URL'))
            define('ANUGRAH_URL', base_url() . 'index.php/admin/');

        if (!defined('ANUGRAH_TEMPLATE'))
            define('ANUGRAH_TEMPLATE', 'admin/template/index');
    }

}
