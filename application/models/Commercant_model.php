<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commercant_model extends MY_Model
{
	// Nom de la table
	protected $table = 'commercant';
    // Nom de l'identifiant de la table
    protected $id = 'idCommercant';
    
    public function ajouter_commercant($idCommercant,$nomCommercant,$prenomCommercant,
            $dateNaissanceCommercant,$telCommercant,$mailCommercant)
	{
            $data = array(
                'idCommercant' => $idCommercant,
                'nomCommercant' => $nomCommercant,
                'prenomCommercant' => $prenomCommercant,
                'dateNaissanceCommercant' => $dateNaissanceCommercant,
                'telCommercant' => $telCommercant,
                'mailCommercant' => $mailCommercant
                );
            
            return $this->create($data);
	}
    
}

/* End of file Commercant_model.php */
/* Location: ./application/models/Commercant_model.php */