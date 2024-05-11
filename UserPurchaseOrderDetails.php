<?php

	session_start();

	if(!defined("_UTILITIES_PATH_")){

		define("_UTILITIES_PATH_", "assets/main/php/");
	}

	include_once(_UTILITIES_PATH_ . "Session_CheckAuth.php");
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
	<link rel="stylesheet" href="assets/user-portal/css/portal-orderDetail.css">

	<?php

		Session_CheckAuthLevel("USER");

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

						<h1 class="app-page-title col">Order Detail</h1>

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
			    
			    <div class="app-card shadow-sm mb-4 border-left-decoration">
				    <div class="">
					    <div class="app-card-body p-3 p-lg-4">
						    
						    <div class="row gx-5 gy-4">
								
						        <div class="col pt-lg-4 pb-lg-0 pr-lg-2">
									<h2>
										Recipe: &nbsp;&nbsp;#12345
									</h2>
								</div>

								<div class="col-md-auto m-auto mt-4 mb-0 px-5">
									<h6> Total Payment </h6>
									<div class="col-md-auto">

										<h2>$4575</h2>
									
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
						                <h4 class="app-card-title">Purchased Products</h4>
							        </div><!--//col-->
						        </div><!--//row-->
					        </div><!--//app-card-header-->


					        <div class="app-card-body p-4">
						        <div class="table-responsive">
							        <table class="table table-borderless mb-0">
										<thead>
											<tr>
												<th class="meta">Item ID</th>
												<th class="meta">Name</th>
												<th class="meta stat-cell">Price</th>
												<th class="meta stat-cell">Date</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><a href="#">#0011</a></td>
												<td>Item One</td>
												<td class="stat-cell">$236</td>
												<td class="stat-cell">2004-01-01</td>
											</tr>
											<tr>
												<td><a href="#">#1245</a></td>
												<td>Item One</td>
												<td class="stat-cell">$236</td>
												<td class="stat-cell">2004-01-01</td>
											</tr>
											<tr>
												<td><a href="#">#2765</a></td>
												<td>Item One</td>
												<td class="stat-cell">$236</td>
												<td class="stat-cell">2004-01-01</td>
											</tr>
											<tr>
												<td><a href="#">#1276 </a></td>
												<td>Item One</td>
												<td class="stat-cell">$236</td>
												<td class="stat-cell">2004-01-01</td>
											</tr>
											<tr>
												<td><a href="#">#2333 </a></td>
												<td>Item One</td>
												<td class="stat-cell">$236</td>
												<td class="stat-cell">2004-01-01</td>
											</tr>
										</tbody>
									</table>
						        </div><!--//table-responsive-->
					        </div><!--//app-card-body-->
							
				        </div><!--//app-card-->
			        </div><!--//col-->

			    </div><!--//row-->

				<div class="row mt-4"> <!-- Go Back Button -->
					<form action="UserPurchaseHistory.php">
						<button type="submit" class="shadow-sm btn app-btn-primary">Go Back</button>	
					</form>
				</div>
<!-- =========================================================================================================================================================================================================================================== -->

			<!-- Main Page - Portal Template Author Signature -->
			<footer class="app-footer">
				<div class="container text-center py-3">
					<!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
				<small class="copyright">Designed with <span class="sr-only">love</span><i class="fas fa-heart" style="color: #fb866a;"></i> by <a class="app-link" href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for developers</small>
				
				</div>
			</footer><!--//app-footer-->
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

</body>
</html> 

