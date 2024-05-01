<?php
    session_start();
    include "utils/utils.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>DENNIS' ARMORY | Sign Up</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="img/png" href="img/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/login_utils.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
<!--===============================================================================================-->

	<!-- from main page css -->
    <link rel="stylesheet" href="css/style.css" type="text/css"> <!-- USED FOR PAGE TRANSITION-->

<!-- Functionalities -->
	<?php
		
		User_GetRegisteration();

	?>
</head>
<body style="background-color: #666666;">
	
	<!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form-custom00 validate-form" action="Register.php" method="post">
					<span class="login100-form-title p-b-43">
						Sign Up
					</span>
					
					<div class="wrap-input100 validate-input" data-validate = "No Information was entered">
						<input class="input100" type="text" name="fAccount">
						<span class="focus-input100"></span>
						<span class="label-input100">Account</span>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate = "No Information was entered">
						<input class="input100" type="text" name="fRealName">
						<span class="focus-input100"></span>
						<span class="label-input100">Real Name</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" name="fEmail">
						<span class="focus-input100"></span>
						<span class="label-input100">Email</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "No Information was entered">
						<input class="input100" type="text" name="fBirthday">
						<span class="focus-input100"></span>
						<span class="label-input100">Birthday</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="fPhoneNumber">
						<span class="focus-input100"></span>
						<span class="label-input100">Phone Number</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="fPassword">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="This credential is needd">
						<input class="input100" type="password" name="fPassword_Again">
						<span class="focus-input100"></span>
						<span class="label-input100">Repeat Password</span>
					</div>

					<div class="container-login100-form-btn p-t-25">
						<button class="login100-form-btn">
							Register
						</button>
					</div>
					
					<div class="text-center p-t-32 p-b-20">
						<span class="txt1">
							Already have an account? &nbsp;
						</span>
						<span>
							<a class="txt2" href="Login.php">Sign in</a>
						</span>
					</div>
				</form>

				<div class="login100-more" style="background-image: url('img/bg-01.jpg');">
				</div>
			</div>
		</div>
	</div>
	
	

	
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/login.js"></script>

	<!-- from main page js -->
    <script src="js/main.js"></script> <!-- USED FOR PAGE TRANSITION-->
</body>
</html>