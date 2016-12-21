<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Base_controller
 *
 * @author Andi Susilo
 */
class Base_Controller extends CI_Controller {

    var $CI;
    var $_name;
    var $_data;
    var $_view;
    var $_layout_view = 'layouts/main';

    function __construct() {
        parent::__construct();

        $this->CI = $this;

        $this->config->load('app');

        if ($this->config->config['lang_refresh']) {
            exec('./install/lang/xlang > /dev/null 2>/dev/null &', $output);
        }

        if (!$this->input->is_cli_request()) {
            if ($this->config->config['cookie_path'] == '') {
                $x = explode($_SERVER['HTTP_HOST'], $this->config->item('base_url'));
                $cookie_path = rtrim($x[1], '/');
                $this->config->config['cookie_path'] = ($cookie_path == '') ? '/' : $cookie_path;
            }
        }

        $this->_name = $this->uri->rsegments[1];
        $this->_page_title = $this->config->item('page_title');
        $this->lang->load_gettext();

        $this->load->helper(array('url', 'form', 'x', 'text', 'app'));

        $this->load->library('session');
        $this->load->library('xparam');
        $this->load->library('nonce');

        if (!isset($this->auth)) {
            $this->load->library('xauth', null, 'auth');
        }

        if ($this->config->item('debug')) {
            $this->load->driver('cache', array('adapter' => 'dummy'));
        } else {
            $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        }
    }

    function _post_controller_constructor() {
        
        if (!$this->_check_access()) {
            redirect('user/login?continue=' . current_url(), null, 303);
            exit;
        }

        if (!isset($this->admin_panel)) {
            $this->load->library('xmenu', array(
                'menu_list' => $this->_model('menu')->find_admin_panel(),
                    ), 'admin_panel');
        }
        
        if (!$this->input->is_ajax_request()) {
            $track = $this->nonce->track();
        }
    }

    function _post_controller() {
        if (empty($this->_view)) {
            $this->_set_view($this->uri->rsegments[2]);
        }
        if (!$this->input->is_ajax_request() && !empty($this->_layout_view)) {
            $view = $this->_layout_view;
            $data = array();
        } else {
            $view = $this->_view;
            $data = $this->_data;
        }
        widget_view($view, $data);
    }

    function _set_view($view = '') {
        $this->_view = $this->_name . '/' . $view;
        if (file_exists(APPPATH . 'views/' . $this->_view . EXT)) {
            return $this->_view;
        }
        
        if (file_exists(APPPATH . 'views/' . $view . EXT)) {
            $this->_view = $view;
            return $view;
        }
        
        $this->_view = 'default/' . $this->_view;
        if (file_exists(APPPATH . 'views/' . $this->_view . EXT)) {
            return $this->_view;
        }
        $this->_view = 'default/' . $view;
        if (!file_exists(APPPATH . 'views/' . $this->_view . EXT)) {
            $this->_view = $this->_name . '/' . $view;
            return false;
        }
    }

    function _get_user($refetch = false) {
        return $this->auth->get_user($refetch);
    }

    function _get_uri($action = '') {
        $pos = array_search($this->_name, $this->uri->segments);
        if ($pos === false) {
            throw new RuntimeException('Error creating uri for action: ' . $action . ' with uri: ' . $this->uri->uri_string);
        }
        $uri = array_chunk($this->uri->segments, $pos);
        return implode('/', $uri[0]) . '/' . $action;
    }

    function _check_access() {
        if (strtoupper($this->config->item('uri_protocol')) === 'CLI') {
            return true;
        }

        if (preg_match('/user\/(login|logout|register)/', $this->uri->uri_string)) {
            return true;
        } elseif ($this->uri->rsegments[1] == 'about' && $_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
            return true;
        }

//        $uri = $this->uri->rsegments[1] . '/' . $this->uri->rsegments[2];
        $privileges = $this->_model('user')->privileges($this->uri->uri_string);
        if (!empty($privileges)) {
            return true;
        }

        return false;
    }

    function &_model($name = '') {
        if (empty($name)) {
            $name = $this->_name;
        }
        $model = $name . '_model';

        $this->load->model($model);

        return $this->$model;
    }

    function field_data() {
        return $this->db->field_data($this->_name);
    }

}

