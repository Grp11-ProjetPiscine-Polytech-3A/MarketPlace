<div id="liste_commerces">

    <h2>Liste des commerces</h2>
    <hr/>

    <div class="row">

        <?php foreach ($commerces as $c): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="<?php echo site_url('/Commerces/fiche_commerce/' . $c->siretCommerce) ?>">
                                <?php echo $c->nomCommerce ?>
                            </a>                          
                        </h4>
                        <p class="card-text">
                            <?php echo $c->mailCommerce ?>
                            <br/>
                            <?php echo $c->telCommerce ?>
                            <br/>
                            <?php echo $c->numAdresseCommerce ?>
                            <?php echo $c->rueCommerce ?>
                            <br/>

                            <?php
                            if ($c->complementAdresseCommerce)
                                echo $c->complementAdresseCommerce . '<br/>';
                            ?>

                            <?php echo $c->codePostalCommerce ?>
                            <?php echo $c->villeCommerce ?>
                        </p>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>


</div>


