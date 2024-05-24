<?php

	session_start();

	if(!defined("_UTILITIES_PATH_")){

		define("_UTILITIES_PATH_", "assets/main/php/");
	}

	include_once(_UTILITIES_PATH_ . "Session_CheckAuth.php");

	Session_CheckAuthLevel("ADMIN");
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>User Home | DENNIS' ARMORY</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <!-- <link rel="shortcut icon" href="favicon.ico">  -->
    
    <!-- FontAwesome JS-->
    <script defer src="assets/user-portal/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/user-portal/css/portal.css">

	<!-- Override CSS -->  
	<link rel="stylesheet" href="assets/user-portal/css/portal-uploadProduct.css">

	<?php
		include_once(_UTILITIES_PATH_ . "Database_EstConnection.php");

		if(($_SERVER["REQUEST_METHOD"] === "GET") && !(empty($_GET["fFetchTargetUser"])) && ($_GET["fFetchTargetUser"]) && !(empty($_GET["fRequestViewUser"])) && ($_GET["fRequestViewUser"])){

			$USER_INFO = 
			"
				SELECT
					UBase.*,
					UPvc.*,
					USec.*
			
				FROM
					`User_Basics` 	UBase
				JOIN
					`User_Privacy` 	UPvc
					ON
						UBase.UserID = UPvc.UserID 
				JOIN
					`User_Security`	USec
					ON
						UBase.UserID = USec.UserID
				WHERE
					UBase.UserID 	= :UserID
					AND
					UPvc.UserID 	= :UserID
					AND
					UBase.UserID 	= :UserID
			";

			$bTargetUserID = $_GET["fFetchTargetUser"] ?? "";

			$FETCHING_USER_STMT = $dbHandler -> prepare($USER_INFO);
			$FETCHING_USER_STMT-> bindParam(":UserID", $bTargetUserID, PDO::PARAM_STR);

			if($FETCHING_USER_STMT -> execute()){

				$fetchData = $FETCHING_USER_STMT -> fetch(PDO::FETCH_ASSOC);
			}
		}
	?>
</head> 

<body class="app">   	
    <header class="app-header fixed-top">	  



<!-- =========================================================================================================================================================================================================================================== -->
<!-- =========================================================================================================================================================================================================================================== -->



		<!-- Main Content - Page Title -->

        <div class="app-header-inner p-2 p-l-10">  
	        <div class="container-fluid py-1 px-0">
		        <div class="app-header-content"> 
					<div class="row">				

						<div class="col-12 col-md-8">
							<h1 class="app-page-title col">Edit Product</h1>
						</div> 
					</div><!--//row-->
	            </div><!--//app-header-content-->
	        </div><!--//container-fluid-->
        </div><!--//app-header-inner-->



<!-- =========================================================================================================================================================================================================================================== -->
<!-- =========================================================================================================================================================================================================================================== -->



	<!-- Main Page Brief Section -->

    <div class="app-wrapper">
	    
	    <div class="app-content mr-5 pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">

				<div class="col-12 col-md-8">
					<form class="settings-form" action="AdminUserList.php" method="get">
						<input type="hidden" name="CurrentPageIndex" value="1">
						<input type="hidden" name="fUserListSearchHolder" value="">
						<input type="hidden" name="fRequestSearchOnUserList" value="true">
						<button type="submit" name="fGoBack" value="true" class="btn app-btn-primary" style="width: max-content; height:max-content">
							<div class="icon icon-badge app-utility-item">
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
									<path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
								</svg>
							</div>
							&nbsp;
							Go Back
						</button>
					</form>
				</div> 

				<div class="row py-4 g-4 settings-section">

					<div class="app-card shadow-sm mb-4 border-left-decoration">
					
						<div class="app-card-body p-3 p-lg-4">
							
							<div class="row gx-5 gy-4">
								
								<div class="col pt-lg-4 pb-lg-0 pr-lg-2">
									<h2>
										Account: &nbsp;&nbsp;<?php echo $fetchData["Account"];?>
									</h2>
								</div>

								<div class="col-0 col-lg-2 m-auto mt-5">
									<h6> Total Payment </h6>
									<div class="col col-lg-2">
										<div class="col-md-auto">

											<h2>$<?php echo $fetchData["TotalBalance"];?></h2>
									
										</div>
									</div>
								</div>

								<div class="col-sm-1 mx-0 px-5 d-flex">
									<div class="vr"></div>
								</div>
								
								<div class="col-0 col-lg-2 m-auto mt-5">
									<h6> Total Spent </h6>
									<div class="col col-lg-2">
										<div class="col-md-auto">
										
											<h2>$<?php echo $fetchData["TotalSpent"];?></h2>
									
										</div>
									</div>
								</div>


							</div><!--//row-->
						</div><!--//app-card-body-->

					</div><!--//inner-->

					<hr class="my-4">

					<div class="app-card app-card-settings shadow-sm p-4">
						
						<div class="app-card-body">

							<div class="mb-3">
								<h2>Info:</h2>
							</div>
						
							<hr class="my-4">

							<div class="mb-3">
								<h4 class="section-title">Real Name&nbsp;:&emsp;&emsp;&emsp;&emsp; <?php echo $fetchData["RealName"];?> </h4>
								<h4 class="section-title">Email&nbsp;:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <?php echo $fetchData["Email"];?> </h4>
								<h4 class="section-title">Address&nbsp;:&emsp;&emsp;&emsp;&emsp; <?php echo ($fetchData["Address"] ?? "Not Assigned");?> </h4>
								<h4 class="section-title">Birthday&nbsp;:&emsp;&emsp;&emsp;&emsp; <?php echo $fetchData["Birthday"];?> </h4>
								<h4 class="section-title">Phone Number&nbsp;:&emsp;&emsp; <?php echo $fetchData["PhoneNumber"];?> </h4>
							</div>

						</div><!--//app-card-body-->
					</div><!--//app-card-->

				</div>

			</div>
	    </div>
    </div><!--//app-wrapper-->    					



<!-- =========================================================================================================================================================================================================================================== -->
<!-- =========================================================================================================================================================================================================================================== -->




    <!-- Javascript -->
	          
    <script src="assets/user-portal/plugins/popper.min.js"></script>
    <script src="assets/user-portal/plugins/bootstrap/js/bootstrap.min.js"></script>  

    <!-- Charts JS -->
    <script src="assets/user-portal/plugins/chart.js/chart.min.js"></script> 
    <script src="assets/user-portal/js/index-charts.js"></script> 
    
    <!-- Page Specific JS -->
    <script src="assets/user-portal/js/app.js"></script> 
	<script src="assets/user-portal/js/uploadProduct_CustomCategorySelected.js"></script>
	<script src="assets/user-portal/js/uploadProduct_ProductImagePreview.js"></script>
</body>
</html> 

