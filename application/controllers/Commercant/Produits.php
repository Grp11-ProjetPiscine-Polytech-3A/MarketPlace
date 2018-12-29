<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include "Commercant.php";

// TODO : Afficher la liste des produits TYPES dans liste de produits, et afficher les variantes lorsqu'on clique dessus, puis proposition de modifier les variantes ou modifier le produit type (description ...)

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
                        $carac = $data_post["carac"];
                        $carac_text = $data_post["carac_text"];
                        for ($i = 0; $i < count($carac); $i++) {
                            if ($carac_text[$i] != "") {
                                $table_carac = array(
                                    "idProduitVariante" => $idProduitVariante,
                                    "idCaracteristique" => $carac[$i],
                                    "contenuCaracteristique" => $carac_text[$i],
                                );
                                $this->Produit_variante_caracteristique_model->create($table_carac);
                            }
                        }
                    }

                    // Création du dossier accueillant l'image
                    if (!file_exists('assets/images/produits/produit_' . $idProduitType)) {
                        mkdir('assets/images/produits/produit_' . $idProduitType, 0755, true);
                    }

                    // Création du dossier accueillant l'image de la variante
                    if (!file_exists('assets/images/produits/produit_' . $idProduitType . '/variante_' . $idProduitVariante)) {
                        mkdir('assets/images/produits/produit_' . $idProduitType . '/variante_' . $idProduitVariante, 0755, true);
                    }


                    // Enregistrement de l'image
                    // Configurer les fichiers acceptés
                    $config['file_name'] = 'img';
                    $config['upload_path'] = get_absolute_path('assets/images/produits/produit_' . $idProduitType . '/variante_' . $idProduitVariante);
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['max_size'] = 10000;
                    $config['max_width'] = 1024;
                    $config['max_height'] = 768;


                    // Effectue l'upload
                    $upload = upload_files_from_form($config);

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
        $data = $this->get_data_produit_type($id_produit);
        if ($data) {
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

            $categ = $this->Categorie_model->read('*');
            if (!$categ) {
                $categ = array();
            }

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
                    $carac = $data_post["carac"];
                    $carac_text = $data_post["carac_text"];
                    for ($i = 0; $i < count($carac); $i++) {
                        if ($carac_text[$i] != "") {
                            $where_carac = array(
                                "idProduitType" => $id_produit,
                                "idCaracteristique" => $carac[$i],
                            );
                            $table_carac = array_merge($where_carac, ["contenuCaracteristique" => $carac_text[$i]]);
                            if ($this->Produit_type_caracteristique_model->read("*", $where_carac)) {
                                $this->Produit_type_caracteristique_model->update($table_carac);
                            } else {
                                $this->Produit_type_caracteristique_model->create($table_carac);
                            }
                        }
                    }
                }

                // Enregistrement de l'image
                // Configurer les fichiers acceptés
                $config['file_name'] = 'img';
                $config['upload_path'] = get_absolute_path('assets/images/produits/produit_' . $id_produit);
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 10000;
                $config['max_width'] = 1024;
                $config['max_height'] = 768;

                // Effectue l'upload
                $upload = upload_files_from_form($config);

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
            $where = array(
                "idProduitType" => $id_produit_suppr,
            );
            $res = $this->Produit_type_model->delete($where);
            if ($res) {
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

                        // On reccupere les prix des variantes
                        $whereProduit = array(
                            "idProduitType" => $p->idProduitType,
                        );
                        $prix_variantes = $this->Produit_variante_model->read("prixProduitVariante", $whereProduit);

                        // Formate le prix
                        if (count($prix_variantes) >= 2) {
                            if (isset($min)) {
                                unset($min);
                            }
                            if (isset($max)) {
                                unset($max);
                            }

                            foreach ($prix_variantes as $prix) {
                                $pr = $prix->prixProduitVariante;
                                if (!isset($min) || $pr <= $min) {
                                    $min = $pr;
                                }
                                if (!isset($max) || $pr >= $max) {
                                    $max = $pr;
                                }
                            }
                            $p->prixProduitType = $min . ' - ' . $max;
                        } else {
                            $p->prixProduitType = $prix_variantes[0]->prixProduitVariante;
                        }

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
     * @param type $id_produit
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
                    $carac = $data_post["carac"];
                    $carac_text = $data_post["carac_text"];
                    for ($i = 0; $i < count($carac); $i++) {
                        if ($carac_text[$i] != "") {
                            $table_carac = array(
                                "idProduitVariante" => $idProduitVariante,
                                "idCaracteristique" => $carac[$i], // TODO verif si la carac existe bien
                                "contenuCaracteristique" => $carac_text[$i],
                            );
                            $this->Produit_variante_caracteristique_model->create($table_carac);
                        }
                    }
                }

                // Enregistrement des images 
                // Création du dossier accueillant l'image de la variante
                if (!file_exists('assets/images/produits/produit_' . $id_produit . '/variante_' . $idProduitVariante)) {
                    mkdir('assets/images/produits/produit_' . $id_produit . '/variante_' . $idProduitVariante, 0755, true);
                }


                // Configurer les fichiers acceptés
                $config['file_name'] = 'img';
                $config['upload_path'] = get_absolute_path('assets/images/produits/produit_' . $id_produit . '/variante_' . $idProduitVariante);
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 10000;
                $config['max_width'] = 1024;
                $config['max_height'] = 768;

                // Effectue l'upload
                $upload = upload_files_from_form($config);

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
     * Retourne un tableau contenant les informations relatives a ce produit : produit_type, categorie, commerce, tableau des variantes, caracteristiques
     * @param int $id_produit
     * @return array un tableau contenant les infos sur le produit type dans l'index 'produit_type' et le tableau des variantes dans l'index 'variantes'
     * @return null  si le produit type n'a pas été trouvé
     */
    private function get_data_produit_type($id_produit) {
        $where = ['idProduitType' => $id_produit];
        $produitType = $this->Produit_type_model->read('*', $where);
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
            // On reccupere les prix des variantes
            $whereProduit = array(
                "idProduitType" => $produitType->idProduitType,
            );
            $prix_variantes = $this->Produit_variante_model->read("prixProduitVariante", $whereProduit);

            // Formate le prix
            if (count($prix_variantes) >= 2) {

                foreach ($prix_variantes as $prix) {
                    $pr = $prix->prixProduitVariante;
                    if (!isset($min) || $pr <= $min) {
                        $min = $pr;
                    }
                    if (!isset($max) || $pr >= $max) {
                        $max = $pr;
                    }
                }
                $produitType->prixProduitType = $min . ' - ' . $max;
            } else {
                $produitType->prixProduitType = $prix_variantes[0]->prixProduitVariante;
            }

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

}
