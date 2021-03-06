<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class User extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Issue_model');
    } 

    /*
     * Listing of users
     */
    function index()
    {
        $data['users'] = $this->User_model->get_all_users();
        
        $data['_view'] = 'user/index';
        $this->load->view('layouts/main',$data);
    }
    
    public function account(){
        $data = array();
        if($this->session->userdata('isUserLoggedIn')){
			$user = $this->session->userdata('user');
			$data['issues'] = $this->Issue_model->get_issue_params(array('assigned_to_id' => $user['id']));
            $data['user'] = $this->User_model->get_user($this->session->userdata('userId'));
            $this->session->set_userdata($data);
            //load the view
            $dat['_view'] = 'user/account';
            $dat['issues'] = $data['issues'];
			$this->load->view('layouts/main',$dat);
        }else{
            redirect('user/login');
        }
    }

    /*
     * Adding a new user
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'admin' => $this->input->post('admin'),
				'login' => $this->input->post('login'),
				'hash' => password_hash($this->input->post('hash'), PASSWORD_DEFAULT),
				'firstname' => $this->input->post('firstname'),
				'surname' => $this->input->post('surname'),
            );
            
            $user_id = $this->User_model->add_user($params);
            redirect('user/index');
        }
        else
        {            
            $data['_view'] = 'user/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a user
     */
    function edit($id)
    {   
        // check if the user exists before trying to edit it
        $data['user'] = $this->User_model->get_user($id);
        
        if(isset($data['user']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'admin' => $this->input->post('admin'),
					'login' => $this->input->post('login'),
					'firstname' => $this->input->post('firstname'),
					'surname' => $this->input->post('surname'),
                );

                $this->User_model->update_user($id,$params);            
                redirect('user/index');
            }
            else
            {
                $data['_view'] = 'user/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The user you are trying to edit does not exist.');
    } 

    /*
     * Deleting user
     */
    function remove($id)
    {
        $user = $this->User_model->get_user($id);

        // check if the user exists before trying to delete it
        if(isset($user['id']))
        {
            $this->User_model->delete_user($id);
            redirect('user/index');
        }
        else
            show_error('The user you are trying to delete does not exist.');
    }
    
    function login()
    {
		if(isset($_POST) && count($_POST) > 0)     
        {   
			$login = $this->input->post('login');
			$passwd = $this->input->post('hash');
			$user = $this->User_model->get_user_login($login);
			if (isset($user['id'])) {
				if (password_verify($passwd, $user['hash'])) {
					$this->session->set_userdata('isUserLoggedIn',TRUE);
                    $this->session->set_userdata('userId',$user['id']);
                    redirect('user/account/');
				} else {
					show_error('Please enter valid password!');
				}
			} else {
				show_error('Please enter valid login!');
			}
		} else
        {            
            $data['_view'] = 'user/login';
            $this->load->view('layouts/main',$data);
        }
	}
	
	public function logout() {

        $this->session->unset_userdata('isUserLoggedIn');
        $this->session->unset_userdata('userId');
        $this->session->sess_destroy();
        redirect('user/login/');
    }
    
	public static function checkAuth() {

        if (isset($_SESSION['name'])) {
            return true;
        }
        
        return false;
    }

    public static function isGuest() {

        if (isset($_SESSION['name'])) {
            return false;
        }

        return true;
    }
    
}
