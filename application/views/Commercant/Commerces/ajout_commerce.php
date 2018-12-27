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
                <input type="number" class="form-control" name="siretCommerce" id="siretCommerce" placeholder="" value="<?php echo set_value('siretCommerce') ?>">
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
                <input type="number" class="form-control" name="telCommerce" id="inputTel" placeholder="" value="<?php echo set_value('telCommerce') ?>">
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
                <input type="number" class="form-control" name="codePostalCommerce" id="inputCodePostal" placeholder="" value="<?php echo set_value('codePostalCommerce') ?>">
            </div>
            <div class="form-group">
                <label for="inputVille">Ville :</label>
                <input type="text" class="form-control" name="villeCommerce" id="inputVille" placeholder="" value="<?php echo set_value('villeCommerce') ?>">
            </div>
            <div class="form-group">
                <label for="inputComplementAdresse">Complément d'adresse :</label>
                <input type="text" class="form-control" name="complementAdresseCommerce" id="inputComplementAdresse" placeholder="" value="<?php echo set_value('complementAdresseCommerce') ?>">
            </div>
            

            

            <hr />
            <div id="carac">
                <h5>Caractéristiques</h3>
                    <div id="add_carac_button" class="btn btn-secondary">
                        Ajouter une caractéristique
                    </div>
                    <br/>
            </div>
            <hr />


            <button type="submit" class="btn btn-primary">Ajouter le produit</button>

            <?php echo form_close(); ?>
        </div>

    </div>
</div>

<script>
    var carac_array = <?php print(json_encode($caracteristiques)) ?>

    $("#add_carac_button").click(add_carac_field)

    function add_carac_field() {
        var select_carac = document.createElement("select")
        select_carac.className = "form-control col-3"
        select_carac.name = "carac[]"

        for (var idcarac in carac_array) {
            var opt = document.createElement("option")
            opt.value = idcarac;
            opt.innerHTML = carac_array[idcarac];
            select_carac.append(opt)
        }

        var textarea_carac = document.createElement("textarea")
        textarea_carac.name = "carac_text[]"
        textarea_carac.className = "form-control col-12"

        var div_carac = document.createElement("div")
        div_carac.className = "carac"
        div_carac.append("Sélectionner la caractéristique : ")
        div_carac.append(select_carac)
        div_carac.append("Contenu : ")
        div_carac.append(textarea_carac)

        $("#carac").append("<br/>")
        $("#carac").append(div_carac)
    }
</script>