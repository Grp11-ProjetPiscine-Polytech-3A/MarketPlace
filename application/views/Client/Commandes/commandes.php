<div id="commandes">
    <h2>Liste des produits commandés</h2>
    <hr/>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <!--th scope="col">Image</th-->
                    <th scope="col">Désignation</th>
                    <th scope="col">Vendeur</th>
                    <th scope="col">Etat</th>
                    <th scope="col">Prix unitaire</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Prix total</th>
                </tr>
            </thead>



            <tbody>
                <?php foreach ($produits as $p): ?>
                    <tr>
                        <!-- Image
                        <td>
                            <a href="<?php echo site_url('/Produits/fiche_produit/' . $p->idProduitType) ?>">
                                <?php echo base_url("/assets/images/produits/produit_") . $p->$idProduitType . "/img" . $p->$idProduitVariante . ".png" ?>
                            </a>
                        </td>
                        -->

                        <!-- Désignation -->
                        <td>
                            <a href="<?php echo site_url('/Produits/fiche_produit/' . $p->idProduitType) ?>">
                                <?php echo $p->nomProduitType ?>
                            </a>
                        </td>

                        <!-- Vendeur -->
                        <td>
                            echo 'wlh'
                        </td>

                        <!-- Etat -->
                        <td>
                            <?php echo $p->etatReservationLigneCommande ?>
                        </td>

                        <!-- Prix unitaire -->
                        <td>
                            <?php echo $p->prixProduitVariante ?> €
                        </td>

                        <!-- Quantité -->
                        <td>
                            <?php echo $p->quantité ?>
                        </td>

                        <!-- Prix Total-->
                        <td>
                            <?php echo $p->prixAchatProduit*$p->quantité ?> €
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
