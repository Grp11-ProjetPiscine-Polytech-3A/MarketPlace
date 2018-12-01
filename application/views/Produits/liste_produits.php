<div id="liste_produits">

    <h2>Liste des produits</h2>
    <hr/>

    <div class="row">

        <?php foreach ($produits as $p): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a  class="border-bottom" href="<?php echo site_url('/Produits/fiche_produit/' . $p->idProduitType) ?>">
                        <img class="card-img-top" src="<?php echo site_url('assets/images/produits/produit_' . $p->idProduitType . '/img1.png') ?>" alt="<?php echo $p->nomProduitType ?>" style="height:300px">
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
                    <!--                    <div class="card-footer">
                                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                                        </div>-->
                </div>
            </div>

        <?php endforeach; ?>

    </div>


</div>
