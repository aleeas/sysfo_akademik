<?php
/**
 * Description of xform_helper
 *
 * @author Andi Susilo
 */

if ( ! function_exists('xform_autocomplete')) {
    function xform_autocomplete($input_data = '', $value = '', $extra = '', $data = '') {
        $CI = &get_instance();

        if (is_array($input_data)) {
            $field = $input_data['name'].'_options';
            $f_name = $input_data['name'];
        } else {
            $field = $input_data.'_options';
            $f_name = $input_data;
        }

        if ($data === '') {
            if (!empty($CI->load->_ci_cached_vars[$field])) {
                $data = $CI->load->_ci_cached_vars[$field];
            } else {
                $data = site_url('rpc/'.$field);
            }
        } elseif (is_string($data)) {
            $data = site_url($data);
        }

        return $CI->load->view('helpers/xform_autocomplete', array(
                'data' => $data,
                'field' => $f_name,
                'input_data' => $input_data,
                'value' => $value,
                'extra' => $extra,
                ), true);
    }
}

if ( !function_exists('xform_boolean')) {
    function xform_boolean($data) {
        $items = array( 'False', 'True' );
        return form_dropdown($data, $items);
    }
}

if ( !function_exists('xform_to_mdatetime')) {
    function xform_to_mdatetime($fdate, $ftime = '') {
        $fdate = explode('/', $fdate);
        $ftime = explode(':', $ftime);
        if (count($ftime) < 3) {
            $count = count($ftime);
            for($i=$count;$i<=3;$i++) {
                $ftime[] = '00';
            }
        }
        return trim($fdate[2]).'-'.trim($fdate[1]).'-'.trim($fdate[0]).' '.trim($ftime[0]).':'.trim($ftime[1]).':'.trim($ftime[2]);
    }
}

if ( !function_exists('xform_lookup')) {

	function xform_lookup($field_name, $sgroup = '', $selected = array(), $extra = '') {
		$sgroup = (empty($sgroup)) ? $field_name : $sgroup;
		
		$CI = &get_instance();
		$rows = $CI->db->query('SELECT * FROM sysparam WHERE sgroup = ?', array($sgroup))->result_array();
		$options = array();
                $options[''] = '-Pilih-';
		foreach($rows as $row) {
		    $options[$row['skey']] = $row['svalue'];
		}
		return form_dropdown($field_name, $options, $selected, $extra);
	}
}

if ( !function_exists('xform_lookup_sks')) {

	function xform_lookup_sks($field_name, $sgroup = '', $selected = array(), $extra = 'id="sks-box"') {
		$sgroup = (empty($sgroup)) ? $field_name : $sgroup;

		$CI = &get_instance();
		$rows = $CI->db->query('SELECT * FROM sysparam WHERE sgroup = ?', array($sgroup))->result_array();
		$options = array();
                $options[''] = '-Pilih-';
		foreach($rows as $row) {
		    $options[$row['skey']] = $row['svalue'];
		}
		return form_dropdown($field_name, $options, $selected, $extra);
	}
}

if ( !function_exists('xform_date')) {

	function xform_date($name) {
		$CI = &get_instance();
		$data = array(
		    'name' => $name,
		);
		if (empty($_POST[$name])) {
		    $_POST[$name] = mysql_current_date();
		}
		return $CI->load->view('helpers/xform_date', $data, true);
	}

}
