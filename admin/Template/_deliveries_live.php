<?php

// usleep(500000);
require 'functions.php';

$keywordDeliveryLive = $_GET["keyword-delivery-live"];

$deliveries = cariDelivery($keywordDeliveryLive);

?>

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