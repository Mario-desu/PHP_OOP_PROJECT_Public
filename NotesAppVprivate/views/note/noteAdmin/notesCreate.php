<?php include __DIR__ . "/../../layout/header.php"; ?>

<div class="container">

    <div class="shadow-css rounded p-5">

        <h2>Neue Notiz erstellen </h2>

            <p style ="color: <?php echo $color ;?>;"><?php echo  $message ;?></p>


        <form method="post" action="notes-create" class="form-horizontal">
        <div class="form-group mb-3">
            <label class="control-label col-md-3">
                Titel:
            </label>
            <div class="col-md-9">
                <input type="text" name="title" value="<?php echo e($title); ?>" class="form-control">
            </div>    
        </div>
        <div class="form-group mb-3">
            <label class="control-label col-md-3">
                Inhalt:
            </label>
            <div class="col-md-9">
                <textarea name="content" cols="75" rows="5" class="form-control"><?php echo e($content); ?> </textarea>
            </div>    
        </div>
        <div class="form-group mb-3">
            <label class="control-label col-md-3">
                Status:
            </label>
            <div class="col-md-9">
            <input type="checkbox" name="private"> privat
                
            <input type="checkbox" name="public"> öffentlich<br>
            <br>
            <input type="submit" name="submit" value="Neue Notiz speichern" class="btn sub-btn">
            </div>    
        </div>
        </form>
        
        <a href="dashboard"><i class="fas fa-arrow-left"></i> zurück zu Dashboard</a>

    </div>

</div>


<?php include __DIR__ . "/../../layout/footer.php"; ?>