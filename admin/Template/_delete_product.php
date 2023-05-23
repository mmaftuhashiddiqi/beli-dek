<?php

require('functions.php');

$id = $_GET["product_id"];

if (hapus($id) > 0) {
  echo "
		<script>
			alert('The product has been deleted successfully!');
			document.location.href = 'products.php';
		</script>
	";
} else {
  echo "
		<script>
			alert('product failed to delete!');
			document.location.href = 'products.php';
		</script>
	";
}
