<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

  class User_admin_model extends MY_Model {

    // Nom de la table
    protected $table = 'user_admin';
    // Nom de l'identifiant de la table
    protected $id = 'idAdmin';


    /**
     * Used to know if an user is a shopkeeper
     * @param   int     $id     The user id
     * @return  boolean         TRUE if the user associated the $id is an admin
     */
    public function isAdmin($id){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_admin.idUser', $id);
        $this->db->join('user_admin', 'user.idUser = user_admin.idUser');
        $query = $this->db->get();

        if(empty($query->result())){
            return false;
        } else {
            return true;
        }
    }

    // Pas de fonction d'ajout d'admin, il se fera a la main.
}
