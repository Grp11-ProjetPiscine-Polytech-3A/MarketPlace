<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commercant_commerce_gerer_model extends MY_Model
{
	// Nom de la table
    protected $table = 'commercant_commerce_gerer';
    // Nom des identifiants de la table
    protected $id1 = 'idCommercant';
    protected $id2 = 'siretCommerce';
    
    public function ajouter_commercant_commerce_gerer($idCommercant,$siretCommerce)
	{
            $data = array(
                'idCommercant' => $idCommercant,
                'siretCommerce' => $siretCommerce,
                );
            
            return $this->create($data);
	}
    
}

/* End of file Commercant_commerce_gerer_model.php */
/* Location: ./application/models/Commercant_commerce_gerer_model.php */