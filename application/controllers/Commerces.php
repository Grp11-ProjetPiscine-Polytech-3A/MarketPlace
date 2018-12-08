<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Commerces extends CI_Controller {
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
        $this->load->model('Commerce_model');
        $this->load->model('User_admin_model');
    }

    public function index() {
        $this->liste_commerces();
    }

    public function liste_commerces() {
        $result = $this->Commerce_model->read();
        if ($result) {
            $data = array (
                "commerces" => $result,
            );

            // Affiche un bouton de rajout d'un commerce si l'utilisateur est un admin
            if (isset($this->session->logged_in['username'])){
                if ($this->User_admin_model->isAdmin()) {
                    $this->layout->views('Admin/Commerces/title_admin');
                } else {
                    $this->layout->views('Commerces/title_not_admin');
                }
            } else {
                $this->layout->views('Commerces/title_not_admin');
            }
            
            $this->layout->view('Commerces/liste_commerces', $data);
        } else {
            $data = array(
                'error_message' => 'Une erreur s\'est produite',
            );
            $this->layout->view('template/error_display', $data);
        }
    }

    public function fiche_commerce($siret_commerce) {
        $where = array(
            "siretCommerce" => $siret_commerce,
        );
        $result = $this->Commerce_model->read('*', $where, 1);
        if ($result) {
            $data = array (
                "commerce" => $result[0],
            );
            $this->layout->view('Commerces/fiche_commerce', $data);
        } else {
            $data = array(
                'error_message' => 'Une erreur s\'est produite',
            );
            $this->layout->view('template/error_display', $data);
        }
    }

    public function ajout_commerce(){
        // Vérification que l'utilisateur est bien admin
        if ($this->User_admin_model->isAdmin()){
            $data = array (
                // EMPTY
            );
            $this->layout->view('Admin/Commerces/ajout_commerce', $data);
        } else {
            $data = array(
                'error_message' => 'Not allowed here',
            );
            $this->layout->view('template/error_display', $data);
        }
    }
}

?>
