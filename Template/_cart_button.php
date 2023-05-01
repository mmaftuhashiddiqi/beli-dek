<!-- chart button -->
<form action="#" class="font-size-16 font-rale d-flex justify-content-end mr-5 mb-5" style="position: fixed; right: 0; bottom: 0; z-index: 100;">
    <a href="cart.php" class="d-flex justify-content-center align-items-center rounded-circle bg-primary shadow badge-info" style="width: 50px; height: 50px; text-decoration: none;">
        <span class="d-flex justify-content-center font-size-18 text-white"><i class="fas fa-shopping-cart"></i></span>
    </a>
    <span class="d-flex justify-content-center rounded-circle text-white bg-dark font-size-12" style="width: 20px; height: 20px; position: absolute;"><?php echo count($product->getDataCart('cart')); ?></span>
</form>
<!-- !chart button -->