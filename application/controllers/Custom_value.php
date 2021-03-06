<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Custom_value extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Custom_value_model');
    } 

    /*
     * Listing of custom_values
     */
    function index()
    {
        $data['custom_values'] = $this->Custom_value_model->get_all_custom_values();
        
        $data['_view'] = 'custom_value/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new custom_value
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'issue_id' => $this->input->post('issue_id'),
				'tracker_id' => $this->input->post('tracker_id'),
				'custom_field_id' => $this->input->post('custom_field_id'),
				'lock_version' => $this->input->post('lock_version'),
				'value' => $this->input->post('value'),
            );
            
            $custom_value_id = $this->Custom_value_model->add_custom_value($params);
            redirect('custom_value/index');
        }
        else
        {
			$this->load->model('Issue_model');
			$data['all_issues'] = $this->Issue_model->get_all_issues();
            
            $data['_view'] = 'custom_value/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a custom_value
     */
    function edit($id)
    {   
        // check if the custom_value exists before trying to edit it
        $data['custom_value'] = $this->Custom_value_model->get_custom_value($id);
        
        if(isset($data['custom_value']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'issue_id' => $this->input->post('issue_id'),
					'tracker_id' => $this->input->post('tracker_id'),
					'custom_field_id' => $this->input->post('custom_field_id'),
					'lock_version' => $this->input->post('lock_version'),
					'value' => $this->input->post('value'),
                );

                $this->Custom_value_model->update_custom_value($id,$params);            
                redirect('custom_value/index');
            }
            else
            {
				$this->load->model('Issue_model');
				$data['all_issues'] = $this->Issue_model->get_all_issues();

                $data['_view'] = 'custom_value/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The custom_value you are trying to edit does not exist.');
    } 

    /*
     * Deleting custom_value
     */
    function remove($id)
    {
        $custom_value = $this->Custom_value_model->get_custom_value($id);

        // check if the custom_value exists before trying to delete it
        if(isset($custom_value['id']))
        {
            $this->Custom_value_model->delete_custom_value($id);
            redirect('custom_value/index');
        }
        else
            show_error('The custom_value you are trying to delete does not exist.');
    }
    
}
