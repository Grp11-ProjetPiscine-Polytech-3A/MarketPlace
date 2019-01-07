<div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
        <div class="card-body">
            <h4 class="card-title">

                    <?php echo $client->nomClient ?>
                    <?php echo $client->prenomClient ?>

            </h4>
            <p class="card-text">
                <?php echo $client->mailClient ?>
                <br/>
                <?php echo $client->telClient ?>
                <br/>
                <?php echo $client->numAdresseClient ?>
                <?php echo $client->rueClient ?>
                <br/>
                <?php
                if ($client->complementAdresseCommerce)
                    echo $client->complementAdresseCommerce . '<br/>';
                ?>
                <?php echo $client->codePostalClient ?>
                <?php echo $client->villeClient ?>


            </p>
        </div>
    </div>
</div>
