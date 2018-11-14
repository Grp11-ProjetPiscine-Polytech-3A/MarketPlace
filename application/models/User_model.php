<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends MY_Model
{
	// Nom de la table
	protected $table = 'user';
    // Nom de l'identifiant de la table
    protected $id = '';

    /**
     * Check the user with the username and password sent by the user
     * @param   Array     $data    the associative array that contains the loginUser and passUser
     * @return  boolean            TRUE if the informations given are correct, FALSE else
     */
    public function login($data) {
        // Makes the request        
        $this->db->select('*');
        $this->db->from('User');
        $this->db->where('loginUser',$data['loginUser']);
        $this->db->where('passUser',$data['passUser']);
        $this->db->limit(1);
        
        // Executes the query
        $query = $this->db->get();

        // Return true or false
        return $query->num_rows() == 1;
    }

    /**
     * Select all the data from the username
     * @param type  $username    The username (loginUser) of the User
     * @return  The result of the query
     */
    public function select_from_username($username) {

        $this->db->select('*');
        $this->db->from('User');
        $this->db->where('loginUser', $username);
        $this->db->limit(1);
        $query = $this->db->get();


        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
}


/* End of file produit_variante_model.php */
/* Location: ./application/models/produit_variante_model.php */