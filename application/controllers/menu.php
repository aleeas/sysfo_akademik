<?php

/**
 * Description of menu
 *
 * @author Andi Susilo
 */
class Menu extends App_Crud_Controller {

    function _config_grid() {
        $config = parent::_config_grid();
        $config['fields'] = array('title', 'uri', 'id');
        $config['names'] = array('Judul', 'URL', 'Rubah Posisi');
        $config['formats'] = array('', '', 'callback__move',);
        $config['filters'] = array('title', 'uri');
        return $config;
    }

    function _move($value) {
        if (!empty($value)) {
            return '
                <a href="' . site_url('menu/left/' . $value) . '" title="Ke kiri"><img src="' . theme_url('images/prev.gif') . '" /></a>
                    <a href="' . site_url('menu/up/' . $value) . '" title="Ke atas"><img src="' . theme_url('images/up.png') . '" /></a>
                        <a href="' . site_url('menu/down/' . $value) . '" title="Ke bawah"><img src="' . theme_url('images/down.png') . '" /></a>
                            <a href="' . site_url('menu/right/' . $value) . '" title="Ke kanan"><img src="' . theme_url('images/next.gif') . '" /></a>
                    ';
        }
    }

    function left($id) {
        $menu = $this->_model()->query('SELECT * FROM menu WHERE id = ?', $id)->row_array();
        $parent = $this->_model()->query('SELECT * FROM menu WHERE id = ?', $menu['parent_id'])->row_array();
        $menu['parent_id'] = $parent['parent_id'];
        $this->_model()->save($menu, $menu['id']);
        redirect('menu/listing');
    }

    function right($id) {
        $menu = $this->_model()->query('SELECT * FROM menu WHERE id = ?', $id)->row_array();

        $before = $this->_model()->query('
                SELECT * FROM menu WHERE parent_id = ? AND position <= ? ORDER BY position DESC, id DESC LIMIT 1,1
            ', array($menu['parent_id'], $menu['position']))->row_array();

        if (!empty($before)) {
            $this->_model()->save(array('parent_id' => $before['id']), $menu['id']);
        }
        redirect('menu/listing');
    }

    function up($id) {
        $menu = $this->_model()->query('SELECT * FROM menu WHERE id = ?', $id)->row_array();
        $siblings = $this->_model()->query('SELECT * FROM menu WHERE parent_id = ? ORDER BY position, id', $menu['parent_id'])->result_array();

        unset($before_key);
        foreach ($siblings as $key => $sibling) {
            $siblings[$key]['new_position'] = $key;
            if ($sibling['id'] == $menu['id']) {

                if (isset($before_key)) {
                    $siblings[$key]['new_position'] = $siblings[$before_key]['new_position'];
                    $siblings[$before_key]['new_position'] = $key;
                }
            }
            $before_key = $key;
        }

        foreach ($siblings as $key => $sibling) {
            $this->_model()->save(array('position' => $sibling['new_position']), $sibling['id']);
        }
        redirect('menu/listing');
    }

    function down($id) {
        $menu = $this->_model()->query('SELECT * FROM menu WHERE id = ?', $id)->row_array();
        $siblings = $this->_model()->query('SELECT * FROM menu WHERE parent_id = ? ORDER BY position, id', $menu['parent_id'])->result_array();

        $found = false;
        foreach ($siblings as $key => $sibling) {
            if ($found) {
                $found = false;
                continue;
            }
            $siblings[$key]['new_position'] = $key;
            if ($sibling['id'] == $menu['id']) {
                $found = true;
                if ($key + 1 < count($siblings)) {
                    $siblings[$key]['new_position'] = $key + 1;
                    $siblings[$key + 1]['new_position'] = $key;
                }
            }
        }

        foreach ($siblings as $key => $sibling) {
            $this->_model()->save(array('position' => $sibling['new_position']), $sibling['id']);
        }
        redirect('menu/listing');
    }

    function _save($id = null) {
        parent::_save($id);

        $menus = $this->_model()->query('SELECT * FROM menu')->result_array();
        $this->_data['parent_options'][0] = 'Top';
        foreach ($menus as $menu) {
            $this->_data['parent_options'][$menu['id']] = $menu['title'] . ' (' . $menu['uri'] . ')';
        }
    }

    function listing($offset = 0) {
        $this->load->library('pagination');

        $config_grid = $this->_config_grid();
        $config_grid['sort'] = $this->_get_sort();
        $config_grid['filter'] = $this->_get_filter();
        $per_page = $this->pagination->per_page;

        $count = 0;
        $this->_data['items'] = $this->_model()->find_hierarchical($config_grid['filter'], $config_grid['sort'], $per_page, $offset, $count);
        $this->_data['filter'] = $config_grid['filter'];
        $this->load->library('xgrid', $config_grid, 'listing_grid');
        $this->load->library('pagination');
        $this->pagination->initialize(array(
                'total_rows' => $count,
                'per_page' => $per_page,
        ));
    }

}
