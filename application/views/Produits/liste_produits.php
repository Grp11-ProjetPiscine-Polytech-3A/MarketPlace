<div id="liste_produits">

    <div class="row">
        <?php if(isset($produits)): ?>
            <?php foreach ($produits as $p): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a  class="border-bottom" href="<?php echo site_url('/Produits/fiche_produit/' . $p->idProduitType) ?>" style="display:flex; justify-content: center">
                            <img class="card-img-top" src="<?php echo $p->img_url ?>" alt="<?php echo $p->nomProduitType ?>" style="height:300px; width: auto;">
                        </a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="<?php echo site_url('/Produits/fiche_produit/' . $p->idProduitType) ?>">
                                    <?php echo $p->nomProduitType ?>
                                </a>
                            </h4>
                            <h5><?php echo $p->prixProduitType ?> €</h5>
                            <p class="card-text"><?php echo $p->descriptionProduitType ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>


</div>
