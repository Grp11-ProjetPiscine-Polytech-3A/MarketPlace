<div id="login">

    <h2>Login</h2>
    <hr/>

    <?php echo form_open('Auth/login_process'); ?>

    <div class="form-group row">
        <div class="col-2">
            <label>Nom d'utilisateur</label>
        </div>
        <div class="col-9">
            <input type="text" name="loginUser" id="loginUser" placeholder="username" size="30"/>
        </div>
    </div>


    <div class="form-group row">
        <div class="col-2">
            <label>Mot de passe</label>
        </div>
        <div class="col-9">
            <input type="password" name="passUser" id="passUser" placeholder="**********" size="30"/>
        </div>
    </div>


    <input type="submit" value=" Login " name="submit"/><br />

    <?php echo form_close(); ?>
</div>
<br />

<div> 
    Vous n'avez pas de compte ? <a href="<?php echo site_url('Auth/signup') ?>">Créez-en un !</a>
</div>

