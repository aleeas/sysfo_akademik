<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Crud_Controller
 *
 * @author Andi Susilo
 */
class Crud_Controller extends Base_Controller {

    var $_validation;

    function __construct() {
        parent::__construct();
        $this->load->helper(array('inflector', 'xform'));
    }

    function index() {
        redirect($this->_get_uri('listing'));
        exit;
    }

    function detail($id) {
        $this->_data['field_data'] = $this->_model()->field_data();
        $this->_data['data'] = $this->_model()->get($id);
    }

    function add() {
        $this->_save();
    }

    function edit($id) {
        if (!isset($id)) {
            redirect('/');
            exit;
        }

        $id = explode(',', $id);
        $this->_save($id[0]);
    }

    function delete($id) {
        if (!isset($id)) {
            redirect('/');
            exit;
        }
        if (!empty($_GET['confirmed'])) {
            $id = explode(',', $id);
            $this->_model($this->_name)->delete($id);
            redirect($this->_get_uri('listing'));
            exit;
        }

        $this->_data['id'] = $id;
        $this->_data['ids'] = explode(',', $id);

        if (count($this->_data['ids']) == 1) {
            $this->_data['row_name'] = 'row #' . $id;
        }
    }

    function _validate() {
        $this->_data['errors'] = (isset($this->_data['errors'])) ? $this->_data['errors'] : '';
        $result = true;

        $this->load->library('form_validation');
        if (!empty($this->_validation[$this->uri->rsegments[2]])) {
            $this->form_validation->set_rules($this->_validation[$this->uri->rsegments[2]]);

            $result = $this->form_validation->run();

            if (!$result) {
                $this->_data['errors'] = validation_errors();
            }
        }

        $uploader = null;
        if (isset($this->ximage)) {
            $uploader = $this->ximage;
        } elseif (isset($this->upload)) {
            $uploader = $this->upload;
        }
        if (!empty($uploader)) {
            if ($_FILES[$uploader->field]['error'] !== 4) {
                if (!$uploader->do_upload($uploader->field)) {
                    $result = false;
                    $this->_data['errors'] .= "\n" . $uploader->display_errors();
                }
            }
        }
        
        if (!empty($this->_data['errors'])) {
            $this->session->set_flashdata('validation::errors', $this->_data['errors']);
        }
        
        return $result;
    }

    function _save($id = null) {
        if (empty($_GET['nonce'])) {
            $_GET['nonce'] = $nonce = $this->nonce->create();
            $url = current_url() . '?';
            $g = array();
            foreach ($_GET as $key => $value) {
                $g[] = $key . '=' . $value;
            }
            $url .= implode('&', $g);

            redirect($url);
        } else if (!$this->nonce->validate($_GET['nonce'])) {
            $_GET['nonce'] = $nonce = $this->nonce->create();
            $url = current_url() . '?';
            $g = array();
            foreach ($_GET as $key => $value) {
                $g[] = $key . '=' . $value;
            }
            $url .= implode('&', $g);

            redirect($url);
        }
        

        $this->_data['nonce'] = $this->nonce->get($_GET['nonce']);

        $this->_set_view('show');
        $model = $this->_model();
        
        if ($_POST) {
            if ($this->_validate()) {
                $_POST['id'] = $id;
                try {
                    $model->save($_POST, $id);

                    $nonce = $this->nonce->get($_GET['nonce']);
                    $this->nonce->destroy($_GET['nonce']);

                    if ($this->input->is_ajax_request()) {
                        echo true;
                        exit;
                    } else {
                        if (!empty($nonce['referer']->url)) {
                            redirect($nonce['referer']->url);
                        } else {
                            redirect($this->_get_uri('listing'));
                        }
                        exit;
                    }
                } catch (Exception $e) {
                    $this->_data['errors'] = '<p>' . $e->getMessage() . '</p>';
                }
            }
        } else {
            if ($id !== null) {
                $this->_data['id'] = $id;
                $_POST = $model->get($id);
            }
        }

        $this->_data['field_data'] = $model->field_data();
    }

    function listing($offset = 0) {
        $this->load->library('pagination');

        $config_grid = $this->_config_grid();
        $config_grid['sort'] = $this->_get_sort();
        $config_grid['filter'] = $this->_get_filter();
        $per_page = $this->pagination->per_page;

        $method = $config_grid['method'];

        $count = 0;
        $this->_data['items'] = $this->_model()->$method($config_grid['filter'], $config_grid['sort'], $per_page, $offset, $count);
        $this->_data['filter'] = $config_grid['filter'];
        $this->load->library('xgrid', $config_grid, 'listing_grid');
        $this->load->library('pagination');
        $this->pagination->initialize(array(
            'total_rows' => $count,
            'per_page' => $per_page,
        ));
    }

    function _get_sort() {
        $sort = array();
        if (!empty($_GET['sort'])) {
            $ss = explode(',', $_GET['sort']);
            foreach ($ss as $s) {
                $s = explode(':', trim($s));
                $sort[$s[0]] = (!empty($s[1])) ? $s[1] : 'asc';
            }
        }
        return $sort;
    }

    function _get_filter() {
        $filter = '';
        if ($_POST) {
            foreach ($_POST as $key => $value) {
                if (empty($value)) {
                    unset($_POST[$key]);
                }
            }
            $data = array(
                'name' => $this->_name,
                'filter' => $_POST,
            );
            $this->session->set_userdata('listing', $data);
            redirect($this->_get_uri());
            exit;
        } elseif (isset($_GET['q'])) {
            foreach ($_GET as $key => $value) {
                if (empty($value)) {
                    unset($_GET[$key]);
                }
            }
            $data = array(
                'name' => $this->_name,
                'filter' => $_GET,
            );
            $this->session->set_userdata('listing', $data);
            redirect($this->_get_uri());
            exit;
        } else {
            $data = $this->session->userdata('listing');
            if ($data['name'] == $this->_name) {
                $filter = $data['filter'];
                $config_grid = $this->_config_grid();
                $fields = (!empty($config_grid['filters'])) ? $config_grid['filters'] : $this->_model()->list_fields();
                if (!empty($filter['q'])) {
                    foreach ($fields as $field) {
                        if (!array_key_exists($field, $filter)) {
                            $filter[$field] = $filter['q'];
                        }
                    }
                } else {
                    unset($filter['q']);
                }
            } else {
                $this->session->set_userdata('listing', null);
            }
        }


        return $filter;
    }

    function _config_grid() {
        return array(
            'fields' => $this->_model($this->_name)->list_fields(),
            'actions' => array(
                'edit' => $this->_get_uri('edit'),
                'delete' => $this->_get_uri('delete'),
            ),
            'method' => 'listing',
        );
    }

    function _is_generated($field) {
        foreach ($this->_model($this->_name)->_generated as $generated) {
            if ($generated === $field) {
                return true;
            }
        }
        return false;
    }


    function _get_exim_config() {
        $config_grid = $this->_config_grid();

        if (empty($config_grid['import'])) {
            $config_grid['import'] = $config_grid['fields'];
        }

        if (empty($config_grid['import_names'])) {
            foreach ($config_grid['import'] as $field) {
                $config_grid['import_names'][] = humanize($field);
            }
        }

        if (empty($config_grid['import_examples'])) {
            for ($i = 0; $i < 10; $i++) {
                $ex = array();
                foreach ($config_grid['import'] as $field) {
                    $ex[] = $field . ' ' . $i;
                }
                $config_grid['import_examples'][] = $ex;
            }
        }

        return $config_grid;
    }

}

