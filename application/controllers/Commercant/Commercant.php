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
        $this->load->model('Produit_type_model');
        $this->load->model('Produit_variante_model');
        $this->load->model('Commerce_model');
        $this->load->model('Commercant_commerce_gerer_model');

        // Verifie que l'utilisateur est bien un commercant et refuse l'acces si ce n'est pas le cas
        if (!isset($this->session->logged_in['idCommercant'])) {
            $data = array(
                'error_message' => 'Vous ne possédez pas les droits pour accéder à cette page',
            );
            echo $this->layout->view('template/error_display', $data, true);
            die();
        } else {
            // Gestion du menu commercant
            $this->layout->set_menu_auto_false();

            // Menu du haut pour le retour à la vue client
            $this->layout->ajouter_menu('topMenu', '<i class="fa fa-arrow-left"></i> Retour à l\'espace client', '');

            // Menu de gauche (gestion des produits, des commerces, Parametres...
            $this->layout->ajouter_menu_url('menu', 'Gerer vos Produits', 'Commercant/Produits');
            $this->layout->ajouter_menu_url('menu', 'Gerer vos Commerces', 'Commercant/Commerces');
            $this->layout->ajouter_menu_url('menu', 'Paramètres', 'Commercant/Parametres');
        }
    }

    public function index() {
        $this->get_data_commercant();
        $this->layout->view('Commercant/espace_commercant');
    }

    /**
     * Renvoie les donnees relatives a ce commercant
     * @return Array    Le tableau des donnees du commercant
     */
    protected function get_data_commercant() {
        $data = array();
        $idCommercant = $this->session->logged_in['idCommercant'];

        // Chargement des donnees du commercant
        $where = array("idCommercant" => $idCommercant);
        $data_commercant = $this->Commercant_model->read('*', $where);
        if ($data_commercant) {
            $data[] = $data_commercant;
        }
        return $data;
    }

    /**
     * Renvoie la liste des commerces geres pas ce commercant
     * Il y aura deux categories de commerces : 
     * - "commerces" : les commerces dont ce commercant est propriétaire
     * - "commerces_geres" : Les commerces que le commercant gere mais dont il n'est pas proprio
     * @return Array    Les commerces ranges dans les deux cases "commerces" et "commerces_geres
     */
    protected function get_commerces() {
        $data = array();

        $idCommercant = $this->session->logged_in['idCommercant'];
        $where = array("idCommercant" => $idCommercant);

        // Chargement des donnees du commerce
        // Attention : Un commerce peut etre gere par plusieurs commercants, cependant
        // on ne renvoie ici que les commerces dont le commercant actuel est "proprio"
        $data_commerce = $this->Commerce_model->read('*', $where);
        if ($data_commerce) {
            $data['commerces'] = $data_commerce;
        }

        // Chargement des donnes des commerces geres (mais pas proprio)
        $siret_commerces = $this->Commercant_commerce_gerer_model->read('siretCommerce', $where);
        if ($siret_commerces) {
            $data_commerce_geres = array();
            foreach ($siret_commerces as $siret) {
                $siret = $siret->siretCommerce;
                $where = array(
                    "siretCommerce" => $siret,
                );
                $data_commerce_geres[] = $this->Commerce_model->read('*', $where)[0];
            }
            $data['commerces_geres'] = $data_commerce_geres;
        }
        return $data;
    }

    protected function get_raw_commerces() {
        $data = array();
        $commerces = $this->get_commerces();
        foreach ($commerces as $com) {
            foreach ($com as $c) {
                $data[] = $c;
            }
        }
        
        return $data;
    }

}
