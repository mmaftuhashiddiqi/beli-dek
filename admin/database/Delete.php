<?php

function hapus($id) {
	global $con;
	
	$cart = mysqli_query($con, "SELECT * FROM cart WHERE item_id = $id");
	if ( mysqli_num_rows($cart) === 1 ) {
		mysqli_query($con, "DELETE FROM cart WHERE item_id = $id");
	}
	
	$wishlist = mysqli_query($con, "SELECT * FROM wishlist WHERE item_id = $id");
	if ( mysqli_num_rows($wishlist) === 1 ) {
		mysqli_query($con, "DELETE FROM wishlist WHERE item_id = $id");
	}

	mysqli_query($con, "DELETE FROM product WHERE item_id = $id");

	return mysqli_affected_rows($con);
}

function hapusOrder($itemId, $userId) {
	global $con;
	mysqli_query($con, "DELETE FROM orders WHERE item_id = $itemId AND user_id = $userId");
	return mysqli_affected_rows($con);
}