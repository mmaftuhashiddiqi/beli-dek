<?php

$con = mysqli_connect("localhost", "root", "", "ecommerce");

function registrasi($data)
{
  global $con;

  $username = strtolower(stripslashes($data["user-username"]));
  $password = mysqli_real_escape_string($con, $data["user-password"]);
  $password2 = mysqli_real_escape_string($con, $data["user-password2"]);

  // cek username sudah ada atau belum
  $result = mysqli_query($con, "SELECT user_username FROM users WHERE user_username = '$username'");

  if (mysqli_fetch_assoc($result)) {
    echo "<script>
				alert('username sudah terdaftar!')
		      </script>";
    return false;
  }

  // cek konfirmasi password
  if ($password !== $password2) {
    echo "<script>
				alert('konfirmasi password tidak sesuai!');
		      </script>";
    return false;
  }

  // enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // tambahkan userbaru ke database
  mysqli_query($con, "INSERT INTO users VALUES('', '', '$username', '', '', '$password')");

  return mysqli_affected_rows($con);
}
