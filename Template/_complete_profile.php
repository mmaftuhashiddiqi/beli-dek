<?php

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

  // cek apakah data berhasil di tambahkan atau tidak
  if (completeProfile($_POST) > 0) {
    echo "
			<script>
				alert('profile berhasil diupdate!');
				document.location.href = 'index.php';
			</script>
		";
  } else {
    echo "
			<script>
				alert('profile gagal diupdate!');
				document.location.href = 'index.php';
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
    <label for="inputFullName">Nama Lengkap</label>
    <input type="text" name="inputFullName" class="form-control" id="inputFullName" placeholder="Full Name">
  </div>
  <div class="form-group">
    <label for="inputPhoneNumber">Nomor Telepon</label>
    <input type="text" name="inputPhoneNumber" class="form-control" id="inputPhoneNumber" placeholder="Phone Number">
  </div>
  <div class="form-group">
    <label for="inputAddress">Alamat</label>
    <input type="text" name="inputAddress" class="form-control" id="inputAddress" placeholder="Address">
  </div>

  <div class="py-3">
    <button type="submit" name="submit" class="btn btn-primary mr-2">Complete Profile</button>
    <a href="index.php" class="btn btn-danger">Cancel</a>
  </div>
</form>
<!-- !add product -->