<?php

/**
 * Description of jurusan
 *
 * @author Andi Susilo
 */
class Jurusan extends App_Crud_Controller {

    function __construct() {
        parent::__construct();

        $this->_validation = array(
                'add' => array(
                        array(
                                'field' => 'name',
                                'label' => l('nama jurusan'),
                                'rules' => 'required',
                        ),
                        array(
                                'field' => 'fakultas_id',
                                'label' => l('nama fakultas'),
                                'rules' => 'required',
                        ),
                        array(
                                'field' => 'jurusan_status',
                                'label' => l('status akreditasi'),
                                'rules' => 'required',
                        ),
                        array(
                                'field' => 'jurusan_jenjang',
                                'label' => l('jenjang'),
                                'rules' => 'required',
                        ),
                ),
                'edit' => array(
                        array(
                                'field' => 'name',
                                'label' => l('nama jurusan'),
                                'rules' => 'required',
                        ),
                        array(
                                'field' => 'fakultas_id',
                                'label' => l('nama fakultas'),
                                'rules' => 'required',
                        ),
                        array(
                                'field' => 'jurusan_status',
                                'label' => l('status akreditasi'),
                                'rules' => 'required',
                        ),
                        array(
                                'field' => 'jurusan_jenjang',
                                'label' => l('jenjang'),
                                'rules' => 'required',
                        ),
                ),
        );
    }

    function dashboard($id) {
        $jurusans = $this->db->query('SELECT * FROM jurusan WHERE fakultas_id = ?', array($id))->result_array();
        $this->_data['jurusans'] = $jurusans;


        $this->_data['fakultas'] = $this->_model()->get($id);
        $this->load->library('ximage');
        $this->ximage->initialize($this->_image_config());
        $this->_data['fakultas']['map'] = $this->ximage->get_image($this->_data['fakultas'], 'large');
    }

    function _image($value) {
        return $value;
    }

    function detail($id) {
        $this->_data['jurusan'] = $fa = $this->_model()->get($id);

        $fakultas = $this->_model('fakultas')->get($this->_data['jurusan']['fakultas_id']);
        $this->_data['jurusan']['fakultas_name'] = $fakultas['name'];

        $this->_data['mahasiswa_items'] = $this->_model()->find_mahasiswa($id);
        $config = array(
                'fields' => array('username','name', 'year_data','image'),
                'names' => array('NIM Mahasiswa','Nama Mahasiswa','Tahun Akademik', 'Foto Mahasiswa'),
                'formats' => array('callback__mahasiswa_detail', '','','callback__foto_mahasiswa'),
                'actions' => array(),
        );

        $this->load->library('xgrid', $config, 'mahasiswa_list');

        $images = $this->db->query('SELECT * FROM jurusan_foto WHERE jurusan_id = ? ORDER BY is_default DESC LIMIT 5', array($this->_data['jurusan']['id']))->result_array();

        $this->_data['images'] = array();
        $first = true;
        foreach ($images as $image) {
            $type = 'thumb';
            if ($first) {
                $type = 'normal';
                $first = false;
            }
            $this->_data['images'][] = array(
                    'uri' => get_image_path($image['uri'], $type),
                    'title' => $image['title'],
            );
        }

    }
    function _mahasiswa_detail($value, $field_name, $row) {

        return anchor('user/detail/' . $row['id'], $value);
    }

    function _config_grid() {
        $config = parent::_config_grid();
        $config['fields'] = array('name', 'fakultas_name', 'jurusan_status', 'jurusan_jenjang', 'year_data','kaprodi', 'created_by');       
        $config['names'] = array('Nama Jurusan', 'Status Akreditasi', 'Jenjang',  'Tahun Berdiri', 'Nama Kaprodi','Diisi Oleh');
        $config['formats'] = array('row_detail', '', 'param_short', 'param_short', '', '', '');
        $config['filters'] = array('jurusan.name');
        return $config;
    }

    function _save($id=null) {
        $this->_data['years'] = array('' => '-');
        for ($i = 2003; $i <= 2020; $i++) {
            $this->_data['years'][$i] = $i;
        }

        $fakultass = $this->db->query('SELECT * FROM fakultas ORDER BY name ASC')->result_array();
        $this->_data['fakultas_options'] = array(
                '' => '-Pilih-',
        );
        foreach ($fakultass as $fakultas) {
            $this->_data['fakultas_options'][$fakultas['id']] = $fakultas['name'];
        }

        parent::_save($id);

        $this->_data['image'] = get_image_path(@$_POST['image'], 'normal');

        if (empty($id) && empty($_POST['fakultas_id'])) {
            $rsegments = $this->input->referer()->segments;
            if ($rsegments[1] == 'fakultas') {
                $_POST['fakultas_id'] = end($rsegments);
            }
        }
    }

    // Fungsi Gambar Jurusan
    function _foto_mahasiswa($value) {
        $this->load->library('ximage');
        if (empty($value)) {
            $url = data_url('default/default.png');
        } else {
            $d = explode('/', $value);
            $url = data_url($d[0] . '/' . $d[1] . '/thumb/' . $d[2]);
        }
        echo '<a href ="' . data_url($this->ximage->get_image($value, 'large', 'mahasiswa/image')) . '" class = "msgbox"><img style="margin: 0; padding: 0;" src="' . $url . '" width="40"/></a>';
    }

}