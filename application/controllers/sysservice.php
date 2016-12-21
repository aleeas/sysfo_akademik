<?php

/**
 * Description of service
 *
 * @author Andi Susilo
 */
class sysservice extends App_Crud_Controller {
    
    function _config_grid() {
        $config = parent::_config_grid();
        $config['fields'] = array('title', 'uri', 'status');
        $config['names'] = array('', 'URI');
        $config['formats'] = array('row_detail', '', 'callback__status');
        
        $config['actions'] = array(
            'start' => 'sysservice/start',
            'stop' => 'sysservice/stop',
            'delete' => 'sysservice/delete',
        );
        return $config;
        
    }
    
    function _status($value, $field, $row) {
        $result = '';
        if ($value) {
            $result .= '<span style="color:#090">Running ('.$row['pid'].')</span>';
        } else {
            $result .= '<span style="color:#f00">Stopped</span>';
        }
        return $result;
    }
    
    function start($id) {
        $this->_data['status'] = $this->_model()->start($id);
    }
    
    function stop($id) {
        $this->_data['status'] = $this->_model()->stop($id);
    }
    
    function listing($offset = 0) {
        parent::listing($offset);
        
        foreach($this->_data['items'] as &$item) {
            $updated = array();
            $this->_model()->status($item['id'], $updated);
            foreach($updated as $key => $value) {
                $item[$key] = $value;
            }
        }
    }
}