<div id="commandes">
    <h2>Liste des produits commandés</h2>
    <hr/>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"><i class="fa fa-picture-o"></i></th>
                    <th scope="col">Désignation</th>
                    <th scope="col">Vendeur</th>
                    <th scope="col">Etat</th>
                    <th scope="col">Prix unitaire</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Prix total</th>
                </tr>
            </thead>

            <tbody>
                <?php if(isset($produits)): ?>
                    <?php foreach ($produits as $p): ?>
                        <tr>

                            <!-- Image -->
                            <td>
                                <a href="<?php echo site_url('/Produits/fiche_produit/' . $p['idProduitType']) ?>">
                                    <img class="img-thumbnail" src="<?php echo $p['img_url'] ?>" alt="<?php echo $p['nomProduitVariante'] ?>" style="height:50px; width: auto;">
                                </a>
                            </td>

                            <!-- Désignation -->
                            <td>
                                <a href="<?php echo site_url('/Produits/fiche_produit/' . $p['designation']) ?>">
                                    <?php echo $p['designation'] ?>
                                </a>
                            </td>

                            <!-- Vendeur -->
                            <td>
                                <?php echo $p['nomCommerce'] ?>
                            </td>

                            <!-- Etat -->
                            <td>
                                <?php echo $p['etatReservationLigneCommande'] ?>
                            </td>

                            <!-- Prix unitaire -->
                            <td>
                                <?php echo $p['prixProduitVariante'] ?> €
                            </td>

                            <!-- Quantité -->
                            <td>
                                <?php echo $p['quantité'] ?>
                            </td>

                            <!-- Prix Total-->
                            <td>
                                <?php echo $p['prixAchatProduit']*$p['quantité'] ?> €
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                      <p> hum <p>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
