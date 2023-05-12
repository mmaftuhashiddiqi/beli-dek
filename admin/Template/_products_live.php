<?php 

// usleep(500000);
require '../functions.php';

$keywordProductLive = $_GET["keyword-product-live"];

$products = cari($keywordProductLive);

?>

<table class="table table-hover text-center">
    <thead class="thead-dark">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Image</th>
            <th scope="col">Brand</th>
            <th scope="col">Name</th>
            <th scope="col">Stock</th>
            <th scope="col">Price</th>
            <th scope="col">Manage</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($products as $product) { ?>
            <tr>
                <th scope="row"><?= $i ?></th>
                <td><img src="./../assets/products/<?= $product['product_image'] ?>" alt="product" width="40"></td>
                <td><?= $product['product_brand'] ?></td>
                <td><?= $product['product_name'] ?></td>
                <td><?= $product['product_stock'] ?></td>
                <td>Rp. <?= $product['product_price'] ?></td>
                <td>
                    <form method="post">
                        <!-- update button -->
                        <a href="./update.php?id=<?= $product["product_id"]; ?>" id="update-button" class="text-decoration-none btn btn-info font-size-12 m-1">Update</a>
                        <!-- !update button -->

                        <!-- delete button -->
                        <a href="./Template/_delete_product.php?product_id=<?= $product['product_id']; ?>" id="delete-button" class="text-decoration-none btn btn-danger font-size-12 m-1" onclick="return confirm('yakin?');">Delete</a>
                        <!-- !update button -->
                    </form>
                </td>
            </tr>
        <?php $i++; ?>
        <?php } ?>
    </tbody>
</table>