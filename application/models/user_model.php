<?php

/**
 * Description of user_model
 *
 * @author Andi Susilo
 */
class User_model extends App_Base_Model {

    function listing($filter = null, $sort = null, $limit = null, $offset = null, &$count = 0) {
        $this->_db()->start_cache();

        $this->_db()
                ->select('fakultas.name fakultas_name, jurusan.name jurusan_name, user.*')
                ->join('fakultas', 'user.fakultas_id= fakultas.id', 'LEFT')
                ->join('jurusan', 'user.jurusan_id= jurusan.id', 'LEFT')
                ->where('user.id != 1')
                ->order_by('user.username', 'asc');


        if (!empty($filter) && !is_array($filter)) {
            $filter = array('id' => $filter);
            $this->_db()->where($filter);
        } elseif (is_array($filter)) {
            unset($filter['q']);
            $this->_db()->or_like($filter, '', 'both');
        }
        if (!empty($sort) && is_array($sort)) {
            foreach ($sort as $key => $value) {
                $this->_db()->order_by($key, $value);
            }
        }
        $this->_db()->stop_cache();
        $count = $this->_db()->count_all_results($this->_name);

        $result = $this->_db()->get($this->_name, $limit, $offset);
        $this->_db()->flush_cache();

        return $result->result_array();
    }

    function _fetch_user_data(&$user) {
        $CI = &get_instance();
        if (is_object($user)) {
            $user->ip_address = $CI->input->ip_address();
            $user->user_agent = $CI->input->user_agent();
            $user->location = '';
        }
    }

    function _after_query(&$user) {

        if (is_object($user) && !empty($user->id)) {
            $this->_fetch_user_data($user);

            $sql = 'SELECT * FROM `' . $this->_db()->dbprefix . 'user_group` ug
                LEFT JOIN `' . $this->_db()->dbprefix . 'group` g ON ug.group_id = g.id
                    WHERE user_id = ? AND g.active = 1';
            $user->groups = $this->query($sql, array($user->id))->result_array();

            $sql = 'SELECT * FROM `user_kampus` uo LEFT JOIN kampus o ON uo.org_id = o.id WHERE user_id = ?';
            $user->kampus = $this->query($sql, array($user->id))->result_array();
        }

        return $user;
    }

    function login($login, $password) {
        $CI = &get_instance();
        $sql = 'SELECT * FROM ' . $this->_name . '
            	WHERE (username = ? OR email = ?) AND password = ? AND active = 1';
        $user = $this->_db()->query($sql, array($login, $login, md5($password)))->row();

        $this->_after_query($user);
        if (!empty($user)) {
            $user->login_mode = 'default';
        }
        return $user;
    }

    function refetch_user($old_user) {
        $user = $this->_db()->query('SELECT * FROM user WHERE id = ?', array($old_user->id))->row();

        $this->_after_query($user);
        if (!empty($user)) {
            $user->login_mode = $old_user->login_mode;
        }
        return $user;
    }

    function before_save(&$data, $id = null) {
        parent::before_save($data, $id);

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = md5($data['password']);
        }
    }

    function add_user_group($user_id, $group_id) {
        $user_group = array(
                'user_id' => $user_id,
                'group_id' => $group_id,
        );
        $this->before_save($user_group);
        $this->_db()->insert('user_group', $user_group);
    }

    function update_user_group($user_id, $group_id) {
        $group_id = ($group_id == null) ? 0 : $group_id;
        $user_group = array(
                'user_id' => $user_id,
                'group_id' => $group_id,
        );

        $this->_db()->delete('user_group', array('user_id' => $user_id));
        $this->before_save($user_group);
        $this->_db()->insert('user_group', $user_group);
    }

    function update_user_org($user_id, $org_id) {
        $org_id = ($org_id == null) ? 0 : $org_id;
        $user_org = array(
                'user_id' => $user_id,
                'org_id' => $org_id,
        );

        $this->_db()->delete('user_kampus', array('user_id' => $user_id));
        $this->before_save($user_org);
        $this->_db()->insert('user_kampus', $user_org);
    }

    function privileges($uri = '%') {
        $CI = &get_instance();
        $user = $CI->_get_user();

        $uri = fetch_uri($uri);

        $privileges = array();

        if (!empty($user->groups)) {
            foreach ($user->groups as $group) {
                $privileges = array_merge($privileges, $CI->_model('group')->privileges($group['id'], $uri));
            }
        }

        foreach ($privileges as $priv) {
            if ($priv['uri'] === '*') {
                return array($priv);
            }
        }
        return $privileges;
    }

    function find_semester_1($mahasiswa_id) {
        return $this->_db()->query('SELECT nilai_semester_1.*,matkul.code_matkul code_matkul, matkul.name matkul_name, matkul.dosen_name dosen_name, sks.name sks_name, nilai.name nilai_name, nilai.bobot bobot, sks.id sks_id
            FROM nilai_semester_1
            LEFT JOIN matkul ON matkul.id = nilai_semester_1.matkul_id
            LEFT JOIN sks ON matkul.sks_id = sks.id
            LEFT JOIN nilai ON nilai.id = nilai_semester_1.nilai_id
            WHERE  mahasiswa_id = ?', array($mahasiswa_id))->result_array();
    }

    function find_semester_2($mahasiswa_id) {
        return $this->_db()->query('SELECT nilai_semester_2.*,matkul.code_matkul code_matkul, matkul.name matkul_name, matkul.dosen_name dosen_name, sks.name sks_name, nilai.name nilai_name, nilai.bobot bobot, sks.id sks_id
            FROM nilai_semester_2
            LEFT JOIN matkul ON matkul.id = nilai_semester_2.matkul_id
            LEFT JOIN sks ON matkul.sks_id = sks.id
            LEFT JOIN nilai ON nilai.id = nilai_semester_2.nilai_id
            WHERE  mahasiswa_id = ?', array($mahasiswa_id))->result_array();
    }

    function find_semester_3($mahasiswa_id) {
        return $this->_db()->query('SELECT nilai_semester_3.*,matkul.code_matkul code_matkul, matkul.name matkul_name, matkul.dosen_name dosen_name, sks.name sks_name, nilai.name nilai_name, nilai.bobot bobot, sks.id sks_id
            FROM nilai_semester_3
            LEFT JOIN matkul ON matkul.id = nilai_semester_3.matkul_id
            LEFT JOIN sks ON matkul.sks_id = sks.id
            LEFT JOIN nilai ON nilai.id = nilai_semester_3.nilai_id
            WHERE  mahasiswa_id = ?', array($mahasiswa_id))->result_array();
    }

    function find_semester_4($mahasiswa_id) {
        return $this->_db()->query('SELECT nilai_semester_4.*,matkul.code_matkul code_matkul, matkul.name matkul_name, matkul.dosen_name dosen_name, sks.name sks_name, nilai.name nilai_name, nilai.bobot bobot, sks.id sks_id
            FROM nilai_semester_4
            LEFT JOIN matkul ON matkul.id = nilai_semester_4.matkul_id
            LEFT JOIN sks ON matkul.sks_id = sks.id
            LEFT JOIN nilai ON nilai.id = nilai_semester_4.nilai_id
            WHERE  mahasiswa_id = ?', array($mahasiswa_id))->result_array();
    }

    function find_semester_5($mahasiswa_id) {
        return $this->_db()->query('SELECT nilai_semester_5.*,matkul.code_matkul code_matkul, matkul.name matkul_name, matkul.dosen_name dosen_name, sks.name sks_name, nilai.name nilai_name, nilai.bobot bobot, sks.id sks_id
            FROM nilai_semester_5
            LEFT JOIN matkul ON matkul.id = nilai_semester_5.matkul_id
            LEFT JOIN sks ON matkul.sks_id = sks.id
            LEFT JOIN nilai ON nilai.id = nilai_semester_5.nilai_id
            WHERE  mahasiswa_id = ?', array($mahasiswa_id))->result_array();
    }

    function find_semester_6($mahasiswa_id) {
        return $this->_db()->query('SELECT nilai_semester_6.*,matkul.code_matkul code_matkul, matkul.name matkul_name, matkul.dosen_name dosen_name, sks.name sks_name, nilai.name nilai_name, nilai.bobot bobot, sks.id sks_id
            FROM nilai_semester_6
            LEFT JOIN matkul ON matkul.id = nilai_semester_6.matkul_id
            LEFT JOIN sks ON matkul.sks_id = sks.id
            LEFT JOIN nilai ON nilai.id = nilai_semester_6.nilai_id
            WHERE  mahasiswa_id = ?', array($mahasiswa_id))->result_array();
    }

    function find_semester_7($mahasiswa_id) {
        return $this->_db()->query('SELECT nilai_semester_7.*,matkul.code_matkul code_matkul, matkul.name matkul_name, matkul.dosen_name dosen_name, sks.name sks_name, nilai.name nilai_name, nilai.bobot bobot, sks.id sks_id
            FROM nilai_semester_7
            LEFT JOIN matkul ON matkul.id = nilai_semester_7.matkul_id
            LEFT JOIN sks ON matkul.sks_id = sks.id
            LEFT JOIN nilai ON nilai.id = nilai_semester_7.nilai_id
            WHERE  mahasiswa_id = ?', array($mahasiswa_id))->result_array();
    }

    function find_semester_8($mahasiswa_id) {
        return $this->_db()->query('SELECT nilai_semester_8.*,matkul.code_matkul code_matkul, matkul.name matkul_name, matkul.dosen_name dosen_name, sks.name sks_name, nilai.name nilai_name, nilai.bobot bobot, sks.id sks_id
            FROM nilai_semester_8
            LEFT JOIN matkul ON matkul.id = nilai_semester_8.matkul_id
            LEFT JOIN sks ON matkul.sks_id = sks.id
            LEFT JOIN nilai ON nilai.id = nilai_semester_8.nilai_id
            WHERE  mahasiswa_id = ?', array($mahasiswa_id))->result_array();
    }

    function before_save_nilai_semester_1(&$data, $id = null) {
        $CI = &get_instance();

        if (empty($id)) {
            foreach ($this->field_data() as $field) {
                if ($field->name == 'org_id') {
                    $data['org_id'] = $CI->_get_user()->kampus[0]['id'];
                    break;
                }
            }
            $data['mahasiswa_id'] = $this->uri->segment(3);
            $data['active'] = 1;
            $data['created_by'] = $data['updated_by'] = $CI->_get_user()->username;
        } else {
            $data['updated_by'] = $CI->_get_user()->username;
        }
    }

    function save_nilai_semester_1($data, $id = null) {
        $this->before_save_nilai_semester_1($data, $id);

        if (empty($id)) {
            $this->_db()->insert('nilai_semester_1', $data);
            $err_no = $this->_db()->_error_number();
            $err_msg = $this->_db()->_error_message();
            if (empty($err_no)) {
                return $this->_db()->insert_id();
            } else {
                log_message('warn', $err_no . ' : ' . $err_msg);
                throw new RuntimeException($err_msg, $err_no);
            }
        } else {
            $this->_db()->where('id', $id);
            $this->_db()->update('nilai_semester_1', $data);
            $err_no = $this->_db()->_error_number();
            $err_msg = $this->_db()->_error_message();
            if (empty($err_no)) {
                return $id;
            } else {
                log_message('warn', $err_no . ' : ' . $err_msg);
                throw new RuntimeException($err_msg, $err_no);
            }
        }
    }

    function before_save_nilai_semester_2(&$data, $id = null) {
        $CI = &get_instance();

        if (empty($id)) {
            foreach ($this->field_data() as $field) {
                if ($field->name == 'org_id') {
                    $data['org_id'] = $CI->_get_user()->kampus[0]['id'];
                    break;
                }
            }
            $data['mahasiswa_id'] = $this->uri->segment(3);
            $data['active'] = 1;
            $data['created_by'] = $data['updated_by'] = $CI->_get_user()->username;
        } else {
            $data['updated_by'] = $CI->_get_user()->username;
        }
    }

    function save_nilai_semester_2($data, $id = null) {
        $this->before_save_nilai_semester_2($data, $id);

        if (empty($id)) {
            $this->_db()->insert('nilai_semester_2', $data);
            $err_no = $this->_db()->_error_number();
            $err_msg = $this->_db()->_error_message();
            if (empty($err_no)) {
                return $this->_db()->insert_id();
            } else {
                log_message('warn', $err_no . ' : ' . $err_msg);
                throw new RuntimeException($err_msg, $err_no);
            }
        } else {
            $this->_db()->where('id', $id);
            $this->_db()->update('nilai_semester_2', $data);
            $err_no = $this->_db()->_error_number();
            $err_msg = $this->_db()->_error_message();
            if (empty($err_no)) {
                return $id;
            } else {
                log_message('warn', $err_no . ' : ' . $err_msg);
                throw new RuntimeException($err_msg, $err_no);
            }
        }
    }

    function before_save_nilai_semester_3(&$data, $id = null) {
        $CI = &get_instance();

        if (empty($id)) {
            foreach ($this->field_data() as $field) {
                if ($field->name == 'org_id') {
                    $data['org_id'] = $CI->_get_user()->kampus[0]['id'];
                    break;
                }
            }
            $data['mahasiswa_id'] = $this->uri->segment(3);
            $data['active'] = 1;
            $data['created_by'] = $data['updated_by'] = $CI->_get_user()->username;
        } else {
            $data['updated_by'] = $CI->_get_user()->username;
        }
    }

    function save_nilai_semester_3($data, $id = null) {
        $this->before_save_nilai_semester_3($data, $id);

        if (empty($id)) {
            $this->_db()->insert('nilai_semester_3', $data);
            $err_no = $this->_db()->_error_number();
            $err_msg = $this->_db()->_error_message();
            if (empty($err_no)) {
                return $this->_db()->insert_id();
            } else {
                log_message('warn', $err_no . ' : ' . $err_msg);
                throw new RuntimeException($err_msg, $err_no);
            }
        } else {
            $this->_db()->where('id', $id);
            $this->_db()->update('nilai_semester_3', $data);
            $err_no = $this->_db()->_error_number();
            $err_msg = $this->_db()->_error_message();
            if (empty($err_no)) {
                return $id;
            } else {
                log_message('warn', $err_no . ' : ' . $err_msg);
                throw new RuntimeException($err_msg, $err_no);
            }
        }
    }

    function before_save_nilai_semester_4(&$data, $id = null) {
        $CI = &get_instance();

        if (empty($id)) {
            foreach ($this->field_data() as $field) {
                if ($field->name == 'org_id') {
                    $data['org_id'] = $CI->_get_user()->kampus[0]['id'];
                    break;
                }
            }
            $data['mahasiswa_id'] = $this->uri->segment(3);
            $data['active'] = 1;
            $data['created_by'] = $data['updated_by'] = $CI->_get_user()->username;
        } else {
            $data['updated_by'] = $CI->_get_user()->username;
        }
    }

    function save_nilai_semester_4($data, $id = null) {
        $this->before_save_nilai_semester_4($data, $id);

        if (empty($id)) {
            $this->_db()->insert('nilai_semester_4', $data);
            $err_no = $this->_db()->_error_number();
            $err_msg = $this->_db()->_error_message();
            if (empty($err_no)) {
                return $this->_db()->insert_id();
            } else {
                log_message('warn', $err_no . ' : ' . $err_msg);
                throw new RuntimeException($err_msg, $err_no);
            }
        } else {
            $this->_db()->where('id', $id);
            $this->_db()->update('nilai_semester_4', $data);
            $err_no = $this->_db()->_error_number();
            $err_msg = $this->_db()->_error_message();
            if (empty($err_no)) {
                return $id;
            } else {
                log_message('warn', $err_no . ' : ' . $err_msg);
                throw new RuntimeException($err_msg, $err_no);
            }
        }
    }

    function before_save_nilai_semester_5(&$data, $id = null) {
        $CI = &get_instance();

        if (empty($id)) {
            foreach ($this->field_data() as $field) {
                if ($field->name == 'org_id') {
                    $data['org_id'] = $CI->_get_user()->kampus[0]['id'];
                    break;
                }
            }
            $data['mahasiswa_id'] = $this->uri->segment(3);
            $data['active'] = 1;
            $data['created_by'] = $data['updated_by'] = $CI->_get_user()->username;
        } else {
            $data['updated_by'] = $CI->_get_user()->username;
        }
    }

    function save_nilai_semester_5($data, $id = null) {
        $this->before_save_nilai_semester_5($data, $id);

        if (empty($id)) {
            $this->_db()->insert('nilai_semester_5', $data);
            $err_no = $this->_db()->_error_number();
            $err_msg = $this->_db()->_error_message();
            if (empty($err_no)) {
                return $this->_db()->insert_id();
            } else {
                log_message('warn', $err_no . ' : ' . $err_msg);
                throw new RuntimeException($err_msg, $err_no);
            }
        } else {
            $this->_db()->where('id', $id);
            $this->_db()->update('nilai_semester_5', $data);
            $err_no = $this->_db()->_error_number();
            $err_msg = $this->_db()->_error_message();
            if (empty($err_no)) {
                return $id;
            } else {
                log_message('warn', $err_no . ' : ' . $err_msg);
                throw new RuntimeException($err_msg, $err_no);
            }
        }
    }

    function before_save_nilai_semester_6(&$data, $id = null) {
        $CI = &get_instance();

        if (empty($id)) {
            foreach ($this->field_data() as $field) {
                if ($field->name == 'org_id') {
                    $data['org_id'] = $CI->_get_user()->kampus[0]['id'];
                    break;
                }
            }
            $data['mahasiswa_id'] = $this->uri->segment(3);
            $data['active'] = 1;
            $data['created_by'] = $data['updated_by'] = $CI->_get_user()->username;
        } else {
            $data['updated_by'] = $CI->_get_user()->username;
        }
    }

    function save_nilai_semester_6($data, $id = null) {
        $this->before_save_nilai_semester_6($data, $id);

        if (empty($id)) {
            $this->_db()->insert('nilai_semester_6', $data);
            $err_no = $this->_db()->_error_number();
            $err_msg = $this->_db()->_error_message();
            if (empty($err_no)) {
                return $this->_db()->insert_id();
            } else {
                log_message('warn', $err_no . ' : ' . $err_msg);
                throw new RuntimeException($err_msg, $err_no);
            }
        } else {
            $this->_db()->where('id', $id);
            $this->_db()->update('nilai_semester_6', $data);
            $err_no = $this->_db()->_error_number();
            $err_msg = $this->_db()->_error_message();
            if (empty($err_no)) {
                return $id;
            } else {
                log_message('warn', $err_no . ' : ' . $err_msg);
                throw new RuntimeException($err_msg, $err_no);
            }
        }
    }

    function before_save_nilai_semester_7(&$data, $id = null) {
        $CI = &get_instance();

        if (empty($id)) {
            foreach ($this->field_data() as $field) {
                if ($field->name == 'org_id') {
                    $data['org_id'] = $CI->_get_user()->kampus[0]['id'];
                    break;
                }
            }
            $data['mahasiswa_id'] = $this->uri->segment(3);
            $data['active'] = 1;
            $data['created_by'] = $data['updated_by'] = $CI->_get_user()->username;
        } else {
            $data['updated_by'] = $CI->_get_user()->username;
        }
    }

    function save_nilai_semester_7($data, $id = null) {
        $this->before_save_nilai_semester_7($data, $id);

        if (empty($id)) {
            $this->_db()->insert('nilai_semester_7', $data);
            $err_no = $this->_db()->_error_number();
            $err_msg = $this->_db()->_error_message();
            if (empty($err_no)) {
                return $this->_db()->insert_id();
            } else {
                log_message('warn', $err_no . ' : ' . $err_msg);
                throw new RuntimeException($err_msg, $err_no);
            }
        } else {
            $this->_db()->where('id', $id);
            $this->_db()->update('nilai_semester_7', $data);
            $err_no = $this->_db()->_error_number();
            $err_msg = $this->_db()->_error_message();
            if (empty($err_no)) {
                return $id;
            } else {
                log_message('warn', $err_no . ' : ' . $err_msg);
                throw new RuntimeException($err_msg, $err_no);
            }
        }
    }

    function before_save_nilai_semester_8(&$data, $id = null) {
        $CI = &get_instance();

        if (empty($id)) {
            foreach ($this->field_data() as $field) {
                if ($field->name == 'org_id') {
                    $data['org_id'] = $CI->_get_user()->kampus[0]['id'];
                    break;
                }
            }
            $data['mahasiswa_id'] = $this->uri->segment(3);
            $data['active'] = 1;
            $data['created_by'] = $data['updated_by'] = $CI->_get_user()->username;
        } else {
            $data['updated_by'] = $CI->_get_user()->username;
        }
    }

    function save_nilai_semester_8($data, $id = null) {
        $this->before_save_nilai_semester_8($data, $id);

        if (empty($id)) {
            $this->_db()->insert('nilai_semester_8', $data);
            $err_no = $this->_db()->_error_number();
            $err_msg = $this->_db()->_error_message();
            if (empty($err_no)) {
                return $this->_db()->insert_id();
            } else {
                log_message('warn', $err_no . ' : ' . $err_msg);
                throw new RuntimeException($err_msg, $err_no);
            }
        } else {
            $this->_db()->where('id', $id);
            $this->_db()->update('nilai_semester_8', $data);
            $err_no = $this->_db()->_error_number();
            $err_msg = $this->_db()->_error_message();
            if (empty($err_no)) {
                return $id;
            } else {
                log_message('warn', $err_no . ' : ' . $err_msg);
                throw new RuntimeException($err_msg, $err_no);
            }
        }
    }
}
