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
        $this->load->helper('assets');

        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('Layout');

        $this->load->model('Produit_type_model');
        $this->load->model('Produit_variante_model');
        $this->load->model('User_model');
        $this->load->model('Commerce_model');
        $this->load->model('Client_model');
    }

    public function index() {
        $this->afficher_panier();
    }

    /**
     * Page du panier
     */
    public function afficher_panier() {
        $idClient = $this->session->logged_in['idClient'];
        $data = array(
            'produits' => array(),
        );

        if (!is_null($idClient)) {
            $pointsFidelitesClient = $this->Client_model->get_nb_point_client($idClient)->pointsFidelitesClient;
            $data['pointsFidelitesClient'] = $pointsFidelitesClient;
        } else {
            $data['pointsFidelitesClient'] = 0;
        }
        $somme_prix = 0;

        if ($this->session->has_userdata('panier')) {
            $session_data = $this->session->panier;
            foreach ($session_data as $ligne) {
                // On stocke les donnees de la session dans ces deux variables
                $id_Produit_variante = $ligne['idProduit'];
                $quantite = $ligne['quantite'];

                // Reccupere les donnees sur le produit Variante
                $where = array(
                    "idProduitVariante" => $id_Produit_variante,
                );
                $produit_variante = $this->Produit_variante_model->read('*', $where, 1)[0];

                if ($produit_variante) {
                    // Reccupere les donnees sur le produit Type
                    $where = array(
                        "idProduitType" => $produit_variante->idProduitType,
                    );
                    $produit_type = $this->Produit_type_model->read('*', $where, 1);
                }

                // Si le produit existe, on l'ajoute au tableau
                if ($produit_variante && isset($produit_type) && $produit_type) {
                    // Rassemble les donnees du
                    $donnees_produit = (object) array_merge((array) $produit_type[0], (array) $produit_variante);

                    // Ajoute aux donnees du produit l'url de l'image
                    $image_url = url_images_in_folder("/assets/images/produits/produit_" . $donnees_produit->idProduitType . '/variante_' . $id_Produit_variante) [0];
                    $donnees_produit->image_url = $image_url;

                    // Ajoute aux donnees du produit la quantite
                    $donnees_produit->quantite = $quantite;

                    // Recupère les donnees du commerce et les ajoutes
                    $where = array(
                        "siretCommerce" => $donnees_produit->siretCommerce,
                    );
                    $donnes_commerce = $this->Commerce_model->read('*', $where, 1);
                    if ($donnes_commerce) {
                        $donnees_produit->commerce = $donnes_commerce[0];
                    }

                    // Calcul du prix total du produit (PU * quantite) et ajoute a donnees commerce
                    $prix_total = $donnees_produit->prixProduitVariante * $donnees_produit->quantite;
                    $donnees_produit->prixTotal = $prix_total;

                    // Ajoute ce prix total a la somme totale
                    $somme_prix += $prix_total;

                    // Ajoute le produit au tableau de donnees a passer a la vue
                    $data['produits'][] = $donnees_produit;
                } else {
                    // Si le produit n'existe pas, on le supprime de la session
                    $this->supprimer_produit_sesssion($id_Produit_variante, 0);
                }
            }
        }
        $data['somme_totale'] = $somme_prix;
        $this->layout->view('Panier/panier.php', $data);
    }

    /**
     * Ajoute un produit au panier
     * @param int $idProduit    L'id du produit a ajouter au panier
     * @param int $quantite     La quantite a ajouter, ne fait rien si le nombre est negatif
     */
    public function ajouter_panier($idProduitVariante, $quantite = 1) {
        if ($quantite < 0) {
            $quantite = 0;
        }
        $session_data = array();

        $ok = false;
        if ($this->session->has_userdata('panier')) {
            $panier = $this->session->panier;

            foreach ($panier as $p) {
                if ($p['idProduit'] != $idProduitVariante) {
                    $session_data[] = $p;
                } else {
                    $quantite += $p['quantite'];
                    $session_data[] = array(
                        'idProduit' => $idProduitVariante,
                        'quantite' => $quantite,
                    );
                    $ok = true;
                }
            }
        }
        if (!$ok) { // FIXME parce que bof
            $session_data[] = array(
                'idProduit' => $idProduitVariante,
                'quantite' => $quantite,
            );
        }



        // Add user data in session
        $this->session->set_userdata('panier', $session_data);

        $this->afficher_panier();
    }

    /**
     * Supprime un produit du panier et affiche le nouveau panier
     * @param int $idProduit    l'id du produit a supprimer
     * @param int $quantite     La quantite a supprimer, si la quantite est <= 0 ou est plus grande que la quantite actuelle, supprime tout.
     */
    public function supprimer_panier($idProduit, $quantite = 1) {
        $this->supprimer_produit_sesssion($idProduit, $quantite);

        $this->afficher_panier();
    }

    public function vider_panier() {
        $this->session->set_userdata('panier', []);

        $data = array(
            'message_display' => 'Le panier a été vidé',
        );

        // Load the logged_in view
        $this->layout->views('template/message_display', $data);
        
        $this->afficher_panier();
    }

    /**
     * Supprime un produit du panier
     * @param int $idProduit    l'id du produit a supprimer
     * @param int $quantite     La quantite a supprimer, si la quantite est < 0 ou est plus grande que la quantite actuelle, supprime tout.
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
