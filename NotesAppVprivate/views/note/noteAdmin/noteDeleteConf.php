<?php
include __DIR__ . "/../../layout/header.php";
?>

<div class="container">

  <div class="shadow-css rounded p-4">

        <h3 class="mb-4">Möchtest du diese Notiz wirklich  löschen?</h3>
        <form action ="notes-delete" method="post">
                <input type="hidden" name="id" value="<?php echo e($noteId) ?>" />
                <button class="btn btn-danger" type="submit">Ja, bitte löschen!</button>
                <a href="notes-edit?id=<?php echo e($noteId) ?>"><button class="btn btn-warning" type="button">Nein, zurück!</button></a>
        </form>

  </div>

</div>       

<?php
include __DIR__ . "/../../layout/footer.php";
?>