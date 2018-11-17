<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <div id="main">
            <div id="logged">
                Bienvenue <?php echo $username ?> !
                <a href="<?php echo site_url('Auth/logout') ?>"> Logout </a>
            </div>
        </div>
    </body>
</html>
