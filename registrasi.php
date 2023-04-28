<?php 

require ('functions.php');

if( isset($_POST["register"]) ) {

	if( registrasi($_POST) > 0 ) {
		echo "<script>
				alert('user baru berhasil ditambahkan!');
			  </script>";
	} else {
		echo mysqli_error($conn);
	}

}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Halaman Registrasi</title>

	<!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Owl-carousel CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

    <!-- Custom CSS file -->
    <link rel="stylesheet" href="css/style.css">

	<style>
		label {
			display: block;
		}
	</style>
</head>

<body>

<!-- <h1>Halaman Registrasi</h1>

<form action="" method="post">

	<ul>
		<li>
			<label for="username">username :</label>
			<input type="text" name="username" id="username">
		</li>
		<li>
			<label for="password">password :</label>
			<input type="password" name="password" id="password">
		</li>
		<li>
			<label for="password2">konfirmasi password :</label>
			<input type="password" name="password2" id="password2">
		</li>
		<li>
			<button type="submit" name="register">Register!</button>
		</li>
	</ul>
	
</form> -->

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
		<div class="tab-pane fade" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
			<form>
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
		
			<!-- Email input -->
			<div class="form-outline mb-4">
				<label class="form-label" for="loginUsername">Username</label>
				<input type="text" id="loginUsername" class="form-control" />
			</div>
		
			<!-- Password input -->
			<div class="form-outline mb-4">
				<label class="form-label" for="loginPassword">Password</label>
				<input type="password" id="loginPassword" class="form-control" />
			</div>
		
			<!-- 2 column grid layout -->
			<div class="row mb-4">
				<div class="col-md-6 d-flex justify-content-center">
				<!-- Checkbox -->
				<div class="form-check mb-3 mb-md-0">
					<input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
					<label class="form-check-label" for="loginCheck"> Remember me </label>
				</div>
				</div>
			</div>
		
			<!-- Submit button -->
			<button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
		
			<!-- Register buttons -->
			<div class="text-center">
				<p>Not a member? <a href="registrasi.php">Register</a></p>
			</div>
			</form>
		</div>
		<div class="tab-pane fade show active" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
			<form>
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
				<label class="form-label" for="registerUsername">Username</label>
				<input type="text" id="registerUsername" class="form-control" />
			</div>
		
			<!-- Password input -->
			<div class="form-outline mb-4">
				<label class="form-label" for="registerPassword">Password</label>
				<input type="password" id="registerPassword" class="form-control" />
			</div>
		
			<!-- Repeat Password input -->
			<div class="form-outline mb-4">
				<label class="form-label" for="registerRepeatPassword">Repeat password</label>
				<input type="password" id="registerRepeatPassword" class="form-control" />
			</div>
		
			<!-- Submit button -->
			<button type="submit" class="btn btn-primary btn-block mb-3">Sign in</button>
			</form>
		</div>
		</div>
		<!-- Pills content -->
	</div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<!-- Owl Carousel Js file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>

<!--  isotope plugin cdn  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js" integrity="sha256-CBrpuqrMhXwcLLUd5tvQ4euBHCdh7wGlDfNz8vbu/iI=" crossorigin="anonymous"></script>

<!-- Custom Javascript -->
<script src="js/index.js"></script>

</body>

</html>