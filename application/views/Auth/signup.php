<div id="signup" class="container">
    <h2>Sign up to HeroShop</h2>
    <hr/>

    <?php echo form_open('Auth/signup_process'); ?>

    <div class="form-group row">
        <div class="col-3">
            <label>Nom d'utilisateur :</label>
        </div>
        <div class="col-9">
            <input type="text" name="loginUser" id="loginUser" placeholder="JeanDupont" size="30"/>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-3">
            <label>Mot de passe :</label>
        </div>
        <div class="col-9">
            <input type="password" name="passUser" id="passUser" placeholder="**********" size="30"/>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-3">
            <label>Confirmer le mot de passe :</label>
        </div>
        <div class="col-9">
            <input type="password" name="confirm_password" id="confirm_password" placeholder="**********" size="30"/>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-3">
            <label>Adresse e-mail :</label>
        </div>
        <div class="col-9">
            <input type="text" name="email" id="email" placeholder="jean.dupont@gmail.com" size="30"/>
        </div>
    </div>



    <div class="form-group row">
        <div class="col-3">
            <label>Vous êtes :</label>
        </div>
        <div class="col-9">
            <input id="cli" type="radio" name="type" value="0"> <label for="cli">Client</label><br/>
            <input id="com" type="radio" name="type" value="1"> <label for="com">Commerçant</label>
        </div>
    </div>


    <input type="submit" value=" Sign Up " name="submit"/><br />

    <?php echo form_close(); ?>
</div>
<br />
<div>
    Vous avez déjà un compte ? <a href="<?php echo site_url('Auth/login') ?>">Connectez-vous !</a>
</div>

