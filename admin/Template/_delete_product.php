<?php

require('../functions.php');

$id = $_GET["product_id"];

if (hapus($id) > 0) {
  echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = '../products.php';
		</script>
	";
} else {
  echo "
		<script>
			alert('data gagal dihapus!');
			document.location.href = '../products.php';
		</script>
	";
}
