<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Commerces extends CI_Controller {
    /*
      |===============================================================================
      | Constructeur
      |===============================================================================
     */

    public function __construct() {
        parent::__construct();

        $this->load->helper('form');

        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('Layout');

        $this->load->model('Commerce_model');
    }

    public function index() {
        $this->liste_produits();
    }

    public function liste_produits() {
        $result = $this->Commerce_model->read();
        if ($result) {
            $data = array (
                "commerces" => $result,
            );
            $this->layout->view('Commerces/liste_commerces', $data);
        } else {
            $data = array(
                'error_message' => 'Une erreur s\'est produite',
            );
            $this->layout->view('template/error_display', $data);
        }
    }
    
    public function fiche_commerce($siret_commerce) {
        $where = array(
            "siretCommerce" => $siret_commerce,
        );
        $result = $this->Commerce_model->read('*', $where, 1);
        if ($result) {
            $data = array (
                "commerce" => $result[0],
            );
            $this->layout->view('Commerces/fiche_commerce', $data);
        } else {
            $data = array(
                'error_message' => 'Une erreur s\'est produite',
            );
            $this->layout->view('template/error_display', $data);
        }
    }

}

?>