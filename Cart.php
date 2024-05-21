<?php

    session_start();

	if(!defined("_UTILITIES_PATH_")){

		define("_UTILITIES_PATH_", "assets/main/php/");
	}
    include_once(_UTILITIES_PATH_ . "Session_CheckAuth.php");

    Session_CheckAuthLevel("USER");
?>

<?php
    include_once(_UTILITIES_PATH_ . "Database_EstConnection.php");  // Include your database connection

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $customerId = $_SESSION["UserID"];

    if ($action == 'update_quantity') {

        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $update_query = "UPDATE Cart SET Quantity = :quantity, PayAmount = :payamount WHERE CustomerID = :customerid AND ProductID = :productid LIMIT 1";
        $update_stmt = $dbHandler->prepare($update_query);
        $update_stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $payamount = calculatePayAmount($productId, $quantity, $dbHandler);
        $update_stmt->bindParam(':payamount', $payamount, PDO::PARAM_STR);
        $update_stmt->bindParam(':customerid', $customerId, PDO::PARAM_STR);
        $update_stmt->bindParam(':productid', $productId, PDO::PARAM_STR);
        $update_stmt->execute();
    } elseif ($action == 'delete_product') {

        $productId = $_POST['product_id'];
        $delete_query = "DELETE FROM Cart WHERE CustomerID = :customerid AND ProductID = :productid LIMIT 1";
        $delete_stmt = $dbHandler->prepare($delete_query);
        $delete_stmt->bindParam(':customerid', $customerId, PDO::PARAM_STR);
        $delete_stmt->bindParam(':productid', $productId, PDO::PARAM_STR);
        $delete_stmt->execute();
    }
}

function calculatePayAmount($productId, $quantity, $dbHandler) {
    $query = "SELECT Price FROM Products WHERE ProductID = :productid LIMIT 1";
    $stmt = $dbHandler->prepare($query);
    $stmt->bindParam(':productid', $productId, PDO::PARAM_STR);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    return $product['Price'] * $quantity;
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
    <title>Cart | DENNIS' ARMORY</title>

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
            <div class="header__cart__price">Item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="assets/main/images/language.png" alt="">
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
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="Shop.php">Shop</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="shop-details.php">Shop Details</a></li>
                        <li><a href="Cart.php">Shoping Cart</a></li>
                        <li><a href="checkout.php">Check Out</a></li>
                        <li><a href="blog-details.php">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
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
                    
                                                                    title:  'Logout Successfully',
                                                                    icon:   'success',
                                                                    confirmButtonText:  'Okay'
                                                                
                                                                }).then((result) => {
                                                                    
                                                                    if(result.isConfirmed){

                                                                        window.location.href = 'index.php';
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
                            <li><a href="Shop.php?fShopSearchHolder=&fRequestShopSearch=true">Products</a></li>
                            <li><a href="Contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">

                        <ul>
                            <li>
                                <a href="Cart.php">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span id="cart-count">0</span>
                                </a>
                            </li>
                        </ul>
                        <div class="header__cart__price">Total: <span id="total-price0">$0</span></div>
                    
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

                                        echo "<li><a href=\"Shop.php?fShopSearchCategoryID={$availableCategories["CategoryID"]}\">{$availableCategories["Name"]}</a></li>";   
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

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>



                                <?php
                                    $LIST_ALL_INCART_PRODUCT = "

                                        SELECT P.Name  AS ProductName,
                                               P.Image AS ProductImage,
                                               P.Price AS ProductPrice,
                                               C.*

                                        FROM Cart C
                            
                                        JOIN Products P

                                        ON P.ProductID = C.ProductID

                                        WHERE CustomerID = :CustomerID
                                    ";

                                    $LISTING_STMT = $dbHandler -> prepare($LIST_ALL_INCART_PRODUCT);
                                    $LISTING_STMT-> bindParam(":CustomerID", $_SESSION["UserID"], PDO::PARAM_STR);

                                    if($LISTING_STMT-> execute()){

                                        while($_RECS_ = $LISTING_STMT -> fetch(PDO::FETCH_ASSOC)){

                                            echo "
                                                <tr>
                                                    <td class=\"shoping__cart__item\">
                                                        <img src='data:image/jpeg;base64,".base64_encode($_RECS_['ProductImage'])."' alt='Product Image' style='max-width: 20%; max-height: 20%;'>
                                                        <h5>{$_RECS_["ProductName"]}</h5>
                                                    </td>
                                                    <td class=\"shoping__cart__price\">
                                                        \${$_RECS_["ProductPrice"]}
                                                    </td>
                                                    <td class=\"shoping__cart__quantity\">
                                                        <div class=\"quantity\">
                                                            <div class=\"pro-qty\">
                                                                <span class=\"dec qtybtn\" data-id=\"{$_RECS_["ProductID"]}\">-</span>
                                                                <input type=\"text\" value=\"{$_RECS_["Quantity"]}\" data-id=\"{$_RECS_["ProductID"]}\" class=\"quantity-input\">
                                                                <span class=\"inc qtybtn\" data-id=\"{$_RECS_["ProductID"]}\">+</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class=\"shoping__cart__total\">
                                                        \${$_RECS_["PayAmount"]}
                                                    </td>
                                                    <td class=\"shoping__cart__item__close\">
                                                        <span class=\"icon_close delete-product\" data-id=\"{$_RECS_["ProductID"]}\"></span>
                                                    </td>
                                                </tr>
                                            ";
                                        }
                                    }
                                ?>
                                


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Total: <span id="total-price1">$0</span></li>
                        </ul>
                        <a href="Checkout.php" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to update the cart count
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

            // Call updateCartCount on page load
            
            updateCartTotal();

            // Handle quantity change
            function updateQuantity(productId, quantity) {
                $.ajax({
                    url: 'Cart.php',
                    type: 'POST',
                    data: {
                        action: 'update_quantity',
                        product_id: productId,
                        quantity: quantity
                    },
                    success: function(response) {
                        // Update the cart count after changing quantity
                        updateCartCount();
                        // Optionally reload the page to reflect other changes
                        location.reload(); 
                    }
                });
            }

            $('.quantity-input').on('change', function() {
                var productId = $(this).data('id');
                var newQuantity = $(this).val();
                updateQuantity(productId, newQuantity);
            });

            $('.qtybtn').on('click', function() {
                var $button = $(this);
                var oldValue = $button.siblings('.quantity-input').val();
                var productId = $button.data('id');
                var newVal = $button.hasClass('inc') ? parseInt(oldValue) + 1 : parseInt(oldValue) - 1;

                if (newVal >= 1) {  // Ensure the quantity does not go below 1
                    $button.siblings('.quantity-input').val(newVal);
                    updateQuantity(productId, newVal);
                }
            });
            
            // ===========================================================================================================
            // Handle Product Deletion
            // ===========================================================================================================
            $('.delete-product').on('click', function() {
                var productId = $(this).data('id');

                $.ajax({
                    url: 'Cart.php',
                    type: 'POST',
                    data: {
                        action: 'delete_product',
                        product_id: productId
                    },
                    success: function(response) {
                        // Update the cart count after deleting a product
                        updateCartCount();
                        // Optionally reload the page to reflect other changes
                        location.reload(); 
                    }
                });
            });
        });
    </script>
</body>

</html>