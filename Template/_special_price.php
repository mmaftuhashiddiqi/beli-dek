<!-- Special Price -->
<?php

// tombol cari ditekan
if ( isset($_POST["search"]) ) {
    $product_shuffle = cari($_POST["keyword"]);
}

$brand = array_map(function ($pro){ return $pro['product_brand']; }, $product_shuffle);
$unique = array_unique($brand);
sort($unique);
shuffle($product_shuffle);

// request method post
if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {
    if ( isset($_POST['special_price_submit']) ) {
        // call method addToCart
        $Cart->addToCart($_POST['user_id'], $_POST['product_id']);
    }
}

$in_cart = $Cart->getCartId($Cart->getDataCart('carts'));
$in_wishlist = $Cart->getCartId($Cart->getDataCart('wishlists'));

?>

<section id="special-price">
    <div class="container">
        <h4 class="font-rubik font-size-20">Special Price</h4>
        <div id="filters" class="button-group text-right font-baloo font-size-16">
            <button class="btn is-checked" data-filter="*">All Brand</button>
            <?php
                array_map(function ($brand){
                    printf('<button class="btn" data-filter=".%s">%s</button>', $brand, $brand);
                }, $unique);
            ?>
        </div>

        <div class="grid">
            <?php array_map(function ($products) use($in_cart, $in_wishlist) { ?>
            <div class="grid-item border <?php echo $products['product_brand'] ?? "Brand" ; ?>">
                <div class="item py-2" style="width: 200px;">
                    <div class="product font-rale">
                        <a href="<?php printf('%s?product_id=%s', 'product.php',  $products['product_id']); ?>"><img src="./assets/products/<?php echo $products['product_image'] ?? "./assets/products/product-template.jpg"; ?>" alt="product" class="img-fluid"></a>
                        <div class="text-center">
                            <h6><?php echo $products['product_name'] ?? "Unknown"; ?></h6>
                            <div class="rating text-warning font-size-12">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="far fa-star"></i></span>
                            </div>
                            <div class="price py-2">
                                <span><?php echo rupiah($products['product_price']) ?? 0 ?></span>
                            </div>
                            <form method="post">
                                <input type="hidden" name="product_id" value="<?php echo $products['product_id'] ?? '1'; ?>">
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']; ?>">
                                <?php
                                if (in_array($products['product_id'], $in_cart ?? [])) {
                                    echo '<button type="submit" disabled id="add-to-chart-button" class="btn btn-success font-size-12 m-1">In the Cart</button>';
                                } else if (in_array($products['product_id'], $in_wishlist ?? [])) {
                                    echo '<button type="submit" disabled id="add-to-wishlist-button" class="btn btn-success font-size-12 m-1">In the Wishlist</button>';
                                } else {
                                    echo '<button type="submit" name="special_price_submit" id="add-to-chart-button" class="btn btn-warning font-size-12 m-1">Add to Cart</button>';
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php }, $product_shuffle) ?>
        </div>

    </div>
</section>
<!-- !Special Price -->
