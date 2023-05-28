<!--   product  -->
<?php

$product_id = $_GET['product_id'] ?? 1;
foreach ($product->getData() as $products) :
  if ($products['product_id'] == $product_id) :

    // cek apakah tombol submit sudah ditekan atau belum
    if (isset($_POST["submit"])) {
      if (!empty($_POST['inputComment'])) {
        // cek apakah data berhasil di tambahkan atau tidak
        $comment->addComment($_POST);
      }
    }

?>

    <section id="product" class="py-5" style="margin-top: 60px">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <img src="./assets/products/<?php echo $products['product_image'] ?? "./assets/products/product-template.jpg" ?>" alt="product" class="img-fluid">
            <div class="form-row pt-4 font-size-16 font-baloo">
              <div class="col">
                <button type="submit" class="btn btn-danger form-control">Proceed to Buy</button>
              </div>
              <div class="col">
                <?php
                if (in_array($products['product_id'], $Cart->getCartId($product->getData('carts')) ?? [])) {
                  echo '<button type="submit" disabled class="btn btn-success font-size-16 form-control">In the Cart</button>';
                } else {
                  echo '<button type="submit" name="top_sale_submit" class="btn btn-warning font-size-16 form-control">Add to Cart</button>';
                }
                ?>
              </div>
            </div>
          </div>
          <div class="col-sm-6 py-5">
            <h5 class="font-baloo font-size-20"><?php echo $products['product_name'] ?? "Unknown"; ?></h5>
            <small>by <?php echo $products['product_brand'] ?? "Brand"; ?></small>
            <div class="d-flex">
              <div class="rating text-warning font-size-12">
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="far fa-star"></i></span>
              </div>
              <a href="#" class="px-2 font-rale font-size-14">20,534 ratings | 1000+ answered questions</a>
            </div>
            <hr class="m-0">

            <!--- product price -->
            <table class="my-3">
              <tr class="font-rale font-size-14">
                <td>M.R.P:</td>
                <td><strike><?= rupiah($products['product_price'] + 1200000) ?></strike></td>
              </tr>
              <tr class="font-rale font-size-14">
                <td>Deal Price:</td>
                <td class="font-size-20 text-danger"><span><?php echo rupiah($products['product_price']) ?? 0; ?></span><small class="text-dark font-size-12">&nbsp;&nbsp;Inclusive of all taxes</small></td>
              </tr>
              <tr class="font-rale font-size-14">
                <td>You Save:</td>
                <td><span class="font-size-16 text-danger"><?= rupiah(1200000) ?></span></td>
              </tr>
            </table>
            <!--- !product price -->

            <!-- policy -->
            <div id="policy">
              <div class="d-flex">
                <div class="return text-center mr-5">
                  <div class="font-size-20 my-2 color-second">
                    <span class="fas fa-retweet border p-3 rounded-pill"></span>
                  </div>
                  <a href="#" class="font-rale font-size-12">10 Days <br> Replacement</a>
                </div>
                <div class="return text-center mr-5">
                  <div class="font-size-20 my-2 color-second">
                    <span class="fas fa-truck  border p-3 rounded-pill"></span>
                  </div>
                  <a href="#" class="font-rale font-size-12">Daily Tuition <br>Deliverd</a>
                </div>
                <div class="return text-center mr-5">
                  <div class="font-size-20 my-2 color-second">
                    <span class="fas fa-check-double border p-3 rounded-pill"></span>
                  </div>
                  <a href="#" class="font-rale font-size-12">1 Year <br>Warranty</a>
                </div>
              </div>
            </div>
            <!-- !policy -->

            <hr>

            <!-- order-details -->
            <div id="order-details" class="font-rale d-flex flex-column text-dark">
              <small>Delivery by : Mar 29 - Apr 1</small>
              <small>Sold by <a href="#">Daily Electronics </a>(4.5 out of 5 | 18,198 ratings)</small>
              <small><i class="fas fa-map-marker-alt color-primary"></i>&nbsp;&nbsp;Deliver to Customer - 424201</small>
            </div>
            <!-- !order-details -->

            <div class="row">
              <div class="col-6">

                <!-- color -->
                <div class="color my-3">
                  <div class="d-flex justify-content-between">
                    <h6 class="font-baloo">Color:</h6>
                    <div class="p-2 color-yellow-bg rounded-circle"><button class="btn font-size-14"></button></div>
                    <div class="p-2 color-primary-bg rounded-circle"><button class="btn font-size-14"></button></div>
                    <div class="p-2 color-second-bg rounded-circle"><button class="btn font-size-14"></button></div>
                  </div>
                </div>
                <!-- !color -->

              </div>
              <div class="col-6">

                <!-- product qty section -->
                <div class="qty d-flex">
                  <h6 class="font-baloo">Qty</h6>
                  <div class="px-4 d-flex font-rale">
                    <button class="qty-up border bg-light" data-id="pro1"><i class="fas fa-angle-up"></i></button>
                    <input type="text" data-id="pro1" class="qty_input border px-2 w-50 bg-light" disabled value="1" placeholder="1">
                    <button data-id="pro1" class="qty-down border bg-light"><i class="fas fa-angle-down"></i></button>
                  </div>
                </div>
                <!-- !product qty section -->

              </div>
            </div>

            <!-- size -->
            <div class="size my-3">
              <h6 class="font-baloo">Size :</h6>
              <div class="d-flex justify-content-between w-75">
                <div class="font-rubik border p-2">
                  <button class="btn p-0 font-size-14">4GB RAM</button>
                </div>
                <div class="font-rubik border p-2">
                  <button class="btn p-0 font-size-14">8GB RAM</button>
                </div>
                <div class="font-rubik border p-2">
                  <button class="btn p-0 font-size-14">16GB RAM</button>
                </div>
              </div>
            </div>
            <!-- !size -->

          </div>

          <!-- description -->
          <div class="col-12">
            <h6 class="font-rubik">Product Description</h6>
            <hr>
            <p class="font-rale font-size-14"><?php echo nl2br($products['product_desc']) ?></p>
          </div>
          <!-- !description -->

          <!-- comment -->
          <div class="col-12 mt-5">
            <div class="mb-5">
              <form action="" method="post">
                <div class="form-group">
                  <label class="font-rubik mb-3" for="inputComment">Leave Comment</label>
                  <textarea name="inputComment" class="form-control bg-light" id="inputComment" placeholder="Leave Comment ..." rows="5" required></textarea>
                  <input type="hidden" name="product_id" value="<?= $products['product_id']; ?>">
                  <input type="hidden" name="user_id" value="<?= $_SESSION['user']; ?>">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
            <div>
              <p class="font-rubik">Comments</p>
              <?php
              $userComments = $comment->getComments($products["product_id"]);
              if (empty($userComments)) {
                echo '
                  <div class="bg-light rounded shadow-sm d-flex justify-content-center align-items-center p-4">
                    <span class="font-rale font-size-14 text-secondary">Comment not Found!</span>
                  </div>
                ';
              }
              foreach ($comment->getComments($products["product_id"]) as $comments) {
              ?>
                <div class="bg-light rounded shadow-sm p-3 mb-3">
                  <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="row">
                      <span class="ml-3">
                        <img src="./assets/template/profile-dark.png" alt="profile picture" width="40">
                      </span>
                      <span class="font-rubik ml-3">
                        <div>
                          <?= $comments["user_fullname"] != null ? $comments["user_fullname"] : $comments["user_username"]; ?>
                        </div>
                        <div class="font-rale font-size-12 text-secondary">
                          <?php
                          $phpDatetime = strtotime($comments["comment_date"]);
                          echo date("H.i", $phpDatetime);
                          ?>
                        </div>
                      </span>
                    </div>
                    <div>
                      <span class="font-rubik text-secondary">
                        <?php
                        $phpDatetime = strtotime($comments["comment_date"]);
                        echo date("F d, Y", $phpDatetime);
                        ?>
                      </span>
                    </div>
                  </div>
                  <div>
                    <p class="font-rale font-size-14"><?= nl2br($comments["comment_content"]); ?></p>
                  </div>
                  <div class="d-flex justify-content-end">
                    <div class="border border-secondary rounded mr-1 pl-1 pr-1">
                      <span class="text-secondary">10 |</span>
                      <button type="button" class="btn text-secondary p-0">
                        <i class="fas fa-thumbs-up border"></i>
                      </button>
                    </div>
                    <div class="border border-secondary rounded ml-1 pl-1 pr-1">
                      <span class="text-secondary">5 |</span>
                      <button type="button" class="btn text-secondary p-0">
                        <i class="fas fa-thumbs-down"></i>
                      </button>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
          <!-- !comment -->
        </div>
      </div>
    </section>
    <!--   !product  -->

<?php

  endif;
endforeach;

?>