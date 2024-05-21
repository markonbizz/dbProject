<?php

    session_start();

	if(!defined("_UTILITIES_PATH_")){

		define("_UTILITIES_PATH_", "assets/main/php/");
	}

    include_once(_UTILITIES_PATH_ . "Session_CheckAuth.php");
    include_once(_UTILITIES_PATH_ . "Database_EstConnection.php");
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop -  | DENNIS' ARMORY</title>

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

    <?php
        if(($_SERVER["REQUEST_METHOD"] === "POST") && isset($_POST["fRequestAddToCart"]) && ($_POST["fRequestAddToCart"])){

            Session_CheckAuthLevel("USER", "Login.php");

            if(isset($_POST["fAddProductID"]) && ($_POST["fAddProductID"]) && isset($_POST["fAddProductQuantity"]) && ($_POST["fAddProductQuantity"])){

                $INSERT_TO_CART = "
                    INSERT INTO Cart ( CustomerID,  ProductID,  Quantity,  PayAmount) 
                                    VALUES
                                    (:CustomerID, :ProductID, :Quantity, :PayAmount)
                ";

                $bCustomerID        = $_SESSION["UserID"]           ?? "";
                $bProductID         = $_POST["fAddProductID"]       ?? "";
                $bProductQuantity   = $_POST["fAddProductQuantity"] ?? 1;
                $bProductPrice      = $_POST["fAddProductPrice"]    ?? "";
                
                $bProductPayAmount  = $bProductPrice * $bProductQuantity;

                $ADDCART_STMT = $dbHandler -> prepare($INSERT_TO_CART);
                $ADDCART_STMT-> bindParam(":CustomerID",  $bCustomerID,         PDO::PARAM_STR);
                $ADDCART_STMT-> bindParam(":ProductID",   $bProductID,          PDO::PARAM_INT);
                $ADDCART_STMT-> bindParam(":Quantity",    $bProductQuantity,    PDO::PARAM_INT);
                $ADDCART_STMT-> bindParam(":PayAmount",   $bProductPayAmount,   PDO::PARAM_INT);

                try{
                
                    if($ADDCART_STMT -> execute()){

                        echo
                        "
                            <script>
                                alert(\"Product Successfullt Added.\");
                                window.location.href = \"Shop.php?CurrentPageIndex=1&fShopSearchHolder=&fRequestShopSearch=true\";
                            </script>
                        ";
                    }

                }catch(PDOException $ERR){
                
                    echo "DATABASE ERROR:" . $ERR -> getMessage();
                }
            }
        }
    ?>

    <?php
    
        include_once(_UTILITIES_PATH_ . "Database_EstConnection.php");

        $FETCH_PRODUCT_INFO = "

            SELECT * FROM Products
            WHERE ProductID = :ProductID
        ";
        
        $bTargetProductID = $_GET["ProductID"] ?? "";

        $TARGET_PRODUCT_STMT = $dbHandler -> prepare($FETCH_PRODUCT_INFO );    
        $TARGET_PRODUCT_STMT-> bindParam(":ProductID", $bTargetProductID, PDO::PARAM_INT);
    ?>

</head>

<body>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="assets/main/images/logo-title.svg" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.php">Home</a></li>
                <li><a href="./shop-grid.php">Shop</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.php">Shop Details</a></li>
                        <li><a href="./shoping-cart.php">Shoping Cart</a></li>
                        <li><a href="./checkout.php">Check Out</a></li>
                        <li><a href="./blog-details.php">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="./blog.php">Blog</a></li>
                <li><a href="./contact.php">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
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
                            <li><a href="index.php">Home</a></li>
                            <li class="active"><a href="Shop.php?fShopSearchHolder=&fRequestShopSearch=true">Products</a></li>
                            <li><a href="Contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="Cart.php"><i class="fa fa-shopping-cart"></i> <span>3</span></a></li>
                        </ul>
                        <div class="header__cart__price">Item: <span>$150.00</span></div>
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

                                        echo "<li><a href=\"Shop.php?CurrentPageIndex=1&RequestedCategoryID={$availableCategories["CategoryID"]}\">{$availableCategories["Name"]}</a></li>";   
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

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">



                        <?php
                            
                            if($TARGET_PRODUCT_STMT -> execute()){

                                $bProduct = $TARGET_PRODUCT_STMT -> fetch(PDO::FETCH_ASSOC);
                            }

                            echo"
                                <div class=\"product__details__pic__item\">
                                    <img class=\"product__details__pic__item--large\" src='data:image/jpeg;base64,".base64_encode($bProduct["Image"])."' alt='Product Image'>
                                </div>
                            ";

                        ?>



                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="img/product/details/product-details-1.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">

                        <?php

                            echo "
                                <h3>{$bProduct["Name"]}</h3>

                                <div class=\"product__details__price\">\${$bProduct["Price"]}</div>
                            ";
                        ?>

                        <form action="ItemDetail.php" method="post">

                            <div class="product__details__quantity">
                                <div class="quantity" style="display: inline-block; margin-right: 10px;">
                                    <div class="product-qty">
                                        <span class="dec qtybtn" onclick="decreaseQuantity()">-</span>
                                        <input type="text" id="quantity" value="1" readonly>
                                        <span class="inc qtybtn" onclick="increaseQuantity()">+</span>
                                    </div>
                                </div>
                            </div>
                            
                            <input type="hidden" name="fAddProductID" value="<?php echo $bProduct["ProductID"]; ?>">
                            <input type="hidden" name="fAddProductPrice" value="<?php echo $bProduct["Price"]; ?>">
                            <input type="hidden" id="quantity-input" name="fAddProductQuantity" value="1">
                            <button name='fRequestAddToCart' value='true' class="primary-btn" style="display:inline-block; border: none;">ADD TO CARD</button>

                        </form>
                        
                        <?php // Add To Cart

                        ?>

                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">

                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                        </ul>
                    
                        <div class="tab-content">

                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    
                                    
                                
                                    <p>
                                        <?php
                                            echo $bProduct["Description"];
                                        ?>
                                    </p>
                                
                                
                                
                                </div>
                            </div>
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    
    <!-- Related Product Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.php"><img src="assets/main/images/logo-title.svg" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello@colorlib.com</li>
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
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
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
        function increaseQuantity() {
            var quantityInput = document.getElementById('quantity');
            var currentQuantity = parseInt(quantityInput.value);
            quantityInput.value = currentQuantity + 1;
            document.getElementById('quantity-input').value = quantityInput.value;
        }

        function decreaseQuantity() {
            var quantityInput = document.getElementById('quantity');
            var currentQuantity = parseInt(quantityInput.value);
            if (currentQuantity > 1) {
                quantityInput.value = currentQuantity - 1;
                document.getElementById('quantity-input').value = quantityInput.value;
            }
        }
    </script>
</body>

</html>