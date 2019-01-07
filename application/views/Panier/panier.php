<div id="panier">
    <h2>Liste des produits</h2>
    <hr/>

    <div class="table-responsive">
        
        <div class="col-md-2 offset-md-10" style="text-align: right">
            <a href="<?php echo base_url('Panier/vider_panier/') ?>">Vider le panier</a>
        </div>
        
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
                        <td style="display:flex; justify-content: center">
                            <a href="<?php echo site_url('/Produits/fiche_produit/' . $p->idProduitType . '/' . $p->idProduitVariante) ?>">
                                <img src="<?php echo $p->image_url ?>" style="height:80px;width:auto">
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
    <?php echo form_open_multipart(base_url('Client/Commandes/ajouter_commandes')); ?>
    <div class="row justify-content-end">
        <div class="col-lg-3">
            <span class="pull-right lead"> Total : <?php echo $somme_totale ?> € </span>
        </div>
    </div>
    <div class="row justify-content-end">
        <div class="col-lg-3">
            <span class="pull-right lead"> Vous avez <?php echo $pointsFidelitesClient ?> points </span>
            <div class="form-group">
                <label for="inputNumAdresse"> Nombre de points à utiliser : </label>
                <input type="number" class="form-control" name="nbpoints" id="inputNbpoints" min="0" placeholder="" value="<?php echo set_value('nbpoints') ?>">
            </div>
        </div>
    </div>
    <div class="row justify-content-end">
        <div class="col-lg-3">
            <!--<a class="passer_commande btn btn-primary" role="button" href= "<?php echo base_url('Client/Commandes/ajouter_commandes')?>">Passer Commande</a>-->
            <button class="passer_commande btn btn-primary" type="submit" class="btn btn-primary">Passer Commande</button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
