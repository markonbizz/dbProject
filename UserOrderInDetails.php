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
	<link rel="stylesheet" href="assets/user-portal/css/portal-orderDetail.css">



	<?php
		include_once(_UTILITIES_PATH_ . "Database_EstConnection.php");

		if(($_SERVER["REQUEST_METHOD"] === "GET") && !(empty($_GET["fFetchTargetOrder"])) && ($_GET["fFetchTargetOrder"]) && !(empty($_GET["fRequestViewOrder"])) && ($_GET["fRequestViewOrder"])){

			$LISTING_ORDER_PRODUCTS = "

				SELECT 
					* 
				FROM 
					`Orders` 
				WHERE 
					(`CustomerID` = :CustomerID AND `OrderID` = :OrderID)
			";

			$LISTING_PRODUCTS_STMT = $dbHandler -> prepare($LISTING_ORDER_PRODUCTS);
			$LISTING_PRODUCTS_STMT-> bindParam(":CustomerID", 	$_SESSION["UserID"], 			PDO::PARAM_STR);
			$LISTING_PRODUCTS_STMT-> bindParam(":OrderID", 		$_GET["fFetchTargetOrder"], 	PDO::PARAM_STR);

			if($LISTING_PRODUCTS_STMT -> execute()){

				$fetchData = $LISTING_PRODUCTS_STMT -> fetch(PDO::FETCH_ASSOC);

				$bProductIDs = explode(',', $fetchData["ProductIDs"]);
				$bQuantities = explode(',', $fetchData["Quantities"]);
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
										Recipe: &nbsp;&nbsp;#<?php echo $fetchData["OrderID"];?>
									</h2>
								</div>

								<div class="col-md-auto m-auto mt-4 mb-0 px-5">
									<h6> Total Payment </h6>
									<div class="col-md-auto">

										<h2>$<?php echo $fetchData["TotalPayment"];?></h2>
									
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
												<th class="meta">Product ID</th>
												<th class="meta ">Name</th>
												<th class="meta stat-cell">Price</th>
												<th class="meta stat-cell">Quantites</th>
												<th class="meta stat-cell">Total Price</th>
											</tr>
										</thead>
										<tbody>

											<?php

												include_once(_UTILITIES_PATH_ . "Database_EstConnection.php");

												if(($_SERVER["REQUEST_METHOD"] === "GET") && !(empty($_GET["fFetchTargetOrder"])) && ($_GET["fFetchTargetOrder"]) && !(empty($_GET["fRequestViewOrder"])) && ($_GET["fRequestViewOrder"])){

													$FETCH_PRODUCT_INFO = "

														SELECT 
															* 
														FROM 
															`Products` 
														WHERE 
															ProductID = :ProductID
													";

													for($i = 0; ($i < count($bProductIDs)) && ($i < count($bProductIDs)); $i++){
														
														$FETCH_STMT = $dbHandler -> prepare($FETCH_PRODUCT_INFO);
														$FETCH_STMT-> bindParam(":ProductID", $bProductIDs[$i], PDO::PARAM_INT);
														
														if($FETCH_STMT -> execute()){

															$bProductInfo = $FETCH_STMT -> fetch(PDO::FETCH_ASSOC);

															$bIndividualTotalPrice = $bQuantities[$i] * $bProductInfo["Price"];

															echo "

																<tr>
																	<td>						 #{$bProductInfo["ProductID"]}	</td>
																	<td>						  {$bProductInfo["Name"]}		</td>
																	<td class=\"stat-cell\">	\${$bProductInfo["Price"]}		</td>
																	<td class=\"stat-cell\">	  {$bQuantities[$i]}			</td>
																	<td class=\"stat-cell\">	\${$bIndividualTotalPrice}		</td>
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

				<div class="row mt-4"> <!-- Go Back Button -->
					<form action="UserPurchaseHistory.php">
						<button type="submit" class="shadow-sm btn app-btn-primary">Go Back</button>	
					</form>
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

</body>
</html> 

