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

        <div class="col-lg-5 col-md-5 mb-4"> 
            <h5><?php echo $produit->prixProduitType ?> €</h5>
            <p class="card-text"><?php echo $produit->descriptionProduitType ?></p>
        </div>
    </div>

</div>