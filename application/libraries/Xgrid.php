<?php

/**
 * Description of Admin_panel
 *
 * @author Andi Susilo
 */
class Xgrid {

    var $fields = array();
    var $aligns = array();
    var $styles = array();
    var $formats = array();
    var $names = array();
    var $actions = array();
    var $dblclick_handler = '';
    var $sort = '';
    var $context_menu;

    function __construct($params = array()) {
        $CI = &get_instance();
        $CI->load->helper('format_helper');

        $this->initialize($params);
    }

    function initialize($params = array()) {
        if (count($params) > 0) {
            foreach ($params as $key => $val) {
                if (isset($this->$key)) {
                    $this->$key = $val;
                }
            }
        }
    }

    function format($value, $field_name, $row, $index) {
        if (empty($this->formats[$index])) {
            return $value;
        }
        $formatter_method = $this->formats[$index];

        if (strpos($formatter_method, 'callback_') === 0) {
            $CI = &get_instance();
            $formatter_method = str_replace('callback_', '', $formatter_method);
            return $CI->$formatter_method($value, $field_name, $row, $index);
        }

        $formatter_method = 'format_' . $formatter_method;
        if (function_exists($formatter_method)) {
            return $formatter_method($value, $field_name, $row, $index);
        } else {
            return 'not supported formatter (' . $this->formats[$index] . ')';
        }
    }

    function show($data) {
        $CI = &get_instance();

        $libid = uniqid('lib_');
        $CI->load->library('xctxmenu', array(
            'actions' => $this->actions,
                ), $libid);
        $this->context_menu = $CI->$libid;

        return $CI->load->view('libraries/xgrid_show', array(
            'data' => $data,
            'self' => $this,
            'filter' => $CI->_get_filter(),
                ), true);
    }

    function _sort_uri($field) {
        $s = 'asc';
        if (!empty($this->sort[$field])) {
            if (strtolower($this->sort[$field]) == 'asc') {
                $s = 'desc';
            }
        }
        return current_url() . '?sort=' . $field . ':' . $s;
    }

}

