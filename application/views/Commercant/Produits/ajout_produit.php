
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
          <label for="Country">Catégorie :</label>
          <select class="form-control" id="cat" required="true" name="categorie">
            <option value="V">Vêtement</option>
            <option value="A">Alimentaire</option>
            <option value="E">Enfant</option>
            <option value="L">Livre</option>
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
        <div class="form-group">
          <input class="form-control" id="inputImage" placeholder="Ajouter image">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
      </form>
    </div>

  </div>
</div>