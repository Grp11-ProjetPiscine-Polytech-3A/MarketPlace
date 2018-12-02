<div id="signup">
    <h2>Sign up to HeroShop</h2>
    <hr/>

    <?php echo form_open('Auth/signup_process'); ?>
    <label>Login :</label>
    <input type="text" name="loginUser" id="loginUser" placeholder="username"/><br /><br />

    <label>Password :</label>
    <input type="password" name="passUser" id="passUser" placeholder="**********"/><br/><br />

    <label>Confirm Password :</label>
    <input type="password" name="confirm_password" id="confirm_password" placeholder="**********"/><br/><br />

    <input type="submit" value=" Sign Up " name="submit"/><br />

    <?php echo form_close(); ?>
</div>
<br />
<div>
    Vous avez déjà  un compte ? <a href="<?php echo site_url('Auth/login') ?>">Connectez-vous !</a>
</div>

