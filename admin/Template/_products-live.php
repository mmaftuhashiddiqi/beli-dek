<?php 

usleep(500000);
require '../functions.php';

$keywordLive = $_GET["keyword-live"];

$query = "SELECT * FROM product
            WHERE
          item_name LIKE '%$keywordLive%' OR
          item_brand LIKE '%$keywordLive%'
        ";
$product_shuffle = query($query);

?>

<div id="table-container">
    <table class="table table-hover">
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
            <?php foreach ($product_shuffle as $item) { ?>
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