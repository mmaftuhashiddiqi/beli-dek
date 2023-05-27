<?php

// usleep(500000);
require 'functions.php';

$keywordProductLive = $_GET["keyword-product-live"];

$products = cari($keywordProductLive);

?>

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
      <th scope="col" class="align-middle">Delivery</th>
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
          <?php
          $deliveryMethod = json_decode($product['delivery_method']);
          foreach ($deliveryMethod as $delivery) {
          ?>
            <p class="bg-secondary text-white rounded d-inline-block p-1 m-1"><?= $delivery ?></p>
          <?php } ?>
        </td>
        <td class="align-middle">
          <form method="post">
            <!-- update button -->
            <a href="./update.php?id=<?= $product["product_id"]; ?>" id="update-button" class="text-decoration-none btn btn-info font-size-12 m-1">Update</a>
            <!-- !update button -->

            <!-- delete button -->
            <a href="delete.php?product_id=<?= $product['product_id']; ?>" id="delete-button" class="text-decoration-none btn btn-danger font-size-12 m-1" onclick="return confirm('are you sure?');">Delete</a>
            <!-- !update button -->
          </form>
        </td>
      </tr>
      <?php $i++; ?>
    <?php } ?>
  </tbody>
</table>