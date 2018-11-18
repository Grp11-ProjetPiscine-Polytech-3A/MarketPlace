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

        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/main.css'); ?>" />

        <?php foreach ($css as $url): ?>
            <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $url; ?>" />
        <?php endforeach; ?>

        <!-- Custom styles for this template -->
        <link href="<?php echo base_url('assets/css/shop-homepage.css'); ?>" rel="stylesheet">

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="<?php echo site_url('')?>">HeroShop</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?php echo site_url('')?>">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('Produits/') ?>">Liste des Produits</a>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('Auth/') ?>">Authentification</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container">
            <div id="contenu">
                <?php echo $output; ?>
            </div>
        </div>
        
        
        <!-- Footer -->
        <footer class="py-5 bg-dark footer">
                <div class="container">
                    <p class="m-0 text-center text-white">Copyright &copy; HeroShop 2018</p>
                </div>
            <!-- /.container -->
        </footer>

        <!-- Bootstrap core JavaScript -->
        <script src="<?php echo base_url('assets/jquery/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>

        <?php foreach ($js as $url): ?>
            <script type="text/javascript" src="<?php echo $url; ?>"></script> 
        <?php endforeach; ?>

    </body>

</html>
