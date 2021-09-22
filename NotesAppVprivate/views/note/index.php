<?php include __DIR__ . "/../layout/header.php"; ?>

<div class="container">

  <h1>Notizen</h1>

    <div class="shadow-css rounded p-4 m-5">
    <ul class="fs-5">
      <?php foreach ($notes AS $note): ?>
        <li>
          <a href="note?id=<?php echo e($note->id); ?>">
            <?php echo e($note->title); ?>
            <p class="text-muted fs-6"><?php echo e($note->time); ?></p>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>

    </div>

  </div>

  <?php include __DIR__ . "/../layout/footer.php"; ?>