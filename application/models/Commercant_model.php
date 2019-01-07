<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Commercant_model extends MY_Model {

    // Nom de la table
    protected $table = 'commercant';
    // Nom de l'identifiant de la table
    protected $id = 'idCommercant';

    public function ajouter_commercant($nomCommercant, $prenomCommercant, $dateNaissanceCommercant, $telCommercant, $mailCommercant) {
        $data = array(
            'nomCommercant' => $nomCommercant,
            'prenomCommercant' => $prenomCommercant,
            'dateNaissanceCommercant' => $dateNaissanceCommercant,
            'telCommercant' => $telCommercant,
            'mailCommercant' => $mailCommercant
        );

        return $this->create($data);
    }

    /**
     * 
     * @param type $idUser  l'idUser du commercant
     * @return boolean
     */
    public function isCommercant($idUser) {
  
        // Verification de l'existance de l'id de l'utilisateur dans la Table Commercant
        $this->db->select('*');
        $this->db->from('commercant');
        $this->db->where('user.idUser', $idUser);
        $this->db->join('user', 'commercant.idUser = user.idUser');
        $query = $this->db->get();

        if (empty($query->result())) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Renvoie les donnees du commercant en fonction de son idUser
     * @param $id   L'id User du client
     */
    public function get_commercant_iduser($idUser) {
        $data = array(
            'idUser' => $idUser,
        );
        return $this->read('*', $data);

    }
    
    

}

/* End of file Commercant_model.php */
/* Location: ./application/models/Commercant_model.php */
