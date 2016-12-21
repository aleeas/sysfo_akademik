<?php
/**
 * Description of kampus_model
 *
 * @author Andi Susilo
 */
class Kampus_model extends App_Base_Model {
    function save_mine($data, $id = null) {
        $CI = &get_instance();
        $now = date('Y-m-d H:i:s');
        
        $new_id = $this->save($data, $id);
        if (empty($id)) {
            $uo = array(
                'user_id' => $CI->_get_user()->id,
                'org_id' => $new_id,
            );
            
            $this->before_save($uo);
            $this->_db()->insert('user_kampus', $uo);
            
            $id = $new_id;
        } else {
            throw new Exception('Belum');
        }
        return $id;
    }
}
?>
