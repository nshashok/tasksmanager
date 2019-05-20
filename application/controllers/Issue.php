<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Issue extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Issue_model');
         $this->load->model('Commentary_model');
    } 

    /*
     * Listing of issues
     */
    function index()
    {
        $data['issues'] = $this->Issue_model->get_all_issues();
        
        $data['_view'] = 'issue/index';
        $this->load->view('layouts/main',$data);
    }
    
    function view($id) {
		$data['issue'] = $this->Issue_model->get_issue($id);
		$this->load->model('User_model');
			$data['all_users'] = $this->User_model->get_all_users();

			$this->load->model('Status_model');
			$data['all_statuses'] = $this->Status_model->get_all_statuses();
			$data['all_users'] = $this->User_model->get_all_users();

			$this->load->model('Tracker_model');
			$data['all_trackers'] = $this->Tracker_model->get_all_trackers();
			$data['all_users'] = $this->User_model->get_all_users();
		$data['_view'] = 'issue/view';
                $this->load->view('layouts/main',$data);
	}

    /*
     * Adding a new issue
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
			$user = $this->session->userdata('user');
			if ($user == null) {
				redirect('issue/index');
			}
            $params = array(
				'author' => $user['id'],
				'status' => $this->input->post('status'),
				'assigned_to_id' => $this->input->post('assigned_to_id'),
				'tracker_id' => $this->input->post('tracker_id'),
				'last_changer' => $user['id'],
				'title' => $this->input->post('title'),
				'created_on' => $this->input->post('created_on'),
				'updated_on' => $this->input->post('updated_on'),
				'start_date' => $this->input->post('start_date'),
				'due_date' => $this->input->post('due_date'),
				'end_date' => $this->input->post('end_date'),
				'description' => $this->input->post('description'),
            );
            
            $issue_id = $this->Issue_model->add_issue($params);
            redirect('issue/index');
        }
        else
        {
			$this->load->model('User_model');
			$data['all_users'] = $this->User_model->get_all_users();

			$this->load->model('Status_model');
			$data['all_statuses'] = $this->Status_model->get_all_statuses();
			$data['all_users'] = $this->User_model->get_all_users();

			$this->load->model('Tracker_model');
			$data['all_trackers'] = $this->Tracker_model->get_all_trackers();
			$data['all_users'] = $this->User_model->get_all_users();
            
            $data['_view'] = 'issue/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a issue
     */
    function edit($id)
    {   
        // check if the issue exists before trying to edit it
        $data['issue'] = $this->Issue_model->get_issue($id);
        
        if(isset($data['issue']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'author' => $this->input->post('author'),
					'status' => $this->input->post('status'),
					'assigned_to_id' => $this->input->post('assigned_to_id'),
					'tracker_id' => $this->input->post('tracker_id'),
					'last_changer' => $this->input->post('last_changer'),
					'title' => $this->input->post('title'),
					'created_on' => $this->input->post('created_on'),
					'updated_on' => $this->input->post('updated_on'),
					'start_date' => $this->input->post('start_date'),
					'due_date' => $this->input->post('due_date'),
					'end_date' => $this->input->post('end_date'),
					'description' => $this->input->post('description'),
                );

                $this->Issue_model->update_issue($id,$params);            
                redirect('issue/index');
            }
            else
            {
				$this->load->model('User_model');
				$data['all_users'] = $this->User_model->get_all_users();

				$this->load->model('Status_model');
				$data['all_statuses'] = $this->Status_model->get_all_statuses();
				$data['all_users'] = $this->User_model->get_all_users();

				$this->load->model('Tracker_model');
				$data['all_trackers'] = $this->Tracker_model->get_all_trackers();
				$data['all_users'] = $this->User_model->get_all_users();

                $data['_view'] = 'issue/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The issue you are trying to edit does not exist.');
    } 

    /*
     * Deleting issue
     */
    function remove($id)
    {
        $issue = $this->Issue_model->get_issue($id);

        // check if the issue exists before trying to delete it
        if(isset($issue['id']))
        {
            $this->Issue_model->delete_issue($id);
            redirect('issue/index');
        }
        else
            show_error('The issue you are trying to delete does not exist.');
    }
    
    function add_comment($ne_id)
    {
        // get a post id based on news id
        $issue = $this->Issue_model->get_issue($id);
        //set validation rules
        $this->form_validation->set_rules('comment_name', 'Name', 'required|trim|htmlspecialchars');
        $this->form_validation->set_rules('comment_body', 'comment_body', 'required|trim|htmlspecialchars');
        if ($this->form_validation->run() == FALSE) {
            // if not valid load comments
            $this->session->set_flashdata('error_msg', validation_errors());
            redirect("news/show_one/$ne_id");
        } else {
            //if valid send comment to admin to tak approve
            $this->comment_model->add_new_comment();
            redirect("news/show_one/$ne_id");
        }
    }
    
}
