<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Commandes extends CI_Controller {
    /*
      |===============================================================================
      | Constructeur
      |===============================================================================
     */

    public function __construct() {
        parent::__construct();

        $this->load->helper('form');
        $this->load->helper('assets');

        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('Layout');

        $this->load->model('Commande_model');
    }

    public function index() {
        $this->afficher_commandes();
    }

    /**
     * Page du panier
     */
    public function afficher_commandes() {

        if (isset($this->session->logged_in['username'])) {

            $data = array(
                'produits' => $this->Commande_model->produits_commande(),
            );

            $this->layout->view('Commandes/commandes', $data);
        } else {
            $data = array(
                'error_message' => 'Vous n\'êtes pas connecté',
            );
            $this->layout->view('template/error_display', $data);
        }
}

    /**
     * CHECKME On a deja un panier, tu as recopié les commentaires sans les corriger ?
     * 
     * Ajoute un produit au panier
     * @param int $idProduit    L'id du produit a ajouter au panier
     * @param int $quantite     La quantite a ajouter, ne fait rien si le nombre est negatif
     */
    public function ajouter_commandes($idProduit, $quantite = 1) {

        $this->afficher_commandes();
    }

    /**
     * Supprime un produit du panier et affiche le nouveau panier
     * @param int $idProduit    l'id du produit a supprimer
     * @param int $quantite     La quantite a supprimer, si la quantite est <= 0 ou est plus grande que la quantite actuelle, supprime tout.
     */
    public function annuler_commande($idProduit, $quantite = 1) {
        $this->afficher_commandes();
    }
}

?>
