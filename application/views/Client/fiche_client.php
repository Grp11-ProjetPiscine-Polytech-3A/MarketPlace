<div class="container row">
    <div class="col-12">

        <h4 class="card-title">

            <?php echo $client->nomClient ?>
            <?php echo $client->prenomClient ?>

        </h4>

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



    </div>
</div>
</div>