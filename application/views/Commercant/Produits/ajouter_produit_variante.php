<div class="container">
    <div class="product-form">
        <div class="main-div">
            <div class="panel">
                <h3>Ajouter une variante - <?php echo $produit_type->nomProduitType ?></h3>
                <hr>
            </div>
            <?php echo form_open_multipart('Commercant/Produits/ajouter_produit_variante_process/' . $produit_type->idProduitType); ?>

            <div class="form-group">
                <label for="inputNom">Nom de la variante :</label>
                <input class="form-control" name="nomProduit" id="inputNom" placeholder="" value="<?php echo set_value('nomProduit') ?>">
            </div>

            <div class="form-group">
                <label for="inputPrix">Prix (€) :</label>
                <input class="form-control" name="prix" id="inputPrix" placeholder="" value="<?php echo set_value('prix') ?>">
            </div>

            <div class="form-group">
                <label for="stock">Stock :</label>
                <input type="number" class="form-control" name="stock" id="stock" min="0" placeholder="" value="<?php echo set_value('stock') ?>">
            </div>
            <div class="form-group">
                <label for="description">Description du produit :</label>
                <textarea type="text" class="form-control" name="description" id="inputCaract" placeholder="" rows="10"><?php echo set_value('description') ?></textarea>
            </div>

            <div id="ajout image">
                <label for="Image">Images de la variante</label>
                <br />
                <div id="input-img">
                    <div id="add_img_button" class="btn btn-secondary">
                        Ajouter une image
                    </div>
                    </br>

                </div>
            </div>

            <hr />
            <div id="carac">
                <h5>Caractéristiques de la variante</h3>
                    <div id="add_carac_button" class="btn btn-secondary">
                        Ajouter une caractéristique
                    </div>
                    <br/>
            </div>
            <hr />


            <button type="submit" class="btn btn-primary">Ajouter la variante au produit</button>

            <?php echo form_close(); ?>
        </div>

    </div>
</div>

<script>
    var carac_array = <?php print(json_encode($caracteristiques)) ?>
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/Commercant/Produits/gestions_champs_form.js') ?>"></script>