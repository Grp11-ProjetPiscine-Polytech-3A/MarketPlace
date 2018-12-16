<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include "Commercant.php";

class Produits extends Commercant {
    /*
      |===============================================================================
      | Constructeur
      |===============================================================================
     */

    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_menu_url('sideMenu', 'Liste des produits', 'Commercant/Produits/liste_produits');
        $this->layout->ajouter_menu_url('sideMenu', 'Ajouter un produit', 'Commercant/Produits/ajout_produit');
    }

    public function index() {
        $this->liste_produits("");
    }

    public function liste_produits($siretCommerce = null) {
        $commerces = $this->get_commerces();
        if ($siretCommerce) {
            // TODO Tri des produits juste pour ce commerce. ATTENTION : Verifier que l'utilisateur gere bien ce commerce la
        }

        // Reccupere la liste des produits
        $liste_produits = array();
        foreach ($commerces as $com) {
            foreach ($com as $c) {
                $where = array(
                    "siretCommerce" => $c->siretCommerce,
                );
                $produits = $this->Produit_type_model->read('*', $where);

                if ($produits) {
                    foreach ($produits as $p) {

                        // Ajoute aux donnees du produit l'url de l'image 
                        $images_files = scandir(FCPATH . "/assets/images/produits/produit_" . $p->idProduitType . "/");
                        $image_url = base_url("/assets/images/produits/produit_" . $p->idProduitType . "/" . $images_files[2]);
                        $p->image_url = $image_url;
                        
                        // Ajout le nom du commerce au donnees du produit
                        $p->nomCommerce = $c->nomCommerce;
                        
                        // Ajoute le produit avec les donnees completés à la liste
                        $liste_produits[] = $p;
                    }
                }
            }
        }

        $data = array(
            "produits" => $liste_produits,
        );

        $this->layout->view("Commercant/Produits/liste_produits", $data);
    }

    public function ajout_produit() {
        $categ = $this->Categorie_model->read('*');
        if ($categ) {
            $data = array(
                "categories" => $categ,
                "commerces" => $this->get_raw_commerces(),
                "error" => '',
            );
            $this->layout->view('Commercant/Produits/ajout_produit', $data);
        } else {
            $data = array(
                'error_message' => 'Une erreur s\'est produite : Pas de categories',
            );
            $this->layout->view('template/error_display', $data);
        }
    }
    
    public function ajout_produit_process() {
        print "TODO ! ^^'";
    }
    
    /**
     * Verifie que le produit peut bien etre géré par ce commercant
     * @param $idProduit    L'id du produit
     * @return bool true si le commercant a le droit de modifier ce produit, false sinon
     */
    private function verif_produit($idProduit){
        
    }

}
