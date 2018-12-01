<div id="panier">
    <h2>Liste des produits</h2>
    <hr/>

    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th scope="col"></th><!--sert a placer l'image de l'objet-->
            <th scope="col">Désignation</th>
            <th scope="col">Vendeur</th>
            <th scope="col">Prix unitaire</th>
            <th scope="col">Quantité</th>
            <th scope="col">Prix</th>
          </tr>
        </thead>


        <?php foreach ($produits as $p): ?>
          <tbody>
          <td>
            <img src="<?php echo site_url('assets/images/produits/produit_' . $p->idProduitType . '/img1.png') style="height:80px;width:80px"></td>
          <td>
          <a href="<?php echo site_url('/Produits/fiche_produit/' . $p->idProduitType) ?>">
            <<?php echo $p->nomProduitType ?></a></td>
          <td>
            // TODO: nom du vendeur du produit_
          </td>
          <td>
            <?php echo $p->prixProduitType ?></td>
          <td>
            // TODO: gerer la quantité du Panier
          </td>
          <td>
          // TODO: faire une multiplication du produit par la Quantité
          </td>
