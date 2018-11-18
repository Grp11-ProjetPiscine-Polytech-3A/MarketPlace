<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produit_variante_caracteristique_model extends MY_Model
{
	// Nom de la table
    protected $table = 'produit_variante_caracteristique';
    // Nom des identifiants de la table
    protected $id1 = 'idProduitVariante';
    protected $id2 = 'idCaracteristique';
    
    public function ajouter_produit_variante_caracteristique($idProduitVariante,$idCaracteristique,$contenuCaracteristique)
	{
            $data = array(
                'idProduitVariante' => $idProduitVariante,
                'idCaracteristique' => $idCaracteristique,
                'contenuCaracteristique' => $contenuCaracteristique
                );
            
            return $this->create($data);
	}
    
}


/* End of file Produit_variante_caracteristique_model.php */
/* Location: ./application/models/Produit_variante_caracteristique_model.php */