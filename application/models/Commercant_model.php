<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commercant_model extends MY_Model
{
	// Nom de la table
	protected $table = 'commercant';
    // Nom de l'identifiant de la table
    protected $id = 'idCommercant';

    public function ajouter_commercant($nomCommercant,$prenomCommercant,
            $dateNaissanceCommercant,$telCommercant,$mailCommercant)
	{
            $data = array(
                'nomCommercant' => $nomCommercant,
                'prenomCommercant' => $prenomCommercant,
                'dateNaissanceCommercant' => $dateNaissanceCommercant,
                'telCommercant' => $telCommercant,
                'mailCommercant' => $mailCommercant
                );

            return $this->create($data);
	}

    public function isCommercant(){
        // Récupération de l'id de l'utilisateur en session
        $id = $this->session->logged_in['idUser']

        // Vérification de l'existance de l'id de l'utilisateur dans la Table Commercant
        $this->db->select('*');
        $this->db->from('commercant');
        $this->db->where('user.idUser', $id);
        $this->db->join('user', 'commercant.idUser = user.idUser');
        $query = $this->db->get();

        if(empty($query->result())){
            return false;
        } else {
            return true;
        }
    }

}

/* End of file Commercant_model.php */
/* Location: ./application/models/Commercant_model.php */
