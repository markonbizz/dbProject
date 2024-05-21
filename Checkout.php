<?php

    session_start();

	if(!defined("_UTILITIES_PATH_")){

		define("_UTILITIES_PATH_", "assets/main/php/");
	}

    include_once(_UTILITIES_PATH_ . "Session_CheckAuth.php");
    
    Session_CheckAuthLevel();
?>

<?php

    include_once(_UTILITIES_PATH_ . "Database_EstConnection.php");

    $COUNT_CART_CONTENTS = "SELECT COUNT(*) FROM `Cart` WHERE CustomerID = :CustomerID";
    
    $CHECK_STMT = $dbHandler -> prepare($COUNT_CART_CONTENTS);
    $CHECK_STMT-> bindParam(":CustomerID", $_SESSION["UserID"], PDO::PARAM_STR);
    $CHECK_STMT -> execute();
    
    if($CHECK_STMT -> fetchColumn() <= 0){

        echo "

            <script>
                alert(\"No Item in the Cart, redirecting to Shop...\");
                window.location.href = \"Shop.php?CurrentPageIndex=1&fShopSearchHolder=&fRequestShopSearch=true\";
            </script>
        ";
    }
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout | DENNIS' ARMORY</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="assets/main/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/main/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="assets/main/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="assets/main/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="assets/main/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="assets/main/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="assets/main/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="assets/main/css/style.css" type="text/css">

    <!-- CSS Override -->
    <link rel="stylesheet" href="assets/main/css/custom_style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">

                            <?php
                                include_once(_UTILITIES_PATH_ . "Render_Store_Topbar_LoginWelcome.php");
                            ?>
                        
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            
                            <?php

                                include_once(_UTILITIES_PATH_ . "Render_Store_Topbar_AccountEntry.php");
                                echo "&nbsp";
                                echo "&nbsp";
                                if(isset($_SESSION["Account"])){

                                    echo
                                    "
                                        <div class=\"header__top__right__auth\">
                                            <a id=\"RequestUserLogout\">
                                                <i class=\"fa fa-sign-out\"></i>
                                                <strong> Logout </strong>
                                            </a>
                                        </div>
                                    ";
                                }
                            ?>

                            <!-- SweetAlert2 Logout Prompts -->
                            <?php

                                echo "
                                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></>
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


                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="index.php"><img src="assets/main/images/logo-title.svg" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./index.php">Home</a></li>
                            <li><a href="Shop.php?CurrentPageIndex=1&fShopSearchHolder=&fRequestShopSearch=true">Products</a></li>
                            <li><a href="Contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="Cart.php"><i class="fa fa-shopping-cart"></i> <span id="cart-count">0</span></a></li>
                        </ul>
                        <div class="header__cart__price">Total: <span id="total-price0">0</span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
     <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Quick Access</span>
                        </div>
                        <ul>
                            

                            
                            <?php
                                include_once(_UTILITIES_PATH_ . "Database_EstConnection.php");

                                $CATEGORIES = "

                                    SELECT * FROM Categories
                                ";

                                $SQL_STATMENT = $dbHandler -> prepare($CATEGORIES);
                                
                                if($SQL_STATMENT -> execute()){

                                    echo "<li><a href=\"Shop.php?CurrentPageIndex=1&fShopSearchHolder=&fRequestShopSearch=true\">All</a></li>";

                                    while($availableCategories = $SQL_STATMENT -> fetch()){

                                        echo "<li><a href=\"Shop.php?CurrentPageIndex=1&fShopSearchCategoryID={$availableCategories["CategoryID"]}\">{$availableCategories["Name"]}</a></li>";   
                                    }
                                }
                            ?>



                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        
                        
                        
                        <div class="hero__search__form">

                            <form name="ShopSearchForm" action="Shop.php" method="get">

                                <input name="fShopSearchHolder" type="text" placeholder="What's your jam?">
                                <button name="fRequestShopSearch" value="true" type="submit" class="site-btn">SEARCH</button>
                            </form>

                        </div>
                        
                        
                        
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+886 &nbsp; 0912345678</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Billing Details</h4>

                
                <form name="fPlaceOrderForm" action="Checkout.php" method="post">
                    <div class="row">
                        <div class="col-lg-12 col-md-6">

                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input name="fOrderAddress" type="text" placeholder="Enter your address here, otherwise, using account default" value="" class="checkout__input__add">
                            </div>

                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>

                                    <?php

                                        include_once(_UTILITIES_PATH_ . "Database_EstConnection.php");

                                        $FETCH_CART_CONTENTS = "

                                            SELECT 
                                                P.Name AS ProductName,
                                                C.*
                                            FROM 
                                                Cart C
                                            JOIN
                                                Products P
                                            ON 
                                                P.ProductID = C.ProductID
                                            WHERE
                                                CustomerID = :CustomerID
                                        ";

                                        $CART_BRIFE_STMT = $dbHandler -> prepare($FETCH_CART_CONTENTS);
                                        $CART_BRIFE_STMT-> bindParam(":CustomerID", $_SESSION["UserID"], PDO::PARAM_STR);

                                        try{

                                            if($CART_BRIFE_STMT -> execute()){

                                                while($record = $CART_BRIFE_STMT -> fetch(PDO::FETCH_ASSOC)){

                                                    echo "<li>{$record["ProductName"]} <span>\${$record["PayAmount"]}</span></li>";
                                                }               
                                            }
                                        }catch(PDOException $err){

                                            echo "DATABASE ERROR: " . $err->getMessage();
                                        }
                                    ?>
                                </ul>
                                <hr>
                                <div class="checkout__order__total">Total: <span id="total-price1">$0</span></div>
                                <button name="fRequestPlaceOrder" value="true" type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>

                
                
                <!-- Making Order -->
                <?php
                    include_once(_UTILITIES_PATH_ . "Database_EstConnection.php");

                    if(($_SERVER["REQUEST_METHOD"] === "POST") && isset($_POST["fRequestPlaceOrder"]) && ($_POST["fRequestPlaceOrder"])){

                        $COUNT_CART_CONTENT = "
                            SELECT COUNT(*) FROM Cart WHERE CustomerID = :CustomerID 
                        ";

                        $bProductListArray  = [];
                        $bQuantityListArray = [];
                        $bProductList       = "";
                        $bQuantityList      = "";

                        
                        $bCartCustomerID    = $_SESSION["UserID"];
                        $bOrderDate         = date('Y-m-d H:i:s');
                        $bOrderAddress      = $_POST["fOrderAddress"] ?? "";
                        $bCartTotalPayment  = 0;

                        /* ============================================================================================================== */

                        $COUNT_STMT = $dbHandler -> prepare($COUNT_CART_CONTENT);
                        $COUNT_STMT-> bindParam(":CustomerID", $bCartCustomerID, PDO::PARAM_STR);
                        $COUNT_STMT-> execute();

                        if(($COUNT_STMT-> fetchColumn() > 0)){
                            
                            $FETCH_CART_PRODUCTS = "
                                SELECT * FROM Cart WHERE CustomerID = :CustomerID 
                            ";
                            
                            $FETCH_STMT = $dbHandler -> prepare($FETCH_CART_PRODUCTS);
                            $FETCH_STMT-> bindParam(":CustomerID", $bCartCustomerID, PDO::PARAM_STR);
                            $FETCH_STMT-> execute();

                            while($bCartRecord = $FETCH_STMT -> fetch(PDO::FETCH_ASSOC)){

                                array_push($bProductListArray,  $bCartRecord["ProductID"]);
                                array_push($bQuantityListArray, $bCartRecord["Quantity"]);

                                $bCartTotalPayment += $bCartRecord["PayAmount"];
                            }

                            $bProductList  = implode(",", $bProductListArray);
                            $bQuantityList = implode(",", $bQuantityListArray);
                        }

                        /* ============================================================================================================== */
                        /* ============================================================================================================== */

                        if(isset($_POST["fOrderAddress"]) && ($_POST["fOrderAddress"]) && (!empty($bProductListArray)) && (!empty($bQuantityListArray))){

                            $PLACE_ORDER = "
                                INSERT INTO Orders ( CustomerID,  ProductIDs,  Quantities,  TotalPayment,  Date,  Address)
                                                   VALUES
                                                   (:CustomerID, :ProductIDs, :Quantities, :TotalPayment, :Date, :Address)
                            ";

                            $MAKE_ORDER_STMT = $dbHandler -> prepare($PLACE_ORDER);
                            $MAKE_ORDER_STMT-> bindParam(":CustomerID",     $bCartCustomerID,   PDO::PARAM_STR);
                            $MAKE_ORDER_STMT-> bindParam(":ProductIDs",     $bProductList,      PDO::PARAM_STR);
                            $MAKE_ORDER_STMT-> bindParam(":Quantities",     $bQuantityList,     PDO::PARAM_STR);
                            $MAKE_ORDER_STMT-> bindParam(":TotalPayment",   $bCartTotalPayment, PDO::PARAM_INT);
                            $MAKE_ORDER_STMT-> bindParam(":Date",           $bOrderDate,        PDO::PARAM_STR);
                            $MAKE_ORDER_STMT-> bindParam(":Address",        $bOrderAddress,     PDO::PARAM_STR);

                            try{

                                if($MAKE_ORDER_STMT -> execute()){

                                    $EMPTY_CART_ITEMS = "

                                        DELETE FROM Cart WHERE CustomerID = :CustomerID
                                    ";

                                    $CLEARCART_STMT = $dbHandler -> prepare($EMPTY_CART_ITEMS);
                                    $CLEARCART_STMT-> bindParam(":CustomerID", $bCartCustomerID, PDO::PARAM_STR);

                                    if($CLEARCART_STMT-> execute()){
                                    
                                        echo "
                                            <script>
                                                alert(\"Order Successfully Created!\");
                                                window.location.href = \"Shop.php?CurrentPageIndex=1&fShopSearchHolder=&fRequestShopSearch=true\";
                                            </script>
                                        ";
                                    }
                                }
                            }catch(PDOException $err){

                                echo "DATABASE ERROR: " . $err -> getMessage();
                            }
                        }
                    }
                ?>


                
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

   <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="index.php"><img src="assets/main/images/logo-title.svg" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: National Pingtung University</li>
                            <li>Phone: +886 &nbsp; 0912345678</li>
                            <li>Email: dennisbrown12345@email.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->


    <!-- Js Plugins -->
    <script src="assets/main/js/jquery-3.3.1.min.js"></script>
    <script src="assets/main/js/bootstrap.min.js"></script>
    <script src="assets/main/js/jquery.nice-select.min.js"></script>
    <script src="assets/main/js/jquery-ui.min.js"></script>
    <script src="assets/main/js/jquery.slicknav.js"></script>
    <script src="assets/main/js/mixitup.min.js"></script>
    <script src="assets/main/js/owl.carousel.min.js"></script>
    <script src="assets/main/js/main.js"></script>

    <script>
        $(document).ready(function(){
        
            function updateCartCount() {
                $.ajax({
                    url: 'assets/main/php/Store_Cart_CountCart.php', // A PHP file to get the current cart count
                    type: 'GET',
                    success: function(response) {
                        $('#cart-count').text(response);
                    }
                });
            }
            
            updateCartCount();

            function updateCartTotal() {
                $.ajax({
                    url: 'assets/main/php/Store_Cart_CalculateTotalAmount.php',
                    type: 'GET',
                    success: function(response) {
                        $('#total-price0').text('$' + response);
                        $('#total-price1').text('$' + response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching cart total:', status, error);
                    }
                });
            }

            updateCartTotal();
        });
    </script>

</body>

</html>