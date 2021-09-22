<?php include __DIR__ . "/../../layout/header.php"; ?>

<div class="container">

  <div class="shadow-css rounded p-5">

    <h1>Meine Notizen verwalten</h1>
    <br>
    <ul class="fs-5">
      <?php foreach ($notes AS $note): ?>
        <li>
          <a href="notes-edit?id=<?php echo e($note->id); ?>">
            <?php echo e($note->title); ?>
            <p class="text-muted fs-6"><?php echo e($note->time); ?></p>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
    <br>
    <a href="dashboard"><i class="fas fa-arrow-left"></i> zurück zu Dashboard</a>

  </div>

</div>

<?php include __DIR__ . "/../../layout/footer.php"; ?>
