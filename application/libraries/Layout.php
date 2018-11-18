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

        // Parametre les menus
        $this->var['menu'] = array();
        $this->init_menu();
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

    public function view($name, $data = array()) {
        $this->var['output'] .= $this->CI->load->view($name, $data, true);

        $this->CI->load->view('../themes/default_layout', $this->var);
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
        if (is_string($nom) AND ! empty($nom) AND file_exists('./assets/javascript/' . $nom . '.js')) {
            $this->var['js'][] = js_url($nom);
            return true;
        }
        return false;
    }

    /**
     * Ajoute un element au menu. Cet element est rendu actif s'il correspond au meme controlleur que celui courant
     * @param type $intitule
     * @param type $controller
     * @param type $active      Definit si l'element est acif ou non
     */
    public function ajouter_menu($intitule, $controller) {
        $this->var['menu'][$controller] = array(
            "intitule" => $intitule,
            "url" => site_url($controller . "/"),
            "actif" => $controller == $this->CI->router->fetch_class(),
        );
    }

    /**
     * Initialise le menu de base 
     */
    public function init_menu() {
        $this->ajouter_menu('Home', '');
        $this->ajouter_menu('Liste des Produits', 'Produits');
        $this->ajouter_menu('Connexion', 'Auth');
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

}

/* End of file Layout_library.php */
/* Location: ./application/libraries/Layout_library.php */