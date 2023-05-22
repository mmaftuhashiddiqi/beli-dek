<?php

// konfigurasi pagination
$jumlahDataPerHalaman = 10;
$jumlahData = count(query("SELECT * FROM products"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$products = query("SELECT * FROM products LIMIT $awalData, $jumlahDataPerHalaman");

// tombol cari ditekan
if (isset($_POST["search"])) {
  $products = cari($_POST["keyword"]);
}

// sorted by
if (isset($_POST["ascending-price"])) {
  $products = sortedBy("ASC");
} elseif (isset($_POST["descending-price"])) {
  $products = sortedBy("DESC");
} elseif (isset($_POST["shuffle"])) {
  $products = cari("");
}

?>

<section id="products-list">
  <div class="container" style="margin-top: 80px;">
    <h4 class="font-rubik font-size-20">List of Products</h4>
    <hr>

    <div class="container d-flex justify-content-end pt-2 pb-4 pr-0">
      <!-- live search -->
      <div class="live-search">
        <form class="form-inline" action="" method="post">
          <img src="./../assets/template/loader.gif" class="loader" width="50" style="display: none;">
          <input class="form-control mr-sm-2" type="search" placeholder="Live search" aria-label="Search" name="keyword-product-live" autocomplete="off" id="keyword-product-live">
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
      <!-- add button -->
      <div class="btn-group ml-1">
        <a href="add.php" class="btn btn-primary rounded-circle">
          <span><i class="fas fa-plus"></i></span>
        </a>
      </div>
    </div>

    <div id="table-container">
      <table class="table table-bordered table-hover text-center">
        <thead class="thead-dark">
          <tr>
            <th scope="col" class="align-middle">No</th>
            <th scope="col" class="align-middle">Image</th>
            <th scope="col" class="align-middle">Brand</th>
            <th scope="col" class="align-middle">Name</th>
            <th scope="col" class="align-middle">Description</th>
            <th scope="col" class="align-middle">Stock</th>
            <th scope="col" class="align-middle">Price</th>
            <th scope="col" class="align-middle">Payment</th>
            <th scope="col" class="align-middle">Manage</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php foreach ($products as $product) { ?>
            <tr>
              <th scope="row" class="align-middle"><?= $i ?></th>
              <td class="align-middle"><img src="./../assets/products/<?= $product['product_image']; ?>" alt="product" width="40"></td>
              <td class="align-middle"><?= $product['product_brand']; ?></td>
              <td class="align-middle"><?= $product['product_name']; ?></td>
              <td class="align-middle">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-light font-size-12 m-1" data-toggle="modal" data-target="#Modal<?= $product['product_id'] ?>">
                  Show Description
                </button>
                <!-- Modal -->
                <div class="modal fade text-left" id="Modal<?= $product['product_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="ModalTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="ModalTitle"><?= $product['product_name'] ?> Description</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p class="text-break"><?= nl2br($product['product_desc']); ?></p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
              <td class="align-middle"><?= $product['product_stock']; ?></td>
              <td class="align-middle"><?= rupiah($product['product_price']); ?></td>
              <td class="align-middle">
                <?php
                $paymentMethod = json_decode($product['payment_method']);
                foreach ($paymentMethod as $payment) {
                ?>
                  <p class="bg-warning rounded d-inline-block p-1 m-1"><?= $payment ?></p>
                <?php } ?>
              </td>
              <td class="align-middle">
                <form method="post">
                  <!-- update button -->
                  <a href="./update.php?id=<?= $product["product_id"]; ?>" id="update-button" class="text-decoration-none btn btn-info font-size-12 m-1">Update</a>
                  <!-- !update button -->

                  <!-- delete button -->
                  <a href="./Template/_delete_product.php?product_id=<?= $product['product_id']; ?>" id="delete-button" class="text-decoration-none btn btn-danger font-size-12 m-1" onclick="return confirm('are you sure?');">Delete</a>
                  <!-- !update button -->
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