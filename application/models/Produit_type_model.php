<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produit_type_model extends MY_Model
{
	// Nom de la table
	protected $table = 'produit_type';
    // Nom de l'identifiant de la table
    protected $id = 'idProduitType';
    
    public function ajouter_produit_type($nomProduitType,$descriptionProduitType,
            $prixProduitType,$seuilStockProduitType,$idCategorie,$siretCommerce)
	{
            $data = array(
                'nomProduitType' => $nomProduitType,
                'descriptionProduitType' => $descriptionProduitType,
                'prixProduitType' => $prixProduitType,
                'seuilStockProduitType' => $seuilStockProduitType,
                'idCategorie' => $idCategorie,
                'siretCommerce' => $siretCommerce
                );
            
            return $this->create($data);
	}
}


/* End of file produit_type_model.php */
/* Location: ./application/models/produit_type_model.php */