<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Commandes extends CI_Controller {

    private $tauxGainPoints = 0.05;

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
        $this->load->model('Client_model');
        $this->load->model('Client_commande_effectuer_model');
        $this->load->model('Ligne_commande_model');
        $this->load->model('Produit_variante_model');
    }

    public function index() {
        $this->afficher_commandes();
    }

    /**
     * Page de la commande
     */
    public function afficher_commandes() {
        if (isset($this->session->logged_in['username'])) {
            $result = $this->Commande_model->produits_commande();
            if ($result && count($result) > 0) {
                $produits = array();
                foreach ($result as $ligne) {
                    $produit = array();
                    $produit['img_url'] = url_images_in_folder("/assets/images/produits/produit_" . $ligne->idProduitType . "/variante_" . $ligne->idProduitVariante, true)[0];
                    $produit['idLigneCommande'] = $ligne->idLigneCommande;
                    $produit['idCommande'] = $ligne->idCommande;
                    $produit['nomProduitVariante'] = $ligne->nomProduitVariante;
                    $produit['idProduitVariante'] = $ligne->idProduitVariante;
                    $produit['idProduitType'] = $ligne->idProduitType;
                    $produit['designation'] = $ligne->nomProduitType . ' - ' . $ligne->nomProduitVariante;
                    $produit['nomCommerce'] = $ligne->nomCommerce;
                    $produit['etatReservationLigneCommande'] = $ligne->etatReservationLigneCommande;
                    $produit['prixProduitVariante'] = $ligne->prixProduitVariante;
                    $produit['quantité'] = $ligne->quantité;
                    $produit['designation'] = $ligne->nomProduitVariante;
                    $produit['prixAchatProduit'] = $ligne->prixAchatProduit;

                    if ($produit['etatReservationLigneCommande'] != "Confirmée" && $produit['etatReservationLigneCommande'] != "Refusée") {
                        $produit['color'] = "#CCC";
                    } else if ($produit['etatReservationLigneCommande'] == "Confirmée") {
                        $produit['color'] = "#AAFFAA";
                    } else {
                        $produit['color'] = "#FFABAB";
                    }
                    array_push($produits, $produit);
                }

                $data = array(
                    'produits' => $produits,
                );
            } else {
                $data = array(
                    'message_display' => 'Vous n\'avez commandé aucun produit',
                );
                $this->layout->views('template/message_display', $data);
            }
        } else {
            $data = array(
                'error_message' => 'Vous n\'êtes pas connecté',
            );
            $this->layout->views('template/error_display', $data);
        }
        $this->layout->view('Client/Commandes/commandes', $data);
    }

    /**
     * Ajoute le panier aux commandes
     */
    public function ajouter_commandes() {
        // Ajout de la commande
        if (count($this->session->panier)) {
            $result_commande = $this->Commande_model->creer_commande();
            if (!is_null($result_commande)) {
                $idCommande = $result_commande;
                $idClient = $this->session->logged_in['idClient'];

                $whereClient = ["idClient" => $idClient];
                // Gestion du prix avec points de fidelite

                $nbpoint = $this->input->post('nbpoints');
                $ptsFidelitesClients = $this->Client_model->read('pointsFidelitesClient', $whereClient)[0]->pointsFidelitesClient;
                if ($nbpoint > $ptsFidelitesClients) {
                    $nbpoint = $ptsFidelitesClients;
                }

                $ptsFidelitesClients = $ptsFidelitesClients - $nbpoint;

                // Liaison de la commande avec le client
                $result_client_commande = $this->Client_commande_effectuer_model->ajouter_client_commande_effectuer($idCommande, $idClient, $nbpoint);
                if ($result_client_commande) {
                    // Si l'ajout s'est bien effectué
                    // Ajout des produits dans le panier aux commandes

                    $prixTotal = 0;

                    $reduction = ($nbpoint / 100) / count($this->session->panier);

                    foreach ($this->session->panier as $product) {
                        $idProduit = (int) $product['idProduit'];
                        $data = array(
                            'etatReservationLigneCommande' => 'Commande passée non validée',
                            'quantité' => $product['quantite'],
                            'prixAchatProduit' => $this->Produit_variante_model->getProductPrice($idProduit) - $reduction,
                            'idProduitVariante' => $product['idProduit'],
                            'idCommande' => $idCommande,
                        );
                        $prixTotal += $data['prixAchatProduit'] * $data['quantité'];
                        $result = $this->Ligne_commande_model->create($data);
                    }

                    // Calcul des points
                    $pointsGagnes = (Int) $prixTotal * $this->tauxGainPoints;

                    // Ajout des points
                    $addPts = $this->Client_model->update($whereClient, ['pointsFidelitesClient' => $ptsFidelitesClients + $pointsGagnes]);

                    // Supprime les donnees du panier
                    $this->session->set_userdata('panier', []);
                    $this->afficher_commandes();
                } else {
                    //annuler_commande
                    $where = array(
                        'idCommande' => $idCommande,
                    );
                    $this->Commande_model->delete($where);
                    $this->Client_commande_effectuer_model->delete($where);
                    $data = array(
                        'error_message' => 'Echec de l\'ajout de la commande, suppression',
                    );
                    $this->layout->view('template/error_display', $data);
                }
            } else {
                $data = array(
                    'error_message' => 'Echec de l\'ajout de la commande',
                );
                $this->layout->view('template/error_display', $data);
            }
        } else {
            $data = array(
                'error_message' => 'Votre panier est vide',
            );
            $this->layout->view('template/error_display', $data);
        }
    }

    /**
     * Supprime un produit du panier et affiche le nouveau panier
     * @param int $idProduit    l'id du produit a supprimer des commandes
     * @param int $quantite     La quantite a supprimer, si la quantite est <= 0 ou est plus grande que la quantite actuelle, supprime tout.
     */
    public function annuler_commande($idLigneCommande = 0) {

        // Verif de la commande
        $where = ["ligne_commande.idLigneCommande" => $idLigneCommande];
        $commande_ok = $this->Commande_model->produits_commande(0, $where);

        if ($commande_ok && count($commande_ok) > 0) {
            $idCommande = $commande_ok[0]->idCommande;

            // Supprime la ligne de commande
            $del = $this->Ligne_commande_model->delete($where);

            if ($del) {


                // Supprime la commande s'il n'y a plus de lignes
                $lignes_commande = $this->Commande_model->lignes_commandes($idCommande);

                if ($lignes_commande && count($lignes_commande) == 0) {
                    $where = ['idCommande' => $idCommande];
                    $this->Commande_model->delete($where);
                }

                $data = array(
                    'message_display' => 'Commande supprimée',
                );

                $this->layout->views('template/message_display', $data);
            } else {
                $data = array(
                    'error_message' => 'Echec de la suppression de commande',
                );
                $this->layout->views('template/error_display', $data);
            }
        } else {
            $data = array(
                'error_message' => 'Echec de la suppression de commande',
            );
            $this->layout->views('template/error_display', $data);
        }
        $this->afficher_commandes();
    }

}

?>
