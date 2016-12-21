<?php

/**
 * Description of Base_Model
 *
 * @author Andi Susilo
 */
class Base_Model extends CI_Model {
    const BELONGS_TO='BELONGS_TO';
    const HAS_ONE='HAS_ONE';
    const HAS_MANY='HAS_MANY';

    var $_name;
    var $_generated;
    var $_dbname = 'default';

    function __construct() {
        parent::__construct();

        $CI = &get_instance();

        include APPPATH . 'config/' . ENVIRONMENT . '/database' . EXT;

        foreach ($db as $key => $value) {
            if ($key !== 'default') {
                $dbname = 'db_' . $key;
                $CI->$dbname = $CI->load->database($key, TRUE);
            } else {
                $CI->load->database();
            }
        }

        $name = preg_replace('/(.*)_model$/', '$1', get_class($this));
        $data = explode('_', $name);
        $this->_name = $db[$this->_dbname]['dbprefix'] . strtolower($name);

        $this->_generated = array('id', 'active', 'created_by', 'updated_by');
    }

    function before_save(&$data, $id = null) {
        $CI = &get_instance();
        $now = date(l('format.mysql_datetime'));

        if (empty($id)) {
            $data['active'] = 1;
            $data['created_by'] = $data['updated_by'] = $CI->_get_user()->username;
        } else {
            $data['updated_by'] = $CI->_get_user()->username;
        }
    }

    function save($data, $id = null) {
        $this->before_save($data, $id);

        if (empty($id)) {
            $this->_db()->insert($this->_name, $data);
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
            $this->_db()->update($this->_name, $data);
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

    function get($filter = null) {
        $count = 0;
        if (!empty($filter) && !is_array($filter)) {
            $filter = array('id' => $filter);
        } elseif (is_array($filter)) {
            unset($filter['q']);
        }
        $result = $this->_db()->get_where($this->_name, $filter)->row_array();
        return $result;
    }

    function find($filter = null, $sort = null, $limit = null, $offset = null, &$count = 0) {
        $this->_db()->start_cache();
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
    
    function listing($filter = null, $sort = null, $limit = null, $offset = null, &$count = 0) {
        return $this->find($filter, $sort, $limit, $offset, $count);
    }

    function delete($id) {
        if (is_array($id)) {
            $this->_db()->where_in('id', $id);
            $this->_db()->delete($this->_name);
        } else {
            $this->_db()->delete($this->_name, array('id' => $id));
        }
    }
    
    function delete_detail($parent_field, $parent_id) {
        $this->_db()->delete($this->_name, array($parent_field => $parent_id));
    }

    function field_data() {
        return $this->_db()->field_data($this->_name);
    }

    function _db($name = null) {
        if (!isset($name)) {
            $name = $this->_dbname;
        }

        if ($name === 'default') {
            return $this->db;
        } else {
            return $this->{$name . 'db'};
        }
    }

    function list_fields() {
        return $this->_db()->list_fields($this->_name);
    }

    function query($sql, $binds = FALSE) {
        return $this->_db()->query($sql, $binds);
    }
    
    function truncate() {
        return $this->_db()->truncate($this->_name);
    }

}

