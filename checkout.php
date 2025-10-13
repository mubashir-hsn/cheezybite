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

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $cart_count < 1) {
    echo "<script>alert('Your cart is empty.'); window.location='cart.php';</script>;";
    exit();
}


$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$email = $_SESSION['email'];

if (isset($_POST['submit_order'])) {

    global $con;
    
   // form details
    $contact_no = $_POST['contact'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $payment = $_POST['payment'];
    $payment_status = '';

     if ($payment=='cod') {
        $payment_status='pending';
     }else{
        $payment_status='paid';
     }

    // fetch user cart items
    $cart_query = mysqli_query($con,"SELECT * FROM cart WHERE user_id = '$user_id'");

    if (mysqli_num_rows($cart_query)==0) {
        echo "<script>alert('Your cart is empty.'); window.location='cart.php';</script>;";
        exit();
    }

    // insert into order table
    $order_query = mysqli_query($con,"INSERT INTO orders(user_id,total_price,name,email,contact,city,address,payment,payment_status)
                                     VALUES ('$user_id','$totalPrice','$user_name','$email','$contact_no','$city','$address','$payment','$payment_status')");
    
    if ($order_query) {
        $order_id = mysqli_insert_id($con);

        while ($cart_items = mysqli_fetch_assoc($cart_query)) {

            $product_id = $cart_items['product_id'];
            $quantity = $cart_items['quantity'];
           // insert order items
            mysqli_query($con,"INSERT INTO order_items(order_id,product_id,quantity,total_price) VALUES ('$order_id','$product_id','$quantity','$totalPrice')");
           
        }
        // delete items from cart
        mysqli_query($con,"DELETE FROM cart WHERE user_id = '$user_id'");
        echo "<script>alert('Order placed successfully.'); window.location='orders.php';</script>;";

    }else {
        echo "<script>alert('Order failed. Please try again.'); window.location='cart.php';</script>";
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
    <title>Cart Checkout</title>
</head>

<body style="font-family: Poppins; background-color: whitesmoke;">

    <!-- ......Navbar Section Start ..................................    -->
    <header>
        <?php include('navbar.php'); ?>
    </header>

    <!-- ...... Navbar Section End ..............................................................  -->

    <div class="container-fluid" style="margin-top: 5rem;">
        <div class="bg-image image-responsive row d-flex justify-content-center align-items-center" style="
        background-image: url('./images/out.png');
        height: 400px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        background-attachment:fixed;
        ">
            <div class="col-12 col-md-10 col-lg-8 p-sm-0 p-md-2 p-lg-5" style="background-color: rgba(255,255,255,.5);">
                <h1 class="mt-1" style="text-align: center; color:black; padding: 20px 0px;">Cart Checkout</h1>
            </div>
        </div>

    </div>


    <section style="margin-top: 2rem;">
        <div class="container-fluid mt-1">
            <div class="container p-3">

                <div class="row pt-3 d-flex flex-column flex-md-row justify-content-center justify-content-md-start align-items-center align-items-md-start gap-5">

                    <!-- Billing Detail -->
                    <div class="col-12 col-md-7 bg-white rounded-2 p-3 d-flex gap-3 flex-column justify-content-center justify-content-md-start align-items-center align-items-md-start">
                        <div class="w-100 mb-3">
                            <h5 class="text-capitalize ps-2 py-1" style="font-family: 'Poppins'; color: #c50303; border-bottom:2px solid #c50303;">Billing Details</h5>
                        </div>

                        <form class="w-100" action="checkout.php" method="post">

                            <!-- Name & Email -->
                            <div class=" d-flex align-items-center gap-3 mb-2">
                                <div class="w-100 mb-2" style="font-size: 15px;">
                                    <label class="form-label fw-medium pb-1 ps-1">Name:</label>
                                    <input onfocus="this.style.boxShadow = 'none'" disabled type="text" name="name" value="<?php echo $user_name; ?>" class="form-control text-capitalize bg-white py-2 px-3 border-1 border-secondary" placeholder="Your full name" style="outline: none; font-size:15px;">
                                </div>
                                <div class="w-100 mb-2" style="font-size: 15px;">
                                    <label class="form-label fw-medium pb-1 ps-1">Email:</label>
                                    <input onfocus="this.style.boxShadow = 'none'" disabled type="email" name="email" value="<?php echo $email; ?>" class="form-control py-2 px-3 bg-white border-1 border-secondary" placeholder="Your email address" style="outline: none; font-size:15px;">
                                </div>
                            </div>

                            <!-- Phone & City -->
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <div class="w-100 mb-2" style="font-size: 15px;">
                                    <label class="form-label fw-medium pb-1 ps-1">Contact No:</label>
                                    <input onfocus="this.style.boxShadow = 'none'" type="number" required name="contact" placeholder="e.g. 03001234567" class="form-control py-2 px-3 bg-body-secondary border-1 border-secondary" style="outline: none; font-size:15px;">
                                </div>
                                <div class="w-100 mb-2" style="font-size: 15px;">
                                    <label class="form-label fw-medium pb-1 ps-1">City:</label>
                                    <input onfocus="this.style.boxShadow = 'none'" type="text" required name="city" placeholder="e.g. Lahore, Karachi" class="form-control text-capitalize py-2 px-3 bg-body-secondary border-1 border-secondary" style="outline: none;font-size:15px;">
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="w-100 mb-2" style="font-size: 15px;">
                                <label class="form-label fw-medium pb-1 ps-1">Complete Address:</label>
                                <textarea onfocus="this.style.boxShadow = 'none'" name="address" required placeholder="Street name, house no, nearby landmark, etc." cols="15" rows="3" class="form-control py-2 px-3 bg-body-secondary border-1 border-secondary" style="outline: none;font-size:15px;"></textarea>
                            </div>

                            <!-- Payment Method -->
                            <div class="w-100 mb-2 ps-3 mt-3" style="font-size: 16px;">
                                <label class="form-label fw-medium pb-1 ps-1 fw-semibold">Select Payment Method:</label>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="form-check">
                                        <input onfocus="this.style.boxShadow = 'none'" class="form-check-input" checked type="radio" name="payment" value="cod" required>
                                        <label class="form-check-label">Cash on Delivery</label>
                                    </div>
                                    <div class="form-check">
                                        <input onfocus="this.style.boxShadow = 'none'" class="form-check-input" type="radio" name="payment" value="card" required>
                                        <label class="form-check-label">Credit Card</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Button -->
                            <div class="pt-3 pb-1">
                                <button type="submit" name="submit_order" class="w-100 btn btn-lg btn-danger fw-normal" style="font-family: 'Poppins';">
                                   Place Your Order
                                </button>
                            </div>

                        </form>
                    </div>


                    <!-- Cart Items list -->
                    <div class="col-12 col-md-4 rounded-2 bg-dark p-3">
                        <div class="w-100">
                            <div class="mb-3 border-bottom border-2 border-warning">
                                <h5 class=" text-capitalize h5 pt-1 ps-2 text-warning" style="font-family: 'Poppins';">Your Bucket List </h5>
                            </div>

                            <div class='px-3 border-secondary mb-3 border-bottom text-danger pt-2 d-flex justify-content-between align-items-end pb-0 fw-medium'>
                                <p>Items</p>
                                <p>Price</p>
                            </div>

                            <!-- Cart list -->

                            <?php
                            global $con;
                            $sql = mysqli_query($con, "SELECT cart.* , p.name , p.price FROM cart JOIN products AS p ON cart.product_id = p.id WHERE cart.user_id = '$user_id'");
                            $count = 1;
                            while ($row = mysqli_fetch_assoc($sql)) {
                                $name = $row['name'];
                                $price = $row['price'];
                                $quantity = $row['quantity'];
                                echo "
                                          <div class='px-3 text-warning pb-1 d-flex justify-content-between align-items-center fw-medium'>
                                             <p><span class='text-danger fw-semibold'>" . $count . ".</span>  " . $name . " (x" . $quantity . ")</p>
                                             <p>" . $price . "</p>
                                          </div>
                                       ";
                                $count += 1;
                            }
                            ?>





                            <!-- Cart Total -->
                            <div class=" text-danger px-3 pt-1 border-top border-secondary d-flex justify-content-between align-items-center fw-semibold" style="font-size: '22px';">
                                <p>Total</p>
                                <p><?php echo $totalPrice; ?></p>
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