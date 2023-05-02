<?php

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
	
	// cek apakah data berhasil di tambahkan atau tidak
	if( tambah($_POST) > 0 ) {
		echo "
			<script>
				alert('data berhasil ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
	}

}

?>

<!-- add product -->
<form action="" method="post" enctype="multipart/form-data" style="margin-top: 100px; margin-bottom: 100px; margin-left: 25vw; margin-right: 25vw;">
    <div class="form-group">
        <label for="inputBrandName">Nama Brand</label>
        <input type="text" name="inputBrandName" class="form-control" id="inputBrandName" placeholder="Brand Name">
    </div>
    <div class="form-group">
        <label for="inputProductName">Nama Produk</label>
        <input type="text" name="inputProductName" class="form-control" id="inputProductName" placeholder="Product Name">
    </div>
    <div class="form-group">
        <label for="inputProductPrice">Harga Produk</label>
        <input type="number" name="inputProductPrice" class="form-control" id="inputProductPrice" placeholder="Product Price">
    </div>
    <div class="form-group">
        <label for="inputProductImage">Gambar Produk</label>
        <div class="custom-file">
            <input type="file" name="inputProductImage" id="inputProductImage" style="opacity: 1;">
        </div>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Add Product</button>
</form>
<!-- !add product -->