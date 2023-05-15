<!-- Shopping cart section  -->
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['delete-cart-submit'])) {
    $deletedrecord = $Cart->deleteCart($_POST['product_id'], $_POST['user_id']);
  }

  // save for later
  if (isset($_POST['wishlist-submit'])) {
    $Cart->saveForLater($_POST['product_id'], $_POST['user_id']);
  }

  // proceed to buy
  if (isset($_POST['proceed-to-buy'])) {
    $Cart->proceedToBuy($_POST['user_id']);
  }

  // increase product amount
  if (isset($_POST['qty-up'])) {
    $Cart->amountInc($_POST['product_id']);
  }

  // decrease product amount
  if (isset($_POST['qty-down'])) {
    $Cart->amountDec($_POST['product_id']);
  }
}

?>

<section id="cart" class="py-5 mb-5" style="margin-top: 60px;">
  <div class="container-fluid w-75">
    <h5 class="font-baloo font-size-20">Shopping Cart</h5>

    <!--  shopping cart products   -->
    <div class="row">
      <div class="col-sm-9">
        <?php
        foreach ($Cart->getDataCart('carts') as $products) :
          $cart = $product->getProduct($products['product_id']);
          $subTotal[] = array_map(function ($products) {
        ?>

            <!-- cart product -->
            <div class="row border-top py-3 mt-3">
              <div class="col-sm-2">
                <img src="./assets/products/<?php echo $products['product_image'] ?? "./assets/products/product-template.jpg" ?>" style="height: 120px;" alt="product" class="img-fluid">
              </div>
              <div class="col-sm-8">
                <h5 class="font-baloo font-size-20"><?php echo $products['product_name'] ?? "Unknown"; ?></h5>
                <small>by <?php echo $products['product_brand'] ?? "Brand"; ?></small>

                <!-- product rating -->
                <div class="d-flex">
                  <div class="rating text-warning font-size-12">
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="far fa-star"></i></span>
                  </div>
                  <a href="#" class="px-2 font-rale font-size-14">20,534 ratings</a>
                </div>
                <!-- !product rating -->

                <?php
                // product amount
                $amount = query("SELECT product_count FROM carts WHERE product_id = {$products['product_id']} AND user_id = {$_SESSION['user']}");
                $productAmount = $amount[0]['product_count'];
                ?>

                <!-- product qty -->
                <div class="qty d-flex pt-2">
                  <div class="d-flex font-rale w-25">
                    <!-- increase amount -->
                    <form method="post" class="d-flex font-rale w-25">
                      <input type="hidden" value="<?php echo $products['product_id'] ?? 0; ?>" name="product_id">
                      <button class="qty-up border bg-light" type="submit" name="qty-up" <?= $productAmount == 10 ? 'disabled' : ''; ?>><i class="fas fa-angle-up"></i></button>
                    </form>

                    <!-- amount -->
                    <input type="text" class="qty_input border px-2 w-100 bg-light" disabled value="<?= $productAmount ?>">

                    <!-- decrease amount -->
                    <form method="post" class="d-flex font-rale w-25">
                      <input type="hidden" value="<?php echo $products['product_id'] ?? 0; ?>" name="product_id">
                      <button class="qty-down border bg-light" type="submit" name="qty-down" <?= $productAmount == 1 ? 'disabled' : ''; ?>><i class="fas fa-angle-down"></i></button>
                    </form>
                  </div>

                  <form method="post">
                    <input type="hidden" value="<?php echo $products['product_id'] ?? 0; ?>" name="product_id">
                    <input type="hidden" value="<?php echo $_SESSION['user'] ?? 0; ?>" name="user_id">
                    <button type="submit" name="delete-cart-submit" class="btn font-baloo text-danger px-3 border-right">Delete</button>
                  </form>

                  <form method="post">
                    <input type="hidden" value="<?php echo $products['product_id'] ?? 0; ?>" name="product_id">
                    <input type="hidden" value="<?php echo $_SESSION['user'] ?? 0; ?>" name="user_id">
                    <button type="submit" name="wishlist-submit" class="btn font-baloo text-danger">Save for Later</button>
                  </form>
                </div>
                <!-- !product qty -->

              </div>
              <div class="col-sm-2 text-right">
                <div class="text-danger font-baloo">
                  <span class="product_price" data-id="<?php echo $products['product_id'] ?? '0'; ?>"><?php echo rupiah($products['product_price'] * $productAmount) ?? 0; ?></span>
                </div>
              </div>
            </div>
            <!-- !cart product -->

        <?php
            return $products['product_price'];
          }, $cart); // closing array_map function
        endforeach;
        ?>
      </div>

      <!-- subtotal section-->
      <div class="col-sm-3">
        <div class="sub-total border text-center mt-2">
          <h6 class="font-size-12 font-rale text-success py-3"><i class="fas fa-check"></i> Your order is eligible for FREE Delivery.</h6>
          <div class="border-top py-4">
            <h5 class="font-baloo font-size-20">Subtotal ( <?php echo isset($subTotal) ? count($subTotal) : 0; ?> product):&nbsp; <div class="text-danger"><span class="text-danger" id="deal-price"><?php echo isset($subTotal) ? rupiah($Cart->getSumPrice()) : rupiah(0); ?></span> </div>
            </h5>
            <form action="" method="post">
              <input type="hidden" value="<?php echo $_SESSION['user'] ?? 0; ?>" name="user_id">
              <button type="submit" name="proceed-to-buy" class="btn btn-warning mt-3">Proceed to Buy</button>
            </form>
          </div>
        </div>
      </div>
      <!-- !subtotal section-->

    </div>
    <!-- !shopping cart products -->

  </div>
</section>
<!-- !Shopping cart section -->