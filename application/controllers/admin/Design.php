<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Design extends Admin_Controller {
    
    function __construct() {
        parent::__construct();
    }
    function index(){
        $this->load->view("admin/includes/header");
        $this->load->view("admin/design");
        $this->load->view("admin/includes/footer");
    }
}
