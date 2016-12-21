<?php

/**
 * Description of rpc
 *
 * @author Andi Susilo
 */
class rpc extends Base_Controller {

    function get_jurusan_by_fakultas($id) {
        $this->db->select('id, name, jurusan_jenjang')->where('fakultas_id', $id)->order_by('name');
        $result = $this->db->get('jurusan')->result_array();
        echo json_encode($result);
        exit;
    }

    function get_mahasiswa_by_jurusan($id) {
        $this->db->select('id, username, name')->where('jurusan_id', $id)->order_by('name');
        $result = $this->db->get('user')->result_array();
        echo json_encode($result);
        exit;
    }

    function get_matkul_by_jurusan($id) {
        $this->db->select('id, code_matkul, semester, jurusan_id, name')->where('jurusan_id', $id)->order_by('semester');
        $result = $this->db->get('matkul')->result_array();
        echo json_encode($result);
        exit;
    }

    function get_agama($id) {
        $this->db->select('id, name_agama')->where('id', $id)->order_by('name_agama');
        $result = $this->db->get('agama')->result_array();
        echo json_encode($result);
        exit;
    }

}
