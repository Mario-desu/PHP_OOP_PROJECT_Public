<?php include __DIR__ . "/../layout/header.php"; ?>

<div class="container">

<div class="shadow-css rounded p-5">

    <h1>
      Hallo im Dashboard <?php echo e($userFirstName) ;?>!  
    </h1>

    <ul class="fs-4">
    <li>
          <a href="mynotes">
            Meine Notizen
          </a>
        </li>
        <li>
          <a href="notes-create">
            Neue Notiz erstellen
          </a>
        </li>
        <li>
          <a href="notes-admin">
            Notizen verwalten
          </a>
        </li>

        <?php
        //Wird nur bei Admins angezeigt
        if ($_SESSION['role'] == 'admin') {
        echo  "<li><a href='admdash'>User verwalten</a></li>";
        }
        ?>

        <li>
          <a href="logout">
            Logout
          </a>
        </li>
        <li>
          <a href="user-delconf?id=<?php echo e($_SESSION['userId']); ?> " >
            Mein Konto löschen
          </a>
        </li>
    </ul>

  </div>

</div>

<?php include __DIR__ . "/../layout/footer.php"; ?>