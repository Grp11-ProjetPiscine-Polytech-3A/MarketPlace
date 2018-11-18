<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends MY_Model {

    // Nom de la table
    protected $table = 'user';
    // Nom de l'identifiant de la table
    protected $id = 'idUser';

    /**
     * Creates the user
     * @param type $login       The login
     * @param type $password    The password
     * @return boolean          TRUE if the process worked
     */
    public function signup($login, $password) {
        // Encrypt the password
        $encrypted_password = encrypt_password($password, $login);

        // Set the data
        $data = array(
            "loginUser" => $login,
            "passUser" => $encrypted_password,
        );

        return $this->create($data);
    }

    /**
     * Check the user with the username and password sent by the user
     * @param String $login         The username of the entered by the user
     * @param String $password      The password
     * @return boolean            TRUE if the informations given are correct, FALSE else
     */
    public function login($login, $password) {
        // Check if the user exists. 
        $result = $this->select_from_username($login);

        // If it doesn't exist, return false
        if (!$result) {
            return false;
        } else {
            $login = $result[0]->loginUser;
        }

        // Encrypt the password
        $encrypted_password = encrypt_password($password, $login);

        // Check if the password is the right one
        $data = array(
            "loginUser" => $login,
            "passUser" => $encrypted_password,
        );

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($data);
        $this->db->limit(1);

        // Executes the query
        $query = $this->db->get();

        // Return true or false
        return $query->num_rows() == 1;
    }

    /**
     * Select all the data from the username. This method is not case sensitive
     * @param type  $username    The username (loginUser) of the User
     * @return  The result of the query
     */
    public function select_from_username($username) {

        // 'UPPER' allows to ignore case
        $data = array(
            "UPPER(loginUser)" => mb_strtoupper($username),
        );

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($data);
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