<?php
if (isset($message_display))
    echo "<div class='message_display'>" . $message_display . "</div>";
?>

<div id="signup">
    <?php
    if (isset($error_message))
        echo "<div class='error_msg'>" . $error_message . "</div>";
    ?>

    <h2>Sign up to HéroShop</h2>
    <hr/>

    <?php echo form_open('Auth/user_signup'); ?>
    <label>Login :</label>
    <input type="text" name="loginUser" id="loginUser" placeholder="username"/><br /><br />

    <label>Password :</label>
    <input type="password" name="passUser" id="passUser" placeholder="**********"/><br/><br />

    <input type="submit" value=" Login " name="submit"/><br />

    <?php echo form_close(); ?>
</div>

