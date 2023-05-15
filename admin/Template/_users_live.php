<?php

// usleep(500000);
require '../functions.php';

$keywordUserLive = $_GET["keyword-user-live"];

$users = cariUser($keywordUserLive);

?>

<table class="table table-hover text-center">
  <thead class="thead-dark">
    <tr>
      <th scope="col">No</th>
      <th scope="col">Username</th>
      <th scope="col">Full Name</th>
      <th scope="col">Phone</th>
      <th scope="col">Address</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1; ?>
    <?php foreach ($users as $user) { ?>
      <tr>
        <th scope="row"><?= $i ?></th>
        <td><?= $user['user_username'] ?></td>
        <td><?= $user['user_fullname'] ?></td>
        <td><?= $user['user_phone'] ?></td>
        <td><?= $user['user_address'] ?></td>
      </tr>
      <?php $i++; ?>
    <?php } ?>
  </tbody>
</table>