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
        $liste_produits = $this->liste_produit();

        $data = array(
            "produits" => $liste_produits,
        );

        $this->layout->view("Commercant/Produits/liste_produits", $data);
    }

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
     *
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
                    $config['file_name'] = 'img1';
                    $config['upload_path'] = 'assets/images/produits/produit_' . $idProduitType . '/variante_' . $idProduitVariante;
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['max_size'] = 10000;
                    $config['max_width'] = 1024;
                    $config['max_height'] = 768;

                    // Charger la librairie upload
                    $this->load->library('upload', $config);

                    // Vérifier que l'upload s'est bien effectuer
                    if (!$this->upload->do_upload('userfile')) {
                        $data = array(
                            'error_message' => $this->upload->display_errors(),
                            'message_display' => $data_post["nomProduit"] . ' ajouté a vos produits ',
                        );
                    } else {
                        $data = array(
                            'message_display' => $data_post["nomProduit"] . ' ajouté a vos produits',
                        );
                    }
                } else {
                    $this->Produit_type_model->delete($table_produit_type);
                    $data = array(
                        'error_message' => "Une erreur s'est produite",
                    );
                }
            } else {
                $data = array(
                    'error_message' => "Une erreur s'est produite",
                );

                $this->ajout_produit();
            }
        } else {
            $data = array(
                'error_message' => "Erreur dans le formulaire : <br />" . $this->form_validation->error_string()
            );
        }
        $this->layout->views('template/error_display', $data);
        $this->layout->views('template/message_display', $data);
        $this->layout->view('Commercant/espace_commercant', $data);
    }

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

    public function modifier_produit_process() {
        // TODO
    }

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
     * Retourne un tableau contenant les informations relatives a ce produit : produit_type, categorie, commerce, tableau des variantes
     * @param int $id_produit
     * @return array  un tableau contenant les infos sur le produit type dans l'index 'produit_type' et le tableau des variantes dans l'index 'variantes'
     * @return null si le produit type n'a pas été trouvé
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

}
