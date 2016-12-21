<?php

/**
 * Description of nilai_semester_4
 *
 * @author Andi Susilo
 */

class Nilai_semester_4 extends App_Crud_Controller {
    function __construct() {
        parent::__construct();

        $this->_validation = array(
                'add' => array(
                        array(
                                'field' => 'jurusan_id',
                                'label' => l('nama jurusan'),
                                'rules' => 'required',
                        ),
                        array(
                                'field' => 'mahasiswa_id',
                                'label' => l('nim mahasiswa'),
                                'rules' => 'required',
                        ),
                        array(
                                'field' => 'matkul_id',
                                'label' => l('nama matkul'),
                                'rules' => 'required|callback__matkul',
                        ),
                        array(
                                'field' => 'nilai_id',
                                'label' => l('nilai'),
                                'rules' => 'required',
                        ),
                ),
                'edit' => array(
                        array(
                                'field' => 'jurusan_id',
                                'label' => l('nama jurusan'),
                                'rules' => 'required',
                        ),
                        array(
                                'field' => 'mahasiswa_id',
                                'label' => l('nim mahasiswa'),
                                'rules' => 'required',
                        ),
                        array(
                                'field' => 'matkul_id',
                                'label' => l('nama matkul'),
                                'rules' => 'required',
                        ),
                        array(
                                'field' => 'nilai_id',
                                'label' => l('nilai'),
                                'rules' => 'required',
                        ),
                ),
        );
    }

    function _matkul($value) {
        $this->_data['user'] = $fa = $this->_model()->get();
        $mahasiswa_id = $this->_data['user']['mahasiswa_id'];
        $row = $this->db->query('select * from nilai_semester_4 where matkul_id = ? AND mahasiswa_id=?', array($value, $mahasiswa_id))->row();
        if (empty($row)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('_matkul', 'Maaf, kode/matkul yang dipilih sudah ada disemester empat ini <br> silahkan pilih kode/matkul yang lain.');
            return FALSE;
        }
    }

    function delete($id) {
        if (!isset($id)) {
            redirect('user/listing');
            exit;
        }
        if (!empty($_GET['confirmed'])) {
            $id = explode(',', $id);
            $this->_model($this->_name)->delete($id);
            redirect('user/listing');
            exit;
        }

        $this->_data['id'] = $id;
        $this->_data['ids'] = explode(',', $id);

        if (count($this->_data['ids']) == 1) {
            $this->_data['row_name'] = 'row #' . $id;
        }
    }

    function _config_grid() {
        $config = parent::_config_grid();
        $config['fields'] = array( 'mahasiswa_nim','jurusan_name','code_matkul','matkul_name', 'sks_name','nilai_name', 'created_by');
        $config['names'] = array('NIM Mahasiswa','Jurusan','Kode Matkul' , 'Mata Kuliah','SKS', 'Nilai', 'Diisi Oleh');
        $config['formats'] = array('', '', '','',  '','', '');
        $config['filters'] = array('nilai_semester_4.mahasiswa_nim');
        return $config;
    }

    function _save($id=null) {

        $jurusans = $this->db->query('SELECT * FROM jurusan ORDER BY name ASC')->result_array();
        $this->_data['jurusan_options'] = array(
                '' => '-Pilih-',
        );
        foreach ($jurusans as $jurusan) {
            $this->_data['jurusan_options'][$jurusan['id']] = $jurusan['name'];
        }

        $mahasiswas = $this->db->query('SELECT * FROM user WHERE user.id != 1 ORDER BY username ASC')->result_array();
        $this->_data['mahasiswa_options'] = array(
                '' => '-Pilih-',
        );
        foreach ($mahasiswas as $mahasiswa) {
            $this->_data['mahasiswa_options'][$mahasiswa['id']] = '('.$mahasiswa['username'].') - '.$mahasiswa['name'];
        }

        $matkuls = $this->db->query('SELECT * FROM matkul ORDER BY semester ASC')->result_array();
        $this->_data['matkul_options'] = array(
                '' => '-Pilih-',
        );
        foreach ($matkuls as $matkul) {
            $this->_data['matkul_options'][$matkul['id']] = 'Semester '.$matkul['semester'].' - '.'('.$matkul['code_matkul'].') - '.$matkul['name'];
        }

        $nilais = $this->db->query('SELECT * FROM nilai ORDER BY name ASC')->result_array();
        $this->_data['nilai_options'] = array(
                '' => '-Pilih-',
        );
        foreach ($nilais as $nilai) {
            $this->_data['nilai_options'][$nilai['id']] = $nilai['name'];
        }

        parent::_save($id);

    }
}
