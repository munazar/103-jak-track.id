<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_status extends CI_Controller {

	public function __construct(){
		parent::__construct();
		# Pastikan Bahwa User Login
        if($this->session->userdata('is_logged_in')==FALSE){
			redirect('login');
		}
    }

	function show_list(){
		$this->load->model('m_update_status', 'status');
		// $data['ls_data'] = $this->status->get_list();
		$data['main_view'] = 'v_list';
		$data['title'] = 'Update Status';
        $this->load->view('header',$data);
        $this->load->view('body',$data);
        $this->load->view('footer',$data);

	}

	function show_list2(){
		$this->load->model('m_update_status', 'status');
		// $data['ls_data'] = $this->status->get_list();
		$data['main_view'] = 'v_list2';
		$data['title'] = 'Update Status 2';
        $this->load->view('header',$data);
        $this->load->view('body',$data);
        $this->load->view('footer',$data);

	}

	function get_list(){
		$this->load->model('m_update_status', 'status');
		
		$data = array();
		$no   = $_POST['start'];
		$arr_search = array('begin_limit'=>$this->input->post('start', true),'limit'=>$this->input->post('length', true), 'keyword'=> $this->input->post('search', true)['value']);
		$ls_data = $this->status->get_list($arr_search);
		$ls_all_data = $this->status->count_list($arr_search);
        foreach ($ls_data->result() as $field) {
        	// $enc_id=base64_encode($this->encrypt->encode($field->id));
        	// $uraian=$this->kdata->drt($field->uraian,$field->uraian);
            $no++;
			$row    = array();
			$row[]	= $no;
			$row[]	= $field->enc;
			$row[]	= $field->umur;
			$row[]	= $field->sifat;
			$row[]	= $field->gender;
			$row[]	= $field->sex_partner;
			$row[]	= $field->status_HIV;
			$row[]	= $field->keterangan;
			$row[]	= $field->kondisi_HIV;
			$row[]	= $field->tanpa_kondom;
			$row[]	= $field->pms;
			$row[]	= $field->imbalan;
			$row[]	= $field->jarum_suntik;
			$row[]	= $field->paksaan;
			$row[]	= $field->berganti_pasangan;
			$row[]	= $field->tidak_pernah;
			$row[]	= $field->tanpa_kondom_2;
			$row[]	= $field->pms_2;
			$row[]	= $field->pms_2;
			$row[]	= $field->imbalan_2;
			$row[]	= $field->jarum_suntik_2;
			$row[]	= $field->paksaan_2;
			$row[]	= $field->berganti_pasangan_2;
			$row[]	= $field->cam;
			$row[]	= $field->uid;
			$row[]	= $field->site;
			$row[]	= $field->score;
			$row[]	= $field->start_date;
			$row[]	= $field->submit_date;
			$row[]	= $field->network_id;
            $data[] = $row;
        }
        $output = array(
						"draw"            => $_POST['draw'],
						"recordsTotal"    => $ls_all_data->num_rows(),
						"recordsFiltered" => $ls_all_data->num_rows(),
						"data"            => $data,
                );
        //Tampilkan data
        echo json_encode($output);
	}

	function get_list2(){
		$this->load->model('m_update_status', 'status');
		
		$data = array();
		$no   = $_POST['start'];
		$arr_search = array('begin_limit'=>$this->input->post('start', true),'limit'=>$this->input->post('length', true), 'keyword'=> $this->input->post('search', true)['value']);
		$ls_data = $this->status->get_list2($arr_search);
		$ls_all_data = $this->status->count_list2('_tbl_resupdatestatus',$arr_search);
        foreach ($ls_data->result() as $field) {
        	// $enc_id=base64_encode($this->encrypt->encode($field->id));
        	// $uraian=$this->kdata->drt($field->uraian,$field->uraian);
            $no++;
			$row    = array();
			$row[]	= $no;
			$row[]	= $field->kps_group;
			$row[]	= $field->cam;
			$row[]	= $field->uid;
			$row[]	= $field->result;
			$row[]	= $field->site_from;
			$row[]	= $field->nama;
			$row[]	= $field->tanggal_lahir;
			$row[]	= $field->res_code;
			$row[]	= $field->handphone;
			$row[]	= $field->email;
			$row[]	= $field->puskesmas;
			$row[]	= $field->tanggal_reservasi;
			$row[]	= $field->jam_reservasi;
			$row[]	= $field->status;
			$row[]	= $field->keperluan;
			$row[]	= $field->pendamping;
			$row[]	= $field->tanggal_akses;
			
            $data[] = $row;
        }
        $output = array(
						"draw"            => $_POST['draw'],
						"recordsTotal"    => $ls_all_data->num_rows(),
						"recordsFiltered" => $ls_all_data->num_rows(),
						"data"            => $data,
                );
        //Tampilkan data
        echo json_encode($output);
	}
}
