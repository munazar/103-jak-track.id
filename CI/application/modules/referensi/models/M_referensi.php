<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_referensi extends CI_Model{
	
	function get_basic_table($table='', $where=array(), $order_by=''){
		try {
			if($table!=''){
				if(!empty($where)){
					foreach ($where as $key => $value) {
						$this->db->where($key, $value);
					}
				}
				if($order_by!=''){
					$this->db->order_by($order_by);	
				}
				return $this->db->get($table);
			}
			return false;
		} catch (Exception $e) {
			return false;
		}
	}

	function insert_table($table='', $data=array()){
		try {
			if($table!='' && !empty($data)){
				return $this->db->insert($table, $data);
			}
			return false;
		} catch (Exception $e) {
			return false;
		}
	}

	function replace_table($table='', $data=array()){
		try {
			if($table!='' && !empty($data)){
				return $this->db->replace($table, $data);
			}
			return false;
		} catch (Exception $e) {
			return false;
		}
	}

	function update_table($table='', $data=array(), $where=array()){
		try {
			if($table!='' && !empty($data) && !empty($where)){
				foreach ($where as $key => $value) {
					$this->db->where($key,$value);
				}
				return $this->db->update($table, $data);
			}
			return false;
		} catch (Exception $e) {
			return false;
		}
	}

	function get_list_kota(){
		try {
			$this->db->select('k.*, p.nama as nama_provinsi, p.kode as kode_provinsi');
			$this->db->join('ref_provinsi p', 'p.id=k.id_provinsi', 'left');
			$this->db->order_by('k.id_provinsi, k.id asc');
			return $this->db->get('ref_kota k');
		} catch (Exception $e) {
			return false;
		}
	}

	function get_list_kecamatan(){
		try {
			$this->db->select('k.*, ko.nama as nama_kota, ko.kode as kode_kota, p.nama as nama_provinsi, p.kode as kode_provinsi');
			$this->db->join('ref_kota ko', 'ko.id=k.id_kota', 'left');
			$this->db->join('ref_provinsi p', 'p.id=k.id_provinsi', 'left');
			$this->db->order_by('k.aktif desc, k.id_provinsi, k.id_kota, k.id asc');
			return $this->db->get('ref_kecamatan k');
		} catch (Exception $e) {
			
		}
	}

	function get_list_puskesmas(){
		try {
			$this->db->select('p.*, concat(kec.nama, ", ", ko.nama, ", ", prov.nama) as kecamatan');
			$this->db->join('ref_kecamatan kec', 'kec.id=p.id_kecamatan', 'left');
			$this->db->join('ref_kota ko', 'ko.id=kec.id_kota', 'left');
			$this->db->join('ref_provinsi prov', 'prov.id=ko.id_provinsi', 'left');
			
			return $this->db->get('ref_puskesmas p');
		} catch (Exception $e) {
			
		}
	}

	function get_data_puskesmas($id_puskesmas){
		try {
			$this->db->select('p.*, concat(kec.nama, ", ", ko.nama, ", ", prov.nama) as kecamatan');
			$this->db->join('ref_kecamatan kec', 'kec.id=p.id_kecamatan', 'left');
			$this->db->join('ref_kota ko', 'ko.id=kec.id_kota', 'left');
			$this->db->join('ref_provinsi prov', 'prov.id=ko.id_provinsi', 'left');
			$this->db->where('p.id', $id_puskesmas);
			return $this->db->get('ref_puskesmas p');
		} catch (Exception $e) {
			return array();	
		}
	}

	function get_list_pendamping(){
		try {
			$this->db->select('p.*, pus.nama as nama_puskesmas');
			$this->db->join('ref_puskesmas pus', 'pus.id=p.id_puskesmas', 'left');
			return $this->db->get('_tbl_cso_pendamping p');
		} catch (Exception $e) {
			
		}
	}

	function get_list_short_url(){
		try {
			$this->db->select('s');
			$this->db->distinct();
			$this->db->order_by('s');
			return $this->db->get('url');
		} catch (Exception $e) {
			
		}
	}
}