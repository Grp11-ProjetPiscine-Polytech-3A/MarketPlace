<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Modèle CRUD
// Ce modèle a pour but de ne pas réécrire des méthodes redondantes
// Les méthodes exigés par ce modèle sont CREATE, READ, UPDATE, DELETE (CRUD)
// https://fr.wikipedia.org/wiki/CRUD
// -----------------------------------------------------------------------------

class MY_Model extends CI_Model
{
    /**
     *  Insère une nouvelle ligne dans la base de données.
     *  Les options echappees sont des données interprétées (NOW() par exemple)
     *  Renvoie true si le create a marché
     */
    public function create($options_echappees = array(), $options_non_echappees = array())
    {
        //  Vérification des données à insérer
        if(empty($options_echappees) AND empty($options_non_echappees))
        {
            return false;
        }

        return (bool) $this->db ->set($options_echappees)
                                ->set($options_non_echappees, null, false)
                                ->insert($this->table);
    }

    /**
     *  Récupère des données dans la base de données.
     */
    public function read($select = '*', $where = array(), $nb = null, $debut = null)
    {
        return $this->db->select($select)
                        ->from($this->table)
                        ->where($where)
                        ->limit($nb, $debut)
                        ->get()
                        ->result();
    }

    /**
     *  Modifie une ou plusieurs lignes dans la base de données.
     */
    public function update($where, $options_echappees = array(), $options_non_echappees = array())
    {
        //  Vérification des données à mettre à jour
        if(empty($options_echappees) AND empty($options_non_echappees))
        {
            return false;
        }

        //  Raccourci dans le cas où on sélectionne l'id
        //  TODO : Remplacer 'id' par une variable id, toute les tables (aucune en fait) n'a d'indentifiant s'appelant id
        if(is_integer($where))
        {
            $where = array('id' => $where);
        }

        return (bool) $this->db ->set($options_echappees)
                                ->set($options_non_echappees, null, false)
                                ->where($where)
                                ->update($this->table);

    }

    /**
     *  Supprime une ou plusieurs lignes de la base de données.
     */
    public function delete($where)
    {
        if(is_integer($where))
        {
            $where = array($this->id => $where);
        }

        return (bool) $this->db ->where($where)
                                ->delete($this->table);
    }

    /**
     *  Retourne le nombre de résultats.
     *  Peut prendre en paramètre soit
     *   - Rien (Retourne le nombre totale de valeur dans la table)
     *   - Un champs et la valeur souhaité
     *   - Un array avec tout les paramètres souhaités (le paramètre $valuer sera alors ignoré)
     *  Exemples d'appel :
     *  //  Le nombre d'entrées dans la table du modèle userManager
     *  $nb_membres = $this->userManager->count();
     *
     *  //  Une seule condition
     *  $nb_messages = $this->userManager->count('pseudo', 'Arthur');
     *
     *  //  Multiples conditions
     *  $option = array();
     *  $option['titre']  = 'Mon Super Titre';
     *  $option['auteur'] = 'Arthur';
     *  $nb_messages_deux = $this->userManager->count($option);
     */
    public function count($champ = array(), $valeur = null)
    {

        return (int) $this->db->where($champ, $valeur)
                              ->from($this->table)
                              ->count_all_results();
    }
}

/* End of file MY_Model.php */
/* Location: ./system/application/core/MY_Model.php */
