<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <div id="main">
            <?php
            if (isset($message_display))
                echo "<div class='message_display'>" . $message_display . "</div>";
            ?>

            <div id="login">
                <?php
                if (isset($error_message))
                    echo "<div class='error_msg'>" . $error_message . "</div>";
                ?>
                
                <h2>Login</h2>
                <hr/>

                <?php echo form_open('Auth/user_login'); ?>
                <label>Login :</label>
                <input type="text" name="loginUser" id="loginUser" placeholder="username"/><br /><br />
                
                <label>Password :</label>
                <input type="password" name="passUser" id="passUser" placeholder="**********"/><br/><br />
                
                <input type="submit" value=" Login " name="submit"/><br />
                
                <?php echo form_close(); ?>
            </div>
        </div>
    </body>
</html>
