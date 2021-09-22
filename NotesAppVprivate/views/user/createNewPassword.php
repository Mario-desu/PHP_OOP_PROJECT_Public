<?php include __DIR__ . "/../layout/header.php"; ?>

<div class="container">

    <div class="shadow-css rounded p-5">

        <h2>Neues Passwort erstellen</h2>
        <br>
        <form action="reset-pw-action" method="POST">
            <input type="hidden" name="selector" value="<?php echo $selector ?>">
            <input type="hidden" name="validator" value="<?php echo $validator ?>">
        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-12 col-form-label">Passwort</label>
            <div class="col-sm-12">
                <input type="password" class="form-control" name="pwd" placeholder="Neues Passwort"  >                
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-12 col-form-label">Passwort bestätigen</label>
            <div class="col-sm-12">
                <input type="password" class="form-control" name="pwdRepeat" placeholder="Neues Passwort wiederholen">                
            </div>
        </div>
        <button type="submit" name="reset-password-submit" class="btn sub-btn">Passwort zurücksetzen</button>

        </form>

    </div>

</div>  


<?php include __DIR__ . "/../layout/footer.php"; ?>