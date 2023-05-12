<?php

// ambil data di URL
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$products = query("SELECT * FROM products WHERE product_id = $id")[0];

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
	
	// cek apakah data berhasil diubah atau tidak
	if( ubah($_POST) > 0 ) {
		echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = './index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal diubah!');
				document.location.href = './index.php';
			</script>
		";
	}

}

?>

<!-- update product -->
<form action="" method="post" enctype="multipart/form-data" style="margin-top: 100px; margin-bottom: 100px; margin-left: 25vw; margin-right: 25vw;">
    <input type="hidden" name="id" value="<?= $products["product_id"]; ?>">
    <input type="hidden" name="inputProductImageOld" value="<?= $products["product_image"]; ?>">

    <div class="form-group">
        <label for="inputBrandName">Nama Brand</label>
        <input type="text" name="inputBrandName" class="form-control" id="inputBrandName" value="<?= $products["product_brand"]; ?>">
    </div>
    <div class="form-group">
        <label for="inputProductName">Nama Produk</label>
        <input type="text" name="inputProductName" class="form-control" id="inputProductName" value="<?= $products["product_name"]; ?>">
    </div>
    <div class="form-group">
        <label for="inputProductPrice">Stok Produk</label>
        <input type="number" name="inputProductStock" class="form-control" id="inputProductStock" value="<?= $products["product_stock"]; ?>">
    </div>
    <div class="form-group">
        <label for="inputProductPrice">Harga Produk</label>
        <input type="number" name="inputProductPrice" class="form-control" id="inputProductPrice" value="<?= $products["product_price"]; ?>">
    </div>
    <div class="form-group">
        <label for="inputProductImage">Gambar Produk</label>
        <div class="custom-file">
            <img src="./../assets/products/<?= $products['product_image']; ?>" width="70"> <br>
            <input type="file" name="inputProductImage" id="inputProductImage" style="opacity: 1;">
        </div>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Update Product</button>
</form>
<!-- !update product -->