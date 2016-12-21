<?php

/**
 * Description of jurusan_model
 *
 * @author Andi Susilo
 */
class Jurusan_model extends Base_Model {


    function find($filter = null, $sort = null, &$count = 0) {
        $this->_db()->start_cache();

        $this->_db()
                ->select('fakultas.name fakultas_name, jurusan.*')
                ->join('fakultas', 'jurusan.fakultas_id = fakultas.id', 'LEFT')
                ->order_by('jurusan.fakultas_id,jurusan.name', 'asc');

        if (!empty($filter) && !is_array($filter)) {
            $filter = array('id' => $filter);
            $this->_db()->where($filter);
        } elseif (is_array($filter)) {
            unset($filter['q']);
            $this->_db()->or_like($filter, '', 'both');
        }
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

    function find_mahasiswa($jurusan_id) {
        return $this->_db()->query('SELECT *, user.image FROM user WHERE jurusan_id = ?', array($jurusan_id))->result_array();
    }

}
?>
