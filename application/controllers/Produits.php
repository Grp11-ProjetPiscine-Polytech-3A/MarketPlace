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

        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('Layout');

        $this->load->model('Produit_type_model');
        $this->load->model('Categorie_model');
        $this->load->model('Commerce_model');
        $this->load->model('Commercant_model');
        $this->load->model('User_admin_model');

        $categ = $this->getCategories();

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
            $data = array(
                "produits" => $result,
            );

            // Affiche un bouton de rajout d'un produit si l'utilisateur est un commercant
            if (isset($this->session->logged_in['username'])){
                if ($this->Commercant_model->isCommercant()) {
                    $this->layout->views('Commercant/Produits/bouton_ajout_produit', $data);
                }
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
            $images_files = scandir(FCPATH . "/assets/images/produits/produit_" . $id_Produit . "/");
            $images_url = array();
            for ($i = 2; $i < count($images_files); $i++) {
                $images_url[] = base_url("/assets/images/produits/produit_" . $id_Produit . "/" . $images_files[$i]);
            }

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

    //TODO : Mettre en private : Accessible pour un commercant/Admin seulement
    public function ajout_produit(){
        // Vérification que l'utilisateur est bien commercant
        if ($this->User_admin_model->isAdmin()){
            $result = $this->Categorie_model->read();
            if ($result) {
                $data = array (
                    "Categories" => $result,
                );
                $this->layout->view('Commercant/Produits/ajout_produit', $data);
            } else {
                $data = array(
                    'error_message' => 'Une erreur s\'est produite',
                );
                $this->layout->view('template/error_display', $data);
            } 
        } else {
            $data = array(
                    'error_message' => 'Not allowed here',
                );
                $this->layout->view('template/error_display', $data);
        }
        
    }

    private function getCategories() {
        $result = $this->Categorie_model->read('*');
        return $result;
    }
}

?>
