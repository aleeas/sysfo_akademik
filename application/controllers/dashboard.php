<?php

/**
 * Description of dashboard
 *
 * @author Andi Susilo
 */
class Dashboard extends App_Base_Controller {
    
    function index() {
        
        // $fakultass = $this->db->query('SELECT * FROM fakultas')->result_array();
        // $this->_data['fakultass'] = $fakultass;
    
        $nilais = $this->db->query('SELECT * FROM nilai')->result_array();
        $this->_data['nilais'] = $nilais;
        
        $jurusans = $this->db->query('SELECT * FROM jurusan')->result_array();
        $this->_data['jurusans'] = $jurusans;
    }
    
    function _check_access() {
        return $this->auth->is_login();
    }
}