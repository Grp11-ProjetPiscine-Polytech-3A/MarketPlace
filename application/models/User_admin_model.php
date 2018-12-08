<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
    public function isAdmin(){
        // Récupération de l'id de l'utilisateur en session
        $id = $this->session->logged_in['idUser']

        // Vérification de l'existance de cet ID dans la Table user_admin
        $this->db->select('*');
        $this->db->from('user_admin');
        $this->db->where('user_admin.idUser', $id);
        $query = $this->db->get();

        // Retourne True si l'utilisateur est admin
        if(empty($query->result())){
            return false;
        } else {
            return true;
        }
    }

    // Pas de fonction d'ajout d'admin, il doit se faire a la main pour des questions de sécurité.
}

/* End of file User_admin_model.php */
/* Location: ./application/models/User_admin_model.php */