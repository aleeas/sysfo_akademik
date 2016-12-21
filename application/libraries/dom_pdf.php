<?php

/**
 * Description of dompdf
 *
 * @author Andi Susilo
 */
class dom_pdf {
    var $size = 'letter';
    var $orientation = 'portrait';

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

    function from_html($html, $filename, $stream = TRUE) {
        require_once(APPPATH . 'pdf/dompdf_config.inc.php');
        spl_autoload_register('DOMPDF_autoload');

        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        $dompdf->set_paper($this->size, $this->orientation);
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename . ".pdf");
        } else {
            $CI = & get_instance();
            $CI->load->helper('file');
            write_file('./' . $filename . 'pdf', $dompdf->output());
        }
    }

    function from_template($template, $data, $filename, $stream = TRUE) {
        $CI = &get_instance();
        $html = $CI->load->view($template, $data, true);
        $this->from_html($html, $filename, $stream);
    }

}

?>
