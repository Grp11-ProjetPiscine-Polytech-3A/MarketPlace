<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_donner_avis_model extends MY_Model
{
	// Nom de la table
	protected $table = 'client_donner_avis';
    // Nom des identifiants de la table
    protected $id1 = 'idClient';
    protected $id2 = 'idProduitVariante';
    
    
    public function ajouter_client_donner_avis($idClient,$idProduitVariante,$commentaire,$note)
	{
            $data = array(
                'idClient' => $idClient,
                'idProduitVariante' => $idProduitVariante,
                'commentaire' => $commentaire,
                'note' => $note
                );
            
            return $this->create($data);
	}
}


/* End of file Client_donner_avis.php */
/* Location: ./application/models/Client_donner_avis.php */