<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Code_reduction_model extends MY_Model
{
	// Nom de la table
    protected $table = 'code_reduction';
    // Nom de l'identifiant de la table
    protected $id = 'idCodeReduction';
    
    public function ajouter_code_reduction($idCodeReduction,$dateDebutCodeReduction,$dateFinCodeReduction)
	{
            $data = array(
                'idCodeReduction' => $idCodeReduction,
                'dateDebutCodeReduction' => $dateDebutCodeReduction,
                'dateFinCodeReduction' => $dateFinCodeReduction,
                );
            
            return $this->create($data);
	}
    
}


/* End of file Code_reduction_model.php */
/* Location: ./application/models/Code_reduction_model.php */