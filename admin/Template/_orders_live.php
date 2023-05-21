<?php

// usleep(500000);
require '../functions.php';

$keywordOrderLive = $_GET["keyword-order-live"];

$orders = cariOrder($keywordOrderLive);

?>

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
        <td class="align-middle">
          <p class="bg-info text-white rounded d-inline-block p-1 m-1"><?= $order['payment_method'] ?></p>
        </td>
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