<?php include __DIR__ . "/../../layout/header.php"; ?>

<div class="container">


   <div class="shadow-css rounded p-4">

        <h3 class="mb-4">Möchtest du dieses Konto wirklich löschen?</h3>
        <form action ="user-delete" method="post">
                <input type="hidden" name="id" value="<?php echo e($userId) ?>" />
                <button class="btn btn-danger" type="submit">Ja, bitte löschen!</button>
                <a href="admdash"><button class="btn btn-warning" type="button">Nein, zurück!</button></a>
        </form>
   </div>
</div>

<?php include __DIR__ . "/../../layout/footer.php"; ?>