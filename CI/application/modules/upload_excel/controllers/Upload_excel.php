<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Upload_excel extends CI_Controller {

	function get_id_ref($db_res, $search, $field){
		if($search=='') return NULL;
		if(!empty($db_res)){
			foreach ($db_res->result() as $row) {
				if($row->$field == $search){
					return $row->id;
				}
			}
		}else{
			return NULL;
		}
	}

	public function upload_status(){
		$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		if(isset($_FILES['fileform']['name']) && in_array($_FILES['fileform']['type'], $file_mimes)) {
			$arr_file = explode('.', $_FILES['fileform']['name']);
			$extension = end($arr_file);
			$file_type  = array('xls','xlsx','csv');
			//double check file format
			if(!in_array($extension,$file_type)){
                $alert = array('tipe' => 'danger', 'msg' => 'File tidak sesuai dengan format excel');
				$this->session->set_flashdata('error_upload', $alert);
				redirect('update_status/show_list');
            }
            if('csv' == $extension){
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} else {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}

			$this->load->model('update_status/m_update_status', 'status');
			$ls_sifat 			= $this->status->get_table('ref_sifat');
			$ls_gender 			= $this->status->get_table('ref_gender');
			$ls_sex_partner		= $this->status->get_table('ref_sex_partner');
			$ls_status_HIV 		= $this->status->get_table('ref_status_HIV');
			$ls_test_HIV 		= $this->status->get_table('ref_test_HIV');
			$ls_kondisi_HIV 	= $this->status->get_table('ref_kondisi_HIV');
			//list data yang sudah terupload
			$ls_trans_responses = $this->status->get_table('trans_responses');
			$ls_enc = array();
			foreach ($ls_trans_responses->result() as $key => $value) {
				$ls_enc[$value->id] = $value->enc;
			}
			//fetching file
			$spreadsheet = $reader->load($_FILES['fileform']['tmp_name']);
			$sheetData = $spreadsheet->getActiveSheet()->toArray();
			$data=array();
			foreach ($sheetData as $key => $value) {
				if($key!=0){
					//filtering yang belum tersimpan di dalam database
					foreach ($ls_enc as $k => $v) {
						if($value[0]==$v){
							$data[$key-1]['id'] = $k;
							break;
						}
					}
				 	$data[$key-1]['enc'] 				= $value[0];
					$data[$key-1]['umur'] 				= $value[1];
					$data[$key-1]['id_sifat'] 			= $this->get_id_ref($ls_sifat, $value[2], 'sifat');
					$data[$key-1]['id_gender'] 			= $this->get_id_ref($ls_gender, $value[3], 'gender');
					$data[$key-1]['id_sex_partner'] 	= $this->get_id_ref($ls_sex_partner, $value[4], 'sex_partner');
					$data[$key-1]['id_status_HIV'] 		= $this->get_id_ref($ls_status_HIV, $value[5], 'status_HIV');
					$data[$key-1]['id_test_HIV'] 		= $this->get_id_ref($ls_test_HIV, $value[6], 'keterangan');
					$data[$key-1]['id_kondisi_HIV'] 	= $this->get_id_ref($ls_kondisi_HIV, $value[7], 'kondisi_HIV');
					$data[$key-1]['tanpa_kondom'] 		= $value[8];
					$data[$key-1]['pms'] 				= $value[9];
					$data[$key-1]['imbalan'] 			= $value[10];
					$data[$key-1]['jarum_suntik'] 		= $value[11];
					$data[$key-1]['paksaan'] 			= $value[12];
					$data[$key-1]['berganti_pasangan'] 	= $value[13];
					$data[$key-1]['tidak_pernah'] 		= $value[14];
					$data[$key-1]['tanpa_kondom_2'] 	= $value[15];
					$data[$key-1]['pms_2'] 				= $value[16];
					$data[$key-1]['imbalan_2'] 			= $value[17];
					$data[$key-1]['jarum_suntik_2'] 	= $value[18];
					$data[$key-1]['paksaan_2'] 			= $value[19];
					$data[$key-1]['berganti_pasangan_2'] = $value[20];
					$data[$key-1]['tidak_pernah_2'] 	= $value[21];
					$data[$key-1]['cam'] 				= $value[22];
					$data[$key-1]['uid'] 				= $value[23];
					$data[$key-1]['site'] 				= $value[24];
					$data[$key-1]['score'] 				= $value[25];
					$data[$key-1]['start_date'] 		= $value[26];
					$data[$key-1]['submit_date'] 		= $value[27];
					$data[$key-1]['network_id'] 		= $value[28]; 
					if(!$this->status->save_file('trans_responses',$data[$key-1])){
						$alert = array('tipe' => 'danger', 'msg' => 'Kesalahan ketika menyimpan ke dalam database row '.($key+1));
						$this->session->set_flashdata('error_upload', $alert);
						redirect('update_status/show_list');
					}
					

				}else{
					if($value[0]!='#'){
						//validasi isi file excel di cell A1
						$alert = array('tipe' => 'danger', 'msg' => 'File tidak sesuai dengan format');
						$this->session->set_flashdata('error_upload', $alert);
						redirect('update_status/show_list');
					}
				}
			}
			
			$alert = array('tipe' => 'success', 'msg' => 'File berhasil di upload');
			$this->session->set_flashdata('error_upload', $alert);
		}else{
			$alert = array('tipe' => 'danger', 'msg' => 'File tidak sesuai dengan format excel');
			$this->session->set_flashdata('error_upload', $alert);
		}
		redirect('update_status/show_list');
	}

	public function upload_status2(){
		$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		if(isset($_FILES['fileform']['name']) && in_array($_FILES['fileform']['type'], $file_mimes)) {
			$arr_file = explode('.', $_FILES['fileform']['name']);
			$extension = end($arr_file);
			$file_type  = array('xls','xlsx','csv');
			//double check file format
			if(!in_array($extension,$file_type)){
                $alert = array('tipe' => 'danger', 'msg' => 'File tidak sesuai dengan format excel');
				$this->session->set_flashdata('error_upload', $alert);
				redirect('update_status/show_list');
            }
            if('csv' == $extension){
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} else {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}

			$this->load->model('update_status/m_update_status', 'status');
			
			//fetching file
			$spreadsheet = $reader->load($_FILES['fileform']['tmp_name']);
			$sheetData = $spreadsheet->getActiveSheet()->toArray();
			$data=array();
			foreach ($sheetData as $key => $value) {
				if($key==0){
					if($value[0]!='Laporan Data Update Status'){
						//validasi isi file excel di cell A1
						$alert = array('tipe' => 'danger', 'msg' => 'File tidak sesuai dengan format');
						$this->session->set_flashdata('error_upload', $alert);
						redirect('update_status/show_list');
					}
				}elseif($key!=1){
					//filtering yang belum tersimpan di dalam database

					$arr_kps = explode('-', $value[1]);
					$data[$key-2]['kps_group'] 			= intval($arr_kps[0]);
					$data[$key-2]['cam'] 				= $value[2];
					$data[$key-2]['uid'] 				= $value[3];
					$arr_result = explode('-', $value[4]);
					$arr_result[0] = (trim($arr_result[0])=='')? 'U':trim($arr_result[0]);
					$data[$key-2]['result'] 			= trim($arr_result[0]);
					$data[$key-2]['site_from']	 		= $value[5];
					switch ($value[5]) {
						case 'http://ayo-res.bantuanteknis.org':
							$site_id = 2;
							break;
						case 'http://yuk-res.bantuanteknis.org':
							$site_id = 1;
							break;
						
						default:
							$site_id = 0;
							break;
					}
					$data[$key-2]['site_id']	 		= $site_id;
					$data[$key-2]['nama']		 		= $value[6];
					$data[$key-2]['tanggal_lahir'] 		= $this->tanggalhelper->convertToMysqlDate($value[7]);
					$data[$key-2]['res_code'] 			= $value[8];
					$id_ira = $this->status->get_id_ira($value[8]);
					$data[$key-2]['id_ira'] 			= $id_ira;
					$data[$key-2]['handphone'] 			= $value[9];
					$data[$key-2]['email'] 				= $value[10];
					$data[$key-2]['puskesmas']	 		= $value[11];
					$pkm = $this->status->get_pkm($value[11]);
					$data[$key-2]['pkm'] 				= $pkm;
					$data[$key-2]['tanggal_reservasi'] 	= $value[12];
					$data[$key-2]['jam_reservasi']	 	= $value[13];
					$data[$key-2]['status']		 		= $value[14];
					$data[$key-2]['keperluan']		 	= $value[15];
					$data[$key-2]['pendamping'] 		= $value[16];
					$data[$key-2]['tanggal_akses'] 		= $value[17];
					$data[$key-2]['modify_by'] 			= 'uploads';
					$data[$key-2]['modify_date'] 		= date("Y-m-d h:m:s");
					if(!$this->status->save_file('_tbl_resupdatestatus', $data[$key-2])){
						$alert = array('tipe' => 'danger', 'msg' => 'Kesalahan ketika menyimpan ke dalam database row '.($key));
						$this->session->set_flashdata('error_upload', $alert);
						redirect('update_status/show_list');
					}
					
				}
			}
			
			$alert = array('tipe' => 'success', 'msg' => 'File berhasil di upload');
			$this->session->set_flashdata('error_upload', $alert);
		}else{
			$alert = array('tipe' => 'danger', 'msg' => 'File tidak sesuai dengan format excel');
			$this->session->set_flashdata('error_upload', $alert);
		}
		redirect('update_status/show_list2');
	}
}
