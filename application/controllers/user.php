<?php

/**
 * Description of user
 *
 * @author Andi Susilo
 */
class User extends App_Crud_Controller {

    function __construct() {
        parent::__construct();

        $this->_validation = array(
                'add' => array(
                        array(
                                'field' => 'username',
                                'label' => l('nim'),
                                'rules' => 'required|callback__mahasiswa_nim',
                        ),
                        array(
                                'field' => 'name',
                                'label' => l('nama'),
                                'rules' => 'required',
                        ),
                        array(
                                'field' => 'password',
                                'label' => l('password'),
                                'rules' => 'required',
                        ),
                        array(
                                'field' => 'fakultas_id',
                                'label' => l('fakultas'),
                                'rules' => 'required',
                        ),
                        array(
                                'field' => 'jurusan_id',
                                'label' => l('jurusan'),
                                'rules' => 'required',
                        ),
                        array(
                                'field' => 'year_data',
                                'label' => l('tahun akademik'),
                                'rules' => 'required',
                        ),
                ),
                'edit' => array(
                        array(
                                'field' => 'username',
                                'label' => l('nim'),
                                'rules' => 'required',
                        ),
                        array(
                                'field' => 'name',
                                'label' => l('nama'),
                                'rules' => 'required',
                        ),
                        array(
                                'field' => 'fakultas_id',
                                'label' => l('fakultas'),
                                'rules' => 'required',
                        ),
                        array(
                                'field' => 'jurusan_id',
                                'label' => l('jurusan'),
                                'rules' => 'required',
                        ),
                        array(
                                'field' => 'year_data',
                                'label' => l('tahun akademik'),
                                'rules' => 'required',
                        ),
                ),
                'tambah_nilai_semester_1' => array(
                        array(
                                'field' => 'matkul_id',
                                'label' => l('matkul'),
                                'rules' => 'required|callback__check_matkul1',
                        ),
                        array(
                                'field' => 'nilai_id',
                                'label' => l('nilai'),
                                'rules' => 'required',
                        ),
                ),
                'tambah_nilai_semester_2' => array(
                        array(
                                'field' => 'matkul_id',
                                'label' => l('matkul'),
                                'rules' => 'required|callback__check_matkul2',
                        ),
                        array(
                                'field' => 'nilai_id',
                                'label' => l('nilai'),
                                'rules' => 'required',
                        ),
                ),
                'tambah_nilai_semester_3' => array(
                        array(
                                'field' => 'matkul_id',
                                'label' => l('matkul'),
                                'rules' => 'required|callback__check_matkul3',
                        ),
                        array(
                                'field' => 'nilai_id',
                                'label' => l('nilai'),
                                'rules' => 'required',
                        ),
                ),
                'tambah_nilai_semester_4' => array(
                        array(
                                'field' => 'matkul_id',
                                'label' => l('matkul'),
                                'rules' => 'required|callback__check_matkul4',
                        ),
                        array(
                                'field' => 'nilai_id',
                                'label' => l('nilai'),
                                'rules' => 'required',
                        ),
                ),
                'tambah_nilai_semester_5' => array(
                        array(
                                'field' => 'matkul_id',
                                'label' => l('matkul'),
                                'rules' => 'required|callback__check_matkul5',
                        ),
                        array(
                                'field' => 'nilai_id',
                                'label' => l('nilai'),
                                'rules' => 'required',
                        ),
                ),
                'tambah_nilai_semester_6' => array(
                        array(
                                'field' => 'matkul_id',
                                'label' => l('matkul'),
                                'rules' => 'required|callback__check_matkul6',
                        ),
                        array(
                                'field' => 'nilai_id',
                                'label' => l('nilai'),
                                'rules' => 'required',
                        ),
                ),
                'tambah_nilai_semester_7' => array(
                        array(
                                'field' => 'matkul_id',
                                'label' => l('matkul'),
                                'rules' => 'required|callback__check_matkul7',
                        ),
                        array(
                                'field' => 'nilai_id',
                                'label' => l('nilai'),
                                'rules' => 'required',
                        ),
                ),
                'tambah_nilai_semester_8' => array(
                        array(
                                'field' => 'matkul_id',
                                'label' => l('matkul'),
                                'rules' => 'required|callback__check_matkul8',
                        ),
                        array(
                                'field' => 'nilai_id',
                                'label' => l('nilai'),
                                'rules' => 'required',
                        ),
                ),
        );
    }

    function _check_matkul1($value) {
        if (!empty($this->uri->rsegments[3])) {
            $mahasiswa_id = $this->uri->rsegments[3];
        } else {
            $mahasiswa_id = 0;
        }
        $row = $this->db->query('select * from nilai_semester_1 where matkul_id = ? AND mahasiswa_id=?', array($value, $mahasiswa_id))->row();
        if (empty($row)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('_check_matkul1', 'Maaf, code/matkul ini sudah anda masukkan disemester ini, silahkan pilih matkul yang lain.');
            return FALSE;
        }
    }

    function _check_matkul2($value) {
        if (!empty($this->uri->rsegments[3])) {
            $mahasiswa_id = $this->uri->rsegments[3];
        } else {
            $mahasiswa_id = 0;
        }
        $row = $this->db->query('select * from nilai_semester_2 where matkul_id = ? AND mahasiswa_id=?', array($value, $mahasiswa_id))->row();
        if (empty($row)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('_check_matkul2', 'Maaf, code/matkul ini sudah anda masukkan disemester ini, silahkan pilih matkul yang lain.');
            return FALSE;
        }
    }

    function _check_matkul3($value) {
        if (!empty($this->uri->rsegments[3])) {
            $mahasiswa_id = $this->uri->rsegments[3];
        } else {
            $mahasiswa_id = 0;
        }
        $row = $this->db->query('select * from nilai_semester_3 where matkul_id = ? AND mahasiswa_id=?', array($value, $mahasiswa_id))->row();
        if (empty($row)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('_check_matkul3', 'Maaf, code/matkul ini sudah anda masukkan disemester ini, silahkan pilih matkul yang lain.');
            return FALSE;
        }
    }

    function _check_matkul4($value) {
        if (!empty($this->uri->rsegments[3])) {
            $mahasiswa_id = $this->uri->rsegments[3];
        } else {
            $mahasiswa_id = 0;
        }
        $row = $this->db->query('select * from nilai_semester_4 where matkul_id = ? AND mahasiswa_id=?', array($value, $mahasiswa_id))->row();
        if (empty($row)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('_check_matkul4', 'Maaf, code/matkul ini sudah anda masukkan disemester ini, silahkan pilih matkul yang lain.');
            return FALSE;
        }
    }

    function _check_matkul5($value) {
        if (!empty($this->uri->rsegments[3])) {
            $mahasiswa_id = $this->uri->rsegments[3];
        } else {
            $mahasiswa_id = 0;
        }
        $row = $this->db->query('select * from nilai_semester_5 where matkul_id = ? AND mahasiswa_id=?', array($value, $mahasiswa_id))->row();
        if (empty($row)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('_check_matkul5', 'Maaf, code/matkul ini sudah anda masukkan disemester ini, silahkan pilih matkul yang lain.');
            return FALSE;
        }
    }

    function _check_matkul6($value) {
        if (!empty($this->uri->rsegments[3])) {
            $mahasiswa_id = $this->uri->rsegments[3];
        } else {
            $mahasiswa_id = 0;
        }
        $row = $this->db->query('select * from nilai_semester_6 where matkul_id = ? AND mahasiswa_id=?', array($value, $mahasiswa_id))->row();
        if (empty($row)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('_check_matkul6', 'Maaf, code/matkul ini sudah anda masukkan disemester ini, silahkan pilih matkul yang lain.');
            return FALSE;
        }
    }

    function _check_matkul7($value) {
        if (!empty($this->uri->rsegments[3])) {
            $mahasiswa_id = $this->uri->rsegments[3];
        } else {
            $mahasiswa_id = 0;
        }
        $row = $this->db->query('select * from nilai_semester_7 where matkul_id = ? AND mahasiswa_id=?', array($value, $mahasiswa_id))->row();
        if (empty($row)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('_check_matkul7', 'Maaf, code/matkul ini sudah anda masukkan disemester ini, silahkan pilih matkul yang lain.');
            return FALSE;
        }
    }

    function _check_matkul8($value) {
        if (!empty($this->uri->rsegments[3])) {
            $mahasiswa_id = $this->uri->rsegments[3];
        } else {
            $mahasiswa_id = 0;
        }
        $row = $this->db->query('select * from nilai_semester_8 where matkul_id = ? AND mahasiswa_id=?', array($value, $mahasiswa_id))->row();
        if (empty($row)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('_check_matkul8', 'Maaf, code/matkul ini sudah anda masukkan disemester ini, silahkan pilih matkul yang lain.');
            return FALSE;
        }
    }

    function _mahasiswa_nim($value) {
        $row = $this->db->query('select * from user where username=?', $value)->row();
        if (empty($row)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('_mahasiswa_nim', 'Maaf NIM : "' . $value . '" Sudah Tersedia.');
            return FALSE;
        }
    }

    function login($mode = '') {
        $this->_layout_view = '';

        if ($_POST || !empty($mode)) {
            $is_login = $this->auth->login(@$_POST['login'], @$_POST['password'], $mode);

            if ($is_login) {
                $continue = (!empty($_REQUEST['continue'])) ? $_REQUEST['continue'] : (!empty($_COOKIE['continue'])) ? $_COOKIE['continue'] : base_url();
                redirect($continue);
                exit;
            } else {
                $this->_data['errors'] = l('NIM atau Password anda salah');
            }
        }
    }

    function logout() {
        $this->auth->logout();
        $continue = (!empty($_REQUEST['continue'])) ? $_REQUEST['continue'] : (!empty($_COOKIE['continue'])) ? $_COOKIE['continue'] : base_url();
        redirect($continue);
    }

    function _config_grid() {
        $config = parent::_config_grid();
        $config['fields'] = array('username','name','fakultas_name', 'jurusan_name', 'year_data', 'created_by');
        $config['names'] = array('NIM', 'Nama Mahasiswa','Fakultas', 'Jurusan', 'Tahun Akademik', 'Diisi Oleh');
        $config['styles'] = array('', '',  '', '', '');
        $config['aligns'] = array('', '',  'left', '', 'left');
        $config['formats'] = array('row_detail', '', '','', '', '', '');
        $config['filters'] = array('user.username');
        return $config;
    }

    function ganti_password() {
        $user = $this->db->query('
            SELECT * ,fakultas.name fakultas_id, jurusan.name jurusan_id, user.id, user.name, user.image FROM user
            LEFT JOIN fakultas ON user.fakultas_id=fakultas.id
            LEFT JOIN jurusan ON user.jurusan_id=jurusan.id
            WHERE user.id = ?', array($this->_get_user()->id))->row_array();
        $this->_data['user'] = $user;

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        if($this->input->post('password')) {
            if ($this->_validate->run) {
                
            }
            else {
                $password = array(
                        'password' => md5($this->input->post('password'))
                );
                $this->db->where('id', ($this->_get_user()->id));
                $this->db->update('user',$password);
                redirect ('/');
            }
        }
    }

    function ganti_password_admin() {
        $user = $this->db->query('
            SELECT * ,fakultas.name fakultas_id, jurusan.name jurusan_id, user.id, user.name, user.image FROM user
            LEFT JOIN fakultas ON user.fakultas_id=fakultas.id
            LEFT JOIN jurusan ON user.jurusan_id=jurusan.id
            WHERE user.id = ?', array($this->_get_user()->id))->row_array();
        $this->_data['user'] = $user;

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        if($this->input->post('password')) {
            if ($this->_validate->run) {

            }
            else {
                $password = array(
                        'password' => md5($this->input->post('password'))
                );
                $this->db->where('id', ($this->_get_user()->id));
                $this->db->update('user',$password);
                redirect ('/');
            }
        }
    }

    function _save($id = null) {
        $this->_set_view('show');
        $fakultass = $this->db->query('SELECT * FROM fakultas ORDER BY name ASC')->result_array();
        $this->_data['fakultas_options'] = array(
                '' => '-Pilih-',
        );
        foreach ($fakultass as $fakultas) {
            $this->_data['fakultas_options'][$fakultas['id']] = $fakultas['name'];
        }

        $jurusans = $this->db->query('SELECT * FROM jurusan ORDER BY name ASC')->result_array();
        $this->_data['jurusan_options'] = array(
                '' => '-Pilih-',
        );
        foreach ($jurusans as $jurusan) {
            $this->_data['jurusan_options'][$jurusan['id']] = $jurusan['name'];
        }

        $this->_data['years'] = array('' => '-Pilih-');
        for ($i = 2003;
        $i <= 2020;
        $i++) {
            $this->_data['years'][$i] = $i;
        }

        $config = array(
                'presets' => array(
                        'thumb' => array('width' => 180, 'height' => 120),
                        'normal' => array('width' => 300, 'height' => 250),
                        'large' => array('width' => 950, 'height' => 500),
                ),
                'field' => 'image',
                'data_dir' => 'mahasiswa/image',
                'allowed_types' => 'gif|jpg|png',
                'encrypt_name' => true,
        );

        $user_model = $this->_model('user');
        $this->load->library('ximage');
        $this->ximage->initialize($config);

        if ($_POST) {
            if ($this->_validate()) {
                $group_id = @$_POST['group'];
                $org_id = @$_POST['org'];
                $_POST['id'] = $id;
                unset($_POST['group']);
                unset($_POST['org']);
                unset($_POST['password2']);

                $id = $user_model->save($_POST, $id);
                if (!empty($group_id)) {
                    $user_model->update_user_group($id, $group_id);
                } else {
                    $user_model->update_user_group($id, 2);
                }
                if (!empty($org_id)) {
                    $user_model->update_user_org($id, $org_id);
                }

                if ($this->input->is_ajax_request()) {
                    echo true;
                    exit;
                } else {
                    redirect($this->_get_uri('listing'));
                    exit;
                }
            } else {
                $this->_data['errors'] = validation_errors();
            }
        } else {
            if ($id !== null) {
                $this->_data['id'] = $id;
                $_POST = $user_model->get($id);
                $param = array($_POST['id']);

                $group = $user_model->_db()->query('SELECT group_id FROM ' . $user_model->_db()->dbprefix . 'user_group WHERE user_id = ?', $param)->row_array();
                if (!empty($group)) {
                    $_POST['group'] = $group['group_id'];
                }
                $org = $user_model->_db()->query('SELECT org_id FROM user_kampus WHERE user_id = ?', $param)->row_array();
                if (!empty($org)) {
                    $_POST['org'] = $org['org_id'];
                }
            }
        }

        $this->_data['field_data'] = $user_model->field_data();

        $_POST['password'] = '';

        $groups = $this->_model('group')->find();
        $this->_data['group_items'] = array('' => '');
        foreach ($groups as $group) {
            $this->_data['group_items'][$group['id']] = $group['name'];
        }
        $orgs = $this->_model('kampus')->find(null, array('name' => 'asc'));
        $this->_data['org_items'] = array();
        foreach ($orgs as $org) {
            $this->_data['org_items'][$org['id']] = $org['name'];
        }

        $religion_items = $this->_model('agama')->find(null, array('id' => 'asc'));
        $this->_data['religion_items'] = array();
        foreach ($religion_items as $religion_item) {
            $this->_data['religion_items'][$religion_item['id']] = $religion_item['name_agama'];
        }

        $this->_data['image'] = $this->ximage->get_image($_POST);
    }

    function download_pdf($id) {
        $this->load->helper('format');
        $this->load->helper('x_helper');
        $data[$this->_name] = $this->_model()->get($id);

        $jurusan = $this->_model('jurusan')->get($data[$this->_name]['jurusan_id']);
        $data[$this->_name]['jurusan_name'] = $jurusan['name'];
        $fakultas = $this->_model('fakultas')->get($data[$this->_name]['fakultas_id']);
        $data[$this->_name]['fakultas_name'] = $fakultas['name'];

        $data[$this->_name]['nilai_semester1_items'] = $this->_model()->find_semester_1($id);
        foreach ($data as &$user) {
            $this->_data['nilai_semester1_items'] = $user;
        }

        $data[$this->_name]['nilai_semester2_items'] = $this->_model()->find_semester_2($id);
        foreach ($data as &$user) {
            $this->_data['nilai_semester2_items'] = $user;
        }

        $data[$this->_name]['nilai_semester3_items'] = $this->_model()->find_semester_3($id);
        foreach ($data as &$user) {
            $this->_data['nilai_semester3_items'] = $user;
        }

        $data[$this->_name]['nilai_semester4_items'] = $this->_model()->find_semester_4($id);
        foreach ($data as &$user) {
            $this->_data['nilai_semester4_items'] = $user;
        }

        $data[$this->_name]['nilai_semester5_items'] = $this->_model()->find_semester_5($id);
        foreach ($data as &$user) {
            $this->_data['nilai_semester5_items'] = $user;
        }

        $data[$this->_name]['nilai_semester6_items'] = $this->_model()->find_semester_6($id);
        foreach ($data as &$user) {
            $this->_data['nilai_semester6_items'] = $user;
        }

        $data[$this->_name]['nilai_semester7_items'] = $this->_model()->find_semester_7($id);
        foreach ($data as &$user) {
            $this->_data['nilai_semester7_items'] = $user;
        }

        $data[$this->_name]['nilai_semester8_items'] = $this->_model()->find_semester_8($id);
        foreach ($data as &$user) {
            $this->_data['nilai_semester8_items'] = $user;
        }

        $this->load->library('dom_pdf', array(
                'size' => 'A4',
                'orientation' => 'landscape',
        ));
        $this->dom_pdf->from_template($this->_name.'/download_pdf', $data, 'Nilai'.' '.$user['name']);
        exit;
    }

    function nilai_pdf() {
        $this->load->helper('format');

        $data[$this->_name] = $this->db->query('
            SELECT * ,fakultas.name fakultas_name, jurusan.name jurusan_name, user.id, user.name, user.image FROM user
            LEFT JOIN fakultas ON user.fakultas_id=fakultas.id
            LEFT JOIN jurusan ON user.jurusan_id=jurusan.id
            WHERE user.id = ?', array($this->_get_user()->id))->row_array();

        $data[$this->_name]['nilai_semester1_items'] = $this->_model()->find_semester_1($this->_get_user()->id);
        foreach ($data as &$user) {
            $this->_data['nilai_semester1_items'] = $user;
        }

        $data[$this->_name]['nilai_semester2_items'] = $this->_model()->find_semester_2($this->_get_user()->id);
        foreach ($data as &$user) {
            $this->_data['nilai_semester2_items'] = $user;
        }

        $data[$this->_name]['nilai_semester3_items'] = $this->_model()->find_semester_3($this->_get_user()->id);
        foreach ($data as &$user) {
            $this->_data['nilai_semester3_items'] = $user;
        }

        $data[$this->_name]['nilai_semester4_items'] = $this->_model()->find_semester_4($this->_get_user()->id);
        foreach ($data as &$user) {
            $this->_data['nilai_semester4_items'] = $user;
        }

        $data[$this->_name]['nilai_semester5_items'] = $this->_model()->find_semester_5($this->_get_user()->id);
        foreach ($data as &$user) {
            $this->_data['nilai_semester5_items'] = $user;
        }

        $data[$this->_name]['nilai_semester6_items'] = $this->_model()->find_semester_6($this->_get_user()->id);
        foreach ($data as &$user) {
            $this->_data['nilai_semester6_items'] = $user;
        }

        $data[$this->_name]['nilai_semester7_items'] = $this->_model()->find_semester_7($this->_get_user()->id);
        foreach ($data as &$user) {
            $this->_data['nilai_semester7_items'] = $user;
        }

        $data[$this->_name]['nilai_semester8_items'] = $this->_model()->find_semester_8($this->_get_user()->id);
        foreach ($data as &$user) {
            $this->_data['nilai_semester8_items'] = $user;
        }

        $this->load->library('dom_pdf', array(
                'size' => 'A4',
                'orientation' => 'landscape',
        ));
        $this->dom_pdf->from_template($this->_name.'/nilai_pdf', $data, 'Nilai'.' '.$user['name']);
        exit;
    }

    function delete_confirm() {
        echo '<script type="text/javascript">window.history.go(-2)</script>';
        exit;
    }

    function detail($id) {
        $this->_data['user'] = $fa = $this->_model()->get($id);
        $jurusan = $this->_model('jurusan')->get($this->_data['user']['jurusan_id']);
        $this->_data['user']['jurusan_name'] = $jurusan['name'];
        $fakultas = $this->_model('fakultas')->get($this->_data['user']['fakultas_id']);
        $this->_data['user']['fakultas_name'] = $fakultas['name'];

        $this->_data['nilai_semester1_items'] = $this->_model()->find_semester_1($id);
        $config = array(
                'fields' => array('code_matkul','matkul_name','dosen_name','sks_name','nilai_name','bobot'),
                'names' => array('Kode MK','Nama Mata Kuliah', 'Nama Dosen','SKS', 'Nilai','Nilai Bobot'),
                'styles' => array('', '', '', '', '', 'margin-left: 30px'),
                'aligns' => array('', '',  '', '', '', ''),
                'formats' => array('','', '','', '',''),
                'actions' => array(
                        'edit' => 'nilai_semester_1/edit',
                        'delete' => 'nilai_semester_1/delete',
                ),
        );
        $this->load->library('xgrid', $config, 'nilai_semester_1_list');


        $this->_data['nilai_semester2_items'] = $this->_model()->find_semester_2($id);
        $config = array(
                'fields' => array('code_matkul','matkul_name','dosen_name','sks_name','nilai_name','bobot'),
                'names' => array('Kode MK','Nama Mata Kuliah', 'Nama Dosen','SKS', 'Nilai','Nilai Bobot'),
                'styles' => array('', '', '', '', '', 'margin-left: 30px'),
                'aligns' => array('', '',  '', '', '', ''),
                'formats' => array('','', '','', '',''),
                'actions' => array(
                        'edit' => 'nilai_semester_2/edit',
                        'delete' => 'nilai_semester_2/delete',
                ),
        );
        $this->load->library('xgrid', $config, 'nilai_semester_2_list');

        $this->_data['nilai_semester3_items'] = $this->_model()->find_semester_3($id);
        $config = array(
                'fields' => array('code_matkul','matkul_name','dosen_name','sks_name','nilai_name','bobot'),
                'names' => array('Kode MK','Nama Mata Kuliah', 'Nama Dosen','SKS', 'Nilai','Nilai Bobot'),
                'styles' => array('', '', '', '', '', 'margin-left: 30px'),
                'aligns' => array('', '',  '', '', '', ''),
                'formats' => array('','', '','', '',''),
                'actions' => array(
                        'edit' => 'nilai_semester_3/edit',
                        'delete' => 'nilai_semester_3/delete',
                ),
        );
        $this->load->library('xgrid', $config, 'nilai_semester_3_list');

        $this->_data['nilai_semester4_items'] = $this->_model()->find_semester_4($id);
        $config = array(
                'fields' => array('code_matkul','matkul_name','dosen_name','sks_name','nilai_name','bobot'),
                'names' => array('Kode MK','Nama Mata Kuliah', 'Nama Dosen','SKS', 'Nilai','Nilai Bobot'),
                'styles' => array('', '', '', '', '', 'margin-left: 30px'),
                'aligns' => array('', '',  '', '', '', ''),
                'formats' => array('','', '','', '',''),
                'actions' => array(
                        'edit' => 'nilai_semester_4/edit',
                        'delete' => 'nilai_semester_4/delete',
                ),
        );
        $this->load->library('xgrid', $config, 'nilai_semester_4_list');

        $this->_data['nilai_semester5_items'] = $this->_model()->find_semester_5($id);
        $config = array(
                'fields' => array('code_matkul','matkul_name','dosen_name','sks_name','nilai_name','bobot'),
                'names' => array('Kode MK','Nama Mata Kuliah', 'Nama Dosen','SKS', 'Nilai','Nilai Bobot'),
                'styles' => array('', '', '', '', '', 'margin-left: 30px'),
                'aligns' => array('', '',  '', '', '', ''),
                'formats' => array('','', '','', '',''),
                'actions' => array(
                        'edit' => 'nilai_semester_5/edit',
                        'delete' => 'nilai_semester_5/delete',
                ),
        );
        $this->load->library('xgrid', $config, 'nilai_semester_5_list');

        $this->_data['nilai_semester6_items'] = $this->_model()->find_semester_6($id);
        $config = array(
                'fields' => array('code_matkul','matkul_name','dosen_name','sks_name','nilai_name','bobot'),
                'names' => array('Kode MK','Nama Mata Kuliah', 'Nama Dosen','SKS', 'Nilai','Nilai Bobot'),
                'styles' => array('', '', '', '', '', 'margin-left: 30px'),
                'aligns' => array('', '',  '', '', '', ''),
                'formats' => array('','', '','', '',''),
                'actions' => array(
                        'edit' => 'nilai_semester_6/edit',
                        'delete' => 'nilai_semester_6/delete',
                ),
        );
        $this->load->library('xgrid', $config, 'nilai_semester_6_list');

        $this->_data['nilai_semester7_items'] = $this->_model()->find_semester_7($id);
        $config = array(
                'fields' => array('code_matkul','matkul_name','dosen_name','sks_name','nilai_name','bobot'),
                'names' => array('Kode MK','Nama Mata Kuliah', 'Nama Dosen','SKS', 'Nilai','Nilai Bobot'),
                'styles' => array('', '', '', '', '', 'margin-left: 30px'),
                'aligns' => array('', '',  '', '', '', ''),
                'formats' => array('','', '','', '',''),
                'actions' => array(
                        'edit' => 'nilai_semester_7/edit',
                        'delete' => 'nilai_semester_7/delete',
                ),
        );
        $this->load->library('xgrid', $config, 'nilai_semester_7_list');

        $this->_data['nilai_semester8_items'] = $this->_model()->find_semester_8($id);
        $config = array(
                'fields' => array('code_matkul','matkul_name','dosen_name','sks_name','nilai_name','bobot'),
                'names' => array('Kode MK','Nama Mata Kuliah', 'Nama Dosen','SKS', 'Nilai','Nilai Bobot'),
                'styles' => array('', '', '', '', '', 'margin-left: 30px'),
                'aligns' => array('', '',  '', '', '', ''),
                'formats' => array('','', '','', '',''),
                'actions' => array(
                        'edit' => 'nilai_semester_8/edit',
                        'delete' => 'nilai_semester_8/delete',
                ),
        );
        $this->load->library('xgrid', $config, 'nilai_semester_8_list');
    }

    function index() {
        $this->load->helper('format');
        $user = $this->db->query('
            SELECT * ,fakultas.name fakultas_id, jurusan.name jurusan_id, user.id, user.name, user.image FROM user
            LEFT JOIN fakultas ON user.fakultas_id=fakultas.id
            LEFT JOIN jurusan ON user.jurusan_id=jurusan.id
            WHERE user.id = ?', array($this->_get_user()->id))->row_array();

        $this->_data['user'] = $user;

        $this->_data['nilai_semester1_items'] = $this->_model()->find_semester_1($this->_get_user()->id);
        $config = array(
                'fields' => array('code_matkul','matkul_name','dosen_name','sks_name','nilai_name','bobot'),
                'names' => array('Kode MK','Nama Mata Kuliah', 'Nama Dosen','SKS', 'Nilai','Nilai Bobot'),
                'styles' => array('', '', '', '', '', 'margin-left: 30px'),
                'aligns' => array('', '',  '', '', '', ''),
                'formats' => array('','', '','', '',''),
                'actions' => array(),
        );
        $this->load->library('xgrid', $config, 'nilai_semester_1_list');

        $this->_data['nilai_semester2_items'] = $this->_model()->find_semester_2($this->_get_user()->id);
        $config = array(
                'fields' => array('code_matkul','matkul_name','dosen_name','sks_name','nilai_name','bobot'),
                'names' => array('Kode MK','Nama Mata Kuliah', 'Nama Dosen','SKS', 'Nilai','Nilai Bobot'),
                'styles' => array('', '', '', '', '', 'margin-left: 30px'),
                'aligns' => array('', '',  '', '', '', ''),
                'formats' => array('','', '','', '',''),
                'actions' => array(),
        );
        $this->load->library('xgrid', $config, 'nilai_semester_2_list');

        $this->_data['nilai_semester3_items'] = $this->_model()->find_semester_3($this->_get_user()->id);
        $config = array(
                'fields' => array('code_matkul','matkul_name','dosen_name','sks_name','nilai_name','bobot'),
                'names' => array('Kode MK','Nama Mata Kuliah', 'Nama Dosen','SKS', 'Nilai','Nilai Bobot'),
                'styles' => array('', '', '', '', '', 'margin-left: 30px'),
                'aligns' => array('', '',  '', '', '', ''),
                'formats' => array('','', '','', '',''),
                'actions' => array(),
        );
        $this->load->library('xgrid', $config, 'nilai_semester_3_list');

        $this->_data['nilai_semester4_items'] = $this->_model()->find_semester_4($this->_get_user()->id);
        $config = array(
                'fields' => array('code_matkul','matkul_name','dosen_name','sks_name','nilai_name','bobot'),
                'names' => array('Kode MK','Nama Mata Kuliah', 'Nama Dosen','SKS', 'Nilai','Nilai Bobot'),
                'styles' => array('', '', '', '', '', 'margin-left: 30px'),
                'aligns' => array('', '',  '', '', '', ''),
                'formats' => array('','', '','', '',''),
                'actions' => array(),
        );
        $this->load->library('xgrid', $config, 'nilai_semester_4_list');

        $this->_data['nilai_semester5_items'] = $this->_model()->find_semester_5($this->_get_user()->id);
        $config = array(
                'fields' => array('code_matkul','matkul_name','dosen_name','sks_name','nilai_name','bobot'),
                'names' => array('Kode MK','Nama Mata Kuliah', 'Nama Dosen','SKS', 'Nilai','Nilai Bobot'),
                'styles' => array('', '', '', '', '', 'margin-left: 30px'),
                'aligns' => array('', '',  '', '', '', ''),
                'formats' => array('','', '','', '',''),
                'actions' => array(),
        );
        $this->load->library('xgrid', $config, 'nilai_semester_5_list');

        $this->_data['nilai_semester6_items'] = $this->_model()->find_semester_6($this->_get_user()->id);
        $config = array(
                'fields' => array('code_matkul','matkul_name','dosen_name','sks_name','nilai_name','bobot'),
                'names' => array('Kode MK','Nama Mata Kuliah', 'Nama Dosen','SKS', 'Nilai','Nilai Bobot'),
                'styles' => array('', '', '', '', '', 'margin-left: 30px'),
                'aligns' => array('', '',  '', '', '', ''),
                'formats' => array('','', '','', '',''),
                'actions' => array(),
        );
        $this->load->library('xgrid', $config, 'nilai_semester_6_list');

        $this->_data['nilai_semester7_items'] = $this->_model()->find_semester_7($this->_get_user()->id);
        $config = array(
                'fields' => array('code_matkul','matkul_name','dosen_name','sks_name','nilai_name','bobot'),
                'names' => array('Kode MK','Nama Mata Kuliah', 'Nama Dosen','SKS', 'Nilai','Nilai Bobot'),
                'styles' => array('', '', '', '', '', 'margin-left: 30px'),
                'aligns' => array('', '',  '', '', '', ''),
                'formats' => array('','', '','', '',''),
                'actions' => array(),
        );
        $this->load->library('xgrid', $config, 'nilai_semester_7_list');

        $this->_data['nilai_semester8_items'] = $this->_model()->find_semester_8($this->_get_user()->id);
        $config = array(
                'fields' => array('code_matkul','matkul_name','dosen_name','sks_name','nilai_name','bobot'),
                'names' => array('Kode MK','Nama Mata Kuliah', 'Nama Dosen','SKS', 'Nilai','Nilai Bobot'),
                'styles' => array('', '', '', '', '', 'margin-left: 30px'),
                'aligns' => array('', '',  '', '', '', ''),
                'formats' => array('','', '','', '',''),
                'actions' => array(),
        );
        $this->load->library('xgrid', $config, 'nilai_semester_8_list');


        if ($this->_get_user()->groups[0]['name'] !== '') {
            $this->_view = 'halaman/index_'.$this->_get_user()->groups[0]['name'];
        }
    }

    function tambah_nilai_semester_1($mahasiswa_id) {

        $this->_save_nilai_semester_1($mahasiswa_id);
    }

    function _save_nilai_semester_1($mahasiswa_id, $id = null) {

        $this->_data['user'] = $this->_model()->get($mahasiswa_id);
        $jurusan = $this->_model('jurusan')->get($this->_data['user']['jurusan_id']);
        $this->_data['user']['jurusan_name'] = $jurusan['name'];
        $fakultas = $this->_model('fakultas')->get($this->_data['user']['fakultas_id']);
        $this->_data['user']['fakultas_name'] = $fakultas['name'];

        $this->_data['matkul'] = $fa = $this->_model()->get($mahasiswa_id);
        $mahasiswa_id = $this->_data['matkul'];
        $matkuls = $this->db->query('SELECT * FROM matkul WHERE jurusan_id=? ORDER BY semester', $mahasiswa_id['jurusan_id'])->result_array();
        $this->_data['matkul_options'] = array(
                '' => '-Pilih-',
        );
        foreach ($matkuls as $matkul) {
            $this->_data['matkul_options'][$matkul['id']] = 'Semester'.$matkul['semester'].' - '.'('.$matkul['code_matkul'].') - '.$matkul['name'];
        }

        $nilais = $this->db->query('SELECT * FROM nilai ORDER BY name ASC')->result_array();
        $this->_data['nilai_options'] = array(
                '' => '-Pilih-',
        );
        foreach ($nilais as $nilai) {
            $this->_data['nilai_options'][$nilai['id']] = $nilai['name'];
        }

        $this->_set_view('tambah_nilai_semester_1');
        $user_detail = $this->db->query("select * from user  where user.id = ?", $mahasiswa_id)->row_array();
        $this->_data['nilai_semester_1'] = $user_detail;
        $model = $this->_model();

        if ($_POST) {
            if ($this->_validate()) {
                $_POST['id'] = $id;
                $_POST['jurusan_id'] = $user_detail['jurusan_id'];
                try {
                    $model->save_nilai_semester_1($_POST, $id);
                    if ($this->input->is_ajax_request()) {
                        echo true;
                        exit;
                    } else {
                        redirect('user/detail/' . $user_detail['id']);
                        exit;
                    }
                } catch (Exception $e) {
                    $this->_data['errors'] = '<p>' . $e->getMessage() . '</p>';
                }
            }
        } else {
            $this->_data['errors'] = validation_errors();
            if ($id !== null) {
                $this->_data['id'] = $id;
                $_POST = $model->get($id);
            }
        }

        $this->_data['field_data'] = $model->field_data();
    }


    function tambah_nilai_semester_2($mahasiswa_id) {

        $this->_save_nilai_semester_2($mahasiswa_id);
    }

    function _save_nilai_semester_2($mahasiswa_id, $id = null) {
        $this->_data['user'] = $this->_model()->get($mahasiswa_id);
        $jurusan = $this->_model('jurusan')->get($this->_data['user']['jurusan_id']);
        $this->_data['user']['jurusan_name'] = $jurusan['name'];
        $fakultas = $this->_model('fakultas')->get($this->_data['user']['fakultas_id']);
        $this->_data['user']['fakultas_name'] = $fakultas['name'];

        $this->_data['matkul'] = $fa = $this->_model()->get($mahasiswa_id);
        $mahasiswa_id = $this->_data['matkul'];
        $matkuls = $this->db->query('SELECT * FROM matkul WHERE jurusan_id=? ORDER BY semester', $mahasiswa_id['jurusan_id'])->result_array();
        $this->_data['matkul_options'] = array(
                '' => '-Pilih-',
        );
        foreach ($matkuls as $matkul) {
            $this->_data['matkul_options'][$matkul['id']] = 'Semester'.$matkul['semester'].' - '.'('.$matkul['code_matkul'].') - '.$matkul['name'];
        }

        $nilais = $this->db->query('SELECT * FROM nilai ORDER BY name ASC')->result_array();
        $this->_data['nilai_options'] = array(
                '' => '-Pilih-',
        );
        foreach ($nilais as $nilai) {
            $this->_data['nilai_options'][$nilai['id']] = $nilai['name'];
        }

        $this->_set_view('tambah_nilai_semester_2');
        $user_detail = $this->db->query("select * from user  where user.id = ?", $mahasiswa_id)->row_array();
        $this->_data['nilai_semester_2'] = $user_detail;
        $model = $this->_model();

        if ($_POST) {
            if ($this->_validate()) {
                $_POST['id'] = $id;
                $_POST['jurusan_id'] = $user_detail['jurusan_id'];
                try {
                    $model->save_nilai_semester_2($_POST, $id);
                    if ($this->input->is_ajax_request()) {
                        echo true;
                        exit;
                    } else {
                        redirect('user/detail/' . $user_detail['id']);
                        exit;
                    }
                } catch (Exception $e) {
                    $this->_data['errors'] = '<p>' . $e->getMessage() . '</p>';
                }
            }
        } else {
            if ($id !== null) {
                $this->_data['id'] = $id;
                $_POST = $model->get($id);
            }
        }

        $this->_data['field_data'] = $model->field_data();
    }

    function tambah_nilai_semester_3($mahasiswa_id) {

        $this->_save_nilai_semester_3($mahasiswa_id);
    }

    function _save_nilai_semester_3($mahasiswa_id, $id = null) {
        $this->_data['user'] = $this->_model()->get($mahasiswa_id);
        $jurusan = $this->_model('jurusan')->get($this->_data['user']['jurusan_id']);
        $this->_data['user']['jurusan_name'] = $jurusan['name'];
        $fakultas = $this->_model('fakultas')->get($this->_data['user']['fakultas_id']);
        $this->_data['user']['fakultas_name'] = $fakultas['name'];

        $this->_data['matkul'] = $fa = $this->_model()->get($mahasiswa_id);
        $mahasiswa_id = $this->_data['matkul'];
        $matkuls = $this->db->query('SELECT * FROM matkul WHERE jurusan_id=? ORDER BY semester', $mahasiswa_id['jurusan_id'])->result_array();
        $this->_data['matkul_options'] = array(
                '' => '-Pilih-',
        );
        foreach ($matkuls as $matkul) {
            $this->_data['matkul_options'][$matkul['id']] = 'Semester'.$matkul['semester'].' - '.'('.$matkul['code_matkul'].') - '.$matkul['name'];
        }

        $nilais = $this->db->query('SELECT * FROM nilai ORDER BY name ASC')->result_array();
        $this->_data['nilai_options'] = array(
                '' => '-Pilih-',
        );
        foreach ($nilais as $nilai) {
            $this->_data['nilai_options'][$nilai['id']] = $nilai['name'];
        }

        $this->_set_view('tambah_nilai_semester_3');
        $user_detail = $this->db->query("select * from user  where user.id = ?", $mahasiswa_id)->row_array();
        $this->_data['nilai_semester_3'] = $user_detail;
        $model = $this->_model();

        if ($_POST) {
            if ($this->_validate()) {
                $_POST['id'] = $id;
                $_POST['jurusan_id'] = $user_detail['jurusan_id'];
                try {
                    $model->save_nilai_semester_3($_POST, $id);
                    if ($this->input->is_ajax_request()) {
                        echo true;
                        exit;
                    } else {
                        redirect('user/detail/' . $user_detail['id']);
                        exit;
                    }
                } catch (Exception $e) {
                    $this->_data['errors'] = '<p>' . $e->getMessage() . '</p>';
                }
            }
        } else {
            if ($id !== null) {
                $this->_data['id'] = $id;
                $_POST = $model->get($id);
            }
        }

        $this->_data['field_data'] = $model->field_data();
    }

    function tambah_nilai_semester_4($mahasiswa_id) {

        $this->_save_nilai_semester_4($mahasiswa_id);
    }

    function _save_nilai_semester_4($mahasiswa_id, $id = null) {
        $this->_data['user'] = $this->_model()->get($mahasiswa_id);
        $jurusan = $this->_model('jurusan')->get($this->_data['user']['jurusan_id']);
        $this->_data['user']['jurusan_name'] = $jurusan['name'];
        $fakultas = $this->_model('fakultas')->get($this->_data['user']['fakultas_id']);
        $this->_data['user']['fakultas_name'] = $fakultas['name'];

        $this->_data['matkul'] = $fa = $this->_model()->get($mahasiswa_id);
        $mahasiswa_id = $this->_data['matkul'];
        $matkuls = $this->db->query('SELECT * FROM matkul WHERE jurusan_id=? ORDER BY semester', $mahasiswa_id['jurusan_id'])->result_array();
        $this->_data['matkul_options'] = array(
                '' => '-Pilih-',
        );
        foreach ($matkuls as $matkul) {
            $this->_data['matkul_options'][$matkul['id']] = 'Semester'.$matkul['semester'].' - '.'('.$matkul['code_matkul'].') - '.$matkul['name'];
        }

        $nilais = $this->db->query('SELECT * FROM nilai ORDER BY name ASC')->result_array();
        $this->_data['nilai_options'] = array(
                '' => '-Pilih-',
        );
        foreach ($nilais as $nilai) {
            $this->_data['nilai_options'][$nilai['id']] = $nilai['name'];
        }

        $this->_set_view('tambah_nilai_semester_4');
        $user_detail = $this->db->query("select * from user  where user.id = ?", $mahasiswa_id)->row_array();
        $this->_data['nilai_semester_4'] = $user_detail;
        $model = $this->_model();

        if ($_POST) {
            if ($this->_validate()) {
                $_POST['id'] = $id;
                $_POST['jurusan_id'] = $user_detail['jurusan_id'];
                try {
                    $model->save_nilai_semester_4($_POST, $id);
                    if ($this->input->is_ajax_request()) {
                        echo true;
                        exit;
                    } else {
                        redirect('user/detail/' . $user_detail['id']);
                        exit;
                    }
                } catch (Exception $e) {
                    $this->_data['errors'] = '<p>' . $e->getMessage() . '</p>';
                }
            }
        } else {
            if ($id !== null) {
                $this->_data['id'] = $id;
                $_POST = $model->get($id);
            }
        }

        $this->_data['field_data'] = $model->field_data();
    }

    function tambah_nilai_semester_5($mahasiswa_id) {

        $this->_save_nilai_semester_5($mahasiswa_id);
    }

    function _save_nilai_semester_5($mahasiswa_id, $id = null) {
        $this->_data['user'] = $this->_model()->get($mahasiswa_id);
        $jurusan = $this->_model('jurusan')->get($this->_data['user']['jurusan_id']);
        $this->_data['user']['jurusan_name'] = $jurusan['name'];
        $fakultas = $this->_model('fakultas')->get($this->_data['user']['fakultas_id']);
        $this->_data['user']['fakultas_name'] = $fakultas['name'];

        $this->_data['matkul'] = $fa = $this->_model()->get($mahasiswa_id);
        $mahasiswa_id = $this->_data['matkul'];
        $matkuls = $this->db->query('SELECT * FROM matkul WHERE jurusan_id=? ORDER BY semester', $mahasiswa_id['jurusan_id'])->result_array();
        $this->_data['matkul_options'] = array(
                '' => '-Pilih-',
        );
        foreach ($matkuls as $matkul) {
            $this->_data['matkul_options'][$matkul['id']] = 'Semester'.$matkul['semester'].' - '.'('.$matkul['code_matkul'].') - '.$matkul['name'];
        }

        $nilais = $this->db->query('SELECT * FROM nilai ORDER BY name ASC')->result_array();
        $this->_data['nilai_options'] = array(
                '' => '-Pilih-',
        );
        foreach ($nilais as $nilai) {
            $this->_data['nilai_options'][$nilai['id']] = $nilai['name'];
        }

        $this->_set_view('tambah_nilai_semester_5');
        $user_detail = $this->db->query("select * from user  where user.id = ?", $mahasiswa_id)->row_array();
        $this->_data['nilai_semester_5'] = $user_detail;
        $model = $this->_model();

        if ($_POST) {
            if ($this->_validate()) {
                $_POST['id'] = $id;
                $_POST['jurusan_id'] = $user_detail['jurusan_id'];
                try {
                    $model->save_nilai_semester_5($_POST, $id);
                    if ($this->input->is_ajax_request()) {
                        echo true;
                        exit;
                    } else {
                        redirect('user/detail/' . $user_detail['id']);
                        exit;
                    }
                } catch (Exception $e) {
                    $this->_data['errors'] = '<p>' . $e->getMessage() . '</p>';
                }
            }
        } else {
            if ($id !== null) {
                $this->_data['id'] = $id;
                $_POST = $model->get($id);
            }
        }

        $this->_data['field_data'] = $model->field_data();
    }

    function tambah_nilai_semester_6($mahasiswa_id) {

        $this->_save_nilai_semester_6($mahasiswa_id);
    }

    function _save_nilai_semester_6($mahasiswa_id, $id = null) {
        $this->_data['user'] = $this->_model()->get($mahasiswa_id);
        $jurusan = $this->_model('jurusan')->get($this->_data['user']['jurusan_id']);
        $this->_data['user']['jurusan_name'] = $jurusan['name'];
        $fakultas = $this->_model('fakultas')->get($this->_data['user']['fakultas_id']);
        $this->_data['user']['fakultas_name'] = $fakultas['name'];

        $this->_data['matkul'] = $fa = $this->_model()->get($mahasiswa_id);
        $mahasiswa_id = $this->_data['matkul'];
        $matkuls = $this->db->query('SELECT * FROM matkul WHERE jurusan_id=? ORDER BY semester', $mahasiswa_id['jurusan_id'])->result_array();
        $this->_data['matkul_options'] = array(
                '' => '-Pilih-',
        );
        foreach ($matkuls as $matkul) {
            $this->_data['matkul_options'][$matkul['id']] = 'Semester'.$matkul['semester'].' - '.'('.$matkul['code_matkul'].') - '.$matkul['name'];
        }

        $nilais = $this->db->query('SELECT * FROM nilai ORDER BY name ASC')->result_array();
        $this->_data['nilai_options'] = array(
                '' => '-Pilih-',
        );
        foreach ($nilais as $nilai) {
            $this->_data['nilai_options'][$nilai['id']] = $nilai['name'];
        }

        $this->_set_view('tambah_nilai_semester_6');
        $user_detail = $this->db->query("select * from user  where user.id = ?", $mahasiswa_id)->row_array();
        $this->_data['nilai_semester_6'] = $user_detail;
        $model = $this->_model();

        if ($_POST) {
            if ($this->_validate()) {
                $_POST['id'] = $id;
                $_POST['jurusan_id'] = $user_detail['jurusan_id'];
                try {
                    $model->save_nilai_semester_6($_POST, $id);
                    if ($this->input->is_ajax_request()) {
                        echo true;
                        exit;
                    } else {
                        redirect('user/detail/' . $user_detail['id']);
                        exit;
                    }
                } catch (Exception $e) {
                    $this->_data['errors'] = '<p>' . $e->getMessage() . '</p>';
                }
            }
        } else {
            if ($id !== null) {
                $this->_data['id'] = $id;
                $_POST = $model->get($id);
            }
        }

        $this->_data['field_data'] = $model->field_data();
    }

    function tambah_nilai_semester_7($mahasiswa_id) {

        $this->_save_nilai_semester_7($mahasiswa_id);
    }

    function _save_nilai_semester_7($mahasiswa_id, $id = null) {
        $this->_data['user'] = $this->_model()->get($mahasiswa_id);
        $jurusan = $this->_model('jurusan')->get($this->_data['user']['jurusan_id']);
        $this->_data['user']['jurusan_name'] = $jurusan['name'];
        $fakultas = $this->_model('fakultas')->get($this->_data['user']['fakultas_id']);
        $this->_data['user']['fakultas_name'] = $fakultas['name'];

        $this->_data['matkul'] = $fa = $this->_model()->get($mahasiswa_id);
        $mahasiswa_id = $this->_data['matkul'];
        $matkuls = $this->db->query('SELECT * FROM matkul WHERE jurusan_id=? ORDER BY semester', $mahasiswa_id['jurusan_id'])->result_array();
        $this->_data['matkul_options'] = array(
                '' => '-Pilih-',
        );
        foreach ($matkuls as $matkul) {
            $this->_data['matkul_options'][$matkul['id']] = 'Semester'.$matkul['semester'].' - '.'('.$matkul['code_matkul'].') - '.$matkul['name'];
        }

        $nilais = $this->db->query('SELECT * FROM nilai ORDER BY name ASC')->result_array();
        $this->_data['nilai_options'] = array(
                '' => '-Pilih-',
        );
        foreach ($nilais as $nilai) {
            $this->_data['nilai_options'][$nilai['id']] = $nilai['name'];
        }

        $this->_set_view('tambah_nilai_semester_7');
        $user_detail = $this->db->query("select * from user  where user.id = ?", $mahasiswa_id)->row_array();
        $this->_data['nilai_semester_7'] = $user_detail;
        $model = $this->_model();

        if ($_POST) {
            if ($this->_validate()) {
                $_POST['id'] = $id;
                $_POST['jurusan_id'] = $user_detail['jurusan_id'];
                try {
                    $model->save_nilai_semester_7($_POST, $id);
                    if ($this->input->is_ajax_request()) {
                        echo true;
                        exit;
                    } else {
                        redirect('user/detail/' . $user_detail['id']);
                        exit;
                    }
                } catch (Exception $e) {
                    $this->_data['errors'] = '<p>' . $e->getMessage() . '</p>';
                }
            }
        } else {
            if ($id !== null) {
                $this->_data['id'] = $id;
                $_POST = $model->get($id);
            }
        }

        $this->_data['field_data'] = $model->field_data();
    }

    function tambah_nilai_semester_8($mahasiswa_id) {

        $this->_save_nilai_semester_8($mahasiswa_id);
    }

    function _save_nilai_semester_8($mahasiswa_id, $id = null) {
        $this->_data['user'] = $this->_model()->get($mahasiswa_id);
        $jurusan = $this->_model('jurusan')->get($this->_data['user']['jurusan_id']);
        $this->_data['user']['jurusan_name'] = $jurusan['name'];
        $fakultas = $this->_model('fakultas')->get($this->_data['user']['fakultas_id']);
        $this->_data['user']['fakultas_name'] = $fakultas['name'];

        $this->_data['matkul'] = $fa = $this->_model()->get($mahasiswa_id);
        $mahasiswa_id = $this->_data['matkul'];
        $matkuls = $this->db->query('SELECT * FROM matkul WHERE jurusan_id=? ORDER BY semester', $mahasiswa_id['jurusan_id'])->result_array();
        $this->_data['matkul_options'] = array(
                '' => '-Pilih-',
        );
        foreach ($matkuls as $matkul) {
            $this->_data['matkul_options'][$matkul['id']] = 'Semester'.$matkul['semester'].' - '.'('.$matkul['code_matkul'].') - '.$matkul['name'];
        }

        $nilais = $this->db->query('SELECT * FROM nilai ORDER BY name ASC')->result_array();
        $this->_data['nilai_options'] = array(
                '' => '-Pilih-',
        );
        foreach ($nilais as $nilai) {
            $this->_data['nilai_options'][$nilai['id']] = $nilai['name'];
        }

        $this->_set_view('tambah_nilai_semester_8');
        $user_detail = $this->db->query("select * from user  where user.id = ?", $mahasiswa_id)->row_array();
        $this->_data['nilai_semester_8'] = $user_detail;
        $model = $this->_model();

        if ($_POST) {
            if ($this->_validate()) {
                $_POST['id'] = $id;
                $_POST['jurusan_id'] = $user_detail['jurusan_id'];
                try {
                    $model->save_nilai_semester_8($_POST, $id);
                    if ($this->input->is_ajax_request()) {
                        echo true;
                        exit;
                    } else {
                        redirect('user/detail/' . $user_detail['id']);
                        exit;
                    }
                } catch (Exception $e) {
                    $this->_data['errors'] = '<p>' . $e->getMessage() . '</p>';
                }
            }
        } else {
            if ($id !== null) {
                $this->_data['id'] = $id;
                $_POST = $model->get($id);
            }
        }

        $this->_data['field_data'] = $model->field_data();
    }

    function _check_access() {
        if ($this->uri->rsegments[2] == 'login' || $this->uri->rsegments[2] == 'activation' || $this->uri->rsegments[2] == 'generate_activation_code' || $this->uri->rsegments[2] == 'profile') {
            return true;
        }
        return parent::_check_access();
    }
}
