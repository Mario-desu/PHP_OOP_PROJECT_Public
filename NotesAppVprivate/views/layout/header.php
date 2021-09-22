<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mario Hartleb">
    <title>Notizen</title>
    
    <!-- CSS-Link-->   
    <!--echo time zwingt CSS zu laden-->
    <link rel="stylesheet" href= "../../public/style/styles.css?v=<?php echo time(); ?>">

    <!-- Google-Fonts-->
    <!--Monserrat-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <!--more Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Allison&family=Permanent+Marker&display=swap" rel="stylesheet">

    <!--Bootstrap-CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <!--font-awesome-->
    <script src="https://kit.fontawesome.com/3543c7cdbb.js" crossorigin="anonymous"></script>

    <!--animate.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"  />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary opacity-75 fs-5 px-5 nav-style">
        <div class="container-fluid">
          <a class="navbar-brand opacity-100" href="start"><img src="../../public/img/sticky_notes.png" class ="logo" alt="sticky note"> <span class="logo-text">SmartNotes</span></a>
          
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav opacity-100">
              <a class="nav-link" aria-current="page" href="start">HOME</a>
              <a class="nav-link" href="index">NOTIZEN</a>
              <a class="nav-link" href="dashboard">DASHBOARD</a>
              <?php
              //Je nachdem, ob eingeloggt oder nicht:
              if (isset($_SESSION['login'])) {
              echo  "<a class='nav-link' href='logout'>LOGOUT <i class='fas fa-sign-out-alt'></i></a>";
              } else {
                echo  "<a class='nav-link' href='login'>LOGIN</a>";
              }
              ?>
              <?php    
              if (isset($_SESSION['login'])) {
              echo  "<a class='nav-link d-none' href='logout'>REGISTRIEREN</a>";
              } else {
                echo  "<a class='nav-link' href='register'>REGISTRIEREN</a>";
              }
              ?>
              <!-- <a class="nav-link" href="register">REGISTRIEREN</a> -->
            </div>
          </div>
        </div>
      </nav>
      <br>
      <br>

