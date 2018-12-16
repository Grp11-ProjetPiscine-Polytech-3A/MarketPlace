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
        
        // Verifie que l'utilisateur est bien un commercant et refuse l'acces si ce n'est pas le cas
        if (!isset($this->session->logged_in['idCommercant'])) {
             $data = array(
                'error_message' => 'Vous ne possédez pas les droits pour accéder à cette page',
            );
            echo $this->layout->view('template/error_display', $data, true);
            die();
        }
        
        // Gestion du menu commercant
        if (isset($this->session->logged_in['idCommercant'])) {
            $this->layout->set_menu_auto_false();

            // Menu du haut pour le retour à la vue client
            $this->layout->ajouter_menu('topMenu', '<i class="fa fa-arrow-left"></i> Retour à l\'espace client', '');
            
            // Menu de gauche (gestion des produits, des commerces, Parametres...
            $this->layout->ajouter_menu_url('sideMenu', 'Gerer vos produits', 'Commercant/Produits');
            $this->layout->ajouter_menu_url('sideMenu', 'Gerer vos Commerces', 'Commercant/Commerces');
            $this->layout->ajouter_menu_url('sideMenu', 'Parametres', 'Commercant/Parametres');
        }
    }

    public function index() {
            $this->layout->view('Commercant/espace_commercant');
    }

}
