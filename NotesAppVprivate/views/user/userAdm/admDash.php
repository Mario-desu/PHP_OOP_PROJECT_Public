<?php include __DIR__ . "/../../layout/header.php"; ?>

<div class="container">

  <div class="shadow-css rounded p-4">

    <h2>Userverwaltung</h2>
    <br>

    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">Nachname</th>
          <th scope="col">Vorname</th>
          <th scope="col">E-mail</th>
          <th scope="col">Status</th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <?php foreach ($users AS $user): ?>
      <tbody>
        <tr>
          <td><?php echo e($user->lastName); ?> </td>  
          <td><?php echo e($user->firstName); ?> </td>
          <td><?php echo e($user->email); ?> </td>
          <td><?php echo e($user->role); ?> </td>
          <td>
              <a href="user-delconf?id=<?php echo e($user->userId); ?> " ><i class='fas fa-trash'></i></a>
          </td>
          <td>
              <a href="user-edit?id=<?php echo e($user->userId); ?> " ><i class='far fa-edit'></i></a>
          </td>
          <!-- <td><i class='far fa-edit'>   </td>       -->
        </tr>
      </tbody>
      <?php endforeach; ?>
    </table>

  </div>

</div>

<?php include __DIR__ . "/../../layout/footer.php"; ?>