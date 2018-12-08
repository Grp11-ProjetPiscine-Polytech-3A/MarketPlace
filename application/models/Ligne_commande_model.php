<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ligne_commande_model extends MY_Model
{
	// Nom de la table
    protected $table = 'ligne_commande';
    // Nom de l'identifiant de la table
    protected $id = 'idLigneCommande';
    
    public function ajouter_ligne_commande($etatReservationLigneCommande,
            $quantite,$prixAchatProduit,$idProduitVariante,$idCommande)
	{
            $data = array(
                'etatReservationLigneCommande' => $etatReservationLigneCommande,
                'quantite' => $quantite,
                'prixAchatProduit' => $prixAchatProduit,
                'idProduitVariante' => $idProduitVariante,
                'idCommande' => $idCommande
                );
            
            return $this->create($data);
	}
    
}


/* End of file Ligne_commande_model.php */
/* Location: ./application/models/Ligne_commande_model.php */