<div id="fiche_produit">
    
    <h2><?php echo $produit->nomProduitType ?></h2>
    <hr/>
    <div class="row">
        <img class="card-img-top col-lg-7 col-md-7 mb-4" src="<?php echo site_url('assets/images/produits/produit_' . $produit->idProduitType . '/img1.png') ?>" alt="<?php echo $produit->nomProduitType ?>">
        <div class="col-lg-5 col-md-5 mb-4"> 
            <h5><?php echo $produit->prixProduitType ?> €</h5>
            <p class="card-text"><?php echo $produit->decriptionProduitType ?></p>
        </div>
    </div>

</div>