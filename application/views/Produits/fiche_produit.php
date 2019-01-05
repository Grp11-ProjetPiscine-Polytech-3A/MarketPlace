<div id="fiche_produit">


    <h2><?php echo $produit->nomProduitType ?></h2>
    <hr/>


    <div class="row">

        <!--Carroussel pour les images-->
        <div id="carouselExampleIndicators" class="carousel slide my-4 col-lg-5 col-md-5 mb-4" style="background:#CECECE;height: fit-content;" data-ride="carousel">
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

        <div class="col-lg-7 col-md-7 mb-6" style="word-wrap: break-word;">
            <!--Bouton d'ajout au panier-->
            <div id="ajout_panier" class="col-12 container">
                <a class="passer_commande btn btn-primary" href="<?php echo site_url('Panier/ajouter_panier/' . $variante->idProduitVariante) ?>">
                    Ajouter au panier
                </a>
            </div>
            <!-- Info général sur le produit (prix, commerce)-->
            <h5><?php echo $variante->prixProduitVariante ?> €</h5>
            <a href="<?php echo site_url("Commerces/fiche_commerce/" . $produit->commerce->siretCommerce) ?>"><?php echo $produit->commerce->nomCommerce ?></a>
            <!--Choix des variantes-->
            <div id="choix_variante" class="choix-variante">
                <?php foreach ($variantes as $v): ?>
                    <a class="btn <?php ($v->idProduitVariante == $variante->idProduitVariante) ? print 'btn-dark' : print 'btn-secondary' ?> btn-variante" href="<?php echo base_url('/Produits/fiche_produit/' . $produit->idProduitType . '/' . $v->idProduitVariante) ?>">
                        <?php echo $v->nomProduitVariante ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <!--Liste des caractéristiques-->
            <div id="carac" class="col-12 container">
                <h5>Caractéristiques</h5>
                <div id="liste-carac" class="row">
                    <?php foreach ($caracteristiques as $c): ?>
                        <div class="carac col-lg-6">
                            <h6 style="margin-bottom: 0px; margin-top:1px;"><?php echo $c->nomCaracteristique ?></h6>
                            <p class="card-text"><?php echo $c->contenuCaracteristique ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>


        </div>

        <!--Description du produit-->
        <!--Description generale-->
        <div id="description" class="col-12" style="word-wrap: break-word;">
            <div id="description_generale">
                <p class="card-text"><?php echo $produit->descriptionProduitType ?></p>
            </div>

            <hr/>

            <!--Description de la variante-->
            <div id="description_variante">
                <p class="card-text"><?php echo $variante->descriptionProduitVariante ?></p>

            </div>
        </div>





        <!--zone commentaire-->
        <!--<?php //foreach $commentaire ?>-->
        <div id="commentaire" class="media">
            <div>
                <div> <!-- TODO afficher le nom de l'utilisateur qui a posté le commentaire -->
                </div>
                Date: <!-- TODO Afficher la date du commmentaire-->
            </div>
            <div class="media-body">
                <h5 class="mt-0">  <!-- TODO afficher le titre du commentaire--></h5><!--TODO afficher la note du produit averc des étoiles ★ ★ ★ ★ ☆-->
                <p> <!--TODO afficher le corps du commentaire--></p>
            </div>
        </div>
    </div>


</div>
