<div id="Modif-produit" class="container">
    <div class="panel">
        <div id="title_admin">
            <div class="row">
                <div id="title" class="col-sm-8">
                    <h3><?php echo $produit_type->nomProduitType ?></h3>
                </div>
                <div id="button" class="col-sm-2">
                    <a href="<?php echo base_url('Produits/fiche_produit/' . $produit_type->idProduitType) ?>" class="btn btn-success" role="button"> <span class="glyphicon glyphicon-plus"></span>Voir la fiche en magasin</a>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <div id="images-produit" style="display:flex; justify-content: center">
        <?php foreach ($produit_type->images_url as $img_url): ?>
            <img src="<?php echo $img_url ?>" alt="image du produit" style="height:100px; width:auto">
        <?php endforeach; ?>
    </div>
    <div id="info-genereles">
        <table class="table">
            <tr class="row">
                <td class="col-4 font-weight-bold">
                    Nom du produit
                </td>
                <td class="col-8">
                    <?php echo $produit_type->nomProduitType ?>
                </td>
            </tr>

            <tr class="row">
                <td class="col-4 font-weight-bold">
                    Description du produit
                </td>
                <td class="col-8">
                    <?php echo $produit_type->descriptionProduitType ?>
                </td>
            </tr>

            <tr class="row">
                <td class="col-4 font-weight-bold">
                    Catégorie
                </td>
                <td class="col-8">
                    <?php echo mb_ucfirst($produit_type->categ->descriptionCategorie) ?>
                </td>
            </tr>

            <tr class="row">
                <td class="col-4 font-weight-bold">
                    Commerce
                </td>
                <td class="col-8">
                    <a href="<?php echo base_url("/Commerce/" . $produit_type->commerce->siretCommerce) ?>">
                        <?php echo $produit_type->commerce->nomCommerce ?>
                    </a>
                </td>
            </tr>

            <tr class="row">
                <td class="col-4 font-weight-bold">
                    Prix
                </td>
                <td class="col-8">
                    <?php echo $produit_type->prixProduitType ?> €
                </td>
            </tr>

            <tr class="row">
                <td class="col-4">
                    <span class="font-weight-bold">Seuil de stock</span> (Lorsque votre stock devient inférieur à ce seuil, vous recevrez une alerte)
                </td>
                <td class="col-8">
                    <?php echo $produit_type->seuilStockProduitType ?>
                </td>
            </tr>
        </table>
    </div>

    <div id="modifier-produit-type" style="display:flex; justify-content: center">

        <div>
            <a class="btn btn-primary" role="button" href= "<?php echo base_url('Commercant/Produits/modifier_produit_type/' . $produit_type->idProduitType) ?>" style="padding:6px">Modifier les informations générales pour ce produit</a>
        </div>

    </div>

    <div id="liste-variantes" style="margin-top:35px">
        <h3>Liste des variantes pour ce produit</h3>
        <div class="table-responsive">
            <table class="table">
                <thead class="">
                    <tr>
                        <th scope="col"></th> <!--Image de l'objet-->
                        <th scope="col">Désignation</th>
                        <th scope="col">Description</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Stock</th>
                        <th scope="col"></th> <!--Action-->

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($variantes as $v): ?>
                        <tr>
                            <td style="display:flex; justify-content:center; min-width: max-content;" class="td-center" style="">
                                <img src="<?php echo $v->images_url[0] ?>" style="height:80px;width:auto">
                            </td>
                            <td class="td-center">
                                <?php echo $v->nomProduitVariante ?>
                            </td>

                            <td class="td-center">    
                                <?php echo $v->descriptionProduitVariante ?>
                            </td>

                            <td class="td-center">
                                <?php echo $v->prixProduitVariante ?> €
                            </td>

                            <td class="td-center">
                                <?php echo $v->stockProduitVariante ?>
                            </td>
                            <td class="td-center">
                                <a class="icon-fa" href="<?php echo site_url('Commercant/Produits/modifier_produit_variante/' . $v->idProduitVariante) ?>">
                                    <i class="fa fa-pencil-square-o"></i>                             
                                </a>
                                <a class="icon-fa" href="<?php echo site_url('Commercant/Produits/supprimer_produit_variante/' . $v->idProduitVariante) ?>">
                                    <i class="fa fa-trash"></i>                             
                                </a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div id="modifier-produit-type" style="display:flex; justify-content: center">

            <div>
                <a class="btn btn-primary" role="button" href= "<?php echo base_url('Commercant/Produits/ajouter_produit_variante/' . $produit_type->idProduitType) ?>" style="padding:6px">Ajouter une variante</a>
            </div>
        </div>

    </div>
</div>

</div>
