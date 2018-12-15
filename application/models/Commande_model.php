<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commande_model extends MY_Model
{
	// Nom de la table
	protected $table = 'commande';
    // Nom de l'identifiant de la table
    protected $id = 'idCommande';

    public function ajouter_commande($dateCommande)
	{
            $data = array(
                'dateCommande' => $dateCommande,
                );

            return $this->create($data);
	}

    public function produits_commande()
    {

        $id = $this->session->logged_in['idClient'];

        $this->db->select('*');
        $this->db->from('client_commande_effectuer');
        $this->db->where('client_commande_effectuer.idClient', $id);
        $this->db->join('ligne_commande', 'client_commande_effectuer.idCommande = ligne_commande.idCommande');
        $this->db->join('produit_variante', 'ligne_commande.idProduitVariante = produit_variante.idProduitVariante');
        $this->db->join('produit_type', 'produit_variante.idProduitType = produit_type.idProduitType');
        $query = $this->db->get();

        return $query->result();
    }

}

/* End of file Commande_model.php */
/* Location: ./application/models/Commande_model.php */
