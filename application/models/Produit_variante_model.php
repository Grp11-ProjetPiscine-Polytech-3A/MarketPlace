<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produit_variante_model extends MY_Model
{
	// Nom de la table
	protected $table = 'produit_variante';
    // Nom de l'identifiant de la table
    protected $id = 'idProduitVariante';
    
    public function ajouter_produit_variante($idProduitVariante,$nomProduitVariante,$descriptionProduitVariante,
            $prixProduitVariante,$stockProduitVariante,$idProduitType)
	{
            $data = array(
                'idProduitVariante' => $idProduitVariante,
                'nomProduitVariante' => $nomProduitVariante,
                'descriptionProduitVariante' => $descriptionProduitVariante,
                'prixProduitVariante' => $prixProduitVariante,
                'stockProduitVariante' => $stockProduitVariante,
                'idProduitType' => $idProduitType
                );
            
            return $this->create($data);
	}
}


/* End of file produit_variante_model.php */
/* Location: ./application/models/produit_variante_model.php */