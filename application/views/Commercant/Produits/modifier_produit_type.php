<div class="container">
    <div class="product-form">
        <div class="main-div">
            <div class="panel">
                <h3>Modifier le produit - <?php echo $produit_type->nomProduitType ?></h3>
                <hr>
            </div>
            <?php echo form_open_multipart('Commercant/Produits/modifier_produit_type_process/' . $produit_type->idProduitType); ?>
            <div class="form-group">
                <label for="Commerce">Commerce :</label>
                <select class="form-control" name="commerce" id="commerce" required="true">
                    <?php foreach ($commerces as $c): ?>
                        <option value="<?php echo $c->siretCommerce ?>" <?php (set_value('commerce') == $c->siretCommerce) ? print "selected" : ($produit_type->commerce->siretCommerce == $c->siretCommerce) ? print "selected" : print ""; ?>> 
                            <?php echo $c->nomCommerce ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="inputNom">Nom du produit :</label>
                <input class="form-control" name="nomProduit" id="inputNom" placeholder="" value="<?php echo (set_value('nomProduit')) ? set_value('nomProduit') : $produit_type->nomProduitType ?>">
            </div>
            <div class="form-group">
                <label for="Categorie">Catégorie :</label>
                <select class="form-control" name="categorie" id="cat">
                    <?php if (!$produit_type->categ->idCategorie): ?>
                        <option value=""></option>
                    <?php endif; ?>

                    <?php foreach ($categories as $c): ?>
                        <option value="<?php echo $c->idCategorie ?>" <?php echo (set_value('categorie') == $c->idCategorie) ? "selected" : ($produit_type->categ->idCategorie == $c->idCategorie) ? "selected" : ""; ?>>
                            <?php echo mb_ucfirst($c->descriptionCategorie) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="seuil">Seuil de stock :</label>
                <input type="number" class="form-control" name="seuil" id="seuil" min="0" placeholder="" value="<?php echo (set_value('seuil')) ? set_value("seuil") : $produit_type->seuilStockProduitType ?>">
            </div>
            <div class="form-group">
                <label for="description">Description du produit :</label>
                <textarea type="text" class="form-control" name="description" id="inputCaract" placeholder="" rows="10"><?php echo (set_value('description')) ? set_value('description') : $produit_type->descriptionProduitType ?></textarea>
            </div>

            <div id="ajout image">
                <label for="Image">Images</label>
                <br />
                <div id="images" class="row" style="display:flex; justify-content: center">
                    <?php foreach ($produit_type->images_url as $img): ?>
                        <img class="col" src="<?php echo $img ?>" style="max-height: 100px;width: auto;max-width: 100%;flex-grow:0">
                    <?php endforeach; ?>
                </div>
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
                    <?php foreach ($produit_type->caracteristiques as $c): ?>
                        <br/>
                        <div class="carac">
                            Sélectionner la caractéristique :
                            <select class="form-control col-3" name="carac[]">
                                <?php foreach ($caracteristiques as $idcarac => $carac): ?>
                                    <option value="<?php echo $idcarac ?>" <?php echo ($c->idCaracteristique == $idcarac) ? "selected" : ""; ?>>
                                        <?php echo $carac ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            Contenu : 
                            <textarea name="carac_text[]" class="form-control col-12"><?php print $c->contenuCaracteristique ?></textarea>
                        </div>
                    <?php endforeach; ?>

            </div>
            <hr />

            <button type="submit" class="btn btn-primary">Modifier le produit</button>

            <?php echo form_close(); ?>
        </div>

    </div>
</div>

<script>
   var carac_array = <?php print(json_encode($caracteristiques)) ?>
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/Commercant/Produits/gestions_champs_form.js')?>"></script>