<!-- New Phones -->
<?php

// tombol cari ditekan
if (isset($_POST["search"])) {
  $product_shuffle = cari($_POST["keyword"]);
}

shuffle($product_shuffle);

// request method post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (isset($_POST['new_phones_submit'])) {
    // call method addToCart
    $Cart->addToCart($_POST['user_id'], $_POST['product_id']);
  }
}

?>

<section id="new-phones">
  <div class="container">
    <h4 class="font-rubik font-size-20">New Phones</h4>
    <hr>

    <!-- owl carousel -->
    <div class="owl-carousel owl-theme">
      <?php foreach ($product_shuffle as $products) { ?>
        <div class="item py-2">
          <div class="product font-rale">
            <a href="<?php printf('%s?product_id=%s', 'product.php',  $products['product_id']); ?>"><img src="./assets/products/<?php echo $products['product_image'] ?? "./assets/products/product-template.jpg"; ?>" alt="product" class="img-fluid"></a>
            <div class="text-center">
              <h6><?php echo  $products['product_name'] ?? "Unknown";  ?></h6>
              <div class="rating text-warning font-size-12">
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="far fa-star"></i></span>
              </div>
              <div class="price py-2">
                <span><?php echo rupiah($products['product_price']) ?? '0'; ?></span>
              </div>
              <form method="post">
                <input type="hidden" name="product_id" value="<?php echo $products['product_id'] ?? '1'; ?>">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']; ?>">
                <?php
                if (in_array($products['product_id'], $Cart->getCartId($Cart->getDataCart('carts')) ?? [])) {
                  echo '<button type="submit" disabled id="add-to-chart-button" class="btn btn-success font-size-12 m-1">In the Cart</button>';
                } else if (in_array($products['product_id'], $Cart->getCartId($Cart->getDataCart('wishlists')) ?? [])) {
                  echo '<button type="submit" disabled id="add-to-wishlist-button" class="btn btn-success font-size-12 m-1">In the Wishlist</button>';
                } else {
                  echo '<button type="submit" name="new_phones_submit" id="add-to-chart-button" class="btn btn-warning font-size-12 m-1">Add to Cart</button>';
                }
                ?>
              </form>
            </div>
          </div>
        </div>
      <?php } // closing foreach function 
      ?>
    </div>
    <!-- !owl carousel -->

  </div>
</section>
<!-- !New Phones -->