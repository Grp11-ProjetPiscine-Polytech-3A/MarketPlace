<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include "Commercant.php";


class Commerces extends Commercant {
    /*
      |===============================================================================
      | Constructeur
      |===============================================================================
     */

    
    public function __construct() {
        parent::__construct();

        $this->load->model('Commercant_commerce_gerer_model');
        $this->load->model('Commerce_model');

        $this->layout->ajouter_menu_url('sideMenu', 'Liste des commerces', 'Commercant/Commerces/liste_commerces');
        $this->layout->ajouter_menu_url('sideMenu', 'Ajouter un commerce', 'Commercant/Commerces/ajout_produit');
    }
    
    public function index() {
        $this->liste_commerces("");
    }

    public function liste_commerces($siretCommerce = null) {
        $commerces = $this->get_commerces();
        
        // Reccupere la liste des commerces
        $liste_commerces = $this->liste_commerce();

        $data = array(
            "commerces" => $liste_commerces,
        );

        $this->layout->view('Commercant/Commerces/liste_commerces', $data);
    }
    
     private function liste_commerce() {
        $commerces = $this->get_commerces();

        // Reccupere la liste des produits
        $liste_commerce = array();
        foreach ($commerces as $com) {
            foreach ($com as $c) {
                $where = array(
                    "siretCommerce" => $c->siretCommerce,
                );
                $commerces = $this->Commerce_model->read('*', $where);

                if ($commerces) {
                    foreach ($commerces as $p) {
                        // Ajoute le commerce avec les donnees completés à la liste
                        $liste_commerce[] = $p;
                    }
                }
            }
        }
        return $liste_commerce;
    }
    
}


