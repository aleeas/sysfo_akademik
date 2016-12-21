<?php

/**
 * Description of Matkul_model
 *
 * @author Andi Susilo
 */
class Matkul_model extends App_Base_Model {
    function find($filter = null, $sort = null, &$count = 0) {
        $this->_db()->start_cache();

        $this->_db()
                ->select('jurusan.name jurusan_name, sks.name sks_name, matkul.*')
                ->join('jurusan', 'matkul.jurusan_id= jurusan.id', 'LEFT')
                ->join('sks','matkul.sks_id=sks.id', 'LEFT')
                ->order_by('matkul.jurusan_id ,matkul.semester', 'ASC');

        if (!empty($filter) && !is_array($filter)) {
            $filter = array('id' => $filter);
            $this->_db()->where($filter);
        } elseif (is_array($filter)) {
            unset($filter['q']);
            $this->_db()->or_like($filter, '', 'both');
        }
        $CI = &get_instance();
        $id = $CI->_get_user()->id;

        if (!empty($sort) && is_array($sort)) {
            foreach ($sort as $key => $value) {
                $this->_db()->order_by($key, $value);
            }
        }
        $this->_db()->stop_cache();
        $count = $this->_db()->count_all_results($this->_name);

        $result = $this->_db()->get($this->_name);

        $this->_db()->flush_cache();

        return $result->result_array();
    }
}

?>
