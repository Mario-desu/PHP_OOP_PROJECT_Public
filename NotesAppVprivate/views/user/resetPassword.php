<?php include __DIR__ . "/../layout/header.php"; ?>

<div class="container">

    <div class="shadow-css rounded p-5">

        <h2>Passwort zurücksetzen</h2>
        <br>
        <p class="fst-italic">Du bekommst eine E-Mail mit Anweisungen wie man das Passwort zurücksetzt.</p>

        <?php
        if (isset($_GET["reset"])) {
                if ($_GET["reset"] == "success"){
                   echo "<p style ='color: green;'>Check bitte deine E-Mails!<p>";
                } else if (isset($_GET["newpwd"])){
                    if ($_GET["newpwd"] == "empty") {
                    echo "<p style ='color: red;'>Bitte wiederhole Vorgang. Kein neues Passwort eingegeben!<p>"; 
                        } 
                    else if ($_GET["newpwd"] == "pwdnotequal") {
                            echo "<p style ='color: red;'>Bitte wiederhole Vorgang. Passwörter stimmen nicht überein!<p>";
                        }
                    }
                }
        ?>    

        <form action="reset-pw-request" method="POST">
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-12 col-form-label">Email 
            </label>
            <div class="col-sm-12">
                <input type="email" class="form-control" name="email" placeholder="Bitte deine E-Mail-Adresse eingeben" id="inputEmail3">
            </div>
        </div>
        <button type="submit" name="resetRequestSubmit" class="btn sub-btn">Email anfordern zum Zurücksetzen</button>

        </form>

    </div>

</div>  


<?php include __DIR__ . "/../layout/footer.php"; ?>