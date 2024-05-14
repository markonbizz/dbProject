<?php

    session_start();

	if(!defined("_UTILITIES_PATH_")){

		define("_UTILITIES_PATH_", "assets/main/php/");
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
    <title>DENNIS' ARMORY | Shop</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="assets/main/css/bootstrap.min.css"     type="text/css">
    <link rel="stylesheet" href="assets/main/css/font-awesome.min.css"  type="text/css">
    <link rel="stylesheet" href="assets/main/css/elegant-icons.css"     type="text/css">
    <link rel="stylesheet" href="assets/main/css/nice-select.css"       type="text/css">
    <link rel="stylesheet" href="assets/main/css/jquery-ui.min.css"     type="text/css">
    <link rel="stylesheet" href="assets/main/css/owl.carousel.min.css"  type="text/css">
    <link rel="stylesheet" href="assets/main/css/slicknav.min.css"      type="text/css">
    <link rel="stylesheet" href="assets/main/css/style.css"             type="text/css">

    <!-- CSS Override -->
    <link rel="stylesheet" href="assets/main/css/custom_style.css" type="text/css">

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
                <li><a href="#"><i class="fa fa-shopping-cart"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="Shop.php">Shop</a></li>
                <li><a href="Contact.php">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i>dennisbrown12345@email.com</li>
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
                                include_once(_UTILITIES_PATH_ . "Render_Store_Topbar_LogoutEntry.php");
                            
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
                            <li class="active"><a href="Shop.php">Shop</a></li>
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

                                    while($availableCategories = $SQL_STATMENT -> fetch()){

                                        echo "<li><a href=\"Shop.php?RequestedCategoryID={$availableCategories["CategoryID"]}\">{$availableCategories["Name"]}</a></li>";   
                                    }
                                }

                            ?>



                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
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

    <!-- Breadcrumb Section Begin -->
    
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Catagories</h4>
                            <ul>



                                <?php



                                    include_once(_UTILITIES_PATH_ . "Database_EstConnection.php");

                                    $CATEGORIES = "

                                        SELECT * FROM Categories
                                    ";

                                    $SQL_STATMENT = $dbHandler -> prepare($CATEGORIES);
                                    
                                    if($SQL_STATMENT -> execute()){

                                        while($availableCategories = $SQL_STATMENT -> fetch()){

                                            echo "<li><a href=\"Shop.php?RequestedCategoryID={$availableCategories["CategoryID"]}\">{$availableCategories["Name"]}</a></li>";   
                                        }
                                    }

                                ?>



                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-9 col-md-7">
                    

                    <div class="row">
                        <div class="col-lg-4 col-md-4"></div>

                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <h5><strong>16</strong> Products found</h5>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-4"></div>
                    </div>


                    <!-- Listing Found Products -->
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="assets/main/images/product/product-1.jpg">
                                    <ul class="product__item__pic__hover">
                                        <!-- <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li> -->
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#">Product 01</a></h6>
                                    <h5>$30.00</h5>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

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
                        <!-- <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="footer__copyright__payment"><img src="assets/main/images/payment-item.png" alt=""></div>
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
</body>

</html>