 <?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Commercant extends CI_Controller {
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
        $this->load->model('Commercant_model');
        $this->load->model('Categorie_model');
    }

    public function index() {
        if ($this->Commercant_model->isCommercant()){
            $data = array (
                // EMPTY
            );
            $this->layout->view('Commercant/menu_commercant', $data);
        } else {
            $data = array(
                'error_message' => 'Not allowed here',
            );
            $this->layout->view('template/error_display', $data);
        }
    }

    public function ajout_produit(){
        // Vérification que l'utilisateur est bien commercant
        if ($this->Commercant_model->isCommercant()){
            $categ = $result = $this->Categorie_model->read('*');
            if ($categ) {
                $data = array (
                    "categories"    => $categ,
                    "error"         => ' ',
                );
                $this->layout->view('Commercant/Produits/ajout_produit', $data);
            } else {
                $data = array(
                    'error_message' => 'Une erreur s\'est produite : Pas de categories',
                );
                $this->layout->view('template/error_display', $data);
            } 
        } else {
            $data = array(
                    'error_message' => 'Not allowed here',
                );
                $this->layout->view('template/error_display', $data);
        }
    }
}