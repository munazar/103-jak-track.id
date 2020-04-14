<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistem extends CI_Controller {

	public function __construct(){
		parent::__construct();
		# Pastikan Bahwa User Login
        if($this->session->userdata('is_logged_in')==FALSE){
			redirect('login');
		}
    }

	function group(){
		
		$this->load->model('m_system', 'sistem');
		$data['ls_data'] = $this->sistem->get_table('sys_groups');
		$data['main_view'] = 'v_list_group';
		$data['title'] = 'Group User';
        $this->load->view('header',$data);
        $this->load->view('body',$data);
        $this->load->view('footer',$data);
	}

	function user(){
		$this->load->model('m_system', 'sistem');
		$data['ls_data'] = $this->sistem->get_table('sys_users');
		$data['main_view'] = 'v_list_user';
		$data['title'] = 'User Management';
        $this->load->view('header',$data);
        $this->load->view('body',$data);
        $this->load->view('footer',$data);	
	}

	function v_user($enc=''){
		$data['enc'] = $enc;
		$userid = decrypt_val($enc);
		if(intval($userid>0)){
			$this->load->model('m_system', 'sistem');
			$data['ls_group'] = $this->sistem->get_table('sys_groups');
			$where = array('userid' => $userid);
			$ls_user = $this->sistem->get_table('v_user', $where);
			if($ls_user->num_rows()>0){
				$data['ls_user'] = $ls_user->row();	
			}else{
				$alert = array('tipe' => 'danger', 'msg' => 'Kesalahan data');
				$this->session->set_flashdata('error_v_user', $alert);
				redirect('sistem/user');
			}
			
		}
		$data['main_view'] = 'v_edit_user';
		$data['title'] = 'Edit User';
        $this->load->view('header',$data);
        $this->load->view('body',$data);
        $this->load->view('footer',$data);	
	}

	function save_user(){
		$username = $this->input->post('username', true);
		$userid = decrypt_val($this->input->post('enc', true));
		$passwd = '';
		$this->load->model('m_system', 'sistem');
		if(!empty($this->input->post('passwd'))){
			if($this->input->post('passwd')!==$this->input->post('confirm_passwd')){
				$alert = array('tipe' => 'danger', 'msg' => 'Password tidak sama');
				$this->session->set_flashdata('error_paswd', $alert);	
				redirect('sistem/v_user/'.$this->input->post('enc', true));
			}else{
				//enkrip password
				$passwd = $this->input->post('passwd', true);
				$code_activation = md5(uniqid());
				$password = $this->arr2md5(array($code_activation,$passwd));
				$activation = $this->arr2md5(array($this->input->post('fullname', true), $username, $this->input->post('email', true)));
				$data = array(
					'password' => $password,
					'activation' => $activation,
					'code_activation' => $code_activation,
				);		
			}
		}
		//Cek perubahan profile
		if(isset($_FILES['file_profile']['name'])) {
			if($_FILES['file_profile']['name']!=''){
				
			}
		}

		//update data user
		$data['fullname'] = $this->input->post('fullname', true);
		$data['telp'] = $this->input->post('telp', true);
		$data['email'] = $this->input->post('email', true);
		$data['modified_by'] = $username;
		$data['modified_on'] = date("Y-m-d h:i:s",time());
		if($this->sistem->update_user($data, $userid)){
			$alert = array('tipe' => 'success', 'msg' => 'Data Tersimpan');
			$this->session->set_flashdata('error_v_user', $alert);	
			// redirect('sistem/v_user/'.$this->input->post('enc', true));
			redirect('sistem/user');
		}else{
			$alert = array('tipe' => 'danger', 'msg' => 'data Tidak Tersimpan');
			$this->session->set_flashdata('error_paswd', $alert);	
			redirect('sistem/v_user/'.$this->input->post('enc', true));
		};
		
	}

	function arr2md5($arrinput){
	    $hasil='';
	    foreach($arrinput as $val){
	        if($hasil==''){
	            $hasil=md5($val);
	        }
	        else {
	            $code=md5($val);
	            for($hit=0;$hit<min(array(strlen($code),strlen($hasil)));$hit++){
	                $hasil[$hit]=chr(ord($hasil[$hit]) ^ ord($code[$hit]));
	            }
	        }
	    }
	    return(md5($hasil));
	}

}
