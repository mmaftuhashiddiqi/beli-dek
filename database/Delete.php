<?php

function hapus($id) {
	global $con;
	mysqli_query($con, "DELETE FROM product WHERE item_id = $id");

	$cart = mysqli_query($con, "SELECT * FROM cart WHERE item_id = $id");
	if ( mysqli_num_rows($cart) === 1 ) {
		mysqli_query($con, "DELETE FROM cart WHERE item_id = $id");
	}

	return mysqli_affected_rows($con);
}