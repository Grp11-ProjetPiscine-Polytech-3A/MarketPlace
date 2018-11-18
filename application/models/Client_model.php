<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_model extends MY_Model
{
	// Nom de la table
	protected $table = 'client';
    // Nom de l'identifiant de la table
    protected $id = 'idClient';
    
    public function ajouter_client($idClient,$nomClient,$prenomClient,$dateNaissanceClient,
            $telClient,$mailClient,$numAdresseClient,$rueClient,$codePostalClient,$villeClient,
            $complementAdresseCommerce,$pointsFidelitesClient)
	{
            $data = array(
                'idClient' => $idClient,
                'nomClient' => $nomClient,
                'prenomClient' => $prenomClient,
                'dateNaissanceClient' => $dateNaissanceClient,
                'telClient' => $telClient,
                'mailClient' => $mailClient,
                'numAdresseClient' => $numAdresseClient,
                'rueClient' => $rueClient,
                'codePostalClient' => $codePostalClient,
                'villeClient' => $villeClient,
                'complementAdresseCommerce' => $complementAdresseCommerce,
                'pointsFidelitesClient' => $pointsFidelitesClient
                );
            
            return $this->create($data);
	}
}


/* End of file Client_model.php */
/* Location: ./application/models/Client_model.php */