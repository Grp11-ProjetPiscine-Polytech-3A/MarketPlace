<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Commerce_model extends MY_Model {

    // Nom de la table
    protected $table = 'commerce';
    // Nom de l'identifiant de la table
    protected $id = 'siretCommerce';

    public function ajouter_commerce($siretCommerce, $nomCommerce, $mailCommerce, $telCommerce, $numAdresseCommerce, $rueCommerce, $codePostalCommerce, $villeCommerce, $complementAdresseCommerce, $tempsReservationProduitsCommerce, $produitsLivrablesCommerce, $idCommercant, $descriptionCommerce) {
        $data = array(
            'siretCommerce' => $siretCommerce,
            'nomCommerce' => $nomCommerce,
            'mailCommerce' => $mailCommerce,
            'telCommerce' => $telCommerce,
            'numAdresseCommerce' => $numAdresseCommerce,
            'rueCommerce' => $rueCommerce,
            'codePostalCommerce' => $codePostalCommerce,
            'villeCommerce' => $villeCommerce,
            'complementAdresseCommerce' => $complementAdresseCommerce,
            'tempsReservationProduitsCommerce' => $tempsReservationProduitsCommerce,
            'produitsLivrablesCommerce' => $produitsLivrablesCommerce,
            'idCommercant' => $idCommercant,
            'descriptionCommerce' => $descriptionCommerce,
        );

        return $this->create($data);
    }

}

/* End of file commerce_model.php */
/* Location: ./application/models/commerce_model.php */