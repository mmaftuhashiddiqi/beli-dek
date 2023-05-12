<!-- Shopping cart section  -->
<?php

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    if ( isset($_POST['delete-cart-submit']) ) {
        $deletedrecord = $Cart->deleteCart($_POST['product_id'], $_POST['user_id'], 'wishlists');
    }

    if ( isset($_POST['cart-submit']) ) {
        $Cart->saveForLater($_POST['product_id'], $_POST['user_id'], 'carts', 'wishlists');
    }
}

?>

<section id="cart" class="py-3 mb-5">
    <div class="container-fluid w-75">
        <h5 class="font-baloo font-size-20">Wishlist</h5>

        <!--  shopping cart items   -->
        <div class="row">
            <div class="col-sm-9">
                <?php
                foreach ($Cart->getDataCart('wishlists') as $products) :
                    $cart = $product->getProduct($products['product_id']);
                    $subTotal[] = array_map(function ($products){
                ?>

                <!-- cart item -->
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
                        <!--  !product rating-->

                        <!-- product qty -->
                        <div class="qty d-flex pt-2">
                            <form method="post">
                                <input type="hidden" value="<?php echo $products['product_id'] ?? 0; ?>" name="product_id">
                                <input type="hidden" value="<?php echo $_SESSION['user'] ?? 0; ?>" name="user_id">
                                <button type="submit" name="delete-cart-submit" class="btn font-baloo text-danger pl-0 pr-3 border-right">Delete</button>
                            </form>

                            <form method="post">
                                <input type="hidden" value="<?php echo $products['product_id'] ?? 0; ?>" name="product_id">
                                <input type="hidden" value="<?php echo $_SESSION['user'] ?? 0; ?>" name="user_id">
                                <button type="submit" name="cart-submit" class="btn font-baloo text-danger">Add to Cart</button>
                            </form>
                        </div>
                        <!-- !product qty -->

                    </div>

                    <div class="col-sm-2 text-right">
                        <div class="font-size-20 text-danger font-baloo">
                            Rp. <span class="product_price" data-id="<?php echo $products['product_id'] ?? '0'; ?>"><?php echo $products['product_price'] ?? 0; ?></span>
                        </div>
                    </div>
                </div>
                <!-- !cart item -->
    
                <?php
                return $products['product_price'];
                }, $cart); // closing array_map function
                endforeach;
                ?>
            </div>
        </div>
        <!--  !shopping cart items   -->

    </div>
</section>
<!-- !Shopping cart section  -->