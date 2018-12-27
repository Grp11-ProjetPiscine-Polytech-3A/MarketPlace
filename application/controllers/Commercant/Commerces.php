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

        $this->layout->ajouter_menu_url('sideMenu', 'Liste des commerces', 'Commercant/Commerces/liste_commerce');
        $this->layout->ajouter_menu_url('sideMenu', 'Ajouter un commerce', 'Commercant/Commerces/ajout_produit');
    }
}