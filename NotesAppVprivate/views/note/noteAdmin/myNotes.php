<?php include __DIR__ . "/../../layout/header.php"; ?>

<div class="container"><h1>Meine persönlichen Notizen</h1>

<div class="shadow-css rounded p-4 m-5">

  <ul class="fs-5">
    <?php foreach ($notes AS $note): ?>
      <li>
        <a href="mynotes-detail?id=<?php echo e($note->id); ?>">
          <?php echo e($note->title); ?>
        </a>
        <p class="text-muted fs-6"><?php echo e($note->time); ?></p>
      </li>
    <?php endforeach; ?>
  </ul>
  <br>
    <a href="dashboard"><i class="fas fa-arrow-left"></i> zurück zu Dashboard</a>


</div>

<?php include __DIR__ . "/../../layout/footer.php"; ?>