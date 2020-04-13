<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Admin_Controller {
	


    public function __construct() {
        parent::__construct();
        $this->load->database();
//        $this->load->library(['aauth', 'form_validation']);
//        $this->load->helper(['url', 'language']);

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'aauth'), $this->config->item('error_end_delimiter', 'aauth'));
        $this->lang->load('auth');
    }
    public function index(){
        $this->load->view('template/header');
        $this->load->view('login');
        $this->load->view('template/pied');
    }
  
    //connection
    public function login(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email','Email','trim|required');
        $this->form_validation->set_rules('pass','Password','trim|required');
        if($this->form_validation->run()){
            $email=$this->input->post('email');
            $pass=$this->input->post('pass');
            if($this->aauth->login($email,$pass)){
                redirect('user');
            }
            else{
                $this->session->set_flashdata('login_error');
            }   
        }
        $this->load->view('template/header');
        $this->load->view('login');
        $this->load->view('template/pied');  
    }

    //déconnection
    public function logout(){
        $this->aauth->logout();
        redirect('auth');
    }
   
	/**
     * Create a new user
     */
    public function create_user() {
        $this->data['page_title'] = 'ajouter un utilisateur';

        if (!$this->aauth->is_loggedin() || !$this->aauth->is_admin()) {
            redirect('user', 'refresh');
        }



       

		// valide form input
		$this->form_validation->set_rules('username','Nom','trim|required');
		$this->form_validation->set_rules('email','Email','trim|required');
		$this->form_validation->set_rules('pass1','Password','trim|required');
		$this->form_validation->set_rules('pass2',' Confirm Password','required|matches[pass1]');
		
       
        if ($this->form_validation->run())  {
			$user=$this->input->post('username');
			$email=$this->input->post('email');
			$pass=$this->input->post('pass1');
			if($this->aauth->create_user($email,$pass,$user)){
				$this->session->set_flashdata('register_sucess','Un nouvel Utilisateur a été créé avec succés');
				redirect("user/listeUser", 'refresh');
			}else{
				$this->error($this->CI->lang->line('aauth_error_email_exists'));
				
			}

        } 
            $this->render('auth' . DIRECTORY_SEPARATOR . 'create_user');
        
    }



}