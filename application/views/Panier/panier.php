<div id="panier">
    <h2>Liste des produits</h2>
    <hr/>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"></th><!--sert a placer l'image de l'objet-->
                    <th scope="col">Désignation</th>
                    <th scope="col">Vendeur</th>
                    <th scope="col">Prix unitaire</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Prix</th>
                    <th scope="col"></th>
                </tr>
            </thead>



            <tbody>
                <?php foreach ($produits as $p): ?>
                    <tr>
                        <td>
                            <a href="<?php echo site_url('/Produits/fiche_produit/' . $p->idProduitType . '/' . $p->idProduitVariante) ?>">
                                <img src="<?php echo $p->image_url ?>" style="height:80px;width:80px">
                            </a>
                        <td>
                            <a href="<?php echo site_url('/Produits/fiche_produit/' . $p->idProduitType . '/' . $p->idProduitVariante) ?>">
                                <?php echo $p->nomProduitType . ' - ' . $p->nomProduitVariante ?>
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo site_url('Commerces/fiche_commerce/' . $p->commerce->siretCommerce) ?>">
                                <?php echo $p->commerce->nomCommerce ?>
                            </a>
                        </td>
                        <td>
                            <?php echo $p->prixProduitVariante ?> €
                        </td>
                        <td>
                            <div class="flex-centered-elements">
                                <span>
                                    <?php echo $p->quantite ?>
                                </span>
                                <span class="btn-group-vertical pull-right">
                                    <a href="<?php echo site_url('Panier/ajouter_panier/' . $p->idProduitVariante . '/1') ?>">
                                        <i class="fa fa-angle-up"></i>
                                    </a>
                                    <a href="<?php echo site_url('Panier/supprimer_panier/' . $p->idProduitVariante . '/1') ?>">
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                </span>
                            </div>
                        </td>
                        <td>
                            <?php echo $p->prixTotal ?> €
                        </td>
                        <td>
                            <a href="<?php echo site_url('Panier/supprimer_panier/' . $p->idProduitVariante . '/0') ?>">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="row justify-content-end">
        <div class="col-lg-3">
            <span class="pull-right lead"> Total : <?php echo $somme_totale ?> € </span>
        </div>
    </div>
    <div class="row justify-content-end">
        <div class="col-lg-3">
            <a class="passer_commande btn btn-primary" role="button" href= "<?php echo base_url('Commandes/afficher_commandes')?>">Passer Commande</a>
        </div>
    </div>
</div>
