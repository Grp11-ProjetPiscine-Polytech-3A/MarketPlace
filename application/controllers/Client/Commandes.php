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

        $this -> load -> helper('form');
        $this -> load -> helper('assets');

        $this -> load -> library('form_validation');
        $this -> load -> library('session');
        $this -> load -> library('Layout');

        $this -> load -> model('Commande_model');
        $this -> load -> model('Client_commande_effectuer_model');
        $this -> load -> model('Ligne_commande_model');
        $this -> load -> model('Produit_variante_model');
    }

    public function index() {
        $this -> afficher_commandes();
    }

    /**
     * Page du panier
     */
    public function afficher_commandes() {
        if (isset($this -> session -> logged_in['username'])) {
            $result = $this -> Commande_model -> produits_commande();
            if ($result && count($result) > 0) {
                $produits = array();
                foreach ($result as $ligne) {
                    $produit = array();
                    $produit['img_url'] = url_images_in_folder("/assets/images/produits/produit_" . $ligne -> idProduitType . "/", true)[0];
                    $produit['nomProduitVariante'] = $ligne -> nomProduitVariante;
                    $produit['idProduitType'] = $ligne -> idProduitType;
                    $produit['designation'] = $ligne -> nomProduitVariante;
                    $produit['nomCommerce'] = $ligne -> nomCommerce;
                    $produit['etatReservationLigneCommande'] = $ligne -> etatReservationLigneCommande;
                    $produit['prixProduitVariante'] = $ligne -> prixProduitVariante;
                    $produit['quantité'] = $ligne -> quantité;
                    $produit['designation'] = $ligne -> nomProduitVariante;
                    $produit['prixAchatProduit'] = $ligne -> prixAchatProduit;
                    array_push($produits, $produit);
                }

                $data = array (
                    'produits' => $produits,    
                );

                $this -> layout -> views('template/message_display', $data);
            } else {
                $data = array(
                    'message_display' => 'Aucun produit commandé',
                );
            $this -> layout -> views('template/message_display', $data);
            }
        } else {
            $data = array(
                'error_message' => 'Vous n\'êtes pas connecté',
            );
            $this -> layout -> views('template/error_display', $data);
        }
        $this -> layout -> view('Client/Commandes/commandes');
    }

    /**
     * Ajoute le panier aux commandes
     */
    public function ajouter_commandes() {
        // Ajout de la commande
        $result_commande = $this -> Commande_model -> creer_commande();
        if(!is_null($result_commande)) {
          $idCommande = $result_commande;
          $idClient = $this -> session -> logged_in['idClient'];
          // TODO : ajouter nbPoint depuis panier
          $nbPoint = 0;
          // Liaison de la commande avec le client
          $result_client_commande = $this -> Client_commande_effectuer_model -> ajouter_client_commande_effectuer($idCommande, $idClient, $nbPoint);
          if ($result_client_commande) {
              // Si l'ajout s'est bien effectué
              // Ajout des produits dans le panier aux commandes
              foreach ($this -> session -> panier as $product) {
                $idProduit = (int)$product['idProduit'];
                $data = array(
                  // TODO : Systeme de validation du commercant
                  'etatReservationLigneCommande' => 'Commande passée non validée',
                  'quantité' => $product['quantite'],
                  'prixAchatProduit' => $this -> Produit_variante_model -> getProductPrice($idProduit),
                  'idProduitVariante' => $product['idProduit'],
                  'idCommande' => $idCommande,
                );
                $result = $this -> Ligne_commande_model -> create($data);
              }
              // TODO : Vider Panier (Je ne suis pas sur de comment le faire proprement, sacahnt que je ne peux pas appeler une fonction provenant d'un autre controller ...)
              $this -> afficher_commandes();
          } else {
            //annuler_commande
            $where = array (
                'idCommande' => $idCommande,
            );
            $this -> Commande_model -> delete($where);
            $this -> Client_commande_effectuer_model -> delete($where);
            $data = array(
                'error_message' => 'Echec de l\'ajout de la commande, suppression',
            );
            $this -> layout -> view('template/error_display', $data);
          }
        } else {
          $data = array(
              'error_message' => 'Echec de l\'ajout de la commande',
          );
          $this -> layout -> view('template/error_display', $data);
        }
    }

    /**
     * Supprime un produit du panier et affiche le nouveau panier
     * @param int $idProduit    l'id du produit a supprimer des commandes
     * @param int $quantite     La quantite a supprimer, si la quantite est <= 0 ou est plus grande que la quantite actuelle, supprime tout.
     */
    public function annuler_commande($idProduit, $quantite = 1) {
        // TODO : Faire fonction annuler commande quand l'ajout seras finalisé
        $this -> afficher_commandes();
    }
}

?>
