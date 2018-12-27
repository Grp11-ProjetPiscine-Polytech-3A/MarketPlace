<div id="liste_produit_commercant">
    <h2>Liste des produits</h2>
    <hr/>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"></th> <!--Image de l'objet-->
                    <th scope="col">Désignation</th>
                    <th scope="col">Commerce</th>
                    <th scope="col">Prix</th>
                    <th scope="col"></th> <!--Action-->

                </tr>
            </thead>
            <tbody>

                <?php foreach ($produits as $p): ?>
                    <tr>
                        <td style = "display:flex; justify-content:center">
                            <a href="<?php echo site_url('Commercant/Produits/fiche_produit_type/' . $p->idProduitType) ?>">
                                <img src="<?php echo $p->image_url ?>" style="height:80px;width:auto">
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo site_url('Commercant/Produits/fiche_produit_type/' . $p->idProduitType) ?>">
                                <?php echo $p->nomProduitType ?>
                            </a>
                        </td>
                        <td>    
                            <?php echo $p->nomCommerce ?>
                        </td>
                        <td>
                            <?php echo $p->prixProduitType ?> €
                        </td>
                        <td>
                            <a class="icon-fa" href="<?php echo site_url('Commercant/Produits/fiche_produit_type/' . $p->idProduitType) ?>">
                                <i class="fa fa-pencil-square-o"></i>                             
                            </a>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>