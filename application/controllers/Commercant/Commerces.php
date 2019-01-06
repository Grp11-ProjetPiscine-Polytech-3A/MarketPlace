<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include "Commercant.php";


class Commerces extends Commercant {
    /*
      |===============================================================================
      | Constructeur
      |===============================================================================
     */

    
    public function __construct() {
        parent::__construct();

        $this->load->model('Commercant_commerce_gerer_model');
        $this->load->model('Commerce_model');

        $this->layout->ajouter_menu_url('sideMenu', 'Liste des commerces', 'Commercant/Commerces/liste_commerces');
        $this->layout->ajouter_menu_url('sideMenu', 'Ajouter un commerce', 'Commercant/Commerces/ajout_commerce');
    }
    
    public function index() {
        $this->liste_commerces("");
    }

    public function liste_commerces($siretCommerce = null) {
        $commerces = $this->get_commerces();
        
        // Reccupere la liste des commerces
        $liste_commerces = $this->liste_commerce();

        $data = array(
            "commerces" => $liste_commerces,
        );

        $this->layout->view('Commercant/Commerces/liste_commerces', $data);
    }
    
     private function liste_commerce() {
        $commerces = $this->get_commerces();

        // Reccupere la liste des produits
        $liste_commerce = array();
        foreach ($commerces as $com) {
            foreach ($com as $c) {
                $where = array(
                    "siretCommerce" => $c->siretCommerce,
                );
                $commerces = $this->Commerce_model->read('*', $where);

                if ($commerces) {
                    foreach ($commerces as $p) {
                        // Ajoute le commerce avec les donnees completés à la liste
                        $liste_commerce[] = $p;
                    }
                }
            }
        }
        return $liste_commerce;
    }
    
    public function ajout_commerce() {
        $this->layout->view('Commercant/Commerces/ajout_commerce');
    }
    
     public function ajout_commerce_process() {
        $this->form_validation->set_rules('siretCommerce', '"Siret du commerce"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('nomCommerce', '"Nom du commerce"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('mailCommerce', '"Mail"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('telCommerce', '"Numéro de téléphone"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('numAdresseCommerce', '"Numéro adresse"', 'trim|required|integer|encode_php_tags');
        $this->form_validation->set_rules('rueCommerce', '"Adresse"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('codePostalCommerce', '"Code Postal"', 'trim|integer|required|encode_php_tags');
        $this->form_validation->set_rules('villeCommerce', '"Ville"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('complementAdresseCommerce', '"Complément Adresse"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('tempsReservationProduitsCommerce', '"Temps maximum de réservation"', 'trim|required|time|encode_php_tags');
        $this->form_validation->set_rules('produitsLivrablesCommerce', '"Possibilité de livrer"', 'trim|encode_php_tags');
        $this->form_validation->set_rules('descriptionCommerce', '"Description du commerce"', 'trim|encode_php_tags');

        if ($this->form_validation->run()) {

            // Recuperer les données du formulaire pour creer le commerce
            $data_post = $this->input->post();
            $table_commerce = array(
                "siretCommerce" => $data_post["siretCommerce"],
                "nomCommerce" => $data_post["nomCommerce"],
                "mailCommerce" => $data_post["mailCommerce"],
                "telCommerce" => $data_post["telCommerce"],
                "numAdresseCommerce" => $data_post["numAdresseCommerce"],
                "rueCommerce" => $data_post["rueCommerce"],
                "codePostalCommerce" => $data_post["codePostalCommerce"],
                "villeCommerce" => $data_post["villeCommerce"],
                "complementAdresseCommerce" => $data_post["complementAdresseCommerce"],
                "tempsReservationProduitsCommerce" => $data_post["tempsReservationProduitsCommerce"],
                "produitsLivrablesCommerce" => $data_post["produitsLivrablesCommerce"], 
                "idCommercant" => $this->session->logged_in['idCommercant'], 
                "descriptionCommerce" => $data_post["descriptionCommerce"],
            );
            // Creer la ligne dans commerce
            $resultCommerce = $this->Commerce_model->create($table_commerce);
            $data = array(
                'message_display' => "Le commerce a bien été créé",
            );
            
        } else {
            $data = array(
                'error_message' => "Erreur dans le formulaire : <br />" . $this->form_validation->error_string()
            );
        }
        
        $this->layout->views('template/error_display', $data);
        $this->layout->views('template/message_display', $data);
        $this->liste_commerces();
    }
    
}


