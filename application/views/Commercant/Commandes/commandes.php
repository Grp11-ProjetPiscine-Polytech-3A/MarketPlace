<div id="commandes">
    <h2>Liste des produits commandés par des clients</h2>
    <hr/>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"><i class="fa fa-picture-o"></i></th>
                    <th scope="col">Désignation</th>
                    <th scope="col">Client</th>
                    <th scope="col">Date</th>
                    <th scope="col">Etat</th>
                    <th scope="col">Prix unitaire d'achat</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Prix total</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php if (isset($commandes)): ?>
                    <?php foreach ($commandes as $c): ?>
                        <tr style="background: <?php echo $c->color ?>">

                            <!-- Image -->
                            <td>
                                <a href="<?php echo site_url('/Produits/fiche_produit/' . $c->idProduitType . '/' . $c->idProduitVariante) ?>">
                                    <img class="img-thumbnail" src="<?php echo $c->img_url ?>" alt="<?php echo $c->nomProduitVariante ?>" style="height:50px; width: auto;">
                                </a>
                            </td>

                            <!-- Désignation -->
                            <td>
                                <a href="<?php echo site_url('/Produits/fiche_produit/' . $c->idProduitType . '/' . $c->idProduitVariante) ?>">
                                    <?php echo $c->nomProduitType . ' - ' . $c->nomProduitVariante ?>
                                </a>
                            </td>

                            <!-- Client -->
                            <td>
                                <a href="<?php echo site_url('/Commercant/Clients/fiche_client/' . $c->idClient) ?>">
                                    <?php echo mb_ucfirst($c->nomClient) . ' ' . mb_ucfirst($c->prenomClient) ?>
                                </a>

                            </td>

                            <!-- Date -->
                            <td>
                                <?php echo $c->dateCommande ?>
                            </td>

                            <!-- Etat -->
                            <td>
                                <?php echo $c->etatReservationLigneCommande ?>
                            </td>

                            <!-- Prix unitaire -->
                            <td>
                                <?php echo $c->prixAchatProduit ?> €
                            </td>

                            <!-- Quantité -->
                            <td>
                                <?php echo $c->quantité ?>
                            </td>

                            <!-- Prix Total-->
                            <td>
                                <?php echo $c->prixAchatProduit * $c->quantité ?> €
                            </td>

                            <td>
                                <a href="<?php echo "" ?>">
                                    <a href="<?php echo base_url('Commercant/Commandes/confirmer_commande/' . $c->idLigneCommande) ?>">
                                        <i class="fa fa-check"></i>
                                    </a>
                                    <a href="<?php echo base_url('Commercant/Commandes/refuser_commande/' . $c->idLigneCommande) ?>" style="color:red">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                <p> Aucunes Commandes <p>
                <?php endif; ?>
                </tbody>
        </table>
    </div>
</div>
