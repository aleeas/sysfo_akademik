<?php

/**
 * Description of Xparam
 *
 * @author Andi Susilo
 */
class Xparam {

    var $tables = array('sysparam');
    var $data;

    function __construct($params = array()) {
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

    function get($sgroup, $skey) {
        $CI = &get_instance();

        if (!empty($this->data[$sgroup])) {
            return (empty($this->data[$sgroup][$skey])) ? array() : $this->data[$sgroup][$skey];
        }
        
        $cache_key = __METHOD__.'_'.$sgroup;
        $data = $CI->cache->get($cache_key);
        if ($data) {
            return (empty($data[$skey])) ? array() : $data[$skey];
        }

        foreach ($this->tables as $table) {
            $result = $CI->db->query('SELECT * FROM '.$table.' WHERE sgroup = ?', array($sgroup))->result_array();
            if (!empty($result)) {
                $data = array();
                foreach ($result as $row) {
                    $data[$row['skey']] =  $row;
                }
                break;
            }
        }
        $this->data[$sgroup] = $data;
        $CI->cache->save($cache_key, $data, 60 * 60 * 24);
        
        return (empty($data[$skey])) ? array() : $data[$skey];
    }

}
