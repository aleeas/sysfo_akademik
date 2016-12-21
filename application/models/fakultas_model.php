<?php

/**
 * Description of fakultas_model
 *
 * @author Andi Susilo
 */
class Fakultas_model extends App_Base_Model {
    function find_all($filter = null, $sort = null, $limit = null, $offset = null, &$count = 0) {
        $this->_db()->start_cache();

        $this->_db()
                ->select('fakultas.*')
                ->order_by('fakultas.name', 'asc');

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

        $result = $this->_db()->get($this->_name, $limit, $offset);

        $this->_db()->flush_cache();

        return $result->result_array();
    }
}

?>
