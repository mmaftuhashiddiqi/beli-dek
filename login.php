<?php 

session_start();
require ('functions.php');

// cek cookie
if ( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	// ambil username berdasarkan id
	$result = mysqli_query($con, "SELECT user_username FROM users WHERE user_id = $id");
	$row = mysqli_fetch_assoc($result);

	// cek cookie dan username
	if ( $key === hash('sha256', $row['user_username']) ) {
		$_SESSION['login'] = true;
		$_SESSION['user'] = $id;
	}
}

if ( isset($_SESSION["login"]) && isset($_SESSION['user']) ) {
	header("Location: index.php");
	exit;
}

if ( isset($_POST["login"]) ) {

	$username = $_POST["user-username"];
	$password = $_POST["user-password"];

	$result = mysqli_query($con, "SELECT * FROM users WHERE user_username = '$username'");

	// cek username
	if ( mysqli_num_rows($result) === 1 ) {

		// cek password
		$row = mysqli_fetch_assoc($result);
		if ( password_verify($password, $row["user_password"]) || $password === $row["user_password"] ) {
			// set session
			$_SESSION["login"] = true;
			$_SESSION['user'] = $row["user_id"];

			// cek remember me
			if ( isset($_POST['remember']) ) {
				// buat cookie
				setcookie('id', $row['user_id'], time()+60);
				setcookie('key', hash('sha256', $row['user_username']), time()+60);
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
	<title>User Login</title>

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
			<a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="login.php" role="tab"
			aria-controls="pills-login" aria-selected="true">Login</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="register.php" role="tab"
			aria-controls="pills-register" aria-selected="false">Register</a>
		</li>
		</ul>
		<!-- Pills navs -->
		
		<!-- Pills content -->
		<div class="tab-content">
		<div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
			<form action="" method="post">
			<div class="text-center mb-3">
				<p>Sign in with:</p>
				<button type="button" class="btn btn-link btn-floating mx-1">
				<i class="fab fa-facebook-f"></i>
				</button>
		
				<button type="button" class="btn btn-link btn-floating mx-1">
				<i class="fab fa-google"></i>
				</button>
		
				<button type="button" class="btn btn-link btn-floating mx-1">
				<i class="fab fa-twitter"></i>
				</button>
		
				<button type="button" class="btn btn-link btn-floating mx-1">
				<i class="fab fa-github"></i>
				</button>
			</div>
		
			<p class="text-center">or:</p>

			<?php if( isset($error) ) : ?>
				<p class="text-danger font-italic">username / password salah</p>
			<?php endif; ?>
		
			<!-- Email input -->
			<div class="form-outline mb-4">
				<label class="form-label" for="user-username">Username</label>
				<input type="text" name="user-username" id="user-username" class="form-control" />
			</div>
		
			<!-- Password input -->
			<div class="form-outline mb-4">
				<label class="form-label" for="user-password">Password</label>
				<input type="password" name="user-password" id="user-password" class="form-control" />
			</div>
		
			<!-- Checkbox -->
			<div class="form-check mb-3 md-0">
				<input class="form-check-input" type="checkbox" name="remember" id="remember" />
				<label class="form-check-label" for="remember"> Remember me </label>
			</div>
		
			<!-- Submit button -->
			<button type="submit" name="login" class="btn btn-primary btn-block mb-4">Sign in</button>
		
			<!-- Register buttons -->
			<div class="text-center">
				<p>Not a member? <a href="register.php">Register</a></p>
			</div>
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