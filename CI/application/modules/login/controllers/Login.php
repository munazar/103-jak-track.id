<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		# Pastikan Bahwa User Login
        if($this->session->userdata('is_logged_in')==TRUE){
			redirect('main');
		}
    }

	public function index(){
		$this->load->view('login_test');
	}

	function validation_credential(){
		$this->form_validation->set_rules('username','username','trim|required');
		$this->form_validation->set_rules('password','password','trim|required');
		if($this->form_validation->run()===TRUE){
			$this->load->model('validation_user');
			if($this->validation_user->validate()==TRUE){
				redirect('main');
			}else{
				$alert = array('tipe' => 'danger', 'msg' => 'Username atau Password yang anda masukkan salah');
				$this->session->set_flashdata('error_login', $alert);
				redirect('login');
			}
		}else{
			$alert = array('tipe' => 'danger', 'msg' => 'Username atau Password yang anda masukkan salah');
			$this->session->set_flashdata('error_login', $alert);
			redirect('login');
		}
	}

	public function validation_credential_(){
		$username = $this->input->post('username', true);
		$password = $this->input->post('password', true);
		if($username=='admincbso'){
			$data = array(
				    	'cbso_is_logged_in' 	=> TRUE,
				    	'cbso_login_time' 	=> date('Y-m-d H:i:s')
				    );
		}elseif($username=='adminmonev'){
			$data = array(
				    	'monev_is_logged_in' 	=> TRUE,
				    	'monev_login_time' 	=> date('Y-m-d H:i:s')
				    );
		}else{
			$alert = array('tipe' => 'danger', 'msg' => 'Username atau Password yang anda masukkan salah');
			$this->session->set_flashdata('error_login', $alert);
			redirect('login');
		}
		$this->session->set_userdata($data);
		redirect('main');
		
	}
}
