<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Code_reduction_produit_variante_concerner_model extends MY_Model
{
	// Nom de la table
    protected $table = 'code_reduction_produit_variante_concerner';
    // Nom de l'identifiant de la table
    protected $id1 = 'idCodeReduction';
    protected $id2 = 'idProduitVariante';
    
    public function ajouter_code_reduction_produit_variante($idCodeReduction,$idProduitVariante)
	{
            $data = array(
                'idCodeReduction' => $idCodeReduction,
                'idProduitVariante' => $idProduitVariante
                );
            
            return $this->create($data);
	}
}


/* End of file Code_reduction_produit_variante_concerner_model.php */
/* Location: ./application/models/Code_reduction_produit_variante_concerner_model.php */