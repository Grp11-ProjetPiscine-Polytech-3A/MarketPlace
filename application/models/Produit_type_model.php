<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produit_type_model extends MY_Model {

    // Nom de la table
    protected $table = 'produit_type';
    // Nom de l'identifiant de la table
    protected $id = 'idProduitType';

    public function ajouter_produit_type($nomProduitType, $descriptionProduitType
    , $seuilStockProduitType, $idCategorie, $siretCommerce) {
        $data = array(
            'nomProduitType' => $nomProduitType,
            'descriptionProduitType' => $descriptionProduitType,
            'prixProduitType' => $prixProduitType,
            'seuilStockProduitType' => $seuilStockProduitType,
            'idCategorie' => $idCategorie,
            'siretCommerce' => $siretCommerce
        );

        return $this->create($data);
    }

    public function getIdProduitType($nomProduit) {
        $this->db->select('idProduitType');
        $this->db->from('produit_type');
        $this->db->where('produit_type.nomProduitType', $nomProduit);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * Renvoie la liste des produits pouvant etre geres par ce commercant
     * @param type $idCommercant    L'id du commercant
     * @param array $where          Des conditions supplementaires
     */
    public function getProduitsCommercant($idCommercant) {

        /*
         *  SELECT idProduitType, nomProduitType, descriptionProduitType, seuilStockProduitType, idCategorie, pt.siretCommerce
         *  FROM produit_type as pt, commercant_commerce_gerer as ccg, commerce as com, commercant as comm
         *  WHERE pt.siretCommerce = com.siretCommerce 
         *        AND (comm.idCommercant = com.idCommercant 
         *              OR (ccg.idCommercant = comm.idCommercant 
         *                  AND ccg.siretCommerce = com.siretCommerce)) 
         *        AND comm.idCommercant = ???
         */


        $this->db->select('idProduitType, nomProduitType, descriptionProduitType, seuilStockProduitType, idCategorie, pt.siretCommerce');

        $this->db->from('produit_type as pt, commercant_commerce_gerer as ccg, commerce as com, commercant as comm');

        $this->db->where('pt.siretCommerce = com.siretCommerce AND (comm.idCommercant = com.idCommercant OR (ccg.idCommercant = comm.idCommercant AND ccg.siretCommerce = com.siretCommerce)) and comm.idCommercant=' . $idCommercant);


        $query = $this->db->get();

        return $query->result();
    }

    /**
     * Retourne les caracteristiques pour ce produit type
     * @param type $idProduitVariantes
     * @return type
     */
    public function getCaracteristiques($idProduitType) {
        $this->db->select('caracteristiques.idCaracteristique, nomCaracteristique, contenuCaracteristique');

        $this->db->from('produit_type_caracteristique');

        $this->db->join('produit_type', 'produit_type_caracteristique.idProduitType = produit_type.idProduitType');
        $this->db->join('caracteristiques', 'caracteristiques.idCaracteristique = produit_type_caracteristique.idCaracteristique');

        $this->db->where('produit_type.idProduitType', $idProduitType);


        $query = $this->db->get();

        return $query->result();
    }

    public function getRangePrice($idProduitType) {
        // On reccupere les prix des variantes
        $CI = & get_instance();
        $CI->load->model('Produit_variante_model');
        $whereProduit = array(
            "idProduitType" => $idProduitType,
        );
        $prix_variantes = $CI->Produit_variante_model->read("prixProduitVariante", $whereProduit);

        // Formate le prix
        if (count($prix_variantes) >= 2) {
            if (isset($min)) {
                unset($min);
            }
            if (isset($max)) {
                unset($max);
            }


            foreach ($prix_variantes as $prix) {
                $p = $prix->prixProduitVariante;
                if (!isset($min) || $p <= $min) {
                    $min = $p;
                }
                if (!isset($max) || $p >= $max) {
                    $max = $p;
                }
            }
            $prix = $min . ' - ' . $max;
        } else {
            $prix = $prix_variantes[0]->prixProduitVariante;
        }
        return $prix;
    }

}

/* End of file produit_type_model.php */
/* Location: ./application/models/produit_type_model.php */