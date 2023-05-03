<!-- Special Price -->
<?php

// tombol cari ditekan
if ( isset($_POST["search"]) ) {
    $product_shuffle = cari($_POST["keyword"]);
}

$brand = array_map(function ($pro){ return $pro['item_brand']; }, $product_shuffle);
$unique = array_unique($brand);
sort($unique);
shuffle($product_shuffle);

$in_cart = $Cart->getCartId($product->getData('cart'));

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
            <?php array_map(function ($item) use($in_cart) { ?>
            <div class="grid-item border <?php echo $item['item_brand'] ?? "Brand" ; ?>">
                <div class="item py-2" style="width: 200px;">
                    <div class="product font-rale">
                        <a href="<?php printf('%s?item_id=%s', 'product.php',  $item['item_id']); ?>"><img src="./../assets/products/<?php echo $item['item_image'] ?? "./../assets/products/product-template.jpg"; ?>" alt="product" class="img-fluid"></a>
                        <div class="text-center">
                            <h6><?php echo $item['item_name'] ?? "Unknown"; ?></h6>
                            <div class="rating text-warning font-size-12">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="far fa-star"></i></span>
                            </div>
                            <div class="price py-2">
                                <span>$<?php echo $item['item_price'] ?? 0 ?></span>
                            </div>
                            <form method="post">
                                <!-- update button -->
                                <a href="./update.php?id=<?= $item["item_id"]; ?>" id="update-button" class="text-decoration-none btn btn-info font-size-12 m-1">Update</a>
                                <!-- !update button -->

                                <!-- delete button -->
                                <a href="./Template/_delete_product.php?id=<?= $item['item_id']; ?>" id="delete-button" class="text-decoration-none btn btn-danger font-size-12 m-1" onclick="return confirm('yakin?');">Delete</a>
                                <!-- !update button -->
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
