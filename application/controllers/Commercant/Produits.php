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
    }
    


    public function ajout_produit(){
        // Vérification que l'utilisateur est bien commercant
        if ($this->Commercant_model->isCommercant()){
            $categ = $result = $this->Categorie_model->read('*');
            if ($categ) {
                $data = array (
                    "categories"    => $categ,
                    "error"         => ' ',
                );
                $this->layout->view('Commercant/Produits/ajout_produit', $data);
            } else {
                $data = array(
                    'error_message' => 'Une erreur s\'est produite : Pas de categories',
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
}