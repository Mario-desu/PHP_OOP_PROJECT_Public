<?php include __DIR__ . "/../../layout/header.php"; ?>

   
<div class="container">

    <div class="shadow-css rounded p-5">

        <h2>Userdaten bearbeiten</h2> 
       
        <p style ="color: <?php echo $color ;?>;"><?php echo  $message ;?></p>


        <form action="user-edit?id=<?php echo e($user->userId); ?>" method="POST">
            <div class="row mb-3">
                <label class="col-sm-12 col-form-label">Nachname: 
                </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="lastName" value="<?php echo e($user->lastName); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-12 col-form-label">Vorname: 
                </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="firstName" value="<?php echo e($user->firstName); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-12 col-form-label" >Email 
                </label>
                <div class="col-sm-12">
                    <input type="email" class="form-control" name="email" id="inputEmail3" value="<?php echo e($user->email); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-12 col-form-label">
                    Rolle:
                    <p class="fst-italic">aktuelle Rolle: <?php echo e($rolePrint); ?></p> 
                </label>
                <div class="col-sm-12">
                    <input type="checkbox" name="admin"> Admin
                    
                    <input type="checkbox" name="user"> User<br>
                    <br>
                    <input type="submit" class="btn sub-btn" value="Änderung speichern" name="submit"></input>
                    <br>
                    <br>
                    <a href="admdash"><i class="fas fa-arrow-left"></i> zurück zu allen Usern</a>
                </div>
            </div>

            </form>

        </div>

    </div>

<?php
include __DIR__ . "/../../layout/footer.php";

