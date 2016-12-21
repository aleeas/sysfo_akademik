<?php

/**
 * Description of format_helper
 *
 * @author Andi Susilo
 */

if (!function_exists('format_number')) {

    function format_number($value, $field_name) {
        return $value;
    }

}

if (!function_exists('format_gender')) {

    function format_gender($value, $field_name) {
        $genders = array('-', 'M', 'F');
        return $genders[$value];
    }

}

if (!function_exists('format_short_datetime')) {

    function format_short_datetime($value) {
        if (empty($value) || substr($value, 0, 10) == '0000-00-00') {
            return '';
        }
        return date(l('format.short_datetime'), strtotime($value));
    }

}

if (!function_exists('format_short_date')) {

    function format_short_date($value) {
        if (empty($value) || substr($value, 0, 10) == '0000-00-00') {
            return '';
        }
        return date(l('format.short_date'), strtotime($value));
    }

}

if (!function_exists('format_long_date')) {

    function format_long_date($value) {
        if (empty($value) || substr($value, 0, 10) == '0000-00-00') {
            return '';
        }
        return date(l('format.long_date'), strtotime($value));
    }

}

if (!function_exists('format_password')) {

    function format_password($value, $field_name) {
        return str_repeat('*', strlen($value));
    }

}

if (!function_exists('format_image')) {

    function format_image($value, $field_name) {
        if (empty($value)) {
            return '';
        }
        return '<img src="' . data_url($value) . '"';
    }

}

if (!function_exists('format_row_detail')) {

    function format_row_detail($value, $field, $row, $index) {
        $CI = &get_instance();
        return sprintf('<a href="%s">%s</a>', site_url($CI->uri->rsegments[1] . '/detail/' . $row['id']), $value);
    }

}

if (!function_exists('format_url')) {

    function format_url($value, $field, $row, $index) {
        $CI = &get_instance();
        $CI->load->helper('url');
        return anchor($value);
    }

}

if (!function_exists('format_param_short')) {

    function format_param_short($value, $field) {
        $CI = &get_instance();
        $param = $CI->xparam->get($field, $value);
        return (empty($param['svalue'])) ? '-' : $param['svalue'];
    }

}

if (!function_exists('format_param_long')) {

    function format_param_long($value, $field) {
        $CI = &get_instance();
        $param = $CI->xparam->get($field, $value);
        return (empty($param['lvalue'])) ? '' : $param['lvalue'];
    }

}

if (!function_exists('format_mutu')) {

    function format_mutu($value, $field) {
        $CI = &get_instance();
        $param = $CI->xparam->get($field, $value);
        return (empty($param['lvalue'])) ? '' : $param['lvalue'];
    }

}

