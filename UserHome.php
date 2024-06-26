<?php

	session_start();

	if(!defined("_UTILITIES_PATH_")){

		define("_UTILITIES_PATH_", "assets/main/php/");
	}

	include_once(_UTILITIES_PATH_ . "Session_CheckAuth.php");

	Session_CheckAuthLevel("USER");
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
    <link rel="stylesheet" href="assets/user-portal/css/portal-override.css">

	<?php
		
		include_once(_UTILITIES_PATH_ . "Database_EstConnection.php");

		$FETCH_NEWEST_RECORDS = "
			SELECT 
				* 
			FROM 
				`Orders`
			WHERE 
				CustomerID = :CustomerID
			ORDER BY 
				`Date` DESC
			LIMIT 8
		";

		$FETCH_RECORDS_STMT = $dbHandler -> prepare($FETCH_NEWEST_RECORDS);
		$FETCH_RECORDS_STMT-> bindParam(":CustomerID", $_SESSION["UserID"], PDO::PARAM_STR);
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
					<div class="row justify-content-between align-items-center">
						
						<div class="col-auto mb-5">
							<a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
								<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img"><title>Home</title><path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path></svg>
							</a>
						</div>					

						<h1 class="app-page-title col">Home</h1>

					</div><!--//row-->
	            </div><!--//app-header-content-->
	        </div><!--//container-fluid-->
        </div><!--//app-header-inner-->



<!-- =========================================================================================================================================================================================================================================== -->
<!-- =========================================================================================================================================================================================================================================== -->



		<!-- Side Panel - Store Logo -->

        <div id="app-sidepanel" class="app-sidepanel"> 
	        <div id="sidepanel-drop" class="sidepanel-drop"></div>
	        <div class="sidepanel-inner d-flex flex-column">

		        <div class="app-branding">
		            <a class="app-logo" href="UserHome.php"><img class="logo-icon me-2" src="assets/main/images/logo.svg" alt="logo"><span class="logo-text">DENNIS' ARMORY</span></a>
	
		        </div><!--//app-branding-->  
		        
			    <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
				    <ul class="app-menu list-unstyled accordion" id="menu-accordion">

<!-- =========================================================================================================================================================================================================================================== -->

						<!-- Side Panel - Main Page -->

					    <li class="nav-item">

					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link active" href="UserHome.php">
						        <span class="nav-icon">
						        	<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
		  								<path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z"/>
		  								<path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
									</svg>
								</span>
								<span class="nav-link-text">Home</span>
					        </a><!--//nav-link-->

					    </li><!--//nav-item-->
					    
<!-- =========================================================================================================================================================================================================================================== -->

						<!-- Side Panel - Uploaded Products -->

						<li class="nav-item">
						
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link" href="UserProductList.php?CurrentPageIndex=1">
						        <span class="nav-icon">
									<svg class="bi bi-journals" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journals" viewBox="0 0 16 16">
										<path d="M5 0h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2 2 2 0 0 1-2 2H3a2 2 0 0 1-2-2h1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1H1a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v9a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1H3a2 2 0 0 1 2-2"/>
										<path d="M1 6v-.5a.5.5 0 0 1 1 0V6h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V9h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 2.5v.5H.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1H2v-.5a.5.5 0 0 0-1 0"/>
									</svg>
								</span>
								<span class="nav-link-text">Uploaded Products</span>
					        </a><!--//nav-link-->

					    </li><!--//nav-item-->

<!-- =========================================================================================================================================================================================================================================== -->
						
						<!-- Side Panel - Transactions History -->

						<li class="nav-item">
					        
					        <a class="nav-link" href="UserPurchaseHistory.php">
						    
							    <span class="nav-icon">
									<svg class="bi bi-receipt" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
										<path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z"/>
										<path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5"/>
									</svg>
						        </span>
								<span class="nav-link-text">Purchase History</span>
					        
							</a><!--//nav-link-->
					    </li><!--//nav-item-->

<!-- =========================================================================================================================================================================================================================================== -->

						<!-- Side Panel - External Pages -->
						
						<li class="nav-item">
						
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link" href="UserAccountSettings.php">
						        <span class="nav-icon">
									<svg class="bi bi-sliders2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders2" viewBox="0 0 16 16">
										<path fill-rule="evenodd" d="M10.5 1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4H1.5a.5.5 0 0 1 0-1H10V1.5a.5.5 0 0 1 .5-.5M12 3.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m-6.5 2A.5.5 0 0 1 6 6v1.5h8.5a.5.5 0 0 1 0 1H6V10a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5M1 8a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 1 8m9.5 2a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V13H1.5a.5.5 0 0 1 0-1H10v-1.5a.5.5 0 0 1 .5-.5m1.5 2.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5"/>
									</svg>
								</span>
								<span class="nav-link-text">Settings</span>
					        </a><!--//nav-link-->

					    </li><!--//nav-item-->
						
					</ul>
				</nav>
<!-- =========================================================================================================================================================================================================================================== -->

				<!-- Side Panel Bottom Utilities -->

			    <div class="app-sidepanel-footer">
				    <nav class="app-nav app-nav-footer">
					    <ul class="app-menu footer-menu list-unstyled">

						    <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
							
							<li class="nav-item">
						        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
						        <a class="nav-link" href="index.php">
							        <span class="nav-icon">
							            <svg class="bi bi-shop" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
											<path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z"/>
										</svg>
							        </span>
			                        <span class="nav-link-text">Back to Shop</span>
						        </a><!--//nav-link-->
						    </li><!--//nav-item-->



						    <li class="nav-item">
						        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
						        <a class="nav-link" id="RequestUserLogout">
							        <span class="nav-icon">
							            <svg class="bi bi-box-arrow-left" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
											<path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
										</svg>
							        </span>
			                        <span class="nav-link-text">Log out</span>
						        </a><!--//nav-link-->

								<!-- SweetAlert2 Logout Prompts -->
								<?php

									echo "
										<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
										<script>

											document.addEventListener('DOMContentLoaded', function() {

												const RequestUserLogout = document.getElementById('RequestUserLogout');

												RequestUserLogout.addEventListener('click', function() {

													Swal.fire({

														title: 'Logout Confirmation',
														text: 'Are you sure you want to logout?',
														icon: 'warning',
														showCancelButton: true,
														confirmButtonText: 'Yes, logout',
														cancelButtonText: 'Cancel'

													}).then((result) => {

														if (result.isConfirmed){

															fetch('assets/main/php/Session_Logout.php', {
																method: 'POST',
															}).then(respond => {

																if(respond.ok){

																	Swal.fire({
						
																		title:  'Logouts Successfully',
																		icon:   'success',
																		confirmButtonText:  'Okay'
																	
																	}).then((result) => {
																		
																		if(result.isConfirmed){

																			window.location.href = 'Login.php';
																		}
																	});
																}
															}).catch(error => {
																
																console.error('Error:', error);
															});
														}
													});
												});
											});
										</script>
									";
								?>


								
						    </li><!--//nav-item-->

						</ul><!--//footer-menu-->
				    </nav>
			    </div><!--//app-sidepanel-footer-->
		       
	        </div><!--//sidepanel-inner-->
	    </div><!--//app-sidepanel-->
    </header><!--//app-header-->
    


<!-- =========================================================================================================================================================================================================================================== -->
<!-- =========================================================================================================================================================================================================================================== -->



	<!-- Main Page Brief Section -->

    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="app-card shadow-sm mb-4 border-left-decoration">
				    <div class="inner">
					    <div class="app-card-body p-3 p-lg-4">
						    

						    <div class="row gx-5 gy-4">
								
						        <div class="col mt-5">
									<h4>
										<?php 
											echo
												"
													<h2>Welcome, <strong>{$_SESSION["Account"]}</strong>!</h2>
												";
										?>
									</h4>
								</div>

								<div class="col-md-auto m-auto mt-5">
									<h6> Total Balance </h6>
									<div class="col-md-auto">

										<?php 
											include_once(_UTILITIES_PATH_ . "Database_EstConnection.php");

											$SQL_STATMENT = $dbHandler -> prepare("SELECT TotalBalance FROM User_Basics WHERE UserID = :UserID");
											$SQL_STATMENT-> bindParam(":UserID", $_SESSION["UserID"]);
											$SQL_STATMENT-> execute();

											$User_Basics = $SQL_STATMENT -> fetch(PDO::FETCH_ASSOC);

											if($User_Basics){
												
												echo "<h3>$" . $User_Basics["TotalBalance"] . "</h3>";
											}
										?>
									
									</div>
								</div>

								<div class="col-sm-1 mx-0 px-5 d-flex">
									<div class="vr"></div>
								</div>
								
								<div class="col-0 col-lg-2 m-auto mt-5">
									<h6> Total Spent </h6>
									<div class="col col-lg-2">
										<div class="col-md-auto">
										
											<?php 
												include_once(_UTILITIES_PATH_ . "Database_EstConnection.php");

												$SQL_STATMENT = $dbHandler -> prepare("SELECT TotalSpent FROM User_Basics WHERE UserID = :UserID");
												$SQL_STATMENT-> bindParam(":UserID", $_SESSION["UserID"]);
												$SQL_STATMENT-> execute();

												$User_Basics = $SQL_STATMENT -> fetch(PDO::FETCH_ASSOC);

												if($User_Basics){
													
													echo "<h3>$" . $User_Basics["TotalSpent"] . "</h3>";
												}
											?>
									
										</div>
									</div>
								</div>
						    
							</div><!--//row-->
					    </div><!--//app-card-body-->
					    
				    </div><!--//inner-->
			    </div><!--//app-card-->

<!-- =========================================================================================================================================================================================================================================== -->

				<!-- Main Page - Trans History Brief -->

			    <div class="row">

			        <div class="col">
				        <div class="app-card app-card-stats-table h-100 shadow-sm">
					        <div class="app-card-header p-3">
						        <div class="row justify-content-between align-items-center">
							        <div class="col-auto">
						                <h4 class="app-card-title">Recent Purchase</h4>
							        </div><!--//col-->
						        </div><!--//row-->
					        </div><!--//app-card-header-->


					        <div class="app-card-body p-4">
						        <div class="table-responsive">
							        <table class="table table-borderless mb-0">
										<thead>
											<tr>
												<th class="cell">Order ID</th>
												<th class="cell">Date</th>
												<th class="cell">Total Price</th>
												<th class="cell">Address</th>									
											</tr>
										</thead>
										<tbody>



											<?php
												if($FETCH_RECORDS_STMT -> execute()){

													if(!($FETCH_RECORDS_STMT -> rowCount())){

														echo "

															<tr>
																<td colspan=\"4\" class=\"cell\" style=\"text-align: center;\">
																	<h5 class=\"pt-3\"> Nothing but Chickens here :) </h5>
																</td>
															</tr>
														";
													}else{

														while($record = $FETCH_RECORDS_STMT -> fetch(PDO::FETCH_ASSOC)){
														
															echo "
																<tr>
																	<td class=\"cell\">		#{$record["OrderID"]}		</td>				
																	<td class=\"cell\">		 {$record["Date"]}			</td>
																	<td class=\"cell\">	   \${$record["TotalPayment"]}	</td>
																	<td class=\"cell\">	     {$record["Address"]}		</td>
																</tr>
															";
														}
													}								
												}
											?>



										</tbody>
									</table>
						        </div><!--//table-responsive-->
					        </div><!--//app-card-body-->


							
				        </div><!--//app-card-->
			        </div><!--//col-->
			    </div><!--//row-->

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

</body>
</html> 

