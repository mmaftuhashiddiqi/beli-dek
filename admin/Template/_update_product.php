<?php

// ambil data di URL
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$products = query("SELECT * FROM products WHERE product_id = $id")[0];

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
  if (!empty($_POST['inputPaymentMethod']) && !empty($_POST['inputDeliveryMethod'])) {
    // cek apakah data berhasil diubah atau tidak
    if (ubah($_POST) > 0) {
      echo "
			<script>
				alert('product modified successfully!');
				document.location.href = './products.php';
			</script>
		";
    } else {
      echo "
			<script>
				alert('product failed to change!');
				document.location.href = './products.php';
			</script>
		";
    }
  } else {
    echo "
    <script>
      alert('please select at least one option!');
    </script>
    ";
  }
}

?>

<!-- update product -->
<form action="" method="post" enctype="multipart/form-data" style="margin-top: 100px; margin-bottom: 100px; margin-left: 25vw; margin-right: 25vw;">
  <input type="hidden" name="id" value="<?= $products["product_id"]; ?>">
  <input type="hidden" name="inputProductImageOld" value="<?= $products["product_image"]; ?>">

  <h4 class="font-rubik font-size-20">Update Product (<?= $products["product_name"] ?>)</h4>
  <hr class="mb-5">

  <div class="form-group">
    <label for="inputBrandName">Nama Brand</label>
    <input type="text" name="inputBrandName" class="form-control" id="inputBrandName" value="<?= $products["product_brand"]; ?>" required>
  </div>
  <div class="form-group">
    <label for="inputProductName">Nama Produk</label>
    <input type="text" name="inputProductName" class="form-control" id="inputProductName" value="<?= $products["product_name"]; ?>" required>
  </div>
  <div class="form-group">
    <label for="inputProductDesc">Deskripsi Produk</label>
    <textarea name="inputProductDesc" class="form-control" id="inputProductDesc" rows="7"><?= $products["product_desc"]; ?></textarea>
  </div>
  <div class="form-group">
    <label for="inputProductPrice">Stok Produk</label>
    <input type="number" name="inputProductStock" class="form-control" id="inputProductStock" value="<?= $products["product_stock"]; ?>" required>
  </div>
  <div class="form-group">
    <label for="inputProductPrice">Harga Produk</label>
    <input type="number" name="inputProductPrice" class="form-control" id="inputProductPrice" value="<?= $products["product_price"]; ?>" required>
  </div>
  <div class="form-group">
    <?php
    $paymentMethod = json_decode($products["payment_method"]);
    ?>
    <label for="inputPaymentMethod">Metode Pembayaran</label>
    <!-- debit card method -->
    <div class="input-group mb-1">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <input type="checkbox" name="inputPaymentMethod[]" id="inputPaymentMethodDebitcard" <?php echo in_array("Debit Card", $paymentMethod) ? 'checked' : 0 ?> value="Debit Card">
        </div>
      </div>
      <label class="form-control" for="inputPaymentMethodDebitcard" style="background-color: #E9ECEF;">Debit Card</label>
    </div>
    <!-- paypal method -->
    <div class="input-group mb-1">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <input type="checkbox" name="inputPaymentMethod[]" id="inputPaymentMethodPaypal" <?php echo in_array("PayPal", $paymentMethod) ? 'checked' : 0 ?> value="PayPal">
        </div>
      </div>
      <label class="form-control" for="inputPaymentMethodPaypal" style="background-color: #E9ECEF;">PayPal</label>
    </div>
    <!-- cash method -->
    <div class="input-group mb-1">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <input type="checkbox" name="inputPaymentMethod[]" id="inputPaymentMethodCash" <?php echo in_array("Cash", $paymentMethod) ? 'checked' : 0 ?> value="Cash">
        </div>
      </div>
      <label class="form-control" for="inputPaymentMethodCash" style="background-color: #E9ECEF;">Cash</label>
    </div>
  </div>
  <div class="form-group">
    <?php
    $deliveryMethod = json_decode($products["delivery_method"]);
    ?>
    <label for="inputDeliveryMethod">Metode Pengiriman</label>
    <!-- debit card method -->
    <div class="input-group mb-1">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <input type="checkbox" name="inputDeliveryMethod[]" id="inputDeliveryMethodSiTurbo" <?php echo in_array("SiTurbo", $deliveryMethod) ? 'checked' : 0 ?> value="SiTurbo">
        </div>
      </div>
      <label class="form-control" for="inputDeliveryMethodSiTurbo" style="background-color: #E9ECEF;">SiTurbo</label>
    </div>
    <!-- paypal method -->
    <div class="input-group mb-1">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <input type="checkbox" name="inputDeliveryMethod[]" id="inputDeliveryMethodMaungParcel" <?php echo in_array("Maung Parcel", $deliveryMethod) ? 'checked' : 0 ?> value="Maung Parcel">
        </div>
      </div>
      <label class="form-control" for="inputDeliveryMethodMaungParcel" style="background-color: #E9ECEF;">Maung Parcel</label>
    </div>
    <!-- cash method -->
    <div class="input-group mb-1">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <input type="checkbox" name="inputDeliveryMethod[]" id="inputDeliveryMethodJNE" <?php echo in_array("JNE", $deliveryMethod) ? 'checked' : 0 ?> value="JNE">
        </div>
      </div>
      <label class="form-control" for="inputDeliveryMethodJNE" style="background-color: #E9ECEF;">Cash</label>
    </div>
  </div>
  <div class="form-group">
    <label for="inputProductImage">Gambar Produk</label>
    <div class="custom-file">
      <img src="./../assets/products/<?= $products['product_image']; ?>" width="70"> <br>
      <input type="file" name="inputProductImage" id="inputProductImage" style="opacity: 1;">
    </div>
  </div>

  <div class="py-3">
    <button type="submit" name="submit" class="btn btn-primary mr-2">Update Product</button>
    <a href="products.php" class="btn btn-danger">Cancel</a>
  </div>
</form>
<!-- !update product -->