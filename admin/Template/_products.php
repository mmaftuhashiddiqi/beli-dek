<?php

// konfigurasi pagination
$jumlahDataPerHalaman = 10;
$jumlahData = count(query("SELECT * FROM product"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;

$products = query("SELECT * FROM product LIMIT $awalData, $jumlahDataPerHalaman");

// tombol cari ditekan
if ( isset($_POST["search"]) ) {
    $products = cari($_POST["keyword"]);
}

// sorted by
if ( isset($_POST["ascending-price"]) ) {
    $products = sortedBy("ASC");
} elseif ( isset($_POST["descending-price"]) ) {
    $products = sortedBy("DESC");
} elseif ( isset($_POST["shuffle"]) ) {
    $products = cari("");
}

?>

<section id="products-list">
    <div class="container" style="margin-top: 120px;">
        <h4 class="font-rubik font-size-20">List of Products</h4>
        <hr>

        <div class="container d-flex justify-content-end pt-2 pb-4 pr-0">
            <!-- live search -->
            <div class="live-search d-flex">
                <form class="form-inline d-flex justify-content-end" action="" method="post">
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
        </div>

        <div id="table-container">
            <table class="table table-hover text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Price</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($products as $item) { ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><img src="./../assets/products/<?= $item['item_image'] ?>" alt="product" width="40"></td>
                            <td><?= $item['item_name'] ?></td>
                            <td><?= $item['item_brand'] ?></td>
                            <td>$<?= $item['item_price'] ?></td>
                            <td>
                                <form method="post">
                                    <!-- update button -->
                                    <a href="./update.php?id=<?= $item["item_id"]; ?>" id="update-button" class="text-decoration-none btn btn-info font-size-12 m-1">Update</a>
                                    <!-- !update button -->

                                    <!-- delete button -->
                                    <a href="./Template/_delete_product.php?id=<?= $item['item_id']; ?>" id="delete-button" class="text-decoration-none btn btn-danger font-size-12 m-1" onclick="return confirm('yakin?');">Delete</a>
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
                <?php if( $halamanAktif > 1 ) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php for( $i = 1; $i <= $jumlahHalaman; $i++ ) : ?>
                    <?php if( $i == $halamanAktif ) : ?>
                        <li class="page-item"><a class="page-link font-weight-bold text-danger" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
                    <?php else : ?>
                        <li class="page-item"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
                    <?php endif; ?>
                <?php endfor; ?>
                <?php if( $halamanAktif < $jumlahHalaman ) : ?>                    
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