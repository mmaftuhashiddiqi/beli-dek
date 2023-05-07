<?php 

// usleep(500000);
require '../functions.php';

$keywordOrderLive = $_GET["keyword-order-live"];

$orders = cariOrder($keywordOrderLive);

?>

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
        <?php
        foreach ($orders as $order) {
            // $producstOrder = $product->getProduct($order['item_id']);
            // $usersOrder = $product->getProduct($order['user_id'], 'user', 'user_id');
            // echo json_encode($producstOrder);
            // echo json_encode($usersOrder);
        ?>
            <tr>
                <th scope="row"><?= $i ?></th>
                <td><?= $order['username']; ?></td>
                <td><?= $order['item_brand']; ?></td>
                <td><?= $order['item_name']; ?></td>
                <td>$<?= $order['item_price']; ?></td>
                <td>1</td>
                <td>$<?= $order['item_price']; ?></td>
                <td>
                    <form method="post">
                        <!-- process button -->
                        <a href="#" id="process-button" class="text-decoration-none btn btn-warning font-size-12 m-1">Process</a>
                        <!-- !process button -->
                        
                        <!-- done button -->
                        <a href="./Template/_delete_order.php?item_id=<?= $order['item_id']; ?>&user_id=<?= $order['user_id']; ?>" id="done-button" class="text-decoration-none btn btn-success font-size-12 m-1">Done</a>
                        <!-- !done button -->
                    </form>
                </td>
            </tr>
        <?php $i++; ?>
        <?php } ?>
    </tbody>
</table>