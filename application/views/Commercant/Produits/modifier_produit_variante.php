<div class="container">
    <div class="product-form">
        <div class="main-div">
            <div class="panel">
                <h3>Modifier la variante - <?php echo $produitType->nomProduitType . ' - ' . $produitVariante->nomProduitVariante ?></h3>
                <hr>
            </div>
            <?php echo form_open_multipart('Commercant/Produits/modifier_produit_variante_process/' . $produitVariante->idProduitVariante); ?>

            <div class="form-group">
                <label for="inputNom">Nom de la variante :</label>
                <input class="form-control" name="nomProduit" id="inputNom" placeholder="" value="<?php echo (set_value('nomProduit')) ? set_value('nomProduit') : $produitVariante->nomProduitVariante ?>">
            </div>

            <div class="form-group">
                <label for="inputPrix">Prix (€) :</label>
                <input class="form-control" name="prix" id="inputPrix" placeholder="" value="<?php echo (set_value('prix')) ? set_value('prix') : $produitVariante->prixProduitVariante ?>">
            </div>

            <div class="form-group">
                <label for="stock">Stock :</label>
                <input type="number" class="form-control" name="stock" id="stock" min="0" placeholder="" value="<?php echo (set_value('stock')) ? set_value('stock') : $produitVariante->stockProduitVariante ?>">
            </div>
            <div class="form-group">
                <label for="description">Description du produit :</label>
                <textarea type="text" class="form-control" name="description" id="inputCaract" placeholder="" rows="10"><?php echo (set_value('description')) ? set_value('description') : $produitVariante->descriptionProduitVariante ?></textarea>
            </div>


            <div id="ajout image">
                <label for="Image">Images</label>
                <br />
                <div id="images" class="row" style="display:flex; justify-content: center">
                    <?php foreach ($produitVariante->images_url as $img): ?>
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
                    <?php foreach ($produitVariante->caracteristiques as $c): ?>
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


            <button type="submit" class="btn btn-primary">Modifier la variante</button>

            <?php echo form_close(); ?>
        </div>

    </div>
</div>

<script>
    var carac_array = <?php print(json_encode($caracteristiques)) ?>
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/Commercant/Produits/gestions_champs_form.js') ?>"></script>