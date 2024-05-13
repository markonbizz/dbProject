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
	<link rel="stylesheet" href="assets/user-portal/css/portal-uploadProduct.css">

	<?php

		Session_CheckAuthLevel("USER", active: true);

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

				<div class="row py-4 g-4 settings-section">

					<div class="col-12 col-md-8">
						<form class="settings-form" action="UserProductList.php">
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

	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">
							
							<div class="app-card-body">

								<form name="fUploadProductForm" class="settings-form" action="UserEditProduct.php" method="post" enctype="multipart/form-data">
									
									<div class="mb-3">
										<label for="setting-input-2" class="form-label">Image</label>
									    <input type='file' name="fProductImage" accept=".jpg, .jpge" class="form-control" id="ImagePreview"/>
									</div>

									<div class="mb-3">
									    <label for="setting-input-2" class="form-label">Name</label>
									    <input type="text" name="fProductName" class="form-control" id="setting-input-2" placeholder="" required>
									</div>

									<div class="mb-3">
									    <label for="setting-input-2" class="form-label">Category</label>

										<select name="fProductCategory" class="form-select mb-3" onchange="UploadCategoryOptionCheck(this);">
											<?php

												include_once(_UTILITIES_PATH_ . "Render_User_ProductList_Upload&Edit_ListExistedCategories.php");
											
											?>
											<option value="0" id="OptionOther">Other</option>
										</select>
									
										<div class="mb-3" id="fProductCustomCategory_Wrapper" style="display: none;">
											<label for="setting-input-2" class="form-label">Custom Category</label>
											<input type="text" name="fProductCustomCategory" class="form-control" id="fProductCustomCategory_Input">
										</div>

									</div>

									<div class="mb-3">
									    <label for="setting-input-2" class="form-label">Price</label>
									    <input type="number" name="fProductPrice" class="form-control" id="setting-input-2" placeholder="" required>
									</div>

									<div class="mb-3">
										<label for="setting-input-2" class="form-label">Description</label>
    									<textarea name="fProductDescription" class="form-control ProductDescription" id="ProductDescription"></textarea>
									</div>

									<button type="submit" name="fUpdateProduct" value="true" class="btn app-btn-primary">
										<div class="icon icon-badge app-utility-item">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
												<path d="M11 2H9v3h2z"/>
												<path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
											</svg>
										</div>
										&nbsp;
										Save Changes
									</button>
							    
								</form>
								
								<?php

									include_once(_UTILITIES_PATH_ . "User_ProductList_EditProduct_Update.php");
								
								?>

						    </div><!--//app-card-body-->
						</div><!--//app-card-->
	                </div>

					<div class="col-12 col-md-4">
						<div class="app-card app-card-settings shadow-sm p-4">
						    <div class="app-card-body">
							    
								<h2 class="section-title">Product Image Preview</h2>
								<img id="blah" src="#" alt="Product Image Gose Here" style="max-width: 45%; max-height: 45%;"/>
								
								<hr class="my-4">

								<div class="mb-2">
									<h1 class="section-title">Target Product Info</h1>
									<?php
										include_once(_UTILITIES_PATH_ . "Render_User_ProductList_EditProduct_FetchProductInfo.php");
									?>
								</div>
							    
								<!-- Info Goes Here -->

						    </div><!--//app-card-body-->
						</div><!--//app-card-->
				    </div>
				
				<!-- =========================================================================================================== -->

				<!-- Main Page - Portal Template Author Signature -->
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

