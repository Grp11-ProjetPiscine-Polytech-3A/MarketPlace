<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include_once "Commercant.php";

class Commandes extends Commercant {
    /*
      |===============================================================================
      | Constructeur
      |===============================================================================
     */

    public function __construct() {
        parent::__construct();

        $this->load->model('Commande_model');
        $this->load->model('Client_commande_effectuer_model');
        $this->load->model('Ligne_commande_model');
        $this->load->model('Produit_variante_model');
        
        $this->load->helper('assets');
        

//        $this->layout->ajouter_menu_url('sideMenu', 'Liste des produits', 'Commercant/Produits/liste_produits');
//        $this->layout->ajouter_menu_url('sideMenu', 'Ajouter un produit', 'Commercant/Produits/ajout_produit');
    }

    public function index() {
        $this->liste_commandes();
    }

    /**
     * Affiche la liste des commandes pour ce commercant
     */
    public function liste_commandes() {
        $commandes = $this->Commande_model->commandes_commercant();
        if ($commandes) {
            
            // Reccuperation des images
            foreach ($commandes as $c) {
                $c->img_url = url_images_in_folder("/assets/images/produits/produit_" . $c->idProduitType . '/variante_' . $c->idProduitVariante) [0];
            }

            $data = ['commandes' => $commandes];
            $this->layout->view('Commercant/Commandes/commandes', $data);
        } else {
            $data = array(
                'error_message' => 'Aucunes commandes pour l\'instant',
            );
            $this->layout->view('template/error_display', $data);
        }
    }

}
