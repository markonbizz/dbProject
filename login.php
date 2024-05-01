<!DOCTYPE html>
<html lang="en">
<head>
	<title>DENNIS' ARMORY | Sign In</title>
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

	<!-- from main page css -->
    <link rel="stylesheet" href="css/style.css" type="text/css"> <!-- USED FOR PAGE TRANSITION-->
<!--===============================================================================================-->

	<!-- Initialize Login Session -->

	<?php
		session_start();
		
		include "utils/Session.php";

		User_VerifyLogin();
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
				<form class="login100-form-custom01 validate-form" action="login.php" method="post">
					<span class="login100-form-title p-b-43">
						Sign In
					</span>
					
					
					<div class="wrap-input100 validate-input" data-validate = "A valid email is required: example@email.xyz">
						<input class="input100" type="text" name="fAccount">
						<span class="focus-input100"></span>
						<span class="label-input100">Account</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="fPassword">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<div class="flex-sb-m w-full p-t-25 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="fRememberMe">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="resetpasswd.php" class="txt2">
								Forgot Password?
							</a>
						</div>
					</div>
			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
					
					<div class="text-center p-t-46 p-b-20">
						<span class="txt1">
							Don't have Accounts? &nbsp;
						</span>
						<span>
							<a class="txt2" href="register.php">Create One</a>
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