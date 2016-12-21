<?php

/**
 * Description of app_crud_controller
 *
 * @author Andi Susilo
 */
class App_Crud_Controller extends Crud_Controller {

    function _image_config() {
        return array(
            'presets' => array(
                'thumb' => array('width' => 180, 'height' => 120),
                'normal' => array('width' => 300, 'height' => 250),
                'large' => array('width' => 950, 'height' => 500),
            ),
            'field' => 'image',
            'data_dir' => $this->_name . '/map',
            'allowed_types' => 'gif|jpg|png',
            'encrypt_name' => true,
        );
    }

    function edit_image($id) {
        $images = $this->db->query('SELECT * FROM ' . $this->_name . '_foto WHERE ' . $this->_name . '_id = ? ORDER BY is_default DESC', array($id))->result_array();
        foreach ($images as &$image) {
            $i = explode('/', $image['uri']);
            $image['thumb'] = $i[0] . '/' . $i[1] . '/thumb/' . $i[2];
        }

        if ($_GET['nonce'] && $this->nonce->validate($_GET['nonce'])) {
            $this->_data['nonce'] = $this->nonce->get($_GET['nonce']);
        } else {
            redirect('jurusan/detail/' . $id);
        }

        $this->_data['images'] = $images;
    }

    function add_image($id) {
        $config = array(
            'presets' => array(
                'thumb' => array('width' => 180, 'height' => 120),
                'normal' => array('width' => 300, 'height' => 250),
                'large' => array('width' => 950, 'height' => 500),
            ),
            'field' => 'image',
            'data_dir' => $this->_name . '/image',
            'allowed_types' => 'gif|jpg|png',
            'encrypt_name' => true,
        );

        $this->load->library('ximage');
        $this->ximage->initialize($config);


        if ($this->_validate()) {

            $data = array(
                $this->_name . '_id' => $id,
                'uri' => $_POST['image'],
            );

            $def = $this->db->query('SELECT * FROM ' . $this->_name . '_foto WHERE ' . $this->_name . '_id = ? && is_default = 1', array($id))->row_array();
            if (empty($def)) {
                $data['is_default'] = 1;
            }
            $this->_model();
            Base_Model::before_save($data);

            $this->db->insert($this->_name . '_foto', $data);

            if (empty($def)) {
                $this->default_image($id, $this->db->insert_id());
            }
        }

        redirect($this->_name . '/edit_image/' . $id . '?nonce=' . $_GET['nonce']);
        exit;
    }

    function delete_image($id, $image_id) {
        $image = $this->db->query('SELECT * FROM ' . $this->_name . '_foto WHERE id = ?', array($image_id))->row_array();
        $def = $image['is_default'];

        $this->db->where('id', $image_id);
        $this->db->delete($this->_name . '_foto');

        if ($def) {
            $image = $this->db->query('SELECT * FROM ' . $this->_name . '_foto WHERE ' . $this->_name . '_id = ?', array($id))->row_array();
            if (empty($image)) {
                $this->default_image($id, 0);
            } else {
                $this->default_image($id, $image['id']);
            }
        }

        redirect($this->_name . '/edit_image/' . $id . '?nonce=' . $_GET['nonce']);
        exit;
    }

    function default_image($id, $image_id) {
        $image = $this->db->query('SELECT * FROM ' . $this->_name . '_foto WHERE id = ?', array($image_id))->row_array();

        if (empty($image_id)) {
            $this->db->where('id', $id);
            $this->db->update($this->_name, array(
                'image' => '',
            ));
        } else {

            $this->db->where('id', $id);
            $this->db->update($this->_name, array(
                'image' => $image['uri'],
            ));

            $this->db->update($this->_name . '_foto', array(
                'is_default' => 0,
            ));
            $this->db->where('id', $image_id);
            $this->db->update($this->_name . '_foto', array(
                'is_default' => 1,
            ));
        }

        redirect($this->_name . '/edit_image/' . $id . '?nonce=' . $_GET['nonce']);
        exit;
    }

    function show_image($id) {
        $data = $this->db->query('SELECT * FROM ' . $this->_name . '_foto WHERE ' . $this->_name . '_id = ? ORDER BY is_default DESC', array($id))->result_array();

        $this->_data['images'] = array();

        foreach ($data as $obj) {

            $image['uri'] = get_image_path($obj['uri'], 'large');
            $image['title'] = $obj['title'];
            $this->_data['images'][] = $image;
        }
    }
    
}
