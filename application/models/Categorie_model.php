<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categorie_model extends MY_Model
{
	// Nom de la table
	protected $table = 'categorie';
    // Nom de l'identifiant de la table
    protected $id = 'idCategorie';
    
  
    public function ajouter_categorie($descriptionCategorie)
	{
            $data = array(
                'descriptionCategorie' => $descriptionCategorie
                );
            
            return $this->create($data);
	}
}


/* End of file Categorie_model.php */
/* Location: ./application/models/Categorie_model.php */