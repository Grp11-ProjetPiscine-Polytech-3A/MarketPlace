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

        $this -> load -> helper('form');
        $this -> load -> helper('assets');

        $this -> load -> library('form_validation');
        $this -> load -> library('session');
        $this -> load -> library('Layout');

        $this -> load -> model('Produit_type_model');
        $this -> load -> model('Produit_variante_model');
        $this -> load -> model('Categorie_model');
        $this -> load -> model('Commerce_model');
        $this -> load -> model('Commercant_model');
        $this -> load -> model('User_admin_model');
        $this -> load -> model('User_model');
        $this -> load -> model('Client_donner_avis_model');

        $categ = $this -> Categorie_model -> read('*');

        foreach ($categ as $c) {
            $intitule = mb_strtoupper(mb_substr($c -> descriptionCategorie, 0, 1)) . mb_substr($c -> descriptionCategorie, 1);
            $this -> layout -> ajouter_menu_url('sideMenu', $intitule, 'Produits/liste_produits/' . $c -> idCategorie);
        }

        $this -> layout -> setNomSideMenu("Categories");
    }

    public function index() {
        $this -> liste_produits();
    }

    public function liste_produits($id_Categ = 0) {
        $where = array();
        if ($id_Categ > 0) {
            $where['idCategorie'] = $id_Categ;
        }
        $result = $this -> Produit_type_model -> read('*', $where);
        if ($result && count($result) > 0) {
            $liste_produits = array();
            foreach ($result as $produit) {

                // On recupere le lien de la premiere image du produit
                $produit -> img_url = url_images_in_folder("/assets/images/produits/produit_" . $produit -> idProduitType . "/", true)[0];


                // Gestion de la taille max de la description
                $longueur_max_description = 100;
                $produit -> descriptionProduitType = substr($produit -> descriptionProduitType, 0, $longueur_max_description);
                if (strlen($produit -> descriptionProduitType) >= $longueur_max_description) {
                    $produit -> descriptionProduitType .= '...';
                }

                // On reccupere le prix
                $produit -> prixProduitType = $this -> Produit_type_model -> getRangePrice($produit -> idProduitType);

                $liste_produits[] = $produit;
            }
            $data = array(
                "produits" => $liste_produits,
            );

            $this -> layout -> views('Produits/title_not_commercant');
            $this -> layout -> view('Produits/liste_produits', $data);
        } else {
            if ($id_Categ > 0) {
                $data = array(
                    'error_message' => 'Il n\'y a pas de produits correspondant à cette catégorie pour le moment',
                );
            } else {
                $data = array(
                    'error_message' => 'Une erreur s\'est produite',
                );
            }
            $this -> layout -> view('template/error_display', $data);
        }
    }

    public function fiche_produit($id_Produit, $id_variante = 0, $error_message = '', $message_display = '') {
        $whereProduit = array(
            "idProduitType" => $id_Produit,
        );
        $result = $this -> Produit_type_model -> read('*', $whereProduit, 1);
        if ($result) {
            $produit = $result[0];

            // Reccupere les variantes et leur donnees
            $variantes = $this -> Produit_variante_model -> read("idProduitVariante, nomProduitVariante", $whereProduit);

            $verif_variante = false;
            foreach ($variantes as $v) {
                if ($v -> idProduitVariante == $id_variante) {
                    $verif_variante = true;
                }
            }
            if (!$verif_variante) {
                $id_variante = $variantes[0] -> idProduitVariante;
            }
            $variante_select = $this -> Produit_variante_model -> read("*", ["idProduitVariante" => $id_variante])[0];

            // Reccupere la liste des url des images du produit type ET de la variante
            $img_paths = ["/assets/images/produits/produit_" . $id_Produit . "/variante_" . $id_variante,
                "/assets/images/produits/produit_" . $id_Produit];
            $images_url = url_images_in_folder($img_paths);

            $whereCommerce = array(
                'siretCommerce' => $produit -> siretCommerce,
            );
            $commerce = $this -> Commerce_model -> read('*', $whereCommerce);

            if ($commerce) {
                $produit -> commerce = $commerce[0];
            }

            if ($variante_select -> descriptionProduitVariante == $produit -> descriptionProduitType) {
                $variante_select -> descriptionProduitVariante = "";
            }
            $variante_select -> descriptionProduitVariante = nl2br($variante_select -> descriptionProduitVariante);
            $produit -> descriptionProduitType = nl2br($produit -> descriptionProduitType);
            $data = array(
                "produit" => $produit,
                "images" => $images_url,
                "variantes" => $variantes,
                "variante" => $variante_select,
                "caracteristiques" => array_merge($this -> Produit_variante_model -> getCaracteristiques($id_variante), $this -> Produit_type_model -> getCaracteristiques($produit -> idProduitType)),
                "commentaire" => $this -> Client_donner_avis_model -> getCommentaires($id_Produit),
            );
            $this -> layout -> ajouter_css("ficheProduit");
            $this -> layout -> ajouter_jquery("Produit/star_rating");

            if ($error_message != '') {
                $data['error_display'] = $error_message;
                $this -> layout -> views('template/error_display', $data);
            }
            if ($message_display != '') {
                $data['message_display'] = $message_display;
                $this -> layout -> views('template/message_display', $data);
            }

            $this -> layout -> view('Produits/fiche_produit', $data);
        } else {
            $data = array(
                'error_message' => 'Une erreur s\'est produite',
            );
            $this -> layout -> view('template/error_display', $data);
        }
    }

    public function ajouter_commentaire($id_produit, $id_produit_variante){
        // Si le client a commandé le produit et note comprise entre 0 et 5 poster commentaire
        $comment = $this -> input -> post('comment');
        $note = $this -> input -> post('note');
        $error_message = '';
        $message_display = '';
        if ($note >= 0 && $note <= 5) {
            if ($this -> User_model -> a_commande($id_produit_variante)) {

                $result = $this -> Client_donner_avis_model -> ajouter_client_donner_avis($id_produit_variante, $comment, $note);
                if ($result) {
                    $message_display = 'Message ajouté';
                } else {
                    $error_message = 'Erreur lors de l\'ajout du message';
                }
            } else {
                $error_message = 'Vous n\'avez pas acheté ce produit';
            }
        } else {
            $error_message = 'Note incorrecte';
        }
        $this -> fiche_produit($id_produit, $id_produit_variante, $error_message, $message_display);
    }

}

?>
