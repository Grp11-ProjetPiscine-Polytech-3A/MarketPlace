<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Panier extends CI_Controller {
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
        $this->load->model('Produit_variante_model');
        $this->load->model('User_model');
        $this->load->model('Commerce_model');
    }

    public function index() {
        $this->afficher_panier();
    }

    /**
     * Page du panier
     */
    public function afficher_panier() {
        $data = array(
            'produits' => array(),
        );

        $somme_prix = 0;

        if ($this->session->has_userdata('panier')) {
            $session_data = $this->session->panier;
            foreach ($session_data as $ligne) {
                // On stocke les donnees de la session dans ces deux variables
                $id_Produit = $ligne['idProduit'];
                $quantite = $ligne['quantite'];

                // Reccupere les donnees sur le produit
                $where = array(
                    "idProduitType" => $id_Produit,
                );
                $result = $this->Produit_type_model->read('*', $where, 1);

                // Si le produit existe, on l'ajoute au tableau
                if ($result) {
                    $donnees_produit = $result[0];

                    // Ajoute aux donnees du produit l'url de l'image 
                    $images_files = scandir(FCPATH . "/assets/images/produits/produit_" . $id_Produit . "/");
                    $image_url = base_url("/assets/images/produits/produit_" . $id_Produit . "/" . $images_files[2]);
                    $donnees_produit->image_url = $image_url;

                    // Ajoute aux donnees du produit la quantite
                    $donnees_produit->quantite = $quantite;

                    // Reccupere les donnees du commerce et les ajoutes
                    $where = array(
                        "siretCommerce" => $donnees_produit->siretCommerce,
                    );
                    $donnes_commerce = $this->Commerce_model->read('*', $where, 1);
                    if ($donnes_commerce) {
                        $donnees_produit->commerce = $donnes_commerce[0];
                    }

                    // Calcul du prix total du produit (PU * quantite) et ajoute a donnees commerce
                    $prix_total = $donnees_produit->prixProduitType * $donnees_produit->quantite;
                    $donnees_produit->prixTotal = $prix_total;

                    // Ajoute ce prix total a la somme totale
                    $somme_prix += $prix_total;

                    // Ajoute le produit au tableau de donnees a passer a la vue
                    $data['produits'][] = $donnees_produit;
                } else {
                    // Si le produit n'existe pas, on le supprime de la session
                    $this->supprimer_produit_sesssion($id_Produit, 0);
                }
            }
        }
        $data['somme_totale'] = $somme_prix;
        $this->layout->view('Panier/panier.php', $data);
    }

    /**
     * Ajoute un produit au panier
     * @param int $idProduit    L'id du produit a ajouter au panier
     */
    public function ajouter_panier($idProduit, $quantite = 1) {
        $session_data = array();

        if ($this->session->has_userdata('panier')) {
            $panier = $this->session->panier;

            foreach ($panier as $p) {
                if ($p['idProduit'] != $idProduit) {
                    $session_data[] = $p;
                } else {
                    $quantite += $p['quantite'];
                }
            }
        }

        $session_data[] = array(
            'idProduit' => $idProduit,
            'quantite' => $quantite,
        );
        // Add user data in session
        $this->session->set_userdata('panier', $session_data);

        $this->afficher_panier();
    }

    /**
     * Supprime un produit du panier et affiche le nouveau panier
     * @param int $idProduit    l'id du produit a supprimer
     * @param int $quantite     La quantite a supprimer, si la quantite est <= 0 ou est plus grande que la quantite actuelle, supprime tout
     */
    public function supprimer_panier($idProduit, $quantite = 1) {
        $this->supprimer_produit_sesssion($idProduit, $quantite);

        $this->afficher_panier();
    }

    /**
     * Supprime un produit du panier
     * @param int $idProduit    l'id du produit a supprimer
     * @param int $quantite     La quantite a supprimer, si la quantite est <= 0 ou est plus grande que la quantite actuelle, supprime tout
     */
    private function supprimer_produit_sesssion($idProduit, $quantite = 1) {
        $session_data = array();

        if ($this->session->has_userdata('panier')) {
            $panier = $this->session->panier;

            foreach ($panier as $p) {
                if ($p['idProduit'] != $idProduit) {
                    $session_data[] = $p;
                } else {
                    $p['quantite'] -= $quantite;
                    if ($quantite > 0 && $p['quantite'] > 0) {
                        $session_data[] = $p;
                    }
                }
            }
        }

        // Add user data in session
        $this->session->set_userdata('panier', $session_data);
    }

}

?>
