<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // proceed to buy
  if (isset($_POST['process-button'])) {
    $order->insertIntoDelivery($_POST['order-id']);
  }
}

// konfigurasi pagination
$jumlahDataPerHalaman = 10;
$jumlahData = count(query("SELECT * FROM orders"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$orders = query(
  "SELECT orders.order_id, orders.user_id, orders.product_id, users.user_username, orders.order_date, products.product_brand, products.product_name, products.product_price, orders.product_count, orders.payment_method, orders.delivery_method
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

<section id="orders-list">
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
            <th scope="col" class="align-middle">Product Name</th>
            <th scope="col" class="align-middle">Product Count</th>
            <th scope="col" class="align-middle">Show Details</th>
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
              <td class="align-middle"><?= $order['product_name']; ?></td>
              <td class="align-middle"><?= $order['product_count'] ?></td>
              <td class="align-middle">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-light font-size-12 m-1" data-toggle="modal" data-target="#Modal<?= $order['order_id'] ?>">
                  Show Details
                </button>
                <!-- Modal -->
                <div class="modal fade text-left" id="Modal<?= $order['order_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="ModalTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="ModalTitle">Order Description</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" style="line-height: 1.2;">
                        <p class="text-break">
                          <span class="font-weight-bold bg-info text-white rounded p-1">Username</span>
                          <i class="fas fa-arrow-right ml-2"></i>
                          <span class="ml-2 p-1"><?= $order['user_username']; ?></span>
                        </p>
                        <p class="text-break">
                          <span class="font-weight-bold bg-info text-white rounded p-1">Order Date</span>
                          <i class="fas fa-arrow-right ml-2"></i>
                          <span class="ml-2 p-1"><?= $order['order_date']; ?></span>
                        </p>
                        <p class="text-break">
                          <span class="font-weight-bold bg-info text-white rounded p-1">Product Brand</span>
                          <i class="fas fa-arrow-right ml-2"></i>
                          <span class="ml-2 p-1"><?= $order['product_brand']; ?></span>
                        </p>
                        <p class="text-break">
                          <span class="font-weight-bold bg-info text-white rounded p-1">Product Name</span>
                          <i class="fas fa-arrow-right ml-2"></i>
                          <span class="ml-2 p-1"><?= $order['product_name']; ?></span>
                        </p>
                        <p class="text-break">
                          <span class="font-weight-bold bg-info text-white rounded p-1">Product Price</span>
                          <i class="fas fa-arrow-right ml-2"></i>
                          <span class="ml-2 p-1"><?= rupiah($order['product_price']); ?></span>
                        </p>
                        <p class="text-break">
                          <span class="font-weight-bold bg-info text-white rounded p-1">Product Count</span>
                          <i class="fas fa-arrow-right ml-2"></i>
                          <span class="ml-2 p-1"><?= $order['product_count']; ?></span>
                        </p>
                        <p class="text-break">
                          <span class="font-weight-bold bg-info text-white rounded p-1">Total Price</span>
                          <i class="fas fa-arrow-right ml-2"></i>
                          <span class="ml-2 p-1 bg-success text-white rounded"><?= rupiah($order['product_price'] * $order['product_count']); ?></span>
                        </p>
                        <p class="text-break">
                          <span class="font-weight-bold bg-info text-white rounded p-1">Payment Method</span>
                          <i class="fas fa-arrow-right ml-2"></i>
                          <span class="ml-2 p-1 bg-warning rounded"><?= $order['payment_method']; ?></span>
                        </p>
                        <p class="text-break">
                          <span class="font-weight-bold bg-info text-white rounded p-1">Delivery Method</span>
                          <i class="fas fa-arrow-right ml-2"></i>
                          <span class="ml-2 p-1 bg-secondary text-white rounded"><?= $order['delivery_method']; ?></span>
                        </p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
              <td class="align-middle">
                <form method="post">
                  <!-- process button -->
                  <button name="process-button" id="process-button" class="btn btn-warning font-size-12 m-1">Process</button>
                  <input type="hidden" name="order-id" id="order-id" value="<?= $order['order_id'] ?>">
                  <!-- !process button -->
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