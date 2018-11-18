<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Code_reduction_ligne_commande_appliquer_model extends MY_Model
{
	// Nom de la table
    protected $table = 'code_reduction_ligne_commande_appliquer';
    // Nom des identifiants de la table
    protected $id1 = 'idCodeReduction';
    protected $id2 = 'idLigneCommande';
    
    public function ajouter_code_reduction_ligne_commande_appliquer($idCodeReduction,$idLigneCommande,$reductionEffective)
	{
            $data = array(
                'idCodeReduction' => $idCodeReduction,
                'idLigneCommande' => $idLigneCommande,
                'reductionEffective' => $reductionEffective,
                );
            
            return $this->create($data);
	}
}


/* End of file Code_reduction_ligne_commande_appliquer_model.php */
/* Location: ./application/models/Code_reduction_ligne_commande_appliquer_model.php */