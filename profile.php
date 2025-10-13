<?php
include('connect.php');

session_start();

if(!isset($_SESSION['login']) || $_SESSION['login'] !== true){
   echo "<script>alert('Login first to see your profile.'); window.location='login.php'</script>";
   exit();
}

  $firstName = '';
  $lastName = '';
  $role = '';
  $createdAt = '';

   $email = $_SESSION['email'];
   $user = mysqli_query($con,"SELECT * FROM users WHERE email = '$email'");
  $row = mysqli_fetch_assoc($user);

  $firstName=$row['first_name'];
  $lastName = $row['last_name'];
  $role = $row['role'];
  $createdAt = $row['created_at'];
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

  <title>Profile.</title>
</head>

<style>
    .profile-card {
      max-width: 800px;
      margin: 50px auto;
      background: #fff;
      padding: 30px;
    }
    .profile-img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
    }
  </style>

<body style="font-family: Poppins; background-color: #f5f4f4;">

  <!-- ......Navbar Section Start ..................................    -->
  <header>
    <?php include('navbar.php'); ?>
  </header>

  <!-- ...... Navbar Section End ..............................................................  -->

<!-- ........... Profile Section Start ................................................. -->

<div class="container-fluid" style="margin-top: 5rem;">
        <div class="bg-image image-responsive row d-flex justify-content-center align-items-center py-5" style="
        background-image: linear-gradient(to left top, #fda902, #feb200, #feba00, #fec300, #fecc00, #ffc400, #ffbb00, #ffb300, #ff9715, #ff7b27, #f85f35, #ed4242);
        ">
            <div class="col-12 col-md-10 col-lg-8 p-sm-0 p-md-2 p-lg-5" style="background-color: rgba(255,255,255,.3);">
                <h1 class="mt-1" style="text-align: center; color:black; padding: 20px 0px;">Your Profile Details</h1>
            </div>
        </div>

    </div>

    <!-- Profile info -->

    
  <div class="profile-card">
    <div class="d-flex align-items-center mb-4 border-2 border-bottom pb-2">
      <img src="./images/u3.png" alt="User" class="profile-img me-3">
      <div>
        <h5 class="mb-0 text-capitalize"><?php echo $firstName; ?></h5>
        <small class="text-muted"><?php echo $email; ?></small>
      </div>
      <button class="btn btn-danger ms-auto">Edit</button>
    </div>

    <form>
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label ps-1 fw-semibold" style="color: brown;">First Name</label>
          <input type="text" disabled class="form-control text-capitalize " value= <?php echo $firstName; ?>>
        </div>
        <div class="col-md-6">
          <label class="form-label ps-1 fw-semibold" style="color: brown;">Last Name</label>
          <input type="text" disabled class="form-control text-capitalize " value= <?php echo $lastName; ?>>
        </div>
        <div class="col-12">
          <label class="form-label ps-1 fw-semibold" style="color: brown;">Email</label>
          <input type="email" disabled class="form-control"  value= <?php echo $email; ?>>
        </div>
        <div class="col-12">
          <label class="form-label ps-1 fw-semibold" style="color: brown;">Role</label>
          <input type="text" disabled class="form-control" value= <?php echo $role; ?>>
        </div>       
        <div class="col-12">
          <label class="form-label ps-1 fw-semibold" style="color: brown;">Language</label>
          <input type="text" disabled class="form-control" value='English' >
        </div>
        <div class="col-12">
          <label class="form-label ps-1 fw-semibold" style="color: brown;">Join At</label>
          <input type="text" disabled class="form-control" value= <?php echo $createdAt; ?>>
        </div>
      </div>

    </form>
  </div>


 <!-- .............. Footer Section Start ............................... -->

 <section>

<?php include('footer.php'); ?>

</section>

<!-- .............. Footer Section End ............................... -->



<script src="/js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>