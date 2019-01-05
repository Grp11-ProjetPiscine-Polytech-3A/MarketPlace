<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Client_model extends MY_Model {

    // Nom de la table
    protected $table = 'client';
    // Nom de l'identifiant de la table
    protected $id = 'idClient';

    public function ajouter_client($nomClient, $prenomClient, $dateNaissanceClient, $telClient, $mailClient, $numAdresseClient, $rueClient, $codePostalClient, $villeClient, $complementAdresseCommerce, $pointsFidelitesClient) {
        $data = array(
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

        return $this -> create($data);
    }

    /**
     * Renvoie les donnees du client en fonction de son idUser
     * @param $idClient   L'id User du client
     */
    public function get_client_id($idClient) {
        $this -> db -> select('idClient');
        $this -> db -> from('client');
        $this -> db -> where('client.idUser', $idClient);
        $query = $this -> db -> get();

        return $query -> result();
    }

    public function get_nb_point_client($idClient){
        $this -> db -> select('pointsFidelitesClient');
        $this -> db -> from('client');
        $this -> db -> where('client.idClient', $idClient);
        $query = $this -> db -> get();

        return $query -> result()[0];
    }

}

/* End of file Client_model.php */
/* Location: ./application/models/Client_model.php */
