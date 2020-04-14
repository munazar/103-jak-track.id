<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index(){
		if($this->session->userdata('is_logged_in')==TRUE){
			$this->show_page();
		}else{
			redirect('login');
		}
	}

	function show_page(){
		$data = array();
		$data['main_view'] = 'v_main';
        $this->load->view('header',$data);
        $this->load->view('body',$data);
        $this->load->view('footer',$data);
	}
}
