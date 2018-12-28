<div class="container">
    <div class="product-form">
        <div class="main-div">
            <div class="panel">
                <h3>Ajouter un produit</h3>
                <hr>
            </div>
            <?php echo form_open_multipart('Commercant/Produits/ajout_produit_process'); ?>
            <div class="form-group">
                <label for="Commerce">Commerce :</label>
                <select class="form-control" name="commerce" id="commerce" required="true">
                    <?php foreach ($commerces as $c): ?>
                        <option value="<?php echo $c->siretCommerce ?>" <?php (set_value('commerce') == $c->siretCommerce) ? "selected" : ""; ?>> 
                            <?php echo $c->nomCommerce ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="inputNom">Nom du produit :</label>
                <input class="form-control" name="nomProduit" id="inputNom" placeholder="" value="<?php echo set_value('nomProduit') ?>">
            </div>
            <div class="form-group">
                <label for="Categorie">Catégorie :</label>
                <select class="form-control" name="categorie" id="cat">
                    <option value=""></option>
                    <?php foreach ($categories as $c): ?>
                        <option value="<?php echo $c->idCategorie ?>" <?php (set_value('categorie') == $c->idCategorie) ? "selected" : ""; ?>>
                            <?php echo $c->descriptionCategorie ?>
                        </option>
                    <?php endforeach; ?>
                </select>
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
                <label for="seuil">Seuil :</label>
                <input type="number" class="form-control" name="seuil" id="seuil" min="0" placeholder="" value="<?php echo set_value('stock') ?>">
            </div>
            <div class="form-group">
                <label for="description">Description du produit :</label>
                <textarea type="text" class="form-control" name="description" id="inputCaract" placeholder="" rows="10"><?php echo set_value('description') ?></textarea>
            </div>

            <div id="ajout image">
                <label for="Image">Images</label>
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
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/Commercant/Produits/gestions_champs_form.js') ?>"></script>