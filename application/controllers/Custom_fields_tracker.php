<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Custom_fields_tracker extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Custom_fields_tracker_model');
    } 

    /*
     * Listing of custom_fields_trackers
     */
    function index()
    {
        $data['custom_fields_trackers'] = $this->Custom_fields_tracker_model->get_all_custom_fields_trackers();
        
        $data['_view'] = 'custom_fields_tracker/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new custom_fields_tracker
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
            );
            
            $custom_fields_tracker_id = $this->Custom_fields_tracker_model->add_custom_fields_tracker($params);
            redirect('custom_fields_tracker/index');
        }
        else
        {            
            $data['_view'] = 'custom_fields_tracker/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a custom_fields_tracker
     */
    function edit($custom_field_id)
    {   
        // check if the custom_fields_tracker exists before trying to edit it
        $data['custom_fields_tracker'] = $this->Custom_fields_tracker_model->get_custom_fields_tracker($custom_field_id);
        
        if(isset($data['custom_fields_tracker']['custom_field_id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
                );

                $this->Custom_fields_tracker_model->update_custom_fields_tracker($custom_field_id,$params);            
                redirect('custom_fields_tracker/index');
            }
            else
            {
                $data['_view'] = 'custom_fields_tracker/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The custom_fields_tracker you are trying to edit does not exist.');
    } 

    /*
     * Deleting custom_fields_tracker
     */
    function remove($custom_field_id)
    {
        $custom_fields_tracker = $this->Custom_fields_tracker_model->get_custom_fields_tracker($custom_field_id);

        // check if the custom_fields_tracker exists before trying to delete it
        if(isset($custom_fields_tracker['custom_field_id']))
        {
            $this->Custom_fields_tracker_model->delete_custom_fields_tracker($custom_field_id);
            redirect('custom_fields_tracker/index');
        }
        else
            show_error('The custom_fields_tracker you are trying to delete does not exist.');
    }
    
}
