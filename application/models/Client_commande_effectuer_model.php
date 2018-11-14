<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_commande_effectuer_model extends MY_Model
{
	// Nom de la table
	protected $table = 'client_commande_effectuer';
    // Nom des identifiants de la table
    protected $id1 = 'idCommande';
    protected $id2 = 'idClient';
}


/* End of file Client_commande_effectuer_model.php */
/* Location: ./application/models/Client_commande_effectuer_model.php */