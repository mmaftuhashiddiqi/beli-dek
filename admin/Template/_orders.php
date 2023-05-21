<?php

// konfigurasi pagination
$jumlahDataPerHalaman = 10;
$jumlahData = count(query("SELECT * FROM orders"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$orders = query(
  "SELECT orders.user_id, orders.product_id, users.user_username, orders.order_date, products.product_brand, products.product_name, products.product_price, orders.product_count, orders.payment_method
    FROM orders
    INNER JOIN users ON orders.user_id = users.user_id
    INNER JOIN products ON orders.product_id = products.product_id 
    LIMIT $awalData, $jumlahDataPerHalaman"
);

// tombol cari ditekan
if (isset($_POST["search"])) {
  $orders = cariOrder($_POST["keyword"]);
}

// sorted by
if (isset($_POST["ascending-price"])) {
  $orders = sortedOrderBy("ASC");
} elseif (isset($_POST["descending-price"])) {
  $orders = sortedOrderBy("DESC");
} elseif (isset($_POST["shuffle"])) {
  $orders = cariOrder("");
}

?>

<section id="products-list">
  <div class="container" style="margin-top: 80px;">
    <h4 class="font-rubik font-size-20">Order of Products</h4>
    <hr>

    <div class="container d-flex justify-content-end pt-2 pb-4 pr-0">
      <!-- live search -->
      <div class="live-search d-flex">
        <form class="form-inline d-flex justify-content-end" action="" method="post">
          <img src="./../assets/template/loader.gif" class="loader" width="50" style="display: none;">
          <input class="form-control mr-sm-2" type="search" placeholder="Live search" aria-label="Search" name="keyword-order-live" autocomplete="off" id="keyword-order-live">
        </form>
      </div>
      <!-- order by filter -->
      <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Sorted by
        </button>
        <div class="dropdown-menu dropdown-menu-right">
          <form action="" method="post">
            <button class="dropdown-item" type="submit" name="ascending-price" id="ascending-price">Ascending price</button>
            <button class="dropdown-item" type="submit" name="descending-price" id="descending-price">Descending price</button>
            <button class="dropdown-item" type="submit" name="shuffle" id="shuffle">Normal</button>
          </form>
        </div>
      </div>
    </div>

    <div id="table-container">
      <table class="table table-bordered table-hover text-center">
        <thead class="thead-dark">
          <tr>
            <th scope="col" class="align-middle">No</th>
            <th scope="col" class="align-middle">Username</th>
            <th scope="col" class="align-middle">Order Date</th>
            <th scope="col" class="align-middle">Product Brand</th>
            <th scope="col" class="align-middle">Product Name</th>
            <th scope="col" class="align-middle">Product Price</th>
            <th scope="col" class="align-middle">Product Count</th>
            <th scope="col" class="align-middle">Total Price</th>
            <th scope="col" class="align-middle">Payment Method</th>
            <th scope="col" class="align-middle">Manage</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php
          foreach ($orders as $order) { ?>
            <tr>
              <th scope="row" class="align-middle"><?= $i ?></th>
              <td class="align-middle"><?= $order['user_username']; ?></td>
              <td class="align-middle"><?= $order['order_date']; ?></td>
              <td class="align-middle"><?= $order['product_brand']; ?></td>
              <td class="align-middle"><?= $order['product_name']; ?></td>
              <td class="align-middle"><?= rupiah($order['product_price']); ?></td>
              <td class="align-middle"><?= $order['product_count'] ?></td>
              <td class="align-middle"><?= rupiah($order['product_price'] * $order['product_count']); ?></td>
              <td class="align-middle"><p class="bg-info text-white rounded d-inline-block p-1 m-1"><?= $order['payment_method'] ?></p></td>
              <td class="align-middle">
                <form method="post">
                  <!-- process button -->
                  <a href="#" id="process-button" class="text-decoration-none btn btn-warning font-size-12 m-1">Process</a>
                  <!-- !process button -->

                  <!-- done button -->
                  <a href="./Template/_delete_order.php?product_id=<?= $order['product_id']; ?>&user_id=<?= $order['user_id']; ?>" id="done-button" class="text-decoration-none btn btn-success font-size-12 m-1">Done</a>
                  <!-- !done button -->
                </form>
              </td>
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