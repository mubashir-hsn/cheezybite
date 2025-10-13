<?php
include('connect.php');
include('./functions/getProducts.php');
session_start();

if (!isset($_SESSION['login']) && $_SESSION['login'] !== true) {
    echo "<script>alert('Please login to view your orders.'); window.location='login.php'</script>";
    exit();
}
    
$user_id = $_SESSION['user_id'] ?? '';
//fetch orders
$result = mysqli_query($con, "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY order_date DESC");
$count=0;


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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="Website icon" type="png" href="/logo/logo.jpg">
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="./css/style.css">
    <title>Orders</title>
</head>

<body style="font-family: Poppins; background-color: whitesmoke;">

    <!-- ......Navbar Section Start ..................................    -->
    <header>
        <?php include('navbar.php'); ?>
    </header>

    <!-- ...... Navbar Section End ..............................................................  -->


    <!-- ........... Orders Section Start ................................................. -->

    

    <section>
        <div class="container-fluid" style="margin-top: 5rem;">
            <div class="container p-3">

                <div class="row my-3">
                    <h1 class=" text-capitalize fw-semibold h2 py-1" style="font-family: 'Poppins'; color: black; border-bottom:2px solid black; ">Your Orders</h1>
                </div>

                <div class="row pt-3">
                   
                  <?php while($row = mysqli_fetch_assoc($result)){ 
                    $order_id = $row['id']; 
                    // Fetch total items for this order
                    $sql = mysqli_query($con, "SELECT COUNT(*) AS total_items FROM order_items WHERE order_id = '$order_id'");
                    $data = mysqli_fetch_assoc($sql);
                    $order_items = $data['total_items'] ?? 0;
                    $count+=1;
                    ?>

                    <div class="col-10 col-md-4 mb-3 rounded-2">
                        <div class="w-100 p-2 rounded-2 bg-dark text-warning">
                            <div class="my-3 pb-1 px-2 border-2 border-bottom border-secondary">
                                <h4 class="text-center text-capitalize h4" style="font-family: 'Poppins'; color: #c50303;">Order #<?php echo $count; ?></h4>
                            </div>
                            
                            <div class=" px-3 pt-1 pt-1 d-flex justify-content-between align-items-center fw-medium" style="font-size: '16px';">
                                <p class="mb-1">Order ID</p>
                                <p class="mb-1 " style="color: rgba(255, 204, 0, 0.8);"><?php echo $row['id']; ?></p>
                            </div>
                            
                            <div class=" px-3 pt-1 d-flex justify-content-between align-items-center fw-medium" style="font-size: '16px';">
                                <p class="mb-1">Food Items</p>
                                <p class="mb-1 " style="color: rgba(255, 204, 0, 0.8);"><?php echo $order_items; ?></p>
                            </div>
                            
                            <div class=" px-3 pt-1 d-flex justify-content-between align-items-center fw-medium" style="font-size: '16px';">
                                <p class="mb-1">Total Price</p>
                                <p class="mb-1 " style="color: rgba(255, 204, 0, 0.8);"><?php echo $row['total_price']; ?></p>
                            </div>
        
                            <div class="px-3 pt-1 d-flex justify-content-between align-items-center fw-medium" style="font-size: '16px';">
                                <p class="mb-1">Order Status</p>
                                <p class="mb-1 text-capitalize" style="color: rgba(255, 204, 0, 0.8);"><?php echo $row['status']; ?></p>
                            </div>
                            
                            <div class=" px-3 pt-1 d-flex justify-content-between align-items-center fw-semibold" style="font-size: '22px';">
                                <p class="mb-1">Order Date</p>
                                <p class="mb-1 " style="color: rgba(255, 204, 0, 0.8);"><?php echo $row['order_date']; ?></p>
                            </div>
                            <div class="pt-3 pb-1 mt-3 border-top border-2 border-secondary text-dark">
                                <a href="order_detail.php?order_id=<?php echo $row['id']; ?>" class="py-3 cartHover cart-btn btn rounded-2 d-flex justify-content-center align-items-center text-decoration-none fw-medium" style="font-family: 'Poppins';">
                                    <span>See Detail</span>
                                </a>
                            </div>

                        </div>
                    </div>
                   
                    <?php   }; ?>


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