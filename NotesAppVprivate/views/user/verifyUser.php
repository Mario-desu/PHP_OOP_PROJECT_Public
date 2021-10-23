<?php include __DIR__ . "/../layout/header.php"; ?>

<div class="container">

    <div class="shadow-css rounded p-5">

        <h2>Registrierung erfolgreich abgeschlossen!</h2>
        <!-- Meldung über erolgreichen reset von Passwort: -->
        <?php
        if (isset($_GET['newpwd'])) {
            if ($_GET['newpwd'] == "passwordupdated") {
                echo "<p style = 'color: green;'>Dein Passwort wurde erfolgreich zurückgesetzt!</p>";
            }
        }
        ?>
        <!-- <p style = "color: red;"><?php  echo $message ?></p> -->

        <form action="login" method="POST">
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-12 col-form-label">Email 
            </label>
            <div class="col-sm-12">
                <input type="email" class="form-control" name="email" value="" id="inputEmail3">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-12 col-form-label">Passwort</label>
            <div class="col-sm-12">
                <input type="password" class="form-control" name="password" id="inputPassword3">
                
            </div>
        </div>
        <button type="submit" class="btn sub-btn"><i class="fas fa-sign-in-alt"></i> Einloggen</button>
        <br>
        <a href="register">noch nicht registriert? <i class="fas fa-arrow-right"></i></a>
        <br>
        <br>
        <a href="reset-pw-request">Passwort vergessen?</a>
        </form>

    </div>

</div>  


<?php include __DIR__ . "/../layout/footer.php"; ?>