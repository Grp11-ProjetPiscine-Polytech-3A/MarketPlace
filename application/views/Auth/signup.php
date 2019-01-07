<div id="signup" class="container">
    <h2>Sign up to HeroShop</h2>
    <hr/>

    <?php echo form_open('Auth/signup_process'); ?>

    <div class="form-group row">
        <div class="col-3">
            <label>Nom d'utilisateur</label>
        </div>
        <div class="col-9">
            <input type="text" name="loginUser" id="loginUser" placeholder="JeanDupont" size="30" value="<?php echo set_value('loginUser') ?>"/>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-3">
            <label>Mot de passe</label>
        </div>
        <div class="col-9">
            <input type="password" name="passUser" id="passUser" placeholder="**********" size="30" />
        </div>
    </div>

    <div class="form-group row">
        <div class="col-3">
            <label>Confirmer le mot de passe</label>
        </div>
        <div class="col-9">
            <input type="password" name="confirm_password" id="confirm_password" placeholder="**********" size="30"/>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-3">
            <label>Adresse e-mail</label>
        </div>
        <div class="col-9">
            <input type="text" name="email" id="email" placeholder="jean.dupont@gmail.com" size="30" value="<?php echo set_value('email') ?>"/>
        </div>
    </div>


    <div class="form-group row">
        <div class="col-3">
            <label>Vous êtes</label>
        </div>
        <div class="col-9">
            <input id="cli" type="radio" name="type" value="0" <?php echo (set_value('type') == 0) ? "checked" : "" ?>> <label for="cli">Client</label><br/>
            <input id="com" type="radio" name="type" value="1" <?php echo (set_value('type') == 1) ? "checked" : "" ?>> <label for="com">Commerçant</label>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-3">
            <label>Nom</label>
        </div>
        <div class="col-9">
            <input type="text" name="nom" id="nom" placeholder="Dupont" size="30" value="<?php echo set_value('nom') ?>"/>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-3">
            <label>Prénom</label>
        </div>
        <div class="col-9">
            <input type="text" name="prenom" id="prenom" placeholder="Jean" size="30" value="<?php echo set_value('prenom') ?>"/>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-3">
            <label>Date de naissance</label>
        </div>
        <div class="col-9">
            <input type="date" name="naiss_date" value="<?php echo set_value('naiss_date') ?>">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-3">
            <label>Téléphone</label>
        </div>
        <div class="col-9">
            <input type="tel" name="tel" id="tel" placeholder="0600000000" size="30" value="<?php echo set_value('tel') ?>"/>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-3">
            <label>Adresse</label>
        </div>
        <div class="col-9">
            <div class="col-12 form-group row">
                <input type="text" name="numAdr" id="numAdr" placeholder="01" size="5" style="margin-right:2px" value="<?php echo set_value('numAdr') ?>"/>
                <input type="text" name="rue" id="rue" placeholder="Rue" size="25" value="<?php echo set_value('rue') ?>"/> 
            </div>

            <div class="col-12 form-group row">
                <input type="text" name="cplAdr" id="cplAdr" placeholder="Complement d'adresse" size="36" value="<?php echo set_value('cplAdr') ?>"/>
            </div>
            
            <div class="col-12 form-group row">
                <input type="text" name="cp" id="cp" placeholder="Code Postal" size="10" style="margin-right:2px" value="<?php echo set_value('cp') ?>"/>
                <input type="text" name="ville" id="ville" placeholder="Ville" size="20" value="<?php echo set_value('ville') ?>"/>
            </div>
        </div>
    </div>


    <input type="submit" value=" Sign Up " name="submit"/><br />

    <?php echo form_close(); ?>
</div>
<br />
<div>
    Vous avez déjà un compte ? <a href="<?php echo site_url('Auth/login') ?>">Connectez-vous !</a>
</div>

