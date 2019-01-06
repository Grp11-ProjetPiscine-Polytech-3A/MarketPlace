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

        $this->load->model('Produit_type_model');
        $this->load->model('Produit_variante_model');
        $this->load->model('Caracteristique_model');
        $this->load->model('Produit_variante_caracteristique_model');
        $this->load->model('Produit_type_caracteristique_model');

        $this->layout->ajouter_menu_url('sideMenu', 'Liste des produits', 'Commercant/Produits/liste_produits');
        $this->layout->ajouter_menu_url('sideMenu', 'Ajouter un produit', 'Commercant/Produits/ajout_produit');
    }

    public function index() {
        $this->liste_produits("");
    }

    /**
     * Affiche la liste des produits pouvant etre geres par ce commercant
     * @param String $siretCommerce     Le siret du commerce pour trier les produits par commerce
     */
    public function liste_produits($siretCommerce = null) {
        $commerces = $this->get_commerces();
        if ($siretCommerce) {
// TODO Tri des produits juste pour ce commerce. ATTENTION : Verifier que l'utilisateur gere bien ce commerce la
        }

// Reccupere la liste des produits
        $liste_produits = $this->liste_produit();

        $data = array(
            "produits" => $liste_produits,
        );

        $this->layout->view("Commercant/Produits/liste_produits", $data);
    }

    /**
     * Affiche le formulaire d'ajout de produit
     */
    public function ajout_produit() {
        $categ = $this->Categorie_model->read('*');
        if (!$categ) {
            $categ = array();
        }

        $caracteristiques = $this->Caracteristique_model->liste_caract();
        if (!$caracteristiques) {
            $caracteristiques = array();
        }

        $data = array(
            "categories" => $categ,
            "commerces" => $this->get_raw_commerces(),
            "caracteristiques" => $caracteristiques,
            "error" => '',
        );
        $this->layout->view('Commercant/Produits/ajout_produit', $data);
    }

    /**
     * Processus d'enregistrement du nouveau produit : Cree un produit type, un produit variante et enregistre les categories et images associees
     * TODO Enregistrer les caracteristiques sur le produit type et non la variante
     * TODO Check que ce commercant a bien le droit d'ajouter un produit a ce commerce
     */
    public function ajout_produit_process() {

        $this->form_validation->set_rules('commerce', '"Commerce"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('nomProduit', '"Nom du produit"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('commerce', '"Catégorie"', 'trim|encode_php_tags');
        $this->form_validation->set_rules('prix', '"Prix"', 'trim|numeric|required|encode_php_tags');
        $this->form_validation->set_rules('stock', '"Stock"', 'trim|integer|encode_php_tags');
        $this->form_validation->set_rules('description', '"Description du produit"', 'trim|required|encode_php_tags');

        if ($this->form_validation->run()) {

// Recuperer les données du formulaire pour creer le produit type
            $data_post = $this->input->post();
            $table_produit_type = array(
                "nomProduitType" => $data_post["nomProduit"],
                "descriptionProduitType" => $data_post["description"],
                "seuilStockProduitType" => $data_post["seuil"],
                "idCategorie" => $data_post["categorie"],
                "siretCommerce" => $data_post["commerce"],
            );
// Creer la ligne dans Produit Type
            $resultProduitType = $this->Produit_type_model->create($table_produit_type);

            if ($resultProduitType) {
// Aller chercher l'id du produit type créé
//$idProduitType = $this->Produit_type_model->getIdProduitType($data_post["nomProduit"])[0]->idProduitType;
//--- Alternative : 
                $idProduitType = $this->db->insert_id();

// Recuperer les données du formulaire pour creer le produit variante
                $table_produit_variante = array(
                    "nomProduitVariante" => $data_post["nomProduit"],
                    "descriptionProduitVariante" => $data_post["description"],
                    "prixProduitVariante" => $data_post["prix"],
                    "stockProduitVariante" => $data_post["stock"],
                    "idProduitType" => $idProduitType,
                );
                $resultProduitVariante = $this->Produit_variante_model->create($table_produit_variante);

                if ($resultProduitVariante) {
// Recuperer les l'id du produit Variant pour l'integrer dans le nom de l'image
                    $idProduitVariante = $this->Produit_variante_model->getIdProduitVariante($data_post["nomProduit"])[0]->idProduitVariante;

// Ajout des caracteristiques
                    if (array_key_exists("carac", $data_post) && array_key_exists("carac_text", $data_post)) {
                        $this->enregistrer_caracteristiques_produit_type($idProduitType, $data_post["carac"], $data_post["carac_text"]);
                    }

// Upload des images
                    $upload = $this->upload_images_produit($idProduitType, $idProduitVariante);

                    if (!$upload) {
                        $data = array(
                            'error_message' => "Erreur lors de l'upload des images : " . $this->upload->display_errors(),
                            'message_display' => $data_post["nomProduit"] . ' ajouté a vos produits ',
                        );
                    } else {
                        $data = array(
                            'message_display' => $data_post["nomProduit"] . ' ajouté a vos produits',
                        );
                    }

                    $this->layout->views('template/message_display', $data);
                    $this->layout->views('template/error_display', $data);
                    $this->fiche_produit_type($idProduitType);
                } else {
                    $this->Produit_type_model->delete($table_produit_type);
                    $data = array(
                        'error_message' => "Une erreur s'est produite",
                    );
                    $this->layout->views('template/error_display', $data);
                    $this->ajout_produit();
                }
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
     * Affiche les informations du produit type dans le menu commercant
     * @param Int $id_produit    L'id du produit a afficher
     */
    public function fiche_produit_type($id_produit = 0) {
        $this->verif_produit($id_produit);
        $data = $this->get_data_produit_type($id_produit, true);
        if ($data) {

// Gestion de la taille max des descriptions des variantes
            foreach ($data['variantes'] as $v) {
                $longueur_max_description = 100;
                $v->descriptionProduitVariante = substr($v->descriptionProduitVariante, 0, $longueur_max_description);
                if (strlen($v->descriptionProduitVariante) >= $longueur_max_description) {
                    $v->descriptionProduitVariante .= '...';
                }
            }

            $this->layout->view('Commercant/Produits/fiche_produit_type', $data);
        } else {
            $data = array(
                'error_message' => "Erreur : Le produit demandé n'existe pas",
            );
            $this->layout->views('template/error_display', $data);
        }
    }

    /**
     * Affiche le formulaire de modification d'un produit type
     * @param type $id_produit
     */
    public function modifier_produit_type($id_produit = 0) {
        $this->verif_produit($id_produit);
        $data = $this->get_data_produit_type($id_produit);
        if ($data) {

// Reccupere la liste des categories
            $categ = $this->Categorie_model->read('*');
            if (!$categ) {
                $categ = array();
            }

// Reccupere la liste des caracteristique
            $caracteristiques = $this->Caracteristique_model->liste_caract();
            if (!$caracteristiques) {
                $caracteristiques = array();
            }

            $data["categories"] = $categ;
            $data["commerces"] = $this->get_raw_commerces();
            $data["caracteristiques"] = $caracteristiques;

            $this->layout->view('Commercant/Produits/modifier_produit_type', $data);
        } else {
            $data = array(
                'error_message' => "Erreur : Le produit demandé n'existe pas",
            );
            $this->layout->views('template/error_display', $data);
        }
    }

    public function modifier_produit_type_process($id_produit = 0) {
        $this->verif_produit($id_produit);

        $this->form_validation->set_rules('commerce', '"Commerce"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('nomProduit', '"Nom du produit"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('commerce', '"Catégorie"', 'trim|encode_php_tags');
        $this->form_validation->set_rules('seuil', '"Seuil de stock"', 'trim|integer|encode_php_tags');
        $this->form_validation->set_rules('description', '"Description du produit"', 'trim|required|encode_php_tags');

        if ($this->form_validation->run()) {
// Recuperer les données du formulaire pour creer le produit type
            $data_post = $this->input->post();
            $table_produit_type = array(
                "nomProduitType" => $data_post["nomProduit"],
                "descriptionProduitType" => $data_post["description"],
                "seuilStockProduitType" => $data_post["seuil"],
                "idCategorie" => $data_post["categorie"],
                "siretCommerce" => $data_post["commerce"],
            );
// Creer la ligne dans Produit Type
// TODO enregistrer image + carac
            $resultProduitType = $this->Produit_type_model->update($id_produit, $table_produit_type);
            if ($resultProduitType) {

// Ajout des caracteristiques
                if (array_key_exists("carac", $data_post) && array_key_exists("carac_text", $data_post)) {
                    $this->enregistrer_caracteristiques_produit_type($id_produit, $data_post["carac"], $data_post["carac_text"]);
                }

// Enregistrement des images
                $upload = $this->upload_images_produit($id_produit);

                if ($upload) {
                    $data = ["message_display" => "Le produit a bien été modifié"];

                    $this->layout->views('template/message_display', $data);
                    $this->fiche_produit_type($id_produit);
                } else {

                    $data = array(
                        'error_message' => "Erreur lors de l'envoi des images, veuillez réessayer : <br />"
                    );
                    $this->layout->views('template/error_display', $data);
                    $this->modifier_produit_type($id_produit);
                }
            }
        } else {
            $data = array(
                'error_message' => "Erreur dans le formulaire : <br />" . $this->form_validation->error_string()
            );
            $this->layout->views('template/error_display', $data);
            $this->modifier_produit_type($id_produit);
        }
    }

    /**
     * @deprecated 
     * Supprimele produit type
     * TODO Supprimer aussi les variantes, demander confirmation
     * @param type $id_produit
     */
    public function supprimer_produit($id_produit = 0) {
        if ($id_produit != 0) {
            $liste_produits = $this->liste_produit();
            $id_produit_suppr = 0;
            foreach ($liste_produits as $p) {
                if ($id_produit == $p->idProduitType) {
                    $id_produit_suppr = $p->idProduitType;
                }
            }
        }
        if ($id_produit_suppr != 0) {
            $this->verif_produit($id_produit_suppr);
            $where = array(
                "idProduitType" => $id_produit_suppr,
            );
            $res = $this->Produit_type_model->delete($where);
            if ($res) {

                // Supprime les images
                rrmdir(FCPATH . 'assets/images/produits/produit_' . $id_produit_suppr);

                $data = array(
                    'message_display' => 'Le produit a bien été supprimé'
                );
                $this->layout->views('template/message_display', $data);
            } else {
                $data = array(
                    'error_message' => "Erreur durant la suppression" . $this->form_validation->error_string()
                );
                $this->layout->views('template/error_display', $data);
            }
        }
        $this->liste_produits();
    }

    /**
     * Supprime une variante
     * @param type $idProduitVariante
     */
    public function supprimer_produit_variante($idProduitVariante = 0) {
        if ($idProduitVariante != 0) {
            // Reccupere les donnees de la variante
            $produitVariante = $this->get_data_produit_variante($idProduitVariante);

            if ($produitVariante) {
                $this->verif_produit($produitVariante->idProduitType);
                $idProduitType = $produitVariante->idProduitType;

                // Supprime de la base de donneees
                $where = array(
                    "idProduitVariante" => $idProduitVariante,
                );
                $res = $this->Produit_variante_model->delete($where);
                if ($res) {
                    // Supprime les images
                    rrmdir(FCPATH . 'assets/images/produits/produit_' . $idProduitType . '/variante_' . $idProduitVariante);

                    $whereProduit = array(
                        "idProduitType" => $idProduitType,
                    );

                    // supprime le produit type s'il n'existe plus de variantes
                    $variantes = $this->Produit_variante_model->read("idProduitVariante", $whereProduit);
                    if ($variantes && count($variantes) > 0) {
                        $data = ["message_display" => "Le produit a bien été supprimé"];
                        $this->layout->views('template/message_display', $data);
                        $this->liste_produits();
                    } else {
                        $this->supprimer_produit($idProduitType);
                    }
                } else {
                    $data = ["error_message" => "Erreur lors de la suppression du produit"];
                    $this->layout->views('template/error_display', $data);
                    $this->liste_produits();
                }
            }
        } else {
            $data = ["error_message" => "Cette variante n'existe pas"];
            $this->layout->views('template/error_display', $data);
            $this->liste_produits();
        }
    }

    /**
     * Retourne la liste des produits pouvant etre geree par ce commercant (connecte)
     * @return Array La liste des produits
     */
    private function liste_produit() {
        $commerces = $this->get_commerces();

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
                        $image_url = url_images_in_folder("/assets/images/produits/produit_" . $p->idProduitType . "/", true) [0];
                        $p->image_url = $image_url;

// Ajout le nom du commerce au donnees du produit
                        $p->nomCommerce = $c->nomCommerce;

// On reccupere le prix 
                        $p->prixProduitType = $this->Produit_type_model->getRangePrice($p->idProduitType);

// Ajoute le produit avec les donnees completés à la liste
                        $liste_produits[] = $p;
                    }
                }
            }
        }

        return $liste_produits;
    }

    /**
     * Affiche le formulaire pour ajouter une variante au produit type
     * @param type $id_produit
     */
    public function ajouter_produit_variante($id_produit = 0) {
        $this->verif_produit($id_produit);

        $where = ["idProduitType" => $id_produit];
        $produit = $this->Produit_type_model->read("*", $where, 1) [0];

        $caracteristiques = $this->Caracteristique_model->liste_caract();
        if (!$caracteristiques) {
            $caracteristiques = array();
        }

        if ($produit) {
            $data = array(
                'produit_type' => $produit,
                'caracteristiques' => $caracteristiques,
            );
            $this->layout->view('Commercant/Produits/ajouter_produit_variante', $data);
        } else {
            $data = array(
                'error_message' => "Erreur : Le produit demandé n'existe pas",
            );
            $this->layout->view('template/error_display', $data);
        }
    }

    /**
     * Processus d'ajout de la variante
     * @param type $id_produit  L'id du produit Type
     */
    public function ajouter_produit_variante_process($id_produit = 0) {
        $this->verif_produit($id_produit);

        $this->form_validation->set_rules('nomProduit', '"Nom de la variante"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('prix', '"Prix"', 'trim|numeric|required|encode_php_tags');
        $this->form_validation->set_rules('stock', '"Stock"', 'trim|integer|encode_php_tags');
        $this->form_validation->set_rules('description', '"Description du produit"', 'trim|required|encode_php_tags');

        if ($this->form_validation->run()) {

            $idProduitType = $id_produit;
// Recuperer les données du formulaire pour creer le produit type
            $data_post = $this->input->post();

// Recuperer les données du formulaire pour creer le produit variante
            $table_produit_variante = array(
                "nomProduitVariante" => $data_post["nomProduit"],
                "descriptionProduitVariante" => $data_post["description"],
                "prixProduitVariante" => $data_post["prix"],
                "stockProduitVariante" => $data_post["stock"],
                "idProduitType" => $idProduitType,
            );
            $resultProduitVariante = $this->Produit_variante_model->create($table_produit_variante);

            if ($resultProduitVariante) {
                $idProduitVariante = $this->db->insert_id();

// Ajout des caracteristiques
                if (array_key_exists("carac", $data_post) && array_key_exists("carac_text", $data_post)) {
                    $this->enregistrer_caracteristiques_produit_variante($idProduitVariante, $data_post["carac"], $data_post["carac_text"]);
                }

// Enregistrement des images 
                $upload = $this->upload_images_produit($id_produit, $idProduitVariante);

                if (!$upload) {
                    $data = array(
                        'error_message' => "Erreur lors de l'upload des images : " . $this->upload->display_errors() . '<br/>Veuillez réessayer.',
                        'message_display' => $data_post["nomProduit"] . ' ajouté a vos produits ',
                    );
                } else {
                    $data = array(
                        'message_display' => "La variante a bien été enregistrée",
                    );
                }
                $this->layout->views('template/error_display', $data);
                $this->layout->views('template/message_display', $data);
                $this->fiche_produit_type($id_produit);
            } else {
                $data = array(
                    'error_message' => 'Une erreur s\'est produite, veuillez réessayer',
                );
                $this->layout->views('template/error_display', $data);
                $this->ajouter_produit_variante($id_produit);
            }
        } else {
            $data = array(
                'error_message' => "Erreur dans le formulaire : <br />" . $this->form_validation->error_string()
            );
            $this->layout->views('template/error_display', $data);
            $this->ajouter_produit_variante($id_produit);
        }
    }

    /**
     * Affiche le formulaire de modification de la variante
     * Redirige vers une erreur si l'utilisateur n'a pas le droit de modifier cette variante
     * @param type $idProduitVariante
     */
    public function modifier_produit_variante($idProduitVariante = 0) {
// Reccupere les donnees de la variante
        $produitVariante = $this->get_data_produit_variante($idProduitVariante);

        if ($produitVariante) {
            $this->verif_produit($produitVariante->idProduitType);

// Reccupere les donnees du produit type
            $whereProduitType = ['idProduitType' => $produitVariante->idProduitType];
            $produit_type = $this->Produit_type_model->read("*", $whereProduitType, 1)[0];

// Reccupere la liste des carac
            $caracteristiques = $this->Caracteristique_model->liste_caract();
            if (!$caracteristiques) {
                $caracteristiques = array();
            }

            $data = array(
                'produitVariante' => $produitVariante,
                'produitType' => $produit_type,
                'caracteristiques' => $caracteristiques,
            );
            $this->layout->view('Commercant/Produits/modifier_produit_variante', $data);
        } else {
// La variante n'existe pas
            $data = array(
                'error_message' => "Cette variante n'existe pas"
            );
            $this->layout->view('template/error_display', $data);
        }
    }

    public function modifier_produit_variante_process($idProduitVariante = 0) {

// Reccupere les donnees de la variante
        $produitVariante = $this->get_data_produit_variante($idProduitVariante);

        if ($produitVariante) {
            $this->verif_produit($produitVariante->idProduitType);

            $this->form_validation->set_rules('nomProduit', '"Nom de la variante"', 'trim|required|encode_php_tags');
            $this->form_validation->set_rules('prix', '"Prix"', 'trim|numeric|required|encode_php_tags');
            $this->form_validation->set_rules('stock', '"Stock"', 'trim|integer|encode_php_tags');
            $this->form_validation->set_rules('description', '"Description du produit"', 'trim|required|encode_php_tags');

            if ($this->form_validation->run()) {
// Recuperer les données du formulaire pour creer le produit type
                $data_post = $this->input->post();


                $whereVariante = array(
                    "idProduitVariante" => $idProduitVariante,
                );
// Recuperer les données du formulaire pour creer le produit variante
                $setVariante = array(
                    "nomProduitVariante" => $data_post["nomProduit"],
                    "descriptionProduitVariante" => $data_post["description"],
                    "prixProduitVariante" => $data_post["prix"],
                    "stockProduitVariante" => $data_post["stock"],
                );
                $updateProduitVariante = $this->Produit_variante_model->update($whereVariante, $setVariante);

                if ($updateProduitVariante) {

// Ajout des caracteristiques
                    if (array_key_exists("carac", $data_post) && array_key_exists("carac_text", $data_post)) {
                        $this->enregistrer_caracteristiques_produit_variante($idProduitVariante, $data_post["carac"], $data_post["carac_text"]);
                    }

// Enregistrement des images 
                    $upload = $this->upload_images_produit($produitVariante->idProduitType, $idProduitVariante);

                    if (!$upload) {
                        $data = array(
                            'error_message' => "Erreur lors de l'upload des images : " . $this->upload->display_errors() . '<br/>Veuillez réessayer.',
                            'message_display' => 'La variante a bien été modifiée',
                        );
                    } else {
                        $data = array(
                            'message_display' => "La variante a bien été modifiée",
                        );
                    }
                    $this->layout->views('template/error_display', $data);
                    $this->layout->views('template/message_display', $data);
                    $this->fiche_produit_type($produitVariante->idProduitType);
                } else {
                    $data = array(
                        'error_message' => "Une erreur s'est produite, veuillez réessayer.",
                    );
                    $this->layout->views('template/error_display', $data);
                    $this->modifier_produit_variante($idProduitVariante);
                }
            } else {
                $data = array(
                    'error_message' => "Erreur dans le formulaire : <br />" . $this->form_validation->error_string(),
                );
                $this->layout->views('template/error_display', $data);
                $this->modifier_produit_variante($idProduitVariante);
            }
        } else {
// La variante n'existe pas
            $data = array(
                'error_message' => "Cette variante n'existe pas"
            );
            $this->layout->view('template/error_display', $data);
        }
    }

    /**
     * Ajoute la / les caracteristique(s) a ce produit type
     * Dans le cas ou il s'agit de plusieurs caracteristiques, l'index du tableau idCarac doit correspondre a l'index du tableau contenucarac
     * @param int $id_produit       L'id du produit
     * @param Array $idCarac        Un tableau d'id de caracteristique OU juste l'id de la caracteristique
     * @param Array $contenuCarac   Un tableau du contenu OU juste le contenu
     * @return true si l'enregistrement s'est bien passé, false sinon
     */
    private function enregistrer_caracteristiques_produit_type($id_produit, $idCarac, $contenuCarac) {
        if (!is_array($idCarac)) {
            $idCarac = [$idCarac];
        }
        if (!is_array($contenuCarac)) {
            $contenuCarac = [$contenuCarac];
        }
        $carac = $idCarac;
        $carac_text = $contenuCarac;
        if (count($carac_text) == count($carac)) {
            $errors = false;
            for ($i = 0; $i < count($carac); $i++) {
                if ($carac_text[$i] != "") {
                    $where_carac = array(
                        "idProduitType" => $id_produit,
                        "idCaracteristique" => $carac[$i],
                    );

                    if ($this->Produit_type_caracteristique_model->read("*", $where_carac)) {
                        $setCarac = ["contenuCaracteristique" => $carac_text[$i]];
                        $errors = $errors || !$this->Produit_type_caracteristique_model->update($where_carac, $setCarac);
                    } else {
                        $table_carac = array_merge($where_carac, ["contenuCaracteristique" => $carac_text[$i]]);
                        $errors = $errors || !$this->Produit_type_caracteristique_model->create($table_carac);
                    }
                }
            }
            if (!$errors) {
                return true;
            }
        }
        return false;
    }

    /**
     * Ajoute la / les caracteristique(s) a ce produit variante
     * Dans le cas ou il s'agit de plusieurs caracteristiques, l'index du tableau idCarac doit correspondre a l'index du tableau contenucarac
     * @param int $id_produit       L'id du produit
     * @param Array $idCarac        Un tableau d'id de caracteristique OU juste l'id de la caracteristique
     * @param Array $contenuCarac   Un tableau du contenu OU juste le contenu
     * @return true si l'enregistrement s'est bien passé, false sinon
     */
    private function enregistrer_caracteristiques_produit_variante($id_produit, $idCarac, $contenuCarac) {
        if (!is_array($idCarac)) {
            $idCarac = [$idCarac];
        }
        if (!is_array($contenuCarac)) {
            $contenuCarac = [$contenuCarac];
        }
        $carac = $idCarac;
        $carac_text = $contenuCarac;
        if (count($carac_text) == count($carac)) {
            $errors = false;
            for ($i = 0; $i < count($carac); $i++) {
                if ($carac_text[$i] != "") {
                    $where_carac = array(
                        "idProduitVariante" => $id_produit,
                        "idCaracteristique" => $carac[$i],
                    );

                    if ($this->Produit_variante_caracteristique_model->read("*", $where_carac)) {
                        $setCarac = ["contenuCaracteristique" => $carac_text[$i]];
                        $errors = $errors || !$this->Produit_variante_caracteristique_model->update($where_carac, $setCarac);
                    } else {
                        $table_carac = array_merge($where_carac, ["contenuCaracteristique" => $carac_text[$i]]);
                        $errors = $errors || !$this->Produit_variante_caracteristique_model->create($table_carac);
                    }
                }
            }
            if (!$errors) {
                return true;
            }
        }
        return false;
    }

    /**
     * Upload les image du produit en utilisant les données du formulaire
     * @param type $idProduitType       L'id du produit type
     * @param type $idProduitVariante   L'id du produit variante, s'il s'agit des images d'un produit type, laisser cette valeur a 0
     * @return boolean  true si l'upload s'est bien passe, false sinon
     *                  Retourne false si l'id produit type n'est pas renseigné
     */
    private function upload_images_produit($idProduitType, $idProduitVariante = 0) {
        if ($idProduitType) {
            $config = [];

// Configurer les fichiers acceptés
            $config['file_name'] = 'img';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = 10000;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;

// Création du dossier accueillant l'image
            if (!file_exists('assets/images/produits/produit_' . $idProduitType)) {
                mkdir('assets/images/produits/produit_' . $idProduitType, 0755, true);
            }
            if ($idProduitVariante) {
// Création du dossier accueillant l'image de la variante
                if (!file_exists('assets/images/produits/produit_' . $idProduitType . '/variante_' . $idProduitVariante)) {
                    mkdir('assets/images/produits/produit_' . $idProduitType . '/variante_' . $idProduitVariante, 0755, true);
                }
                $config['upload_path'] = get_absolute_path('assets/images/produits/produit_' . $idProduitType . '/variante_' . $idProduitVariante);
            } else {
                $config['upload_path'] = get_absolute_path('assets/images/produits/produit_' . $idProduitType);
            }

// Effectue l'upload
            return upload_files_from_form($config);
        }
        return false;
    }

    /**
     * Retourne un tableau contenant les informations relatives a ce produit : produit_type, categorie, commerce, tableau des variantes, caracteristiques
     * @param int $id_produit
     * @paramm boolean  $short_derscription    True si on veut que les descrption des variantes soient raccourcies
     * @return array un tableau contenant les infos sur le produit type dans l'index 'produit_type' et le tableau des variantes dans l'index 'variantes'
     * @return null  si le produit type n'a pas été trouvé
     */
    private function get_data_produit_type($id_produit, $short_derscription = false) {
        $where = ['idProduitType' => $id_produit];
        $produitType = $this->Produit_type_model->read('*', $where, 1);
        if ($produitType) {
            $produitType = $produitType [0];

// Reccuperation des url des images du produit
            $produitType->images_url = url_images_in_folder("/assets/images/produits/produit_" . $produitType->idProduitType);

// Reccupere les variantes et leur donnees
            $variantes = $this->Produit_variante_model->read("*", $where);

            $array_variantes = array();
// Reccuperation des url des images des variantes 
            foreach ($variantes as $v) {
                $v->images_url = url_images_in_folder("/assets/images/produits/produit_" . $produitType->idProduitType . '/variante_' . $v->idProduitVariante);
                $array_variantes[] = $v;
            }

// Reccuperation de la categorie
            $whereCateg = ['idCategorie' => $produitType->idCategorie];
            $categ = $this->Categorie_model->read('*', $whereCateg, 1)[0];

            $produitType->categ = $categ;

// Reccuperation du commerce
            $whereCom = ['siretCommerce' => $produitType->siretCommerce];
            $com = $this->Commerce_model->read('*', $whereCom, 1)[0];

            $produitType->commerce = $com;

// Reccuperation des caracteristiques
            $carac = $this->Produit_type_model->getCaracteristiques($id_produit);
            $produitType->caracteristiques = $carac;

// Reccuperation du prix 
            $produitType->prixProduitType = $this->Produit_type_model->getRangePrice($produitType->idProduitType);

// Construction du tableau
            $data = [
                "produit_type" => $produitType,
                "variantes" => $array_variantes,
            ];
            return $data;
        } else {
            return null;
        }
    }

    private function get_data_produit_variante($idProduitVariante = 0) {
// Reccupere les donnees de la variante
        $whereVariante = ['idProduitVariante' => $idProduitVariante];
        $produitVariante = $this->Produit_variante_model->read('*', $whereVariante, 1);

        if ($produitVariante) {
            $produitVariante = $produitVariante[0];
// Reccupere les url des images
            $produitVariante->images_url = $this->get_url_img_produit($produitVariante->idProduitType, $idProduitVariante);

// Reccuperation des caracteristiques
            $carac = $this->Produit_variante_model->getCaracteristiques($idProduitVariante);
            $produitVariante->caracteristiques = $carac;

            return $produitVariante;
        } else {
            return null;
        }
    }

    /**
     * Verifie que le produit peut bien etre géré par ce commercant
     * Si ce n'est pas le cas, arrete l'execution et affiche une erreur
     * @param $idProduit    L'id du produit
     * @return bool true si le commercant a le droit de modifier ce produit, false sinon
     */
    private function verif_produit($idProduit) {
        $liste_produits = $this->Produit_type_model->getProduitsCommercant($this->session->logged_in['idCommercant']);
        foreach ($liste_produits as $p) {
            if ($p->idProduitType == $idProduit) {
                return true;
            }
        }

// Si la fonction n'a pas retourne, c'est a dire si l'id du produit renseigne ne correspond a aucun produits pouvant gere par le commercant
        $data = array(
            'error_message' => 'Vous ne possédez pas les droits pour accéder à cette page',
        );
        echo $this->layout->view('template/error_display', $data, true);
        die();
    }

    /**
     * Retourne un tableau d'url des images du produit
     * @param type $idProduitType       L'id du produit Type
     * @param type $idProduitVariante   L'id de la variante, laisser a 0 si ce produit n'est pas une variante
     * @param type $reccursive          Si vous souhaitez reccuperer toutes les images du produit type, mettez cette valeur a true
     * @return type
     */
    private function get_url_img_produit($idProduitType, $idProduitVariante = 0, $reccursive = false) {
        if ($idProduitVariante && !$reccursive) {
            return url_images_in_folder("/assets/images/produits/produit_" . $idProduitType . '/variante_' . $idProduitVariante);
        } else {
            return url_images_in_folder("/assets/images/produits/produit_" . $idProduitType, true);
        }
    }

}
