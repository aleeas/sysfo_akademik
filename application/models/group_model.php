<?php
/**
 * Description of group_model
 *
 * @author Andi Susilo
 */
class Group_model extends App_Base_Model {

    function add_group_user($group_id, $user_id) {
        $group_user = array (
                'user_id' => $user_id,
                'group_id' => $group_id,
        );
        $gu = $this->db->get_where('user_group', $group_user)->row_array();

        if (empty($gu)) {
            $this->before_save($group_user);
            $this->db->insert('user_group', $group_user);
        }
    }

    function privileges($group_id, $uri = '%') {
        $CI = &get_instance();
        return $privileges = $this->_db()->query('SELECT * FROM '.$this->_db()->dbprefix.'privilege_group WHERE group_id = ? AND ( uri LIKE ? OR uri LIKE "*" )', array( $group_id, $uri ))->result_array();;
    }
}
?>
