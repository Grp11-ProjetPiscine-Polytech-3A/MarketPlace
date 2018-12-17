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
                        $image_url = url_files_in_folder ("/assets/images/produits/produit_" . $p->idProduitType . "/") [0];
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

    /**
     * TODO changer cette fonction pour gerer les variantes + stocks
     */
    public function ajout_produit_process() {
        $this->form_validation->set_rules('commerce', '"Commerce"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('nomProduit', '"Nom du produit"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('commerce', '"Catégorie"', 'trim|encode_php_tags');
        $this->form_validation->set_rules('prix', '"Prix"', 'trim|numeric|required|encode_php_tags');
        $this->form_validation->set_rules('stock', '"Stock"', 'trim|integer|encode_php_tags');
        $this->form_validation->set_rules('description', '"Description du produit"', 'trim|required|encode_php_tags');

        if ($this->form_validation->run()) {

            // Retrieve the data from POST
            $data_post = $this->input->post();
            $data_create = array(
                "nomProduitType" => $data_post["nomProduit"],
                "descriptionProduitType" => $data_post["description"],
                "prixProduitType" => $data_post["prix"],
                "idCategorie" => $data_post["categorie"],
                "siretCommerce" => $data_post["commerce"],
            );

            $result = $this->Produit_type_model->create($data_create);

            if ($result) {
                $data = array(
                    'message_display' => 'Le produit a bien été ajouté'
                );
                $this->layout->views('template/message_display', $data);
                $this->liste_produits();
            } else {
                $data = array(
                    'error_message' => "Une erreur s'est produite",
                );
                $this->layout->views('template/error_display', $data);
                $this->ajout_produit();
            }
        } else {
            $data = array(
                'error_message' => "Erreur dans le formulaire : <br />" . $this->form_validation->error_string()
            );
            $this->layout->views('template/error_display', $data);
            $this->ajout_produit();
        }
    }

    /**
     * Verifie que le produit peut bien etre géré par ce commercant
     * @param $idProduit    L'id du produit
     * @return bool true si le commercant a le droit de modifier ce produit, false sinon
     */
    private function verif_produit($idProduit) {
        
    }

}
