<?php 

require ('functions.php');

if ( isset($_POST["register"]) ) {

	if ( registrasi($_POST) > 0 ) {
		echo "<script>
				alert('user baru berhasil ditambahkan!');
			  </script>";
	} else {
		echo mysqli_error($con);
	}

}

?>

<!DOCTYPE html>
<html>

<head>
	<title>User Registration</title>

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
			<a class="nav-link" id="tab-login" data-mdb-toggle="pill" href="login.php" role="tab"
			aria-controls="pills-login" aria-selected="true">Login</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link active" id="tab-register" data-mdb-toggle="pill" href="registrasi.php" role="tab"
			aria-controls="pills-register" aria-selected="false">Register</a>
		</li>
		</ul>
		<!-- Pills navs -->
		
		<!-- Pills content -->
		<div class="tab-content">
		<div class="tab-pane fade show active" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
			<form action="" method="post">
			<div class="text-center mb-3">
				<p>Sign up with:</p>
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

			<!-- Username input -->
			<div class="form-outline mb-4">
				<label class="form-label" for="user-username">Username</label>
				<input type="text" name="user-username" id="user-username" class="form-control" />
			</div>
		
			<!-- Password input -->
			<div class="form-outline mb-4">
				<label class="form-label" for="user-password">Password</label>
				<input type="password" name="user-password" id="user-password" class="form-control" />
			</div>
		
			<!-- Repeat Password input -->
			<div class="form-outline mb-4">
				<label class="form-label" for="user-password2">Repeat password</label>
				<input type="password" name="user-password2" id="user-password2" class="form-control" />
			</div>
		
			<!-- Submit button -->
			<button type="submit" name="register" class="btn btn-primary btn-block mb-3">Sign up</button>
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