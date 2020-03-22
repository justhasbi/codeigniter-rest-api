<?php 

class Dashboard_admin extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // load view admin dashboard_admin.php

        $this->load->view("admin/dashboard_admin");
    }
}