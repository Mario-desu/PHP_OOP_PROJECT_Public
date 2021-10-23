<?php include __DIR__ . "/../layout/header.php"; 
?>

 <div class="container">

    <div class="shadow-css rounded p-5">
    
        <p style = "color: red;"><?php  echo $message ?></p>

        <h2>Registrierung</h2> 
        <br>
    
        <form action="register" method="POST">
            <div class="row mb-3">
                <label class="col-sm-12 col-form-label">Nachname: 
                </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="lastName" value="<?php echo e($lastName); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-12 col-form-label">Vorname: 
                </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="firstName" value="<?php echo e($firstName); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-12 col-form-label" >Email: 
                </label>
                <div class="col-sm-12">
                    <input type="email" class="form-control" name="email" placeholder="example@mail.com" id="inputEmail3" value="<?php echo e($email); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-12 col-form-label">Passwort:
                </label>
                <div class="col-sm-12">
                    <input type="password" class="form-control" name="password1" placeholder="Passwort eingeben (Kleinbuchstabe, Großbuchstabe, Zahl und Sonderzeichen(!?%#.))" id="inputPassword3">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-12 col-form-label">Passwort:</label>
                <div class="col-sm-12">
                    <input type="password" class="form-control" name="password2" placeholder="Passwort wiederholen" id="inputPassword3">
                </div>
            </div>
            <br>
            <input type="checkbox" name="zustimmungAGB" value="ok"<?php if($zustimmungAGB=="ok") { echo "checked"; } ?>>ich stimme den AGB zu<br>
                
            <input type="checkbox" name="zustimmungDatenschutz" value="ok"<?php if($zustimmungDatenschutz=="ok") { echo "checked"; } ?>>ich stimme dem Datenschutz zu<br>
            <br>

            <div class="g-recaptcha" data-sitekey="<?php echo $publicKeyRecaptcha ; ?>"></div>
            <br/>

            <input type="submit" class="btn sub-btn" value="Registrieren" name="submit"></input>

        </form>

</div>

</div>

<?php include __DIR__ . "/../layout/footer.php"; ?>