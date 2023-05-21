<?php

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
  if (!empty($_POST['inputPaymentMethod'])) {
    // cek apakah data berhasil di tambahkan atau tidak
    if (tambah($_POST) > 0) {
      echo "
			<script>
				alert('data berhasil ditambahkan!');
				document.location.href = 'products.php';
			</script>
		";
    } else {
      echo "
			<script>
				alert('data gagal ditambahkan!');
				document.location.href = 'products.php';
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

<!-- add product -->
<form action="" method="post" enctype="multipart/form-data" style="margin-top: 100px; margin-bottom: 100px; margin-left: 25vw; margin-right: 25vw;">
  <h4 class="font-rubik font-size-20">Add Product</h4>
  <hr class="mb-5">

  <div class="form-group">
    <label for="inputBrandName">Nama Brand</label>
    <input type="text" name="inputBrandName" class="form-control" id="inputBrandName" placeholder="Brand Name" required>
  </div>
  <div class="form-group">
    <label for="inputProductName">Nama Produk</label>
    <input type="text" name="inputProductName" class="form-control" id="inputProductName" placeholder="Product Name" required>
  </div>
  <div class="form-group">
    <label for="inputProductDesc">Deskripsi Produk</label>
    <textarea name="inputProductDesc" class="form-control" id="inputProductDesc" placeholder="Product Description" rows="7"></textarea>
  </div>
  <div class="form-group">
    <label for="inputProductPrice">Stok Produk</label>
    <input type="number" name="inputProductStock" class="form-control" id="inputProductStock" placeholder="Product Stock" required>
  </div>
  <div class="form-group">
    <label for="inputProductPrice">Harga Produk</label>
    <input type="number" name="inputProductPrice" class="form-control" id="inputProductPrice" placeholder="Product Price" required>
  </div>
  <div class="form-group">
    <label for="inputPaymentMethod">Metode Pembayaran</label>
    <!-- debit card method -->
    <div class="input-group mb-1">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <input type="checkbox" name="inputPaymentMethod[]" id="inputPaymentMethodDebitcard" value="Debit Card">
        </div>
      </div>
      <label class="form-control" for="inputPaymentMethodDebitcard" style="background-color: #E9ECEF;">Debit Card</label>
    </div>
    <!-- paypal method -->
    <div class="input-group mb-1">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <input type="checkbox" name="inputPaymentMethod[]" id="inputPaymentMethodPaypal" value="PayPal">
        </div>
      </div>
      <label class="form-control" for="inputPaymentMethodPaypal" style="background-color: #E9ECEF;">PayPal</label>
    </div>
    <!-- cash method -->
    <div class="input-group mb-1">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <input type="checkbox" name="inputPaymentMethod[]" id="inputPaymentMethodCash" value="Cash">
        </div>
      </div>
      <label class="form-control" for="inputPaymentMethodCash" style="background-color: #E9ECEF;">Cash</label>
    </div>
  </div>
  <div class="form-group">
    <label for="inputProductImage">Gambar Produk</label>
    <div class="custom-file">
      <input type="file" name="inputProductImage" id="inputProductImage" style="opacity: 1;" required>
    </div>
  </div>

  <div class="py-3">
    <button type="submit" name="submit" class="btn btn-primary mr-2">Add Product</button>
    <a href="products.php" class="btn btn-danger">Cancel</a>
  </div>
</form>
<!-- !add product -->