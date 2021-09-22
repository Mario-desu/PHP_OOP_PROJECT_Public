<?php include __DIR__ . "/../../layout/header.php"; ?>

<div class="container">

  <h1>Notiz</h1>
  <div class="shadow-css rounded p-4 m-5">

    <div class="card" >
      <!-- <img src="..." class="card-img-top" alt="..."> -->
      <div class="card-body">
        <h5 class="card-title"><?php echo e($note["title"]); ?></h5>
        <p class="card-text"><?php echo e(nl2br($note["content"])); ?></p>
      </div>
      <div class="card-footer">
        <p>erstellt: <?php echo e($note["time"]); ?> </p>
      </div>
    </div>
    <br>
        <!--Bestätigung Kommentar-->
        <p style ="color: <?php echo $color ;?>;"><?php echo $commentMessage ;?></p>
  
    <form method="post" action="mynotes-detail?id=<?php echo e($note['id']); ?>">
        <textarea name="content" cols="75" rows="3" placeholder="Kommentar eingeben" class="form-control w-75"></textarea>
        <br>
        <input type="submit" value="Kommentar posten" class="btn sub-btn">
    </form>
    
    <a href="mynotes"><i class="fas fa-arrow-left"></i> zurück zu allen Notizen</a>
    <br>  
    <br>  

    <h3>Kommentare</h3>

    <ul class="list-group w-75">
      <?php foreach($comments AS $comment): ?>
        <li class="list-group-item"> 
          <!-- htmlentities: converts all characters to html-entities,
        z.B <  = &lt, UTF8 to be flexible with server  -->
          <p class="text-muted fst-italic"><?php echo e($comment->time); ?></p>
          <?php echo e(nl2br($comment->content)); ?>
        </li>
      <?php endforeach; ?>  
    </ul>

  </div>

</div>

<?php include __DIR__ . "/../../layout/footer.php"; ?>