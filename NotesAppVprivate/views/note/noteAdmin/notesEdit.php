<?php include __DIR__ . "/../../layout/header.php"; ?>

<div class="container">

    <div class="shadow-css rounded p-5">

        <h2>Notiz bearbeiten </h2>

        <p style ="color: <?php echo $color ;?>;"><?php echo  $message ;?></p>


        <form method="post" action="notes-edit?id=<?php echo e($note->id); ?>" class="form-horizontal">
        <div class="form-group mb-3">
            <label class="control-label col-md-3">
                Titel:
            </label>
            <div class="col-md-9">
                <input type="text" name="title" value="<?php echo e($note->title); ?>" class="form-control">
            </div>    
        </div>
        <div class="form-group mb-3">
            <label class="control-label col-md-3">
                Inhalt:
            </label>
            <div class="col-md-9">
                <textarea name="content" cols="75" rows="5" class="form-control"><?php echo e($note->content); ?></textarea>
            </div>    
        </div>
        <div class="form-group mb-3">
            <label class="control-label col-md-3">
                Status:
                <p class="fst-italic">aktueller Status: <?php echo e($statusPrint); ?></p>
            </label>
            <div class="col-md-9">
            <input type="checkbox" name="private"> privat
                
            <input type="checkbox" name="public"> öffentlich<br>
            <br>
            <input type="submit" value="Notiz ändern" class="btn sub-btn">
            </form>
            <a href="notes-delconf?id=<?php echo e($note->id); ?>"><btn class="btn btn-danger">Notiz löschen</btn></a>
            <br>
            <br>
            <a href="notes-admin"><i class="fas fa-arrow-left"></i> zurück zu allen Notizen</a>
        </div>    
    

    </div>

</div>




<?php include __DIR__ . "/../../layout/footer.php"; ?>