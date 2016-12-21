<?php

/**
 * Description of nilai_semester_8_model
 *
 * @author Andi Susilo
 */
class Nilai_Semester_8_model extends App_Base_Model {
    function listing($filter = null, $sort = null, $limit = null, $offset = null, &$count = 0) {
        $this->_db()->start_cache();

        $this->_db()
                ->select('matkul.code_matkul code_matkul ,matkul.name matkul_name, jurusan.name jurusan_name, nilai.name nilai_name, sks.name sks_name, user.username mahasiswa_nim,nilai_semester_8.*')
                ->join('jurusan', 'nilai_semester_8.jurusan_id= jurusan.id', 'LEFT')
                ->join('matkul', 'nilai_semester_8.matkul_id= matkul.id', 'LEFT')
                ->join('sks', 'matkul.sks_id= sks.id', 'LEFT')
                ->join('user', 'nilai_semester_8.mahasiswa_id= user.id', 'LEFT')
                ->join('nilai', 'nilai_semester_8.nilai_id= nilai.id', 'LEFT')
                ->order_by('nilai_semester_8.mahasiswa_id', 'asc');

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

        $result = $this->_db()->get($this->_name, $limit, $offset);
        $this->_db()->flush_cache();

        return $result->result_array();
    }

}
