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

        <!-- Custom styles for this template -->
        <link href="<?php echo base_url('assets/css/shop-homepage.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/main.css'); ?>" />

        <?php foreach ($css as $url): ?>
            <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $url; ?>" />
        <?php endforeach; ?>



    </head>

    <body>
        <!-- Navigation -->
        
        <div class="navbar-dark bg-dark top-navbar">
            <!--TopMenu-->
            <div id="topMenu" class="container">
                <div class="row">                        
                    <div class="col-md-12 right-nav">

                        <a href="<?php echo($topMenu['Auth']['url']); ?>">
                            <div id="connexion-menu" class="top-menu">
                                <i class="fa fa-user"></i>
                                <?php echo($topMenu['Auth']['intitule']); ?>
                            </div>
                        </a>
                        <a href="<?php echo($topMenu['Panier']['url']); ?>">
                            <div id="panier-menu" class="top-menu">
                                <i class="fa fa-shopping-cart"></i>
                                <?php echo($topMenu['Panier']['intitule']); ?>
                            </div>
                        </a>

                        <?php foreach ($topMenu as $m): ?>
                            <?php if ($m['url'] != site_url("Auth/") && $m['intitule'] != 'Panier'): ?>
                                <a href="<?php echo($m['url']); ?>">
                                    <div id="panier-menu" class="top-menu">
                                        <?php echo($m['intitule']); ?>
                                    </div>
                                </a>
                            <?php endif; ?>

                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
            
            <!--Menu-->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

                <div class="container">
                    <a class="navbar-brand" href="<?php echo site_url('') ?>">HeroShop</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto">

                            <?php foreach ($menu as $m): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php ($m['actif']) ? print 'active' : print '' ?>" href="<?php echo $m["url"] ?>">
                                        <?php echo $m["intitule"] ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Page Content -->
        <div class="container main-content">

            <div class="row">

                <div class="col-lg-3">

                    <!--TODO : chapger le side menu selon php input dans layout --> 

                    <h1 class="my-4">Shop Name</h1>
                    <div class="list-group">
                        <a href="#" class="list-group-item">Category 1</a>
                        <a href="#" class="list-group-item">Category 2</a>
                        <a href="#" class="list-group-item">Category 3</a>
                    </div>

                </div>
                <!-- /.col-lg-3 -->

                <div class="col-lg-9">

                    <div id="contenu">
                        <?php echo $output; ?>
                    </div>


                </div>
                <!-- /.col-lg-9 -->

            </div>
            <!-- /.row -->

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
