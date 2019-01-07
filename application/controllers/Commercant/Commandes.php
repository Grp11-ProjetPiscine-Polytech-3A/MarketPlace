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
                if ($c->etatReservationLigneCommande != "Confirmée" && $c->etatReservationLigneCommande != "Refusée") {
                    $c->color = "#CCC";
                } else if ($c->etatReservationLigneCommande == "Confirmée") {
                    $c->color = "#AAFFAA";
                } else {
                    $c->color = "#FFABAB";
                }
            }
            $data = ['commandes' => $commandes];
        } else {
            $data = array();
        }


        $this->layout->view('Commercant/Commandes/commandes', $data);
    }

    public function confirmer_commande($idLigne = 0) {
        if ($this->check_commande($idLigne)) {
            $update = $this->Ligne_commande_model->update(['idLigneCommande' => $idLigne], ['etatReservationLigneCommande' => 'Confirmée']);

            $this->liste_commandes();
        }
    }

    public function refuser_commande($idLigne = 0) {
        if ($this->check_commande($idLigne)) {
            $update = $this->Ligne_commande_model->update(['idLigneCommande' => $idLigne], ['etatReservationLigneCommande' => 'Refusée']);

            $this->liste_commandes();
        }
    }

    private function check_commande($idLigne) {
        $where = ['lc.idLigneCommande' => $idLigne];
        return count($this->Commande_model->commandes_commercant(0, $where)) > 0;
    }

}
