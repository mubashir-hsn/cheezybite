<?php
include('connect.php');
include('./functions/getProducts.php');

session_start();

if (!isset($_SESSION['login']) && $_SESSION['login'] !== true) {
    echo "<script>alert('Please login to view your orders.'); window.location='login.php'</script>";
    exit();
}

$user_id = $_SESSION['user_id'] ?? '';
//fetch specific order
$order_id = $_GET['order_id'];
$order_query = mysqli_query($con, "SELECT * FROM orders WHERE id = '$order_id'");
$res = mysqli_fetch_assoc($order_query);

// fetch order items

$query = "SELECT order_items.* ,p.name,p.image,p.price FROM order_items JOIN products AS p ON order_items.product_id = p.id WHERE order_items.order_id = '$order_id'";
$result = mysqli_query($con, $query);


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
    <title>Order Detail</title>
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
                    <h1 class=" text-capitalize fw-semibold h2 py-1" style="font-family: 'Poppins'; color: black; border-bottom:2px solid black; ">Order Detail</h1>
                </div>

                <div class="row mb-0">
                    <table class="table mb-0 bg-white align-middle table-hover table-sm table-bordered overflow-x-auto mt-4">
                        <thead class="bg-danger text-center">
                            <tr>
                                <th class="ps-md-5 text-white">Food Items</th>
                                <th class="text-white">Quantity</th>
                                <th class="text-white">Price</th>
                            </tr>
                        </thead>
                        <tbody class= "text-center" style="background-color: white;">
                            <?php while ($product = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td class="text-start ps-3">
                                        <img src="./images/<?php echo $product['image']; ?>" width="50" height="40">
                                        <span class="ps-2"> <?php echo $product['name']; ?></span>
                                    </td>
                                    <td><?php echo $product['quantity']; ?></td>
                                    <td>Rs. <?php echo $product['price'] * $product['quantity']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="row" style="background-color: white;">
                    <div class="col-6 p-2 text-center h-100 border-start border-bottom border-secondary-subtle bg-white">
                        <p class="mb-0 text-danger fw-semibold">Total Price</p>
                    </div>
                    <div class="col-6 p-2 text-center border-top-0 border border-secondary-subtle bg-white">
                        <p class="mb-0 fw-medium">Rs <?php echo $res['total_price']; ?> </p>
                    </div>
                </div>

            </div>

        </div>

    </section>

    <!-- Billing Detail -->
    <section>

        <div class="container bg-white rounded mt-3">
            <div class="row p-2">
                <h4 class="text-capitalize text-white p-2 bg-danger" style="font-family: 'Poppins';">Billing Details</h4>
            </div>

            <div class="row p-2">
                <div class="col-4 p-0">
                    <p class="mb-0 text-danger p-2 ps-3 border border-secondary-subtle fw-semibold">Name</p>
                    <p class="mb-0 text-danger p-2 ps-3 border border-secondary-subtle fw-semibold">Email</p>
                    <p class="mb-0 text-danger p-2 ps-3 border border-secondary-subtle fw-semibold">Contact No</p>
                    <p class="mb-0 text-danger p-2 ps-3 border border-secondary-subtle fw-semibold">City</p>
                    <p class="mb-0 text-danger p-2 ps-3 border border-secondary-subtle fw-semibold">Address</p>
                    <p class="mb-0 text-danger p-2 ps-3 border border-secondary-subtle fw-semibold">Payment</p>
                </div>
                <div class="col-8 text-start p-0">
                    <p class="mb-0 fw-medium p-2 ps-3 border border-secondary-subtle text-capitalize"><?php echo $res['name']; ?> </p>
                    <p class="mb-0 fw-medium p-2 ps-3 border border-secondary-subtle"><?php echo $res['email']; ?> </p>
                    <p class="mb-0 fw-medium p-2 ps-3 border border-secondary-subtle">0<?php echo $res['contact']; ?> </p>
                    <p class="mb-0 fw-medium p-2 ps-3 text-capitalize border border-secondary-subtle"><?php echo $res['city']; ?> </p>
                    <p class="mb-0 fw-medium p-2 ps-3 text-capitalize border border-secondary-subtle"><?php echo $res['address']; ?> </p>
                    <p class="mb-0 fw-medium p-2 ps-3 text-capitalize border border-secondary-subtle"><?php echo $res['payment_status'] == 'pending' ? "Cash On Delivery" : "Credit Card"; ?> </p>
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