<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller {
	
	public function __construct() {
        parent::__construct();
        //If user ins not logged in redirect
        if (!$this->aauth->is_loggedin()){
            redirect('auth');
        }

    }



	/**
 * Create a new user
 */
    public function create_user() {
        $this->load->model('user_model');
        $this->data['page_title'] = 'utilisateur';

        if (!$this->aauth->is_loggedin() || !$this->aauth->is_admin()) {
            redirect('user', 'refresh');
        }


        // validate form input
        $this->form_validation->set_rules('nom','Nom','trim|required');
        $this->form_validation->set_rules('prenom','Prenom','trim|required');
        $this->form_validation->set_rules('telephone', 'Telephone', 'trim');
        $this->form_validation->set_rules('adresse', 'Adresse', 'trim');
        $this->form_validation->set_rules('pass1','Password','trim|required');
        $this->form_validation->set_rules('pass2',' Confirm Password','required|matches[pass1]');

        if ($this->form_validation->run() === TRUE) {
            $prenom = $this->input->post('prenom');
            $nom = $this->input->post('nom');
            $telephone = $this->input->post('telephone');
            $adresse= $this->input->post('adresse');
            $email = strtolower($this->input->post('email'));
            $pass = $this->input->post('pass1');


        }
        if ($this->form_validation->run() === TRUE && $this->aauth->create_user($email, $pass) && $this->user_model->addUser($prenom,$nom,$telephone,$adresse,$email) ) {
            // check to see if we are creating the user
            // redirect them back to the admin page

            $this->session->set_flashdata('register_success', 'Un utilisateur a été créés avec succés!!');
            redirect("user/listeUser", 'refresh');
        } else {
            // display the create user form
            // set the flash data error message if there is one

            $this->session->set_flashdata('register_error', 'echec d enregistrement!!');


            $this->render('auth' . DIRECTORY_SEPARATOR . 'create_user');
        }
    }


//
	
	//déconnection
    public function logout(){
        $this->aauth->logout();
        redirect('auth');
	}
	

	//index
	public function index() {

        if (!$this->aauth->is_loggedin()) {
            // redirect them to the login page
            redirect('user/login', 'refresh');
        } 
        else {
            $this->data['page_title'] = 'index';

            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

         
            $this->render('auth' . DIRECTORY_SEPARATOR . 'admin');
        }
	}
	


    /**
     *liste des utilisateurs
     */
    public function listeUser() {
        if (!$this->aauth->is_loggedin() || !$this->aauth->is_admin()) {
            // redirect them to the login page
            redirect('user/login', 'refresh');
        } else {

            $this->data['page_title'] = $this->lang->line('index_heading');
            $this->render('auth' . DIRECTORY_SEPARATOR . 'index');
        }
	}

    /**
     *
     */
    public function getList()
    {
        $list = $this->user_model->getListes();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $l) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $l->prenom;
            $row[] = $l->nom;
            $row[] = $l->telephone;
            $row[] = $l->adresse;
            $row[] = $l->email;



            $lien1 = '<a href="#" class="btn btn-primary" title="Modifier"><span class="fa fa-edit"></span></a>';

            $row[] = $lien1;


            $data[] = $row;
        }

        // Structure des données à retourner
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->user_model->count_all(),
            "recordsFiltered" => $this->user_model->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }

		

		
}