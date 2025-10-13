<?php
include('connect.php');
include('./functions/getProducts.php');

$product_id = $_GET['p_id'] ?? '';

$sql = "SELECT * FROM products WHERE id = '$product_id'";
$res = mysqli_query($con, $sql);
$rows = mysqli_fetch_assoc($res);

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
  <link rel="Website icon" type="png" href="/logo/logo.jpg">
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="./css/style.css">
    <title>Food Item Details</title>
</head>

<body style="font-family: Poppins; background-color: #f5f4f4;">

    <!-- ......Navbar Section Start ..................................    -->
    <header>
        <?php include('navbar.php'); ?>
    </header>

    <!-- ...... Navbar Section End ..............................................................  -->

    <!-- ...... Product Detail Section start ..............................................................  -->

    <!-- <section>
        <div class="container-fluid" style="margin-top: 5rem;">
            <div class="bg-image image-responsive row d-flex justify-content-center align-items-center" style="
               background-image: url('./images/ban2.png');
               height: 300px;
               background-repeat: no-repeat;
               background-position: center;
               background-size: cover;
               background-attachment:fixed;
               ">
                <div class="col-12 col-md-10 col-lg-8 p-sm-0 p-md-2 p-lg-5" style="background-color: rgba(255,255,255,.5);">
                    <h3 class="mt-1 text-center text-capitalize fw-semibold" style="text-align: center; color:black; padding: 20px 0px;"><?php echo $rows['name']; ?></h3>
                </div>
            </div>

        </div>
    </section> -->


    <section class="" style="margin-top: 8rem;">
        <?php getUniqueProduct(); ?>
    </section>

    <!-- .............. Footer Section Start ............................... -->

    <section>

        <?php include('footer.php'); ?>

    </section>

    <!-- .............. Footer Section End ............................... -->


    <script src="/js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/app.js"></script>
    <script>
        document.getElementById('addToCart').addEventListener('click', function(e) {
            e.preventDefault();
            let quantity = document.getElementById('quantity').value;
            let url = this.getAttribute('href') + quantity;
            window.location.href = url;
        })
    </script>
</body>

</html>