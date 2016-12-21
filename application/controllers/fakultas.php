<?php

/**
 * Description of fakultas
 *
 * @author Andi Susilo
 */
class Fakultas extends App_Crud_Controller {

    function __construct() {
        parent::__construct();

        $this->_validation = array(
                'add' => array(
                        array(
                                'field' => 'name',
                                'label' => _('fakultas Name'),
                                'rules' => 'required',
                        ),
                ),
                'edit' => array(
                        array(
                                'field' => 'name',
                                'label' => _('fakultas Name'),
                                'rules' => 'required',
                        ),
                ),
        );
    }

    function _config_grid() {
        $config = parent::_config_grid();
        $config['fields'] = array('name','informasi');
        $config['names'] = array('Nama Fakultas','Informasi Fakultas');
        $config['formats'] = array(null, null);
        $config['formats'] = array('row_detail','');
        $config['filters'] = array('fakultas.name');

        return $config;
    }

    function _save($id=null) {
        parent::_save($id);
    }

    function detail($id) {
        $this->_data['fakultas'] = $fa = $this->_model()->get($id);
    }

}
