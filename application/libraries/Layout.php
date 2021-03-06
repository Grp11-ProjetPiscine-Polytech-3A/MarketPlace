<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Layout {

    private $CI;
    private $var = array();

    /*
      |===============================================================================
      | Constructeur
      |===============================================================================
     */

    public function __construct() {
        $this->CI = & get_instance();

        $this->menu_auto = true;

        $this->var['output'] = '';

        /*  Le titre est composé du nom de la méthode et du nom du contrôleur
         *  La fonction ucfirst permet d'ajouter une majuscule
         */
        $this->var['titre'] = ucfirst($this->CI->router->fetch_method()) . ' - ' . ucfirst($this->CI->router->fetch_class());

        /*  Nous initialisons la variable $charset avec la même valeur que
         *  la clé de configuration initialisée dans le fichier config.php
         */
        $this->var['charset'] = $this->CI->config->item('charset');

        $this->var['css'] = array();

        $this->var['js'] = array();

        $this->var['jquery'] = array();

        // Parametre les menus
        // Menu principal
        $this->var['menu'] = array();

        // Menu du haut
        $this->var['topMenu'] = array();

        // Menu de gauche : il sera adaptatif en fonction du controleur (donc gere dans celui ci)
        $this->var['sideMenu'] = array();
        $this->var['nomSideMenu'] = "";
    }

    /*
      |===============================================================================
      | Méthodes pour charger les vues
      |   . view
      |   . views
      |===============================================================================
     */
    /*
     *  view permet d'afficher une vue dans un layout
     */

    public function view($name, $data = array(), $return = false) {
        if ($this->menu_auto) {
            $this->init_menu();
        }

        $this->var['output'] .= $this->CI->load->view($name, $data, true);

        if (!$return) {
            $this->CI->load->view('../themes/default_layout', $this->var);
        } else {
            return $this->CI->load->view('../themes/default_layout', $this->var, true);
        }
    }

    /*
     *  views permet de sauvegarder le contenu d'une ou plusieurs vues dans une variable,
     *  sans l'afficher immédiatement.
     *  Pour l'affichage, il faudra utiliser la méthode view.
     *  Ici on ajoute au contenue de output (vide ou non) le contenu d'une vue.
     */

    public function views($name, $data = array()) {
        $this->var['output'] .= $this->CI->load->view($name, $data, true);
        return $this;
    }

    /*
      |===============================================================================
      | Méthodes pour modifier les variables envoyées au layout
      |   . set_titre
      |   . set_charset
      |===============================================================================
     */

    public function set_titre($titre) {
        if (is_string($titre) AND ! empty($titre)) {
            $this->var['titre'] = $titre;
            return true;
        }
        return false;
    }

    public function set_charset($charset) {
        if (is_string($charset) AND ! empty($charset)) {
            $this->var['charset'] = $charset;
            return true;
        }
        return false;
    }

    /*
      |===============================================================================
      | Méthodes pour ajouter des feuilles de CSS et de JavaScript
      |   . ajouter_css
      |   . ajouter_js
      |   . ajouter_jquery
      |===============================================================================
     */

    public function ajouter_css($nom) {
        if (is_string($nom) AND ! empty($nom) AND file_exists('./assets/css/' . $nom . '.css')) {
            $this->var['css'][] = css_url($nom);
            return true;
        }
        return false;
    }

    public function ajouter_js($nom) {
        if (is_string($nom) AND ! empty($nom) AND file_exists('./assets/js/' . $nom . '.js')) {
            $this->var['js'][] = site_url('assets/js/') . $nom . '.js';
            return true;
        }
        return false;
    }

    public function ajouter_jquery($nom) {
        if (is_string($nom) AND ! empty($nom) AND file_exists('./assets/jquery/' . $nom . '.js')) {
            $this->var['jquery'][] = site_url('assets/jquery/') . $nom . '.js';
            return true;
        }
        return false;
    }

    /**
     * Ajoute un element au menu. Cet element est rendu actif s'il correspond au meme controlleur que celui courant
     * @param String $menu      Le menu ou ajouter le lien
     * @param type $intitule
     * @param type $controller
     * @param type $active      Definit si l'element est actif ou non
     */
    public function ajouter_menu($menu, $intitule, $controller) {
        $this->var[$menu][$controller] = array(
            "intitule" => $intitule,
            "url" => site_url($controller . "/"),
            "actif" => $controller == $this->CI->router->fetch_class(),
        );

    }

    /**
     * Ajoute un element au menu. Cet element est rendu actif s'il correspond au meme controlleur que celui courant
     * @param String $menu      Le menu ou ajouter le lien
     * @param type $intitule
     * @param type $url
     */
    public function ajouter_menu_url($menu, $intitule, $url) {
        $this->var[$menu][$url] = array(
            "intitule" => $intitule,
            "url" => site_url($url . "/"),
        );
    }

    /**
     * Initialise le menu de base
     */
    public function init_menu() {
        $this->CI->load->library('session');

        // Ajoute a menu
        $this->ajouter_menu('menu', 'Accueil', '');
        $this->ajouter_menu('menu', 'Liste des Commerces', 'Commerces');
        $this->ajouter_menu('menu', 'Liste des Produits', 'Produits');

        // Ajoute a topMenu
        if (isset($this->CI->session->logged_in['username'])) {
            $this->ajouter_menu('topMenu', '<i class="fa fa-credit-card" aria-hidden="true"></i> Commandes', 'Client/Commandes');
            if (isset($this->CI->session->logged_in['idCommercant'])) {
                $this->ajouter_menu('topMenu', '<i class="fa fa fa-cogs"></i> Espace commercant', 'Commercant/Commercant');
            }
            $this->ajouter_menu('topMenu', $this->CI->session->logged_in['username'], 'Auth');

        } else {
            $this->ajouter_menu('topMenu', 'Connexion', 'Auth');
        }
        $this->ajouter_menu('topMenu', 'Panier', 'Panier');
    }

    /**
     * Rend le menu actif
     * @param String $controller    Le controlleur du menu
     */
    public function activer_menu($controller = "") {
        foreach ($this->var['menu'] as $m) {
            $m["actif"] = false;
        }
        $this->var['menu'][$controller]['actif'] = true;
    }

    /**
     * Change le titre au dessus du side menu
     * @param String $nom Le contenu du titre au dessus du sidemenu
     */
    public function setNomSideMenu($nom = "") {
        $this->var['nomSideMenu'] = $nom;
    }

    /**
     * Supprime toutes les entrees d'un menu
     * @param String $menu  Le menu a reset
     */
    public function resetMenu($menu) {
        if (array_key_exists($menu, $this->var) && is_array($this->var[$menu])) {
            $this->var[$menu] = array();
        }
    }

    public function set_menu_auto_false() {
        $this->menu_auto = false;
    }

}

/* End of file Layout_library.php */
/* Location: ./application/libraries/Layout_library.php */
