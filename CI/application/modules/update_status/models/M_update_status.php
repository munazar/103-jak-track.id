<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_update_status extends CI_Model {

 	public function __construct(){
 		 parent::__construct();

 	}

	function get_list($arr_search=array()){
		try {
			if(!empty($arr_search)){
				if($arr_search['keyword']!=''){
					$this->db->or_where('enc like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('umur like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('gender like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('sifat like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('sex_partner like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('status_HIV like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('kondisi_HIV like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('keterangan like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('tanpa_kondom like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('tanpa_kondom_2 like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('pms like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('pms_2 like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('imbalan like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('imbalan_2 like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('jarum_suntik like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('jarum_suntik_2 like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('paksaan like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('paksaan_2 like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('berganti_pasangan like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('berganti_pasangan_2 like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('tidak_pernah like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('tidak_pernah_2 like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('cam like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('uid like "%'.$arr_search['keyword'].'%"');
				}
				$this->db->limit($arr_search['limit'],$arr_search['begin_limit']);
				$this->db->select('t.*, g.gender, s.sifat, kh.kondisi_HIV, sp.sex_partner, sh.status_HIV, th.keterangan');
				$this->db->join('ref_gender g', 't.id_gender = g.id', 'left');
				$this->db->join('ref_sifat s', 't.id_sifat = s.id', 'left');
				$this->db->join('ref_kondisi_HIV kh', 't.id_kondisi_HIV = kh.id', 'left');
				$this->db->join('ref_sex_partner sp', 't.id_sex_partner = sp.id', 'left');
				$this->db->join('ref_status_HIV sh', 't.id_status_HIV = sh.id', 'left');
				$this->db->join('ref_test_HIV th', 't.id_test_HIV = th.id', 'left');
				$this->db->order_by('t.id asc');
				return $this->db->get('trans_responses t');
			}
		} catch (Exception $e) {
			return false;
		}
	}

	function count_list($arr_search=array()){
		try {
			if(!empty($arr_search)){
				if($arr_search['keyword']!=''){
					$this->db->or_where('enc like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('umur like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('gender like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('sifat like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('sex_partner like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('status_HIV like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('kondisi_HIV like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('keterangan like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('tanpa_kondom like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('tanpa_kondom_2 like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('pms like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('pms_2 like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('imbalan like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('imbalan_2 like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('jarum_suntik like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('jarum_suntik_2 like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('paksaan like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('paksaan_2 like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('berganti_pasangan like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('berganti_pasangan_2 like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('tidak_pernah like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('tidak_pernah_2 like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('cam like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('uid like "%'.$arr_search['keyword'].'%"');
				}
			}
			$this->db->select('t.*, g.gender, s.sifat, kh.kondisi_HIV, sp.sex_partner, sh.status_HIV, th.keterangan');
			$this->db->join('ref_gender g', 't.id_gender = g.id', 'left');
			$this->db->join('ref_sifat s', 't.id_sifat = s.id', 'left');
			$this->db->join('ref_kondisi_HIV kh', 't.id_kondisi_HIV = kh.id', 'left');
			$this->db->join('ref_sex_partner sp', 't.id_sex_partner = sp.id', 'left');
			$this->db->join('ref_status_HIV sh', 't.id_status_HIV = sh.id', 'left');
			$this->db->join('ref_test_HIV th', 't.id_test_HIV = th.id', 'left');
			return $this->db->get('trans_responses t');
		} catch (Exception $e) {
			return false;
		}	
	}

	function get_list2($arr_search=array()){
		try {
			if(!empty($arr_search)){
				if($arr_search['keyword']!=''){
					$this->db->or_where('kps_group like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('cam like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('uid like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('result like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('site_from like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('nama like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('kode_reservasi like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('handphone like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('email like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('puskesmas like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('tanggal_reservasi like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('jam_reservasi like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('status like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('keperluan like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('pendamping like "%'.$arr_search['keyword'].'%"');
				}
			}
			$this->db->limit($arr_search['limit'],$arr_search['begin_limit']);
			return $this->db->get('_tbl_resupdatestatus');
		} catch (Exception $e) {
			
		}
	}

	function count_list2($table, $arr_search=array()){
		try {
			if(!empty($arr_search)){
				if($arr_search['keyword']!=''){
					$this->db->or_where('kps_group like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('cam like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('uid like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('result like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('site_from like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('nama like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('kode_reservasi like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('handphone like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('email like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('puskesmas like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('tanggal_reservasi like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('jam_reservasi like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('status like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('keperluan like "%'.$arr_search['keyword'].'%"');
					$this->db->or_where('pendamping like "%'.$arr_search['keyword'].'%"');
				}
			}
			return $this->db->get($table);
		} catch (Exception $e) {
			
		}
	}

	function get_id_ira($res_code){
		try {
			$this->db->where('res_code', $res_code);
			$this->db->select('id');
			$res = $this->db->get('_tbl_ira_res');
			if($res->num_rows()>0){
				return $res->row()->id;
			}
			return 0;
		} catch (Exception $e) {
			return 0;
		}
	}

	function get_pkm($puskesmas){ 
		try {
			$this->db->where('nama', $puskesmas);
			$this->db->select('param');
			$res = $this->db->get('ref_puskesmas');
			if($res->num_rows()>0){
				return $res->row()->param;
			}
			return NULL;
		} catch (Exception $e) {
			return NULL;
		}
	}

	function get_table($table=''){
		try {
			if($table!=''){
				return $this->db->get($table);
			}
		} catch (Exception $e) {
			
		}
	}

	function save_file($table, $data){
		try {
			return $this->db->replace($table, $data);
		} catch (Exception $e) {
			return false;
		}
	}

}