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
							<h1 class="app-page-title col">Upload A Product</h1>
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

								<form name="fUploadProductForm" class="settings-form" action="UserUploadProduct.php" method="post" enctype="multipart/form-data">
									
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

												include_once(_UTILITIES_PATH_ . "Render_User_UploadProduct_AvaliableCategories.php");
											
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

									<button type="submit" name="fUploadProduct" value="true" class="btn app-btn-primary">
										<div class="icon icon-badge app-utility-item">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cloud-arrow-up" viewBox="0 0 16 16">
												<path fill-rule="evenodd" d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708z"/>
												<path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383m.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
											</svg>
										</div>
										&nbsp;
										Upload
									</button>
							    
								</form>
								
								<?php

									include_once(_UTILITIES_PATH_ . "User_ProductList_UploadProduct.php");
								
								?>

						    </div><!--//app-card-body-->
						</div><!--//app-card-->
	                </div>

					<div class="col-12 col-md-4">
		                <h2 class="section-title">Product Image Preview</h2>
				   		<hr class="my-4">

						<img id="blah" src="#" alt="Product Image Gose Here" style="max-width: 100%; max-height: 100%;"/>

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

