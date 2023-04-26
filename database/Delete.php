<?php

function hapus($id) {
	global $con;
	mysqli_query($con, "DELETE FROM product WHERE item_id = $id");
	return mysqli_affected_rows($con);
}