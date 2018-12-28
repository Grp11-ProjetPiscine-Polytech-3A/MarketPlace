<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Caracteristique_model extends MY_Model
{
	// Nom de la table
	protected $table = 'caracteristiques';
	// Nom de l'identifiant de la table
    protected $id = 'idCaracteristique';

	/**
	 *	Ajoute une caracteristique
	 *
	 *	@param  string 		$nomCar   	Le nom de la caracteristique
	 *	@return bool					Le résultat de la requête
	 */
	public function ajouter_caract($nomCar)
	{
            $data = array(
                'nomCaracteristique' => $nomCar
                );
            
            return $this->create($data);
	}
	
	/**
	 *	Édite une caracteristique déjà existante
	 *	@param  integer 	$id			L'id de la caracteristique à modifier
	 *	@param  string 		$nomCar   	Le nom de la caracteristique
	 *	@return bool					Le résultat de la requête
	 *
	public function editer_caract($id = null, $nomCar = null)
	{
		if ($id == null OR $nomCar == null)
		{
			return false;
		}

		$this->db->set('nomCaracteristique', $nomCar);
		$this->db->where('idCaracteristique' (int) $id);

		return $this->db->update($this->table);
	}*/
	
	/**
	 *	Supprime une caracteristique
	 *	@param integer 		$id			L'id de la caracteristique à supprimer
	 *	@return bool					Le résultat de la requête
	 *
	public function supprimer_caract()
	{
		$this->db->where('idCaracteristique' (int) $id),
		return $this->db->delete($this->table);
	}*/
	
	/**
	 *	Retourne une liste de caracteristique sous forme de tableau idCarac => nomCarac
	 */
	public function liste_caract()
	{
		$carac = $this->db->select('*')
					->from($this->table)
					->order_by($this->id, 'asc')
					->get()
					->result();
                $array_carac = array();
                foreach ($carac as $c) {
                    $array_carac[$c->idCaracteristique] = $c->nomCaracteristique;
                }
                return $array_carac;
	}
}


/* End of file Caracteristique_model.php */
/* Location: ./application/models/Caracteristique_model.php */