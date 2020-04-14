<?php 
require APPPATH . '/libraries/REST_Controller.php';
// use Restserver\Libraries\REST_Controller;

class Api_rest extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        // $this->load->database();
    }

    //Menampilkan data kontak
    function index_post() {
        // $id = $this->get('id');
        // if ($id == '') {
        //     $kontak = $this->db->get('telepon')->result();
        // } else {
        //     $this->db->where('id', $id);
        //     $kontak = $this->db->get('telepon')->result();
        // }
        $result = array('status' => 1, 'msg'=> 'Testing', 'data'=>$_POST);
        $this->response($result, 200);
        // echo json_encode($result);
    }

    //Masukan function selanjutnya disini
}
?>