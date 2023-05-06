<?php 

require ('../functions.php');

$itemId = $_GET["item_id"];
$userId = $_GET["user_id"];

if ( hapusOrder($itemId, $userId) > 0 ) {
	echo "
		<script>
			alert('product has been sent!');
			document.location.href = '../orders.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('product failed to delete!');
			document.location.href = '../orders.php';
		</script>
	";
}