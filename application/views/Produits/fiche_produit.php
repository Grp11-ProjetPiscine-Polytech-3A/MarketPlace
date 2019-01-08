<div id="fiche_produit">

    <?php if (isset($produit)): ?>
    <h2><?php echo mb_ucfirst($produit->nomProduitType) ?></h2>
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


                <!--Choix des variantes-->
                <div id="choix_variante" class="choix-variante">
                    <?php foreach ($variantes as $v): ?>
                        <a class="btn <?php ($v->idProduitVariante == $variante->idProduitVariante) ? print 'btn-dark' : print 'btn-secondary' ?> btn-variante" href="<?php echo base_url('/Produits/fiche_produit/' . $produit->idProduitType . '/' . $v->idProduitVariante) ?>">
                            <?php echo mb_ucfirst($v->nomProduitVariante) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
                <!-- Infos générales sur le produit (prix, commerce)-->
                <div class="col-12 mb-2">
                    <h5><?php echo $variante->prixProduitVariante ?> €</h5>
                    <a href="<?php echo site_url("Commerces/fiche_commerce/" . $produit->commerce->siretCommerce) ?>"><?php echo $produit->commerce->nomCommerce ?></a>
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

            <!--Bouton d'ajout au panier-->
            <div id="ajout_panier" class="col-12 container mb-4 mt-2">
                <a class="passer_commande btn btn-primary" href="<?php echo site_url('Panier/ajouter_panier/' . $variante->idProduitVariante) ?>">
                    Ajouter au panier
                </a>
            </div>

            <!--Description du produit-->
            <!--Description generale-->
            <div id="description" class="col-12" style="word-wrap: break-word;">
                <div id="description_generale">
                    <h5>Description :</h5>
                    <p class="card-text"><?php echo mb_ucfirst($produit->descriptionProduitType) ?></p>
                </div>

                <br/>

                <!--Description de la variante-->
                <div id="description_variante">
                    <p class="card-text"><?php echo mb_ucfirst($variante->descriptionProduitVariante) ?></p>
                </div>

                <hr/>
            </div>







            <!--zone commentaire-->
            <div class="container">
                <h5>Commentaires :</h5>
                <div class="row">
                    <div class="col-12">
                        <?php echo form_open('/Produits/ajouter_commentaire/'.$variante->idProduitType . '/' . $variante->idProduitVariante . '/'); ?>
                            <!-- Partie Commentaire-->
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-3 col-lg-2 hidden-xs">
                                        <img class="img-responsive" src="<?php echo site_url('/assets/images/website/comments.png') ?>" alt="">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-9 col-lg-10">
                                        <textarea class="form-control" id="message" name ="comment" placeholder="Votre avis sur ce produit" rows="3" required></textarea>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Partie Note -->
                            <div class="form-group" id="rating-ability-wrapper">
                                <label class="control-label" for="rating">
                                    <span class="field-label-info"></span>
                                    <input type="hidden" id="selected_rating" name="note" value="" required="required">
                                </label>
                                <h4 class="bold rating-header" style="">
                                    <span>Votre note :</span>
                                    <span class="selected-rating">0</span> / 5
                                </h4>
                                <button type="button" class="btnrating btn btn-default btn-sm" data-attr="1" id="rating-star-1">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating btn btn-default btn-sm" data-attr="2" id="rating-star-2">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating btn btn-default btn-sm" data-attr="3" id="rating-star-3">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating btn btn-default btn-sm" data-attr="4" id="rating-star-4">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating btn btn-default btn-sm" data-attr="5" id="rating-star-5">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                            </div>
                            <button type="submit" class="btn btn-normal pull-right">Envoyer</button>
                        </form>
                    </div>

                </div>

                <!-- Liste des commentaires-->
                <div class="row">
                    <?php foreach ($commentaire as $aComment): ?>
                        <div class="col-sm-5">
                            <div class="panel panel-default">
                                <div class="panel">
                                    <strong><?php echo $aComment->loginUser ?></strong>
                                    <!-- OPT afficher le nombre de jour écoulé depuis le commentaire -->
                                    <!--span class="text-muted">Commenté il y a 5 jours</span-->
                                </div>
                                <div class = "panel-body">

                                    <!-- Affichage des étoile de la note pleines -->
                                    <?php for ($i = 1; $i <= $aComment->note; $i++): ?>
                                        <i class="fa fa-star"></i>
                                    <?php endfor; ?>

                                    <!-- Affichage des étoile de la note vides -->
                                    <?php for ($i = $aComment->note; $i < 5; $i++): ?>
                                        <i class="fa fa-star-o"></i>
                                    <?php endfor; ?>

                                </div>
                                <div class="panel-body">
                                    <p><?php echo $aComment->commentaire ?></p>
                                </div><!-- /panel-body -->
                            </div><!-- /panel panel-default -->
                        </div><!-- /col-sm-5 -->
                    <?php endforeach; ?>
                </div><!-- /row -->

            </div><!-- /container -->
        </div>
    <?php endif; ?>
</div>
