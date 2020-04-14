<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Referensi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		# Pastikan Bahwa User Login
        if($this->session->userdata('is_logged_in')==FALSE){
			redirect('login');
		}
		$this->load->model('m_referensi', 'referensi');
    }

    public function index(){
		$data = array();
		$data['main_view'] = 'v_list';
		$data['title'] = 'Setting';
        $this->load->view('header',$data);
        $this->load->view('body',$data);
        $this->load->view('footer',$data);
	}

	public function provinsi(){
		$data['ls_provinsi'] = $this->referensi->get_basic_table('ref_provinsi', array());
		$data['main_view'] = 'v_list_provinsi';
		$data['title'] = 'Daftar Provinsi';
        $this->load->view('header',$data);
        $this->load->view('body',$data);
        $this->load->view('footer',$data);
	}

	function v_provinsi($enc){
		$data['enc'] = $enc;
		$id_provinsi = decrypt_val($enc);
		if(intval($id_provinsi>0)){
			$where = array('id' => $id_provinsi);
			$ls_provinsi = $this->referensi->get_basic_table('ref_provinsi', $where);
			if($ls_provinsi->num_rows()>0){
				$data['ls_provinsi'] = $ls_provinsi->row();	
			}else{
				$alert = array('tipe' => 'danger', 'msg' => 'Kesalahan data');
				$this->session->set_flashdata('error_provinsi', $alert);
				redirect('referensi/provinsi');
			}
			
		}else{
			$alert = array('tipe' => 'danger', 'msg' => 'Kesalahan data');
			$this->session->set_flashdata('error_provinsi', $alert);
		}
		$data['main_view'] = 'v_edit_provinsi';
		$data['title'] = 'Edit Provinsi';
        $this->load->view('header',$data);
        $this->load->view('body',$data);
        $this->load->view('footer',$data);	
	}

	function save_provinsi(){
		if(empty($_POST)){
			$alert = array('tipe' => 'danger', 'msg' => 'Data Tidak Tersimpan');
			$this->session->set_flashdata('error_provinsi', $alert);
			redirect('referensi/provinsi');
		}
		$data['kode'] = $this->input->post('kode_provinsi', true);
		$data['nama'] = $this->input->post('nama_provinsi', true);
		$data['aktif'] = $this->input->post('sel_aktif', true);
		if($this->input->post('aksi')=='add'){
			if($this->referensi->insert_table('ref_provinsi', $data)){
				$alert = array('tipe' => 'success', 'msg' => 'Data Tersimpan');
				$this->session->set_flashdata('error_provinsi', $alert);
				redirect('referensi/provinsi');
			}else{
				$alert = array('tipe' => 'danger', 'msg' => 'Data Tidak Tersimpan');
				$this->session->set_flashdata('error_provinsi', $alert);
				redirect('referensi/provinsi');
			}	
		}elseif ($this->input->post('aksi')=='edit') {
			$id_provinsi = decrypt_val($this->input->post('enc', true));
			$where = array('id'=>$id_provinsi);
			if($this->referensi->update_table('ref_provinsi', $data, $where)){
				$alert = array('tipe' => 'success', 'msg' => 'Data Berhasil Di Edit');
				$this->session->set_flashdata('error_provinsi', $alert);
				redirect('referensi/provinsi');
			}else{
				$alert = array('tipe' => 'danger', 'msg' => 'Data Tidak Tersimpan');
				$this->session->set_flashdata('error_provinsi', $alert);	
				redirect('sistem/v_provinsi/'.$this->input->post('enc', true));
			}
		}
		
	}

	function kota(){
		$data['ls_kota'] = $this->referensi->get_list_kota();
		$data['ls_provinsi'] = $this->referensi->get_basic_table('ref_provinsi', array('aktif'=>1));
		$data['main_view'] = 'v_list_kota';
		$data['title'] = 'Daftar Kabupaten/Kotamadya';
        $this->load->view('header',$data);
        $this->load->view('body',$data);
        $this->load->view('footer',$data);		
	}

	function v_kota($enc){
		$data['enc'] = $enc;
		$id_kota = decrypt_val($enc);
		if(intval($id_kota>0)){
			$where = array('id' => $id_kota);
			$ls_kota = $this->referensi->get_basic_table('ref_kota', $where);
			if($ls_kota->num_rows()>0){
				$data['ls_kota'] = $ls_kota->row();	
			}else{
				$alert = array('tipe' => 'danger', 'msg' => 'Kesalahan data');
				$this->session->set_flashdata('error_kota', $alert);
				redirect('referensi/kota');
			}
			
		}else{
			$alert = array('tipe' => 'danger', 'msg' => 'Kesalahan data');
			$this->session->set_flashdata('error_kota', $alert);
			redirect('referensi/kota');
		}
		$data['ls_provinsi'] = $this->referensi->get_basic_table('ref_provinsi', array('aktif'=>1));
		$data['main_view'] = 'v_edit_kota';
		$data['title'] = 'Edit Kabupaten/Kotamadya';
        $this->load->view('header',$data);
        $this->load->view('body',$data);
        $this->load->view('footer',$data);	
	}

	function save_kota(){
		if(empty($_POST)){
			$alert = array('tipe' => 'danger', 'msg' => 'Data Tidak Tersimpan');
			$this->session->set_flashdata('error_kota', $alert);
			redirect('referensi/kota');
		}
		$data['id_provinsi'] = $this->input->post('sel_provinsi', true);
		$data['kode'] = $this->input->post('kode_kota', true);
		$data['nama'] = $this->input->post('nama_kota', true);
		$data['aktif'] = $this->input->post('sel_aktif', true);
		if($this->input->post('aksi', true) == 'add'){
			//insert kota
			if($this->referensi->insert_table('ref_kota', $data)){
				$alert = array('tipe' => 'success', 'msg' => 'Data Tersimpan');
				$this->session->set_flashdata('error_kota', $alert);
				redirect('referensi/kota');
			}else{
				$alert = array('tipe' => 'danger', 'msg' => 'Data Tidak Tersimpan');
				$this->session->set_flashdata('error_kota', $alert);
				redirect('referensi/kota');
			}	
		}elseif ($this->input->post('aksi', true) == 'edit') {
			//update kota
			$id_kota = decrypt_val($this->input->post('enc', true));
			$where = array('id'=>$id_kota);
			if($this->referensi->update_table('ref_kota', $data, $where)){
				$alert = array('tipe' => 'success', 'msg' => 'Data Berhasil Di Edit');
				$this->session->set_flashdata('error_kota', $alert);
				redirect('referensi/kota');
			}else{
				$alert = array('tipe' => 'danger', 'msg' => 'Data Tidak Tersimpan');
				$this->session->set_flashdata('error_kota', $alert);	
				redirect('sistem/v_kota/'.$this->input->post('enc', true));
			}

		}
	}

	function kecamatan(){
		$data['ls_kecamatan'] = $this->referensi->get_list_kecamatan();
		$data['ls_kota'] = $this->referensi->get_basic_table('ref_kota', array('aktif'=>1));
		$data['ls_provinsi'] = $this->referensi->get_basic_table('ref_provinsi', array('aktif'=>1));
		$data['main_view'] = 'v_list_kecamatan';
		$data['title'] = 'Daftar Kecamatan';
        $this->load->view('header',$data);
        $this->load->view('body',$data);
        $this->load->view('footer',$data);		
	}

	function v_kecamatan($enc){
		$data['enc'] = $enc;
		$id_kecamatan = decrypt_val($enc);
		if(intval($id_kecamatan>0)){
			$where = array('id' => $id_kecamatan);
			$ls_kecamatan = $this->referensi->get_basic_table('ref_kecamatan', $where);
			if($ls_kecamatan->num_rows()>0){
				$data['ls_kecamatan'] = $ls_kecamatan->row();	
			}else{
				$alert = array('tipe' => 'danger', 'msg' => 'Kesalahan data');
				$this->session->set_flashdata('error_kecamatan', $alert);
				redirect('referensi/kecamatan');
			}
			
		}else{
			$alert = array('tipe' => 'danger', 'msg' => 'Kesalahan data');
			$this->session->set_flashdata('error_kecamatan', $alert);
			redirect('referensi/kecamatan');
		}
		$data['ls_provinsi'] = $this->referensi->get_basic_table('ref_provinsi', array('aktif'=>1));
		$data['ls_kota'] = $this->referensi->get_basic_table('ref_kota', array('aktif'=>1));
		$data['main_view'] = 'v_edit_kecamatan';
		$data['title'] = 'Edit Kecamatan';
        $this->load->view('header',$data);
        $this->load->view('body',$data);
        $this->load->view('footer',$data);	
	}

	function save_kecamatan(){
		if(empty($_POST)){
			$alert = array('tipe' => 'danger', 'msg' => 'Data Tidak Tersimpan');
			$this->session->set_flashdata('error_kecamatan', $alert);
			redirect('referensi/kecamatan');
		}
		$data['id_provinsi'] = $this->input->post('sel_provinsi', true);
		$data['id_kota'] = $this->input->post('sel_kota', true);
		$data['kode'] = $this->input->post('kode_kecamatan', true);
		$data['nama'] = $this->input->post('nama_kecamatan', true);
		$data['aktif'] = $this->input->post('sel_aktif', true);
		if($this->input->post('aksi', true) == 'add'){
			//insert kecamatan
			if($this->referensi->insert_table('ref_kecamatan', $data)){
				$alert = array('tipe' => 'success', 'msg' => 'Data Tersimpan');
				$this->session->set_flashdata('error_kecamatan', $alert);
				redirect('referensi/kecamatan');
			}else{
				$alert = array('tipe' => 'danger', 'msg' => 'Data Tidak Tersimpan');
				$this->session->set_flashdata('error_kecamatan', $alert);
				redirect('referensi/kecamatan');
			}	
		}elseif ($this->input->post('aksi', true) == 'edit') {
			//update kecamatan
			$id_kecamatan = decrypt_val($this->input->post('enc', true));
			$where = array('id'=>$id_kecamatan);
			if($this->referensi->update_table('ref_kecamatan', $data, $where)){
				$alert = array('tipe' => 'success', 'msg' => 'Data Berhasil Di Edit');
				$this->session->set_flashdata('error_kecamatan', $alert);
				redirect('referensi/kecamatan');
			}else{
				$alert = array('tipe' => 'danger', 'msg' => 'Data Tidak Tersimpan');
				$this->session->set_flashdata('error_kecamatan', $alert);	
				redirect('sistem/v_kecamatan/'.$this->input->post('enc', true));
			}

		}
	}

	function puskesmas(){
		$data['ls_kecamatan'] = $this->referensi->get_list_kecamatan();
		$data['ls_puskesmas'] = $this->referensi->get_list_puskesmas();
		$data['ls_short_url'] = $this->referensi->get_list_short_url();
		$data['main_view'] = 'v_list_puskesmas';
		$data['title'] = 'Daftar Puskesmas';
        $this->load->view('header',$data);
        $this->load->view('body',$data);
        $this->load->view('footer',$data);						
	}

	function save_puskesmas(){
		if(empty($_POST)){
			$alert = array('tipe' => 'danger', 'msg' => 'Data Tidak Tersimpan');
			$this->session->set_flashdata('error_puskesmas', $alert);
			redirect('referensi/puskesmas');
		}
		if(!empty($this->input->post('sabtu_tutup', true))){
			$sabtu_tutup = $this->input->post('sabtu_tutup', true);
		}else{
			$sabtu_tutup = 'T';	
		}
		
		$data = array(
				'nama' => $this->input->post('nama_puskesmas', true),
				'alamat' => $this->input->post('alamat_puskesmas', true),
				'telp1' => $this->input->post('telp1', true),
				'telp2' => $this->input->post('telp2', true),
				'id_kecamatan' => $this->input->post('sel_kecamatan', true),
				'deskripsi' => $this->input->post('deskripsi', true),
				'aktif' => $this->input->post('sel_aktif', true),
				'interval_menit' => $this->input->post('sel_interval', true),
				'layanan_hari' => $this->input->post('layanan_hari', true),
				'short_url' => $this->input->post('short_url', true),
				'jam_buka' => $this->input->post('jam_buka', true),
				'jam_tutup' => $this->input->post('jam_tutup', true),
				'sabtu_tutup' => $sabtu_tutup
			);

		//Cek perubahan profile
		$eror_file   = false;
		if(isset($_FILES['file_logo']['name'])) {
			if($_FILES['file_logo']['name']!=''){

				$direktori  = getcwd()."/resources/img/pkm_res/";
		        $file_type  = array('jpg', 'png', 'jpeg');
		        $max_size   = 5000000; // 5MB

		        $file_name  = $_FILES['file_logo']['name'];
	            $file_size  = $_FILES['file_logo']['size'];
	            //cari extensi file dengan menggunakan fungsi explode
	            $explode    = explode('.',$file_name);
	            $extensi    = $explode[count($explode)-1];
	            if(!in_array($extensi,$file_type)){
	                $eror_file   = true;
	                $tipe='danger';
	                $pesan  = 'Extensi file tidak diizinkan, data tidak tersimpan!';
	            }
	            if($file_size > $max_size){
	            	$eror_file   = true;
	            	$tipe='danger';
	                $pesan  = 'Ukuran file melebihi batas maksimal 5MB, data tidak tersimpan!';
	            }
	            if(!$eror_file){
	            	chmod($direktori, 0755);
	            	// if(move_uploaded_file($_FILES['file_logo']['tmp_name'], $direktori.$file_name)) {
	            	if(copy($_FILES['file_logo']['tmp_name'], $direktori.$file_name)) {
		            	$data['file_logo'] = $file_name;
		            }else{
		            	$alert = array('tipe' => 'danger', 'msg' => 'Gagal Upload File '.$direktori.$file_name);
						$this->session->set_flashdata('error_puskesmas', $alert);
						redirect('referensi/puskesmas');
		            }
	            }else{
	            	$alert = array('tipe' => $tipe, 'msg' => $pesan);
					$this->session->set_flashdata('error_puskesmas', $alert);
					redirect('referensi/puskesmas');
	            }
			}
		}

		$enc = $this->input->post('enc', true);
		if($enc==''){ //TAMBAH DATA
			if($this->referensi->insert_table('ref_puskesmas', $data)){
				$tipe = 'success';$msg='Data Berhasil Ditambah';
			}else{
				$tipe = 'danger';$msg='Kesalahan dalam penyimpanan data!';
			}
		}else{ //EDIT DATA
			$id_puskesmas = decrypt_val($enc);
			if(intval($id_puskesmas)>0){
				// $data['id'] = $id_puskesmas;
				if($this->referensi->update_table('ref_puskesmas', $data, $where=array('id'=>$id_puskesmas))){
					$tipe = 'success';$msg='Data Berhasil Diedit';
				}else{
					$tipe = 'danger';$msg='Kesalahan dalam penyimpanan data!';
				}
			}else{
				$tipe = 'danger';$msg='Kesalahan dalam pengiriman data!';
			}
			
		}
		$alert = array('tipe' => $tipe, 'msg' => $msg);
		$this->session->set_flashdata('error_puskesmas', $alert);
		redirect('referensi/puskesmas');
	}

	function pkm_libur($enc=''){
		$data['ls_puskesmas'] = $this->referensi->get_basic_table('ref_puskesmas', array('aktif'=>1));
		$data['id_puskesmas'] = decrypt_val($enc);
		$data['nm_puskesmas'] = '';
		foreach ($data['ls_puskesmas']->result() as $key => $value) {
			if($data['id_puskesmas']==$value->id){
				$data['nm_puskesmas'] = $value->nama;
				break;
			}
		}
		$arr_calendar = '';
		if($enc!=''){
			$id_puskesmas = $data['id_puskesmas'];
			$ls_data = $this->referensi->get_basic_table('ref_hari_libur', array('puskesmas_id'=>$id_puskesmas), 'tanggal desc');
			if($ls_data->num_rows()>0){
				$i=1;
				foreach ($ls_data->result() as $key => $value) {
					$arr_tanggal = explode('-', $value->tanggal);
					$tahun = $arr_tanggal[0];
					$bulan = $arr_tanggal[1]-1;
					$tgl = $arr_tanggal[2];
					$arr_calendar .= "{id: ".$value->id.", puskesmas_id: ".$value->puskesmas_id.", nm_pkm: '".$data['nm_puskesmas']."', deskripsi: '".$value->deskripsi."', startDate: new Date(".$tahun.", ".$bulan.", ".$tgl."), endDate: new Date(".$tahun.", ".$bulan.", ".$tgl.")},";
				}
			}
		}
		$data['data_source'] = $arr_calendar;
		$data['enc'] = $enc;
		$data['main_view'] = 'v_list_pkm_libur';
		$data['title'] = 'Setting Hari Libur'." - ".$data['nm_puskesmas'];
        $this->load->view('header',$data);
        $this->load->view('body',$data);
        $this->load->view('footer',$data);
	}

	function ajax_get_libur_puskesmas(){
		if(empty($_POST)){
			$res = array('st' => 0, 'data' => array());
			echo json_encode($res);
			return;
		}
		$id_puskesmas = decrypt_val($this->input->post('enc', true));
		$this->session->set_flashdata('hr_libur_puskesmas_id', $id_puskesmas);
		redirect('referensi/pkm_libur');

		$isi = "";
		$ls_data = $this->referensi->get_basic_table('ref_hari_libur', array('puskesmas_id'=>$id_puskesmas), 'tanggal desc');
		$arr_calendar = array();
		if($ls_data->num_rows()>0){
			$i=1;
			foreach ($ls_data->result() as $key => $value) {
				$arr_tanggal = explode('-', $value->tanggal);
				$tahun = $arr_tanggal[0];
				$bulan = $arr_tanggal[1]-1;
				$tgl = $arr_tanggal[2];
				$arr_calendar[] = array(
										'id' => $value->id,
							            'puskesmas_id' => $value->puskesmas_id,
							            'deskripsi' => $value->deskripsi,
							            'startDate' => 'new Date('.$tahun.', '.$bulan.', '.$tgl.')',
							            'endDate' => 'new Date('.$tahun.', '.$bulan.', '.$tgl.')'
									);
				$isi .= "<tr>";
				$isi .= "	<td class='text-center'>".$i."</td>";
				$isi .= "	<td>".$this->tanggalhelper->convertDayDate($value->tanggal)."</td>";
				$isi .= "	<td>".$value->deskripsi."</td>";
				$aktif = $value->aktif==1?'Aktif':'Tidak Aktif';
				$isi .= "	<td>".$aktif."</td>";
				$isi .= "	<td class='text-center'><a href='#' class='edit_form' data-toggle='modal' data-target='#frm_puskesmas' enc='".encrypt_val($value->id)."'><i class='fas fa-edit'></i></a></td>";
				$isi .= "</tr>";
				$i++;
			}
			$res = array('st' => 1, 'lsData' => $isi, 'dataCalendar' => $arr_calendar);	
		}else{
			$res = array('st' => 0, 'lsData' => array(), 'dataCalendar' => array());
		}
		
		echo json_encode($res);
	}

	function ajax_get_hari_libur(){
		if(empty($_POST)){
			$res = array('st' => 0, 'data' => array());
			echo json_encode($res);
			return;
		}
		$id_hari_libur = decrypt_val($this->input->post('enc', true));
		$ls_data = $this->referensi->get_basic_table('ref_hari_libur', array('id'=>$id_hari_libur));
		
		if($ls_data->num_rows()>0){
			$res = array('st' => 1, 'data' => $ls_data->row());	
		}else{
			$res = array('st' => 0, 'data' => array());
		}
		
		echo json_encode($res);
	}

	function save_hari_libur(){
		$enc = $this->input->post('enc', true);
		if(empty($_POST)){
			$alert = array('tipe' => 'danger', 'msg' => 'Proses Simpan dan Edit Masih Dalam Pengerjaan');
			$this->session->set_flashdata('error_puskesmas', $alert);
			redirect('referensi/pkm_libur/'.$enc);
		}
		$id_puskesmas = decrypt_val($this->input->post('enc', true));
		$id_hari_libur = ($this->input->post('event-index', true));
		$startDate = ($this->input->post('event-start-date', true));
		$deskripsi = ($this->input->post('event-deskripsi', true));
		$data = array(
				'deskripsi' => $deskripsi,
				'puskesmas_id' => $id_puskesmas,
				'tanggal' => $startDate
			);
		
		if($id_hari_libur!=''){ //edit
			$data['id'] = $id_hari_libur;
		}
		
		if($this->referensi->replace_table('ref_hari_libur', $data)){
			$tipe = 'success';
			$msg = 'Data Berhasil Disimpan';
		}else{
			$tipe = 'danger';
			$msg = 'Data Tidak Berhasil Disimpan';
		}
		$alert = array('tipe' => $tipe, 'msg' => $msg);
		$this->session->set_flashdata('error_puskesmas', $alert);
		redirect('referensi/pkm_libur/'.$enc);
	}

	function keperluan(){
		$data['ls_keperluan'] = $this->referensi->get_basic_table('ref_keperluan', array());
		$data['main_view'] = 'v_list_keperluan';
		$data['title'] = 'Referensi Keperluan';
        $this->load->view('header',$data);
        $this->load->view('body',$data);
        $this->load->view('footer',$data);
	}

	function save_keperluan(){
		if(empty($_POST)){
			$alert = array('tipe' => 'danger', 'msg' => 'Data Tidak Tersimpan');
			$this->session->set_flashdata('error_keperluan', $alert);
			redirect('referensi/keperluan');
		}

		$data = array(
				'keperluan' => $this->input->post('nama_keperluan', true),
				'aktif' => $this->input->post('sel_aktif', true)
			);
		$enc = $this->input->post('enc', true);
		if($enc==''){ //TAMBAH DATA

		}else{
			//Edit Data
			$id_keperluan = decrypt_val($enc);
			if(intval($id_keperluan)>0){
				$data['id'] = $id_keperluan;
			}
		}
		if($this->referensi->replace_table('ref_keperluan', $data)){
			$tipe = 'success';
			$msg = 'Data Berhasil Disimpan';
		}else{
			$tipe = 'danger';
			$msg = 'Data Tidak Berhasil Disimpan';
		}
		$alert = array('tipe' => $tipe, 'msg' => $msg);
		$this->session->set_flashdata('error_keperluan', $alert);
		redirect('referensi/keperluan');
	}

	function stream(){
		$data['ls_kategori'] = $this->referensi->get_basic_table('ref_kategori_pendamping', array());
		$data['main_view'] = 'v_list_kategori_pendamping';
		$data['title'] = 'Referensi Stream';
        $this->load->view('header',$data);
        $this->load->view('body',$data);
        $this->load->view('footer',$data);
	}

	function ajax_get_stream(){
		if(empty($_POST)){
			$res = array('st' => 0, 'data' => array());
			echo json_encode($res);
			return;
		}
		$id_kategori = decrypt_val($this->input->post('enc', true));
		$ls_data = $this->referensi->get_basic_table('ref_kategori_pendamping', array('id'=>$id_kategori));
		
		if($ls_data->num_rows()>0){
			$res = array('st' => 1, 'data' => $ls_data->row());	
		}else{
			$res = array('st' => 0, 'data' => array());
		}
		
		echo json_encode($res);
	}

	function save_stream(){
		if(empty($_POST)){
			$alert = array('tipe' => 'danger', 'msg' => 'Data Tidak Tersimpan');
			$this->session->set_flashdata('error_pendamping', $alert);
			redirect('referensi/stream');
		}
		$data = array(
				'nama' => $this->input->post('nama_kategori', true),
				'aktif' => $this->input->post('sel_aktif', true)
			);
		$enc = $this->input->post('enc', true);
		if($enc==''){ //TAMBAH DATA
			if($this->referensi->insert_table('ref_kategori_pendamping', $data)){
				$tipe = 'success';
				$msg = 'Data Berhasil Ditambahkan';
			}else{
				$tipe = 'danger';
				$msg = 'Data Tidak Berhasil Ditambahkan';
			}
		}else{
			//Edit Data
			$id_kategori = decrypt_val($enc);
			if(intval($id_kategori)>0){
				if($this->referensi->update_table('ref_kategori_pendamping', $data, array('id'=>$id_kategori))){
					$tipe = 'success';
					$msg = 'Data Berhasil Ditambahkan';
				}else{
					$tipe = 'danger';
					$msg = 'Data Tidak Berhasil Diedit';
				}
			}else{
				$tipe = 'danger';
				$msg = 'Kesalahan Dalam Pengiriman Data';
			}
		}
		$alert = array('tipe' => $tipe, 'msg' => $msg);
		$this->session->set_flashdata('error_pendamping', $alert);
		redirect('referensi/stream');
	}

	function pendamping(){
		$data['ls_pendamping'] = $this->referensi->get_basic_table('_tbl_cso_pendamping', array());
		$data['ls_puskesmas'] = $this->referensi->get_list_puskesmas();
		$data['ls_cso'] = $this->referensi->get_basic_table('_tbl_lembaga', array());
		$data['ls_kategori'] = $this->referensi->get_basic_table('ref_kategori_pendamping', array('aktif'=>1));
		$data['main_view'] = 'v_list_pendamping';
		$data['title'] = 'Referensi Pendamping';
        $this->load->view('header',$data);
        $this->load->view('body',$data);
        $this->load->view('footer',$data);
	}

	function save_pendamping(){
		if(empty($_POST)){
			$alert = array('tipe' => 'danger', 'msg' => 'Data Tidak Tersimpan');
			$this->session->set_flashdata('error_pendamping', $alert);
			redirect('referensi/pendamping');
		}
		$data = array(
				'nm_cso_pendamping' => $this->input->post('nama_pendamping', true),
				'kd_sufix' => $this->input->post('kd_sufix', true),
				'kategori_id' => intval($this->input->post('sel_kategori', true)),
				'kd_cso_pendamping' => $this->input->post('kd_cso_pendamping', true),
				'id_puskesmas' => $this->input->post('sel_pkm_asal', true),
				'alamat' => $this->input->post('alamat_pendamping', true),
				'no_hp' => $this->input->post('handphone', true),
				'email' => $this->input->post('email', true),
				'cso_asal' => $this->input->post('cso_asal', true)
			);
		$enc = $this->input->post('enc', true);
		if($enc==''){ //TAMBAH DATA
			if($this->referensi->insert_table('_tbl_cso_pendamping', $data)){
				$tipe = 'success';
				$msg = 'Data Berhasil Ditambahkan';
			}else{
				$tipe = 'danger';
				$msg = 'Data Tidak Berhasil Ditambahkan';
			}
		}else{
			//Edit Data
			$id_pendamping = decrypt_val($enc);
			if(intval($id_pendamping)>0){
				// $data['id'] = $id_pendamping;
				if($this->referensi->update_table('_tbl_cso_pendamping', $data, array('id'=>$id_pendamping))){
					$tipe = 'success';
					$msg = 'Data Berhasil Ditambahkan';
				}else{
					$tipe = 'danger';
					$msg = 'Data Tidak Berhasil Diedit';
				}
			}else{
				$tipe = 'danger';
				$msg = 'Kesalahan Dalam Pengiriman Data';
			}
		}
		$alert = array('tipe' => $tipe, 'msg' => $msg);
		$this->session->set_flashdata('error_pendamping', $alert);
		redirect('referensi/pendamping');
	}

	function ajax_get_puskesmas(){

		if(empty($_POST)){
			$res = array('st' => 0, 'data' => array());
			echo json_encode($res);
			return;
		}
		$id_puskesmas = decrypt_val($this->input->post('enc', true));
		$data_puskesmas = $this->referensi->get_data_puskesmas($id_puskesmas);
		// $ls_kecamatan =  $this->referensi->get_basic_table('ref_kecamatan', array('aktif'=>1));
		// $data = array('ls_kecamatan' => $ls_kecamatan->result_array(),'puskesmas' => $data_puskesmas->result_array());
		if($data_puskesmas->num_rows()>0){
			$res = array('st' => 1, 'data' => $data_puskesmas->row());	
		}else{
			$res = array('st' => 0, 'data' => array());
		}
		
		echo json_encode($res);
	}

	function ajax_get_kota(){
		if(empty($_POST)){
			$res = array('st' => 0, 'data' => array());
			echo json_encode($res);
			return;
		}
		$id_provinsi = $this->input->post('enc', true);
		$ls_kota =  $this->referensi->get_basic_table('ref_kota', array('aktif'=>1, 'id_provinsi' => $id_provinsi));
		$res = array('st' => 1, 'data' => $ls_kota->result_array());
		echo json_encode($res);
	}

	function ajax_get_keperluan(){
		if(empty($_POST)){
			$res = array('st' => 0, 'data' => array());
			echo json_encode($res);
			return;
		}
		$id_keperluan = decrypt_val($this->input->post('enc', true));
		$ls_keperluan =  $this->referensi->get_basic_table('ref_keperluan', array('id' => $id_keperluan));
		if($ls_keperluan->num_rows()>0){
			$res = array('st' => 1, 'data' => $ls_keperluan->row());	
		}else{
			$res = array('st' => 0, 'data' => array());
		}
		echo json_encode($res);	
	}

	function ajax_get_pendamping(){
		if(empty($_POST)){
			$res = array('st' => 0, 'data' => array());
			echo json_encode($res);
			return;
		}
		$id_pendamping = decrypt_val($this->input->post('enc', true));
		$ls_pendamping =  $this->referensi->get_basic_table('_tbl_cso_pendamping', array('id' => $id_pendamping));
		if($ls_pendamping->num_rows()>0){
			$res = array('st' => 1, 'data' => $ls_pendamping->row());	
		}else{
			$res = array('st' => 0, 'data' => array());
		}
		echo json_encode($res);	
	}

}
