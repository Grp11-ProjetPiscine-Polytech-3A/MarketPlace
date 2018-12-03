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
            $images_files = scandir(FCPATH . "/assets/images/produits/produit_" . $id_Produit . "/");
            $images_url = array();
            for ($i = 2; $i < count($images_files); $i++) {
                $images_url[] = base_url("/assets/images/produits/produit_" . $id_Produit . "/" . $images_files[$i]);
            }
            $data = array(
                "produit" => $result[0],
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

    
    private function getCategories() {
        $result = $this->Categorie_model->read('*');
        return $result;
    }
}

?>
