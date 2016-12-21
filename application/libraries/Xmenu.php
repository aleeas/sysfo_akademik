<?php
/**
 * Description of Admin_panel
 *
 * @author Andi Susilo
 */
class Xmenu {
    var $menu_list = array();
    var $home_url = '';

    function  __construct($params = array()) {
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

    function _get_menu($menus) {
        $CI = &get_instance();
        return $CI->load->view('libraries/xmenu_show', array(
                'menus' => $menus,
                'self' => $this,
                ), true);
    }

    function show() {
        $menu_string = '';
        if (!empty($this->menu_list)) {
            $menu_string = $this->_get_menu($this->menu_list);
        }
        return $menu_string;
    }

    function _get_breadcrumb_path($menus = 'top') {
        if ($menus == 'top') {
            $menus = $this->menu_list;
        }

        $CI = &get_instance();
        $uri = $CI->_get_uri($CI->uri->rsegments[2]);
        foreach ($menus as $menu) {
            if (!empty($menu['uri']) && $menu['uri'] == $uri) {
                return array ( $menu );
            } else if (!empty($menu['children'])) {
                $sub_menu = $this->_get_breadcrumb_path($menu['children']);
                if ($sub_menu !== null) {
                    if (empty($sub_menu['uri'])) {
                        return array_merge(array($menu), $sub_menu);
                    } else {
                        return array($menu, $sub_menu);
                    }
                }
            }
        }
        return null;
    }

    function breadcrumb($breadcrumb = null) {
        if ($breadcrumb == null) {
        $breadcrumb = $this->_get_breadcrumb_path();
        }
        $CI = &get_instance();
        return $CI->load->view('libraries/xmenu_breadcrumb', array(
                'breadcrumb' => $breadcrumb,
                'self' => $this,
                ), true);
    }
}
?>
