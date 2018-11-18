<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produit_type_caracteristique_model extends MY_Model
{
	// Nom de la table
    protected $table = 'produit_type_caracteristique';
    // Nom des identifiants de la table
    protected $id1 = 'idProduitType';
    protected $id2 = 'idCaracteristique';
    
    public function ajouter_produit_type_caracteristique($idProduitType,$idCaracteristique,$contenuCaracteristique)
	{
            $data = array(
                'idProduitType' => $idProduitType,
                'idCaracteristique' => $idCaracteristique,
                'contenuCaracteristique' => $contenuCaracteristique
                );
            
            return $this->create($data);
	}
    
}


/* End of file Produit_type_caracteristique_model.php */
/* Location: ./application/models/Produit_type_caracteristique_model.php */