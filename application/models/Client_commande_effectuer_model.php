<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_commande_effectuer_model extends MY_Model
{
	// Nom de la table
	protected $table = 'client_commande_effectuer';
    // Nom des identifiants de la table
    protected $id1 = 'idCommande';
    protected $id2 = 'idClient';

    public function ajouter_client_commande_effectuer($idCommande,$idClient,$nbPoint = 0)
	{
        $data = array(
            'idCommande' => $idCommande,
            'idClient' => $idClient,
            'nombrePointsUtilisés' => $nbPoint
            );

        return $this->create($data);
	}

	public function a_commande($id_produit_variante) {

		$idClient = $this -> session -> logged_in['idClient'];

		$this -> db -> select('*');
        $this -> db -> from('client_commande_effectuer');

        $this -> db -> join('ligne_commande', 'ligne_commande.idCommande = client_commande_effectuer.idCommande');

        $this -> db -> where('client_commande_effectuer.idClient', $idClient);
		$this -> db -> where('ligne_commande.idProduitVariante', $id_produit_variante);

        $query = $this -> db -> get();
		$count = $query -> num_rows();

        return ($count > 0);
    }
}


/* End of file Client_commande_effectuer_model.php */
/* Location: ./application/models/Client_commande_effectuer_model.php */
