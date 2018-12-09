<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produits extends CI_Controller {
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
        $this->load->model('Categorie_model');
        $this->load->model('Commerce_model');
        $this->load->model('Commercant_model');
        $this->load->model('User_admin_model');

        $categ = $this->Categorie_model->read('*');

        foreach ($categ as $c) {
            $intitule = mb_strtoupper(mb_substr($c->descriptionCategorie, 0, 1)) . mb_substr($c->descriptionCategorie, 1);
            $this->layout->ajouter_menu_url('sideMenu', $intitule , 'Produits/tri_produits_categorie/' . $c->idCategorie);
        }

        $this->layout->setNomSideMenu("Categories");
    }

    public function index() {
        $this->liste_produits();
    }

    public function liste_produits() {
        $result = $this->Produit_type_model->read();
        if ($result) {
            $liste_produits = array();
            foreach ($result as $produit) {
                
                // On recupere le lien de la premiere image du produit
                $produit->img_url = url_files_in_folder("/assets/images/produits/produit_" . $produit->idProduitType . "/")[0];
                $liste_produits[] = $produit;
            }
            $data = array(
                "produits" => $liste_produits,
            );
            

            // Affiche un bouton de rajout d'un produit si l'utilisateur est un commercant
            if (isset($this->session->logged_in['username'])){
                if ($this->Commercant_model->isCommercant()) {
                    $this->layout->views('Commercant/Produits/title_commercant');
                } else {
                    $this->layout->views('Produits/title_not_commercant');
                }
            } else {
                $this->layout->views('Produits/title_not_commercant');
            }
            
            $this->layout->view('Produits/liste_produits', $data);
        } else {
            $data = array(
                'error_message' => 'Une erreur s\'est produite',
            );
            $this->layout->view('template/error_display', $data);
        }
    }

    public function fiche_produit($id_Produit) {
        $where = array(
            "idProduitType" => $id_Produit,
        );
        $result = $this->Produit_type_model->read('*', $where, 1);
        if ($result) {
            $produit = $result[0];
            
            // Reccupere la liste des url des images du dossier
            $images_url = url_files_in_folder("/assets/images/produits/produit_" . $id_Produit . "/");

            $where = array(
                'siretCommerce' => $produit->siretCommerce,
            );
            $commerce = $this->Commerce_model->read('*', $where);

            if ($commerce) {
                $produit->commerce = $commerce[0];
            }
            $data = array(
                "produit" => $produit,
                "images" => $images_url,
            );
            $this->layout->view('Produits/fiche_produit', $data);
        } else {
            $data = array(
                'error_message' => 'Une erreur s\'est produite',
            );
            $this->layout->view('template/error_display', $data);
        }
    }

    public function tri_produits_categorie($id_Categ = 0) {
        $where = array();
        if ($id_Categ > 0) {
            $where['idCategorie']=$id_Categ;
        }
        $result = $this->Produit_type_model->read('*', $where);
        if ($result) {
            $data = array(
                "produits" => $result,
            );
            $this->layout->view('Produits/liste_produits', $data);
        } else {
            $data = array(
                'message_display' => 'Il n\'y a pas de produits correspondant à cette catégorie pour le moment',
            );
            $this->layout->view('template/message_display', $data);
        }
    }
}

?>
