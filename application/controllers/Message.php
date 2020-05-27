<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('User_model');
	}
	
		
	
	
	public function index()
	{
		if(!$this->session->userdata('name'))
		{
			redirect('auth');
		}else{
		$data['title'] = 'chat Me';
		$data['user'] = $this->User_model->getUser($this->session->userdata('id'));
		$data['id'] = $this->session->userdata('id');
		$data['userActive'] = $this->User_model->getAllUser($this->session->userdata('id'));
		
		// var_dump($data['userActive']);
		// die();
		$this->load->view('Message/index', $data);
		}
	
		
	}

	public function getUserData(){
		echo json_encode($this->User_model->GetUserTarget($_POST['data']));
		
	}

	public function sendMessage()
	{
		echo json_encode($this->User_model->sending($_POST['data']));
	}
}
