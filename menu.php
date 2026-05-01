<?php
include('./functions/getProducts.php');
// current category from query (all, pizza, burger, addon)
$currentCategory = isset($_GET['category']) ? trim($_GET['category']) : 'all';
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
  <title>Menu</title>
</head>

<body style="font-family: Poppins; background-color: #faf8f8;">

  <!-- ......Navbar Section Start ..................................    -->
  <header>
    <?php include('navbar.php'); ?>
  </header>

  <!-- ......Navbar Section End ..................................    -->

  <div class="container-fluid" style="margin-top: 5rem;">
    <div class="bg-image image-responsive row d-flex justify-content-center align-items-center" style="
        background-image: url('./images/cartbaner.jpg');
        height: 400px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        background-attachment:fixed;
        ">
      <div class="col-12 col-md-10 col-lg-8 p-sm-0 p-md-2 p-lg-5" style="background-color: rgba(255,255,255,0.6);">
        <h1 class="mt-1" style="text-align: center; color:black; padding: 20px 0px;">Our Menu</h1>
      </div>
    </div>

  </div>

  <!-- Category filter buttons -->
  <div class="container mt-3">
    <div class="d-flex gap-2 justify-content-center">
      <?php
        $cats = [ 'all' => "All", 'pizza' => "Pizza", 'burger' => "Burger", 'addon' => "AddOns" ];
        foreach ($cats as $key => $label) {
          $active = ($currentCategory === $key) ? 'btn btn-danger' : 'btn btn-outline-danger';
          $href = ($key === 'all') ? 'menu.php' : 'menu.php?category=' . $key;
          echo "<a href=\"$href\" class=\"$active\">$label</a>";
        }
      ?>
    </div>
  </div>

  <!-- .......... Pizza Section Start .................................  -->
  <?php if ($currentCategory === 'all' || $currentCategory === 'pizza'): ?>
  <section>
    <div class="container-fluid mt-2">
      <div class="container">
        <h1 style="font-family: Agbalumo; color: #b50101; border-bottom: 2px solid #b50101; padding-bottom: 10px; text-align: start;">
          > Pizza's
        </h1>
        <div class="row d-flex justify-content-lg-start justify-content-md-start justify-content-center align-items-center">

          <?php getProductByCategory('pizza'); ?>

        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- .......... Pizza Section End .................................  -->

  <!-- .......... Burger Section Start .................................  -->
  <?php if ($currentCategory === 'all' || $currentCategory === 'burger'): ?>
  <section>
    <div class="container-fluid ">
      <div class="container mt-5">
        <h1 style="font-family: Agbalumo; color: #b50101; border-bottom: 2px solid #b50101; padding-bottom: 10px; text-align: start;">
          > Burger Zone
        </h1>
        <div class="row d-flex justify-content-lg-start justify-content-md-start justify-content-center align-items-center">

          <?php getProductByCategory('burger'); ?>

        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- .......... Burger Section End .................................  -->

  <!-- .......... Addone Section Start .................................  -->
  <?php if ($currentCategory === 'all' || $currentCategory === 'addon'): ?>
  <section>
    <div class="container-fluid ">
      <div class="container mt-5">
        <h1 style="font-family: Agbalumo; color: #b50101; border-bottom: 2px solid #b50101; padding-bottom: 10px; text-align: start;">
          > AddOn's
        </h1>
        <div class="row d-flex justify-content-lg-start justify-content-md-start justify-content-center align-items-center">

          <?php getProductByCategory('addon'); ?>

        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- .......... Addone Section End .................................  -->

  <!-- .............. Footer Section Start ............................... -->


  <section>
    <?php include('footer.php'); ?>

  </section>

  <!-- .............. Footer Section End ............................... -->

  <script src="/js/bootstrap.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const cards = document.querySelectorAll('.card');
      cards.forEach(card => {
        card.addEventListener('mouseenter', () => card.style.border = '2px solid #ffcb04');
        card.addEventListener('mouseleave', () => card.style.border = '2px solid white');
      });
    });
  </script>
</body>

</html>