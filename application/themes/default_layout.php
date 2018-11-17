<!DOCTYPE html>
<html lang="en">
    <!-- Fichier test pour la partie Theme du projet-->
    <head>

        <!-- Permet l'affichage des caractères dans le bon encodage -->
        <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Best Pool Group">

        <!-- Affiche le titre composé du nom de la méthode et du nom du contrôleur -->
        <title><?php echo $titre; ?></title>

        <!-- Bootstrap core CSS
             Old one
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
        -->

        <?php foreach ($css as $url): ?>
            <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $url; ?>" />
        <?php endforeach; ?>

        <!-- Custom styles for this template -->
        <link href="<?php echo base_url('assets/css/shop-homepage.css'); ?>" rel="stylesheet">

    </head>

    <body>
        <div id="contenu">
            <?php echo $output; ?>
        </div>
        <!-- Footer -->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; HéroShop 2018</p>
            </div>
            <!-- /.container -->
        </footer>

        <!-- Bootstrap core JavaScript 
        <script src="<?php echo base_url('assets/jquery/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
        Old Ones
        -->
        <?php foreach ($js as $url): ?>
            <script type="text/javascript" src="<?php echo $url; ?>"></script> 
        <?php endforeach; ?>

    </body>

</html>
