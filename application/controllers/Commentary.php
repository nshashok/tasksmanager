<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Commentary extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Commentary_model');
        $this->load->model('User_model');
    } 

    /*
     * Listing of commentaries
     */
    function index()
    {
        $data['commentaries'] = $this->Commentary_model->get_all_commentaries();
        $data['_view'] = 'commentary/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new commentary
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('issue_id','Issue Id','required|numeric');
		$this->form_validation->set_rules('author_id','Author Id','required|numeric');
		$this->form_validation->set_rules('value','Value','required');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'issue_id' => $this->input->post('issue_id'),
				'author_id' => $this->input->post('author_id'),
				'value' => $this->input->post('value'),
            );
            
            $commentary_id = $this->Commentary_model->add_commentary($params);
            redirect('commentary/index');
        }
        else
        {
			$this->load->model('Issue_model');
			$data['all_issues'] = $this->Issue_model->get_all_issues();

			$this->load->model('User_model');
			$data['all_users'] = $this->User_model->get_all_users();
            
            $data['_view'] = 'commentary/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a commentary
     */
    function edit($id)
    {   
        // check if the commentary exists before trying to edit it
        $data['commentary'] = $this->Commentary_model->get_commentary($id);
        
        if(isset($data['commentary']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('value','Value','required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'value' => $this->input->post('value'),
                );

                $this->Commentary_model->update_commentary($id,$params);            
                redirect('issue/view/'.$data['commentary']['issue_id']);
            }
            else
            {
				$this->load->model('Issue_model');
				$data['all_issues'] = $this->Issue_model->get_all_issues();

				$this->load->model('User_model');
				$data['all_users'] = $this->User_model->get_all_users();

                $data['_view'] = 'commentary/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The commentary you are trying to edit does not exist.');
    } 

    /*
     * Deleting commentary
     */
    function remove($id)
    {
		if ((null !== $this->session->userdata('user') && ($user = $this->session->userdata('user'))['admin'] == 1)) {
			$commentary = $this->Commentary_model->get_commentary($id);

			// check if the commentary exists before trying to delete it
			if(isset($commentary['id']))
			{
				$this->Commentary_model->delete_commentary($id);     
				echo 'deleted';      
				redirect('issue/view/'.$commentary['issue_id']);
			}
			else
				show_error('The commentary you are trying to delete does not exist.');
		} else {
			
				$this->session->set_flashdata('error_msg', 'You can\' open requested page.');
				redirect('issue/view/'.$commentary['issue_id']);
		}
    }
    
}
