<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Dashboard extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Issue_model');
        
    }

    function index()
    {
        $data['issues'] = $this->Issue_model->get_all_issues();
        
        $data['_view'] = 'issue/index';
        $this->load->view('layouts/main',$data);
    }
    
    function adminPanel()
    {
		
	}
}
