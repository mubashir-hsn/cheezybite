<?php
include('connect.php');
include('./functions/getProducts.php');

session_start();
$totalPrice = 0;
$cart_count = 0;

if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    $cart_count = countCartItems($_SESSION['user_id']);     // Count total cart items
    $totalPrice = getTotalPrice($_SESSION['user_id']);  // Calculate total cart items price
}

$user_id = $_SESSION['user_id'] ?? '';
$product_id = $_GET['p_id'] ?? '';
$action = $_GET['action'] ?? '';

if ($action == 'remove' && !empty($product_id)) {
    global $con;
    $res = mysqli_query($con, "DELETE FROM cart WHERE id = '$product_id'");
    if ($res) {
        echo "<script> alert('Product is removed from cart.') ; window.location = 'cart.php';</script> ";
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
  <link rel="Website icon" type="png" href="/logo/logo.jpg">
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="./css/style.css">
    <title>Cart</title>
</head>

<body style="font-family: Poppins; background-color: whitesmoke;">

    <!-- ......Navbar Section Start ..................................    -->
    <header>
        <?php include('navbar.php'); ?>
    </header>

    <!-- ...... Navbar Section End ..............................................................  -->


    <!-- ........... Cart Section Start ................................................. -->

    <div class="container-fluid" style="margin-top: 5rem;">
        <div class="bg-image image-responsive row d-flex justify-content-center align-items-center" style="
        background-image: url('./images/ban1.jpg');
        height: 400px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        background-attachment:fixed;
        ">
            <div class="col-12 col-md-10 col-lg-8 p-sm-0 p-md-2 p-lg-5" style="background-color: rgba(255,255,255,.5);">
                <h1 class="mt-1" style="text-align: center; color:black; padding: 20px 0px;">Your Bucket</h1>
            </div>
        </div>

    </div>

    <section>
        <div class="container-fluid mt-1">
            <div class="container p-3">

                <div class="row my-3">
                    <h4 class=" text-capitalize h4 py-1" style="font-family: 'Poppins'; color: #c50303; border-bottom:2px solid #c50303; ">Your Cart Items</h4>
                </div>

                <div class="row pt-3 d-flex flex-column flex-md-row justify-content-center justify-content-md-start align-items-center align-items-md-start gap-5">

                    <!-- Cart items -->
                    <div class="col-10 col-md-7 d-flex gap-3 flex-column justify-content-center justify-content-md-start align-items-center align-items-md-start">
                        <?php
                        if ($cart_count > 0) {
                            getCartItems($user_id);
                        } else {
                            echo ' <p class="pt-3 ps-3 lead">Your cart is empty.</p> ';
                        }
                        ?>
                    </div>

                    <!-- Cart Summary -->
                    <div class="col-10 col-md-4 rounded-2">
                        <div class="w-100 p-2 rounded-2" style="background-color: #ffef47; color:black;">
                            <div class="my-3 pb-1 px-2 border-bottom border-secondary">
                                <h4 class=" text-capitalize h4" style="font-family: 'Poppins'; color: #c50303;">Order Summary</h4>
                            </div>
                            <!-- Cart Items -->
                            <div class=" px-3 pt-2 d-flex justify-content-between align-items-center fw-medium" style="font-size: '16px';">
                                <p>Items</p>
                                <p><?php echo $cart_count; ?></p>
                            </div>
                            <!-- Cart Subtotal -->
                            <div class="px-3 pb-2 d-flex justify-content-between align-items-center fw-medium" style="font-size: '16px';">
                                <p>Subtotal</p>
                                <p><?php echo intval($totalPrice); ?></p>
                            </div>
                            <!-- Cart Total -->
                            <div class=" px-3 pt-1 border-top border-secondary d-flex justify-content-between align-items-center fw-semibold" style="font-size: '22px';">
                                <p>Total</p>
                                <p><?php echo $totalPrice; ?></p>
                            </div>
                            <div class="pt-3 pb-1">
                                <a href="checkout.php" class="py-3 cartHover cart-btn btn rounded-2 d-flex justify-content-center align-items-center text-decoration-none fw-medium" style="font-family: 'Poppins';">
                                    <span class="material-symbols-outlined pe-2">credit_card</span>
                                    <span>Checkout Now</span>
                                </a>
                            </div>

                        </div>
                    </div>


                </div>
            </div>

        </div>

    </section>

    <!-- .............. Footer Section Start ............................... -->

    <section>
        <?php include('footer.php'); ?>
    </section>

    <!-- .............. Footer Section End ............................... -->

    <script src="/js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>