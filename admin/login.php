<?php 

session_start();
require ('functions.php');

// cek cookie
if ( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	// ambil username berdasarkan id
	$result = mysqli_query($con, "SELECT username FROM admin WHERE admin_id = $id");
	$row = mysqli_fetch_assoc($result);

	// cek cookie dan username
	if ( $key === hash('sha256', $row['username']) ) {
		$_SESSION['login'] = true;
	}
}

if ( isset($_SESSION["login"]) ) {
	header("Location: index.php");
	exit;
}

if ( isset($_POST["login"]) ) {

	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($con, "SELECT * FROM admin WHERE username = '$username'");

	// cek username
	if( mysqli_num_rows($result) === 1 ) {

		// cek password
		$row = mysqli_fetch_assoc($result);
		if ( password_verify($password, $row["password"]) || $password === $row["password"] ) {
			// set session
			$_SESSION["login"] = true;
			$_SESSION['admin'] = $row['admin_id'];

			// cek remember me
			if ( isset($_POST['remember']) ) {
				// buat cookie
				setcookie('id', $row['admin_id'], time()+60);
				setcookie('key', hash('sha256', $row['username']), time()+60);
			}

			header("Location: index.php");
			exit;
		}
	
	}

	$error = true;

}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Admin Login</title>

	<?php
	// require library
	require ('library/head.php');
	?>

    <!-- Custom CSS file -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="w-100 h-100">
	<div class="nav-container bg-dark text-white p-4 rounded-lg shadow-lg" style="width: 35vw; margin: 10vh auto;">
		<!-- Pills navs -->
		<ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
		<li class="nav-item" role="presentation">
			<a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#" role="tab"
			aria-controls="pills-login" aria-selected="true">Login</a>
		</li>
		</ul>
		<!-- Pills navs -->
		
		<!-- Pills content -->
		<div class="tab-content">
		<div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
			<form action="" method="post">
			<?php if( isset($error) ) : ?>
				<p class="text-danger font-italic">username / password salah</p>
			<?php endif; ?>
		
			<!-- Email input -->
			<div class="form-outline mb-4">
				<label class="form-label" for="username">Username</label>
				<input type="text" name="username" id="username" class="form-control" />
			</div>
		
			<!-- Password input -->
			<div class="form-outline mb-4">
				<label class="form-label" for="password">Password</label>
				<input type="password" name="password" id="password" class="form-control" />
			</div>
		
			<!-- Checkbox -->
			<div class="form-check mb-3 md-0">
				<input class="form-check-input" type="checkbox" name="remember" id="remember" />
				<label class="form-check-label" for="remember"> Remember me </label>
			</div>
		
			<!-- Submit button -->
			<button type="submit" name="login" class="btn btn-primary btn-block mb-4">Sign in</button>
			</form>
		</div>
		</div>
		<!-- Pills content -->
	</div>
</div>


<?php
// require library
require ('library/body.php');
?>

<!-- Custom Javascript -->
<script src="index.js"></script>

</body>

</html>