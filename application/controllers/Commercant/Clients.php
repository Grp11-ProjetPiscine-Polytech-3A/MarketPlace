<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include "Commercant.php";

class Clients extends Commercant {
    /*
      |===============================================================================
      | Constructeur
      |===============================================================================
     */

    public function __construct() {
        parent::__construct();
  }

    public function index() {
        $this->fiche_client("");
    }

    /**
     * Affiche la liste des produits pouvant etre geres par ce commercant
     * @param String $siretCommerce     Le siret du commerce pour trier les produits par commerce
     */
    public function fiche_client($idClient) {
      $where = array(
          "idClient" => $idClient,
      );
      $result = $this->Client_model->read('*', $where, 1);
      if ($result) {
          $data = array (
              "client" => $result[0],
          );
          $this->layout->view('Client/fiche_client', $data);
      } else {
          $data = array(
              'error_message' => 'Une erreur s\'est produite',
          );
          $this->layout->view('template/error_display', $data);
      }
      }
      }
