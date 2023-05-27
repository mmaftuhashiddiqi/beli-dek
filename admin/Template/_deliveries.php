<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // proceed to buy
  if (isset($_POST['done-button'])) {
    if (hapusDelivery($_POST['delivery-id'])) {
      echo "
    		<script>
		    	alert('product has been sent!');
		    	document.location.href = 'deliveries.php';
		    </script>
    	";
    } else {
      echo "
		    <script>
			    alert('product failed to delete!');
		    	document.location.href = 'deliveries.php';
		    </script>
	    ";
    }
  }
}

// konfigurasi pagination
$jumlahDataPerHalaman = 10;
$jumlahData = count(query("SELECT * FROM deliveries"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$deliveries = query(
  "SELECT deliveries.delivery_id, deliveries.user_id, deliveries.product_id, users.user_username, deliveries.delivery_date, products.product_brand, products.product_name, products.product_price, deliveries.product_count, deliveries.payment_method, deliveries.delivery_method
    FROM deliveries
    INNER JOIN users ON deliveries.user_id = users.user_id
    INNER JOIN products ON deliveries.product_id = products.product_id 
    LIMIT $awalData, $jumlahDataPerHalaman"
);

// tombol cari ditekan
if (isset($_POST["search"])) {
  $deliveries = cariDelivery($_POST["keyword"]);
}

// sorted by
if (isset($_POST["ascending-price"])) {
  $deliveries = sortedDeliveryBy("ASC");
} elseif (isset($_POST["descending-price"])) {
  $deliveries = sortedDeliveryBy("DESC");
} elseif (isset($_POST["shuffle"])) {
  $deliveries = cariDelivery("");
}

?>

<section id="deliveries-list">
  <div class="container" style="margin-top: 80px;">
    <h4 class="font-rubik font-size-20">Products On Delivery</h4>
    <hr>

    <div class="container d-flex justify-content-end pt-2 pb-4 pr-0">
      <!-- live search -->
      <div class="live-search d-flex">
        <form class="form-inline d-flex justify-content-end" action="" method="post">
          <img src="./../assets/template/loader.gif" class="loader" width="50" style="display: none;">
          <input class="form-control mr-sm-2" type="search" placeholder="Live search" aria-label="Search" name="keyword-delivery-live" autocomplete="off" id="keyword-delivery-live">
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
            <th scope="col" class="align-middle">Delivery Date</th>
            <th scope="col" class="align-middle">Product Name</th>
            <th scope="col" class="align-middle">Product Count</th>
            <th scope="col" class="align-middle">Show Details</th>
            <th scope="col" class="align-middle">Manage</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php
          foreach ($deliveries as $delivery) { ?>
            <tr>
              <th scope="row" class="align-middle"><?= $i ?></th>
              <td class="align-middle"><?= $delivery['user_username']; ?></td>
              <td class="align-middle"><?= $delivery['delivery_date']; ?></td>
              <td class="align-middle"><?= $delivery['product_name']; ?></td>
              <td class="align-middle"><?= $delivery['product_count'] ?></td>
              <td class="align-middle">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-light font-size-12 m-1" data-toggle="modal" data-target="#Modal<?= $delivery['delivery_id'] ?>">
                  Show Details
                </button>
                <!-- Modal -->
                <div class="modal fade text-left" id="Modal<?= $delivery['delivery_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="ModalTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="ModalTitle">Delivery Description</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" style="line-height: 1.2;">
                        <p class="text-break">
                          <span class="font-weight-bold bg-info text-white rounded p-1">Username</span>
                          <i class="fas fa-arrow-right ml-2"></i>
                          <span class="ml-2 p-1"><?= $delivery['user_username']; ?></span>
                        </p>
                        <p class="text-break">
                          <span class="font-weight-bold bg-info text-white rounded p-1">Delivery Date</span>
                          <i class="fas fa-arrow-right ml-2"></i>
                          <span class="ml-2 p-1"><?= $delivery['delivery_date']; ?></span>
                        </p>
                        <p class="text-break">
                          <span class="font-weight-bold bg-info text-white rounded p-1">Product Brand</span>
                          <i class="fas fa-arrow-right ml-2"></i>
                          <span class="ml-2 p-1"><?= $delivery['product_brand']; ?></span>
                        </p>
                        <p class="text-break">
                          <span class="font-weight-bold bg-info text-white rounded p-1">Product Name</span>
                          <i class="fas fa-arrow-right ml-2"></i>
                          <span class="ml-2 p-1"><?= $delivery['product_name']; ?></span>
                        </p>
                        <p class="text-break">
                          <span class="font-weight-bold bg-info text-white rounded p-1">Product Price</span>
                          <i class="fas fa-arrow-right ml-2"></i>
                          <span class="ml-2 p-1"><?= rupiah($delivery['product_price']); ?></span>
                        </p>
                        <p class="text-break">
                          <span class="font-weight-bold bg-info text-white rounded p-1">Product Count</span>
                          <i class="fas fa-arrow-right ml-2"></i>
                          <span class="ml-2 p-1"><?= $delivery['product_count']; ?></span>
                        </p>
                        <p class="text-break">
                          <span class="font-weight-bold bg-info text-white rounded p-1">Total Price</span>
                          <i class="fas fa-arrow-right ml-2"></i>
                          <span class="ml-2 p-1 bg-success text-white rounded"><?= rupiah($delivery['product_price'] * $delivery['product_count']); ?></span>
                        </p>
                        <p class="text-break">
                          <span class="font-weight-bold bg-info text-white rounded p-1">Payment Method</span>
                          <i class="fas fa-arrow-right ml-2"></i>
                          <span class="ml-2 p-1 bg-warning rounded"><?= $delivery['payment_method']; ?></span>
                        </p>
                        <p class="text-break">
                          <span class="font-weight-bold bg-info text-white rounded p-1">Delivery Method</span>
                          <i class="fas fa-arrow-right ml-2"></i>
                          <span class="ml-2 p-1 bg-secondary text-white rounded"><?= $delivery['delivery_method']; ?></span>
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
                  <!-- done button -->
                  <button name="done-button" id="done-button" class="btn btn-success font-size-12 m-1">Done</button>
                  <input type="hidden" name="delivery-id" id="delivery-id" value="<?= $delivery['delivery_id'] ?>">
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