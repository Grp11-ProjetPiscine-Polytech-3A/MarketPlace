<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Commande_model extends MY_Model {

    // Nom de la table
    protected $table = 'commande';
    // Nom de l'identifiant de la table
    protected $id = 'idCommande';

    // func creer_commande
    // Retourne l'id de la commande tout juste crée
    public function creer_commande() {
        $this->db->set('dateCommande', 'NOW()', FALSE);
        $this->db->insert($this->table);
        return $this->db->insert_id();
    }

    /**
     * Renvoie la liste des produits commandes par un client dont l'id est passe en parametre OU pris de la session
     * @param type $idClient
     * @return type
     */
    public function produits_commande($idClient = 0, $where = array()) {
        if (!$idClient) {
            $id = $this->session->logged_in['idClient'];
        } else {
            $id = $idClient;
        }

        $this->db->select('*');
        $this->db->from('client_commande_effectuer');
        $this->db->where('client_commande_effectuer.idClient', $id);

        if (count($where) > 0) {
            $this->db->where($where);
        }

        $this->db->join('ligne_commande', 'client_commande_effectuer.idCommande = ligne_commande.idCommande');
        $this->db->join('produit_variante', 'ligne_commande.idProduitVariante = produit_variante.idProduitVariante');
        $this->db->join('produit_type', 'produit_variante.idProduitType = produit_type.idProduitType');
        $this->db->join('commerce', 'commerce.siretCommerce = produit_type.siretCommerce');
        $this->db->join('commande', 'commande.idCommande = ligne_commande.idCommande');
        $this->db->order_by("commande.dateCommande", "desc");
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * Renvoie la liste des Commandes que ce commercant peut traiter
     * @param type $idCommercant
     * @return type
     */
    public function commandes_commercant($idCommercant = 0, $where = array()) {

        /**
          SELECT   pv.idProduitVariante, pv.nomProduitVariante, pt.idProduitType,
          pt.nomProduitType, com.siretCommerce, com.nomCommerce, cl.idClient,
          cl.nomClient, cl.prenomClient, co.idCommande, co.dateCommande,
          lc.prixAchatProduit, lc.etatReservationLigneCommande, lc.quantité

          FROM     commercant as c, commerce as com, produit_type as pt, produit_variante as pv,
          ligne_commande as lc, commande as co, client as cl, client_commande_effectuer as clcom, commercant_commerce_gerer ccg

          WHERE
          (c.idCommercant = com.idCommercant OR (c.idCommercant = ccg.idCommercant AND ccg.siretCommerce = com.siretCommerce)) AND com.siretCommerce = pt.siretCommerce
          AND pt.idProduitType = pv.idProduitType AND pv.idProduitVariante = lc.idProduitVariante
          AND co.idCommande = lc.idCommande AND clcom.idCommande = co.idCommande AND clcom.idClient = cl.idClient AND c.idCommercant = ID
         */
        if (!$idCommercant) {
            $id = $this->session->logged_in['idCommercant'];
        } else {
            $id = $idCommercant;
        }

        $this->db->select('pv.idProduitVariante, pv.nomProduitVariante, pt.idProduitType, pt.nomProduitType, com.siretCommerce, com.nomCommerce, cl.idClient, cl.nomClient, cl.prenomClient, co.idCommande, co.dateCommande, lc.prixAchatProduit, lc.etatReservationLigneCommande, lc.quantité, lc.idLigneCommande');
        $this->db->from('commercant as c, commerce as com, produit_type as pt, produit_variante as pv, ligne_commande as lc, commande as co, client as cl, client_commande_effectuer as clcom, commercant_commerce_gerer ccg');
        $this->db->where('(c.idCommercant = com.idCommercant OR (c.idCommercant = ccg.idCommercant AND ccg.siretCommerce = com.siretCommerce)) AND com.siretCommerce = pt.siretCommerce AND pt.idProduitType = pv.idProduitType AND pv.idProduitVariante = lc.idProduitVariante AND co.idCommande = lc.idCommande AND clcom.idCommande = co.idCommande AND clcom.idClient = cl.idClient AND c.idCommercant = ' . $id);

        if (count($where) > 0) {
            $this->db->where($where);
        }

        $this->db->order_by("co.dateCommande", "desc");
        $this->db->order_by("co.idCommande", "desc");
        $this->db->group_by("cl.idClient");

        $query = $this->db->get();

        return $query->result();
    }

    public function lignes_commandes($idCommande) {
        /**
         * Select count(idLigneCommande)
          from ligne_commande as lc, commande as c
          where c.idCommande = lc.idCommande AND c.idCommande=7
         */
        $this->db->select('*');
        $this->db->from('ligne_commande as lc, commande as c');
        $this->db->where('c.idCommande = lc.idCommande AND c.idCommande=' . $idCommande);

        $query = $this->db->get();

        return $query->result();
    }

}

/* End of file Commande_model.php */
/* Location: ./application/models/Commande_model.php */
