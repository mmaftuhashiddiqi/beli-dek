<?php

// konfigurasi pagination
$jumlahDataPerHalaman = 10;
$jumlahData = count(query("SELECT * FROM users"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$users = query("SELECT * FROM users LIMIT $awalData, $jumlahDataPerHalaman");

// tombol cari ditekan
if (isset($_POST["search"])) {
  $users = cariUser($_POST["keyword"]);
}

?>

<section id="products-list">
  <div class="container" style="margin-top: 80px;">
    <h4 class="font-rubik font-size-20">List of Users</h4>
    <hr>

    <div class="container d-flex justify-content-end pt-2 pb-4 pr-0">
      <!-- live search -->
      <div class="live-search d-flex">
        <form class="form-inline d-flex justify-content-end" action="" method="post">
          <img src="./../assets/template/loader.gif" class="loader" width="50" style="display: none;">
          <input class="form-control mr-sm-2" type="search" placeholder="Live search" aria-label="Search" name="keyword-user-live" autocomplete="off" id="keyword-user-live">
        </form>
      </div>
    </div>

    <div id="table-container">
      <table class="table table-bordered table-hover text-center">
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
    </div>

    <!-- pagination -->
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <?php if ($halamanAktif > 1) : ?>
          <li class="page-item">
            <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
          <?php if ($i == $halamanAktif) : ?>
            <li class="page-item"><a class="page-link font-weight-bold text-danger" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
          <?php else : ?>
            <li class="page-item"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
          <?php endif; ?>
        <?php endfor; ?>
        <?php if ($halamanAktif < $jumlahHalaman) : ?>
          <li class="page-item">
            <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
    <!-- !pagination -->
  </div>
</section>