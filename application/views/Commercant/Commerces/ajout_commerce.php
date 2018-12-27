<div id="fiche_commerce">
    <h2><?php echo $commerce->nomCommerce ?></h2>
    <hr/>

    <?php echo $commerce->mailCommerce ?>
    <br/>
    <?php echo $commerce->telCommerce ?>
    <br/>
    <?php echo $commerce->numAdresseCommerce ?>
    <?php echo $commerce->rueCommerce ?>
    <br/>

    <?php
    if ($commerce->complementAdresseCommerce)
        echo $commerce->complementAdresseCommerce . '<br/>';
    ?>

    <?php echo $commerce->codePostalCommerce ?>
    <?php echo $commerce->villeCommerce ?>
    <br/>
    <br/>
    <?php echo $commerce->descriptionCommerce ?>
</div>