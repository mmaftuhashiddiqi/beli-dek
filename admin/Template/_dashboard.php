<?php

$productCount = count($product->getData());
$adminCount = count($product->getData('admins'));
$userCount = count($product->getData('users'));
$orderCount = count($product->getData('orders'));

?>

<section id="dashboard">
    <div class="container" style="margin-top: 80px;">
        <h4 class="font-rubik font-size-20">Dashboard</h4>
        <hr>

        <div class="d-flex justify-content-center">
            <div class="card border-primary m-3" style="max-width: 18rem;">
                <div class="card-header">Products Total</div>
                <div class="card-body text-primary">
                    <div class="text-primary"><i class="fas fa-shopping-bag fa-lg m-2"></i><i class="fas fa-arrow-right m-2"></i><span class="m-2"><?= $productCount ?></span></div>
                    <p class="card-text">There are <?= $productCount ?> products on this website.</p>
                </div>
            </div>
            <div class="card border-secondary m-3" style="max-width: 18rem;">
                <div class="card-header">Admins Total</div>
                <div class="card-body text-secondary">
                    <div class="text-secondary"><i class="fas fa-users-cog fa-lg m-2"></i><i class="fas fa-arrow-right m-2"></i><span class="m-2"><?= $adminCount ?></span></div>
                    <p class="card-text">There are <?= $adminCount ?> admins who use this website.</p>
                </div>
            </div>
            <div class="card border-success m-3" style="max-width: 18rem;">
                <div class="card-header">Users Total</div>
                <div class="card-body text-success">
                    <div class="text-success"><i class="fas fa-users fa-lg m-2"></i><i class="fas fa-arrow-right m-2"></i><span class="m-2"><?= $userCount ?></span></div>
                    <p class="card-text">There are <?= $userCount ?> users using this website.</p>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="card border-danger m-3" style="max-width: 18rem;">
                <div class="card-header">Orders Total</div>
                <div class="card-body text-danger">
                    <div class="text-danger"><i class="fas fa-shopping-cart fa-lg m-2"></i><i class="fas fa-arrow-right m-2"></i><span class="m-2"><?= $orderCount ?></span></div>
                    <p class="card-text"><?= $orderCount ?> orders are happening on this website.</p>
                </div>
            </div>
            <div class="card border-warning m-3" style="max-width: 18rem;">
                <div class="card-header">Transactions Total</div>
                <div class="card-body text-warning">
                    <div class="text-warning"><i class="fas fa-file-invoice-dollar m-2"></i><i class="fas fa-arrow-right m-2"></i><span class="m-2">100</span></div>
                    <p class="card-text">There have been 100 transactions on this website.</p>
                </div>
            </div>
        </div>
    </div>
</section>