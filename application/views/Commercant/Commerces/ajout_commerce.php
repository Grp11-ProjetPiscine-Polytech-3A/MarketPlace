<div class="container">
    <div class="commerce-form">
        <div class="main-div">
            <div class="panel">
                <h3>Ajouter un commerce</h3>
                <hr>
            </div>
            <?php echo form_open_multipart('Commercant/Commerces/ajout_commerce_process'); ?>
            <div class="form-group">
                <label for="inputSiret">Siret du Commerce :</label>
                <input class="form-control" name="siretCommerce" id="siretCommerce" placeholder="" value="<?php echo set_value('siretCommerce') ?>">
            </div>
            <div class="form-group">
                <label for="inputNom">Nom du commerce :</label>
                <input type="text" class="form-control" name="nomCommerce" id="inputNom" placeholder="" value="<?php echo set_value('nomCommerce') ?>">
            </div>
            <div class="form-group">
                <label for="inputMail">Mail :</label>
                <input type="text" class="form-control" name="mailCommerce" id="inputMail" placeholder="" value="<?php echo set_value('MailCommerce') ?>">
            </div>

            <div class="form-group">
                <label for="inputTel">Numéro de téléphone :</label>
                <input class="form-control" name="telCommerce" id="inputTel" placeholder="" value="<?php echo set_value('telCommerce') ?>">
            </div>

            <div class="form-group">
                <label for="inputNumAdresse">Numéro d'adresse :</label>
                <input type="number" class="form-control" name="numAdresseCommerce" id="inputNumAdresse" min="0" placeholder="" value="<?php echo set_value('numAdresseCommerce') ?>">
            </div>
            <div class="form-group">
                <label for="inputRue">Adresse (rue) :</label>
                <input type="text" class="form-control" name="rueCommerce" id="inputRue" placeholder="" value="<?php echo set_value('rueCommerce') ?>">
            </div>
            <div class="form-group">
                <label for="inputCodePostal">Code Postal :</label>
                <input class="form-control" name="codePostalCommerce" id="inputCodePostal" placeholder="" value="<?php echo set_value('codePostalCommerce') ?>">
            </div>
            <div class="form-group">
                <label for="inputVille">Ville :</label>
                <input type="text" class="form-control" name="villeCommerce" id="inputVille" placeholder="" value="<?php echo set_value('villeCommerce') ?>">
            </div>
            <div class="form-group">
                <label for="inputComplementAdresse">Complément d'adresse :</label>
                <input type="text" class="form-control" name="complementAdresseCommerce" id="inputComplementAdresse" placeholder="" value="<?php echo set_value('complementAdresseCommerce') ?>">
            </div>
            <div class="form-group">
                <label for="inputTempsReservation">Temps de réservation maximum pour les produits :</label>
                <input type="time" class="form-control" name="tempsReservationProduitsCommerce" id="inputTempsReservation" placeholder="" value="<?php echo set_value('tempsReservationProduitsCommerce') ?>">
            </div>
            <div class="form-group">
                <label for="inputLivrable">Possibilité de livraison des produits :</label>
                <select class="form-control" name="livrable" id="inputLivrable">
                    <option value=""></option>
                    <option value="Oui">Oui</option>
                    <option value="Non">Non</option>
                </select>
            </div>
       
            <button type="submit" class="btn btn-primary">Ajouter le commerce</button>

            <?php echo form_close(); ?>
        </div>

    </div>
</div>
