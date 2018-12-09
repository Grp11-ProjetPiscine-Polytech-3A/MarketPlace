
<div class="container">
  <div class="product-form">
    <div class="main-div">
      <div class="panel">
        <h3>Ajouter un produit</h3>
      </div>
      <form id="Product">
        <div class="form-group">
          <input class="form-control" id="inputNom" placeholder="Nom">
        </div>
        <div class="form-group">
          <label for="Categorie">Catégorie :</label>
          <select class="form-control" id="cat" required="true" name="categorie">
            <?php foreach ($categories as $c): ?>
              <option value="<?php echo $c->descriptionCategorie ?>"> <?php echo $c->descriptionCategorie ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <input class="form-control" id="inputPrix" placeholder="Prix">
        </div>

        <div class="form-group">
          <input type="number" class="form-control" id="inputQté" min="0" placeholder="Quantité">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="inputCaract" placeholder="Caractéristiques">
        </div>

        <div id ="ajout image">
          <label for="Image">Image</label>
          <br />
          <?php echo $error;?>
          <?php echo form_open_multipart('upload/do_upload');?>
          <input type="file" name="userfile" size="20" />
        </div>
        <hr />

        <button type="submit" class="btn btn-primary">Ajouter</button>

      </form>
    </div>

  </div>
</div>