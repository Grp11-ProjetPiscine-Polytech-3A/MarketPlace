<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_donner_avis_model extends MY_Model
{
	// Nom de la table
	protected $table = 'client_donner_avis';
    // Nom des identifiants de la table
    protected $id1 = 'idClient';
    protected $id2 = 'idProduitVariante';


    public function ajouter_client_donner_avis($idProduitVariante,$commentaire,$note)
	{
			$idClient = $this -> session -> logged_in['idClient'];

            $data = array(
                'idClient' => $idClient,
                'idProduitVariante' => $idProduitVariante,
                'commentaire' => $commentaire,
                'note' => $note
                );

            return $this->create($data);
	}

    public function getCommentaires($idProduitType) {

        $this -> db -> select('*');
        $this -> db -> from('client_donner_avis');

        $this -> db -> join('produit_variante', 'produit_variante.idProduitVariante = client_donner_avis.idProduitVariante');
        $this -> db -> join('client', 'client.idClient = client_donner_avis.idClient');
        $this -> db -> join('user', 'user.idUser = client.idUser');


        $this -> db -> where('produit_variante.idProduitType', $idProduitType);

        $query = $this -> db -> get();

        return $query -> result();
    }
}


/* End of file Client_donner_avis.php */
/* Location: ./application/models/Client_donner_avis.php */
