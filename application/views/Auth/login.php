<div id="login">

    <h2>Login</h2>
    <hr/>

    <?php echo form_open('Auth/login_process'); ?>
    <label>Login :</label>
    <input type="text" name="loginUser" id="loginUser" placeholder="username"/><br /><br />

    <label>Password :</label>
    <input type="password" name="passUser" id="passUser" placeholder="**********"/><br/><br />

    <input type="submit" value=" Login " name="submit"/><br />

    <?php echo form_close(); ?>
</div>
<br />

<div> 
    Vous n'avez pas de compte ? <a href="<?php echo site_url('Auth/signup') ?>">Créez-en un !</a>
</div>

