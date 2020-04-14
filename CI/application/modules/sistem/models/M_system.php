<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_system extends CI_Model {

 	public function __construct(){
 		 parent::__construct();

 	}

	function get_table($table='', $where=array()){
		try {
			if($table!=''){
				if(!empty($where)){
					foreach ($where as $key => $value) {
						$this->db->where($key, $value);
					}
				}
				return $this->db->get($table);
			}
		} catch (Exception $e) {
			
		}
	}

	function save_file($data){
		try {
			return $this->db->replace('trans_responses', $data);
		} catch (Exception $e) {
			return false;
		}
	}

	function update_user($data, $userid){
		try {
			$this->db->where('userid', $userid);
			return $this->db->update('sys_users', $data);
		} catch (Exception $e) {
			return false;
		}
	}

}