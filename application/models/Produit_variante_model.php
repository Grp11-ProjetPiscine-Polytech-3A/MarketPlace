<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produit_variante_model extends MY_Model {

    // Nom de la table
    protected $table = 'produit_variante';
    // Nom de l'identifiant de la table
    protected $id = 'idProduitVariante';

    public function ajouter_produit_variante($nomProduitVariante, $descriptionProduitVariante, $prixProduitVariante, $stockProduitVariante, $idProduitType) {
        $data = array(
            'nomProduitVariante' => $nomProduitVariante,
            'descriptionProduitVariante' => $descriptionProduitVariante,
            'prixProduitVariante' => $prixProduitVariante,
            'stockProduitVariante' => $stockProduitVariante,
            'idProduitType' => $idProduitType
        );

        return $this->create($data);
    }

    public function getIdProduitVariante($nomProduit) {
        $this->db->select('idProduitVariante');
        $this->db->from('produit_variante');
        $this->db->where('produit_variante.nomProduitVariante', $nomProduit);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Renvoie les variantes du produit Type en fonction de son id
     * @param type $idProduitType
     */
    public function getVariantes($idProduitType) {
        $where = array(
            'idProduitType' => $idProduitType,
        );
        return $this->read("*", $where);
    }

    public function getCaracteristiques($idProduitVariantes) {
        $this->db->select('nomCaracteristique, contenuCaracteristique');

        $this->db->from('produit_variante_caracteristique');

        $this->db->join('produit_variante', 'produit_variante_caracteristique.idProduitVariante = produit_variante.idProduitVariante');
        $this->db->join('caracteristiques', 'caracteristiques.idCaracteristique = produit_variante_caracteristique.idCaracteristique');

        $this->db->where('produit_variante.idProduitVariante', $idProduitVariantes);


        $query = $this->db->get();

        return $query->result();
    }

}

/* End of file produit_variante_model.php */
/* Location: ./application/models/produit_variante_model.php */