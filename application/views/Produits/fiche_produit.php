<div id="fiche_produit">


    <h2><?php echo $produit->nomProduitType ?></h2>
    <hr/>


    <div class="row">

        <!--Carroussel pour les images-->
        <div id="carouselExampleIndicators" class="carousel slide my-4 col-lg-5 col-md-5 mb-4" style="background:#CECECE;" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <?php
                for ($i = 1; $i < count($images); $i++) {
                    echo '<li data-target="#carouselExampleIndicators" data-slide-to="' . $i . '"></li>';
                }
                ?>
            </ol>
            <div class="carousel-inner" role="listbox">
                <?php $active = "active"; ?>
                <?php foreach ($images as $img): ?>
                    <div class="carousel-item <?php echo $active ?>">
                        <img class="d-block img-fluid" src="<?php echo $img ?>">
                    </div>

                    <?php $active = "" ?>
                <?php endforeach; ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <!--endCarroussel-->

        <!--Description du produit-->
        <div class="col-lg-7 col-md-7 mb-6"> 
            <!--Choix des variantes-->
            <div id="choix_variante">
                <?php foreach ($variantes as $v): ?>
                    <a class="btn btn-secondary choix-variante" href="<?php echo base_url('/Produits/fiche_produit/' . $produit->idProduitType . '/' . $v->idProduitVariante) ?>">
                        <?php echo $v->nomProduitVariante ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <!--Description generale-->
            <div id="description_generale">
                <h5><?php echo $variante->prixProduitVariante ?> €</h5>
                <a href="<?php echo site_url("Commerces/fiche_commerce/" . $produit->commerce->siretCommerce) ?>"><?php echo $produit->commerce->nomCommerce ?></a>
                <p class="card-text"><?php echo $produit->descriptionProduitType ?></p>
            </div>

            <hr/>

            <!--Description de la variante-->
            <div id="description_variante">
                <p class="card-text"><?php echo $variante->descriptionProduitVariante ?></p>

            </div>

        </div>


        <!--Liste des caractéristiques-->
        <div id="carac" class="col-12">
            <h3>Caractéristiques</h3>
            <?php foreach ($caracteristiques as $c): ?>
                <h6><?php echo $c->nomCaracteristique ?></h6>
                <p class="card-text"><?php echo $c->contenuCaracteristique ?></p>
            <?php endforeach; ?>
        </div>

        <!--Bouton d'ajout au panier-->
        <div id="ajout_panier" class="col-12">
            <a class="passer_commande btn btn-primary" href="<?php echo site_url('Panier/ajouter_panier/' . $variante->idProduitVariante) ?>">
                Ajouter au panier
            </a>
        </div>

    </div>



</div>