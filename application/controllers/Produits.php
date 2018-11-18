<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produits extends CI_Controller {
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

        $this->load->model('Produit_type_model');
    }

    public function index() {
        $this->liste_produits();
    }

    public function liste_produits() {
        $result = $this->Produit_type_model->read();
        if ($result) {
            $data = array (
                "produits" => $result,
            );
            $this->layout->view('Produits/liste_produits', $data);
        } else {
            $data = array(
                'error_message' => 'Une erreur s\'est produite',
            );
            $this->layout->view('template/error_display', $data);
        }
    }
    
    public function fiche_produit($id_Produit) {
        echo 'Fiche du produit dont l\'id est ' . $id_Produit;
    }

}

?>
