<?php

// usleep(500000);
require 'functions.php';

$keywordOrderLive = $_GET["keyword-order-live"];

$orders = cariOrder($keywordOrderLive);

?>

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