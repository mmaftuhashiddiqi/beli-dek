<!-- checkout section  -->
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // proceed to buy
  if (isset($_POST['proceed-to-buy'])) {
    $payment->proceedToBuy($_SESSION['user'], $_POST['inputPaymentMethod']);
  }
}

?>

<section id="payment" class="container py-5 mb-5" style="margin-top: 60px;">
  <h5 class="font-baloo font-size-20">Checkout Form</h5>
  <hr>

  <div class="row">
    <div class="col-md-7">
      <h5 class="font-baloo text-muted">Payment Method</h5>
      <form class="needs-validation" method="post">
        <div class="d-block my-3">
          <?php
          foreach ($payment->getDataPayment() as $payments) {
            $paymentMethods = json_decode($payments['payment_method']);

            $paymentMethodArr = array();
            foreach ($paymentMethods as $paymentMethod) {
              if (!in_array($paymentMethod, $paymentMethodArr)) {
                array_push($paymentMethodArr, $paymentMethod);
              }
            }
          }

          foreach ($paymentMethodArr as $paymentMethods) {
          ?>
            <div class="input-group mb-1">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input type="radio" name="inputPaymentMethod" id="inputPaymentMethod<?= $paymentMethods ?>" value="<?= $paymentMethods ?>" required>
                </div>
              </div>
              <label class="form-control" for="inputPaymentMethod<?= $paymentMethods ?>" style="background-color: #E9ECEF;"><?= $paymentMethods ?></label>
            </div>
          <?php } ?>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="cc-name">Name on card</label>
            <input type="text" class="form-control" id="cc-name" placeholder="Name" required>
            <small class="text-muted">Full name as displayed on card</small>
            <div class="invalid-feedback">
              Name on card is required
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="cc-number">Credit card number</label>
            <input type="text" class="form-control" id="cc-number" placeholder="Credit number" required>
            <div class="invalid-feedback">
              Credit card number is required
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 mb-3">
            <label for="cc-expiration">Expiration</label>
            <input type="text" class="form-control" id="cc-expiration" placeholder="Expiration" required>
            <div class="invalid-feedback">
              Expiration date required
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="cc-cvv">CVV</label>
            <input type="text" class="form-control" id="cc-cvv" placeholder="CVV" required>
            <div class="invalid-feedback">
              Security code required
            </div>
          </div>
        </div>
        <div class="mt-3">
          <button class="btn btn-primary" type="submit" name="proceed-to-buy">Proceed to Buy</button>
        </div>
      </form>
    </div>
    <div class="col-md-5 mb-4">
      <h5 class="d-flex justify-content-between align-items-center mb-3">
        <span class="font-baloo text-muted">Your cart</span>
        <span class="badge badge-secondary badge-pill"><?= count(query("SELECT * FROM payments WHERE user_id = {$_SESSION['user']}")) ?></span>
      </h5>
      <ul class="list-group mb-3">
        <?php
        foreach ($payment->getDataPayment('payments') as $products) :
          $payments = $product->getProduct($products['product_id']);
          $subTotal[] = array_map(function ($products) {
        ?>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <?php
                // product amount
                $amount = query("SELECT product_count FROM payments WHERE product_id = {$products['product_id']} AND user_id = {$_SESSION['user']}");
                $productAmount = $amount[0]['product_count'];
                ?>
                <h6 class="my-0">
                  <?= $products['product_name'] ?>
                  <span class="text-success font-weight-bold">&times;</span>
                  <span class="badge badge-pill badge-success"><?= $productAmount ?></span>
                </h6>
                <small class="text-muted">By <?= $products['product_brand'] ?></small>
              </div>
              <span class="text-muted"><?= rupiah($products['product_price'] * $productAmount) ?></span>
            </li>
        <?php
            return $products['product_price'];
          }, $payments); // closing array_map function
        endforeach;
        ?>
        <li class="list-group-item d-flex justify-content-between bg-light">
          <div class="text-success">
            <h6 class="my-0">Promo code</h6>
            <small>No Events</small>
          </div>
          <span class="text-success">- <?= rupiah(0) ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (Rupiah)</span>
          <strong><?php echo isset($subTotal) ? rupiah($payment->getSumPrice()) : rupiah(0); ?></strong>
        </li>
      </ul>

      <form class="card p-2">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Promo code">
          <div class="input-group-append">
            <button type="submit" class="btn btn-warning">Redeem</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>