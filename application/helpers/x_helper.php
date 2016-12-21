<?php

/*
 * x_helper.php
 *
 * Created on 21/06/2011 16:17:47
 *
 * Copyright(c) 2011 PT Sagara Xinix Solusitama.  All Rights Reserved.
 * This software is the proprietary information of PT Sagara Xinix Solusitama.
 *
 * History
 * =======
 * (dd/mm/yyyy hh:mm) (name)
 * 21/06/2011 16:17   Andi Susilo
 *
 */

if (!function_exists('xdebug')) {

    function xdebug($data, $to_screen = false) {
        if ($to_screen) {
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        }

        log_message('info', print_r($data, true));
    }

}

if (!function_exists('theme_url')) {

    function theme_url($uri = '') {
        $CI = & get_instance();
        $CI->load->helper('url');
        $uri = trim($uri);

        if (!preg_match("/^(http(s?):\/\/|ftp:\/\/{1})/i", $uri)) {
            if ($CI->config->item('debug')) {
                $tstamp = mktime();
                return base_url() . '' . $CI->config->item('theme') . '/' . $uri . '?' . $tstamp;
            } else {
                return base_url() . '' . $CI->config->item('theme') . '/' . $uri;
            }
        }
        return $uri;
    }

}

if (!function_exists('data_url')) {

    function data_url($uri = '') {
        $CI = & get_instance();
        $CI->load->helper('url');
        $uri = trim($uri);
        if (!preg_match("/^(http(s?):\/\/|ftp:\/\/{1})/i", $uri)) {
            $uri = base_url() . 'data/' . $uri;
        }
        return $uri;
    }

}

if (!function_exists('widget_ajax')) {

    function widget_ajax($url, $id = null, $attrs = null, $callback = 'null') {
        if ($id == null) {
            $id = uniqid('widget_');
        }

        $attr_str = '';
        if (!empty($attrs)) {
            foreach ($attrs as $key => $value) {
                $attr_str .= ' ' . $key . '="' . $value . '"';
            }
        }

        return '
            <script type="text/javascript">
                $(function() {
                    $("#' . $id . '").load("' . site_url($url) . '", ' . $callback . ');
                });
            </script>
            <div id="' . $id . '"' . $attr_str . '></div>
        ';
    }

}

if (!function_exists('widget_view')) {

    function widget_view($view, $data = null) {
        $CI = &get_instance();

        $data['CI'] = $CI;

        if (file_exists(APPPATH . '/views/' . $view . '.php')) {
            $CI->load->view($view, $data);
        } else {
            $message = 'View ' . $view . ' belum dibuat bung!';
            show_error($message);
        }
    }

}


if (!function_exists('x_anchor')) {

    function x_anchor($uri, $title, $attributes = '') {
        $CI = &get_instance();
        $privileges = $CI->_model('user')->privileges($uri);
        if (!empty($privileges)) {
            return anchor($uri, $title, $attributes);
        }
    }

}

if (!function_exists('fetch_uri')) {

    function fetch_uri($uri) {
        if ($uri == '/') {
            return $uri;
        }
        $segments = explode('/', $uri);
        return $segments[0] . ( (empty($segments[1])) ? '' : '/' . $segments[1] );
    }

}

if (!function_exists('xview_filter')) {

    function xview_filter($filter, $extra = '') {
        $CI = &get_instance();
        return $CI->load->view('helpers/xview_filter', array(
            'filter' => $filter,
            'extra' => $extra,
                ), true);
    }

}

if (!function_exists('xview_error')) {

    function xview_error() {
        $CI = &get_instance();
        
        $errors = @$CI->_data['errors'];
        $flash = $CI->session->flashdata('validation::errors');
        if ($errors != $flash) {
            @$CI->_data['errors'] .= $flash;
        }
        
        if (!empty($CI->_data['errors'])) {
            echo '<div class="error">' . $CI->_data['errors'] . '</div>';
        }
    }

}

if (!function_exists('xview_current_date')) {

    function xview_current_date() {
        return gmdate('d/m/Y', time() + 25200);
    }

}

if (!function_exists('human_current_date')) {

    function human_current_date() {
        return gmdate(l('format.short_date'), time() + 25200);
    }

}

if (!function_exists('mysql_current_date')) {

    function mysql_current_date() {
        return gmdate(l('format.mysql_datetime'), time() + 25200);
    }

}

if (!function_exists('date_parse_from_format')) {

    function date_parse_from_format($format, $date) {
        throw new Exception('Unimplemented yet on your PHP version');
    }

}

if (!function_exists('human_to_mysql')) {

    function human_to_mysql($d) {
        if (empty($d)) {
            return '';
        }
        $parsed = date_parse_from_format(l('format.short_date'), $d);
        $unix = mktime($parsed['hour'], $parsed['minute'], $parsed['second'], $parsed['month'], $parsed['day'], $parsed['year']);
        return date(l('format.mysql_datetime'), $unix);
    }

}

if (!function_exists('mysql_to_human')) {

    function mysql_to_human($d) {
        if (substr($d, 0, 10) == '0000-00-00') {
            return '';
        }
        $parsed = date_parse_from_format(l('format.mysql_datetime'), $d);
        $unix = mktime($parsed['hour'], $parsed['minute'], $parsed['second'], $parsed['month'], $parsed['day'], $parsed['year']);
        return date(l('format.short_date'), $unix);
    }

}


if (!function_exists('l')) {

    function l($key, $params = array()) {
        if (empty($params)) {
            return _($key);
//        } else if (!is_array($params)) {
//            $params = array($params);
        }

        $retval = sprintf(_($key), $params);
        return $retval;
    }

}

function get_image_path($img, $type = 'thumb', $def = '') {
    if (empty($img)) {
        return $def;
    }

    $d = explode('/', $img);
    return $d[0] . '/' . $d[1] . '/' . $type . '/' . $d[2];
}

