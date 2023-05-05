<?php

shuffle($product_shuffle);

// tombol cari ditekan
if ( isset($_POST["search"]) ) {
    $product_shuffle = cari($_POST["keyword"]);
}

// sorted by
if ( isset($_POST["ascending-price"]) ) {
    $product_shuffle = sortedBy("ASC");
} elseif ( isset($_POST["descending-price"]) ) {
    $product_shuffle = sortedBy("DESC");
} elseif ( isset($_POST["shuffle"]) ) {
    $product_shuffle = cari("");
}

?>

<section id="products-list">
    <div class="container" style="margin-top: 120px;">
        <h4 class="font-rubik font-size-20">Order of Products</h4>
        <hr>

        <div class="container d-flex justify-content-end pt-2 pb-4 pr-0">
            <!-- live search -->
            <div class="live-search d-flex">
                <form class="form-inline d-flex justify-content-end" action="" method="post">
                    <img src="./../assets/template/loader.gif" class="loader d-none" width="50"">
                    <input class="form-control mr-sm-2" type="search" placeholder="Live search" aria-label="Search" name="keyword-live" autocomplete="off" id="keyword-live">
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
                        <button class="dropdown-item" type="submit" name="shuffle" id="shuffle">Shuffle</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="table-container">
            <table class="table table-hover text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Product Brand</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Price</th>
                        <th scope="col">Product Count</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($product_shuffle as $item) { ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><img src="./../assets/products/<?= $item['item_image'] ?>" alt="product" width="40"></td>
                            <td><?= $item['item_brand'] ?></td>
                            <td><?= $item['item_name'] ?></td>
                            <td>$<?= $item['item_price'] ?></td>
                            <td>$<?= $item['item_price'] ?></td>
                            <td>$<?= $item['item_price'] ?></td>
                            <td>
                                <form method="post">
                                    <!-- process button -->
                                    <a href="#" id="process-button" class="text-decoration-none btn btn-info font-size-12 m-1">Process</a>
                                    <!-- !process button -->
                                </form>
                            </td>
                        </tr>
                    <?php $i++; ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>