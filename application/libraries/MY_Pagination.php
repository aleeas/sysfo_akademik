<?php

class MY_Pagination extends CI_Pagination {

    var $per_pages = '';
    var $per_page_changer_prefix = 'Show: ';

    function __construct($params = array()) {
        parent::__construct($params);

        $CI = &get_instance();

        if (isset($_GET['per_page'])) {
            $CI->session->set_userdata('per_page', $_GET['per_page']);
            $this->per_page = $_GET['per_page'];
            redirect($CI->_get_uri($CI->uri->rsegments[2]));
        } else {
            $per_page = $CI->session->userdata('per_page');
            if (!empty($per_page)) {
                $this->per_page = $per_page;
            }
        }
    }

    function initialize($params = array()) {
        $CI = &get_instance();
        $listing_pos = array_search('listing', $CI->uri->segments);

        $this->base_url = site_url($CI->_get_uri('listing'));
        $this->uri_segment = $listing_pos + 1;

        parent::initialize($params);
    }

    function per_page_changer() {
        $CI = &get_instance();
        $current_per_page = $CI->session->userdata('per_page');
        if (empty($current_per_page)) {
            $current_per_page = $this->per_pages[0];
            $CI->session->set_userdata('per_page', $current_per_page);
        }

        return $CI->load->view('libraries/pagination_per_page_changer', array(
            'CI' => $CI,
            'self' => $this,
            'current_per_page' => $current_per_page,
                ), true);
    }

}