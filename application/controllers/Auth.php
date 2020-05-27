<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
        $data['title'] = 'login';
        $this->load->view('auths/head',$data);
        $this->load->view('auths/auth');
        $this->load->view('auths/footer');
        }else{
            $this->login();
        }
       
    }



    private  function login()
    {
        $email = $this->input->post('email');
        $pass  = $this->input->post('password');

        $data_email = $this->db->get_where('user', ['email' => $email])->row_array();
        if($data_email != null)
        {
            $data_pass = $this->db->get_where('user',['password' => $pass])->row_array();
            if($data_pass != null){
                $data = ['id' => $data_pass['id'],
                          'name' => $data_pass['name']  ];
                $this->session->set_userdata($data);
                redirect('message');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">password wrong</div>');
                redirect('auth');
            }

        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">your email is not registered</div>');
            redirect('auth');
        }
        

        
    }

    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('name');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">you have been logout</div>');
            redirect('auth');

    }

}