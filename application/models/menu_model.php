<?php

/**
 * Description of menu_model
 *
 * @author Andi Susilo
 */
class Menu_model extends App_Base_Model {

    var $_priv;

    function _privileges() {
        if (!isset($this->_priv)) {
            $CI = &get_instance();
            $this->_priv = $CI->_model('user')->privileges();
        }
        return $this->_priv;
    }

    function _find_menu($menu_name = '', $parent_id = 0) {
        $privs = $this->_privileges();

        $sql = 'SELECT * FROM ' . $this->_db()->dbprefix . 'menu WHERE parent_id = ? and active = 1 ORDER BY position, id';
        $menu_rows = $this->_db()->query($sql, array($parent_id))->result_array();

        $menus = array();

        $CI = &get_instance();

        foreach ($menu_rows as $menu) {
            // all-access menu
            if (in_array($menu['uri'], array('user/login', 'user/register', ''))) {
                $menu['children'] = $this->_find_menu($menu_name, $menu['id']);
                if (!empty($menu['children']) || $menu['uri'] != '') {
                    $menus[] = $menu;
                }
                continue;
            } elseif ($menu['uri'] == 'user/logout' && $CI->_get_user()->username !== 'guest') {
                $menu['children'] = $this->_find_menu($menu_name, $menu['id']);
                if (!empty($menu['children']) || $menu['uri'] != '') {
                    $menus[] = $menu;
                }
                continue;
            }

            foreach ($privs as $priv) {
                if ($priv['uri'] === '*' || $priv['uri'] === $menu['uri']) {
                    $menu['children'] = $this->_find_menu($menu_name, $menu['id']);
                    if (!empty($menu['children']) || $menu['uri'] != '') {
                        $menus[] = $menu;
                    }
                }
            }
        }
        return $menus;
    }

    function find_admin_panel() {
        $CI = &get_instance();
        $cache_key = __METHOD__ . ':' . $CI->_get_user()->username;
        if ($CI->config->item('cache_menu')) {
            $menus = $CI->cache->get($cache_key);
        }
        if (empty($menus)) {
            $menus = $this->_find_menu();
            $CI->cache->save($cache_key, $menus, 60 * 60 * 24);
        }
        return $menus;
    }

    function find_children($parent_id = 0, $level = 0) {
        $retval = array();
        $result = $this->_db()->query('SELECT * FROM menu WHERE parent_id = ? ORDER BY position', $parent_id)->result_array();
        foreach ($result as $row) {
            $row['title'] = str_repeat('___', $level) . ' ' . $row['title'];
            $retval[] = $row;
            $sub_result = $this->find_children($row['id'], $level + 1);

            if (!empty($sub_result)) {
                $retval = array_merge($retval, $sub_result);
            }
        }
        return $retval;
    }

    function find_hierarchical($filter = null, $sort = null, $limit = null, $offset = null, &$count = 0) {
        $result = $this->find_children();
        return $result;
    }

}
