<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct(){
		parent::__construct();
		# Pastikan Bahwa User Login
        if($this->session->userdata('is_logged_in')==FALSE){
			redirect('login');
		}
    }

	public function index(){
		$data = array();
		$data['main_view'] = 'v_profile';
		$data['title'] = 'Profile Settings';
        $this->load->view('header',$data);
        $this->load->view('body',$data);
        $this->load->view('footer',$data);
	}

}
