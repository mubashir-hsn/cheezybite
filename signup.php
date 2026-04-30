<?php

 include('connect.php'); 

 session_start();

// checked if user already login
 if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    header("location: index.php");
    exit();
 };

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  $first_name= $_POST['firstname'];
  $last_name= $_POST['lastname'];
  $email = $_POST['email'];
  $pass = $_POST['password'];

  // hash user password
  $hash_password = password_hash($pass,PASSWORD_DEFAULT);

  // check if email already exit..
  $result = mysqli_query($con, "SELECT * FROM users WHERE email='$email'");
  
  if ($result && mysqli_num_rows($result)>0) {
    echo "<script>alert('Email already existed.');</script>";
  }else{
    // register user..
    // Set default role to 'user' for newly registered accounts
    $res = mysqli_query($con,"INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`, `role`) VALUES ('$first_name','$last_name','$email','$hash_password','user')");
    
    if ($res) {

      $id = mysqli_insert_id($con);

      $_SESSION['user_id']=$id;
      $_SESSION['login']=true;
      $_SESSION['user_name']=$first_name;
      $_SESSION['email']=$email;
      header("location: index.php ");
      exit();
      
    }

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
  <link rel="Website icon" type="png" href="/logo/logo.jpg">
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="./css/style.css">
  <title>SignUp</title>
</head>

<body style="font-family: Poppins; background-color: #f5f4f4;">

  <!-- ......Navbar Section Start ..................................    -->
  <header>
  <?php include('navbar.php'); ?>
  </header>

<!-- .......... Navbar End .................................................  -->

<!-- ....................Signup Section Start .................................. -->

<!-- Section: Design Block -->
<section>
    <!-- Background image -->
    <div class="p-5 bg-image image-responsive" style="
          background-image: url('./images/hero.png');
          height: 300px;
          "></div>
    <!-- Background image -->
  
    <div class="card mx-4 mx-md-5 shadow-5-strong bg-body-tertiary" style="
          margin-top: -100px;
          border: none;
          box-shadow: 0px 0px 20px #00000026;
          ">
      <div class="card-body py-5 px-md-5">
  
        <div class="row d-flex justify-content-center">
          <div class="col-lg-6">
            <h2 class="mb-5" style="font-family: Agbalumo; color: #b50101;">Sign up!</h2>
            <form method="post" action="signup.php">
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div data-mdb-input-init class="form-outline">
                      <label class="form-label" for="form3Example1">First Name:</label>
                    <input name="firstname"  onfocus="this.style.boxShadow = 'none'" type="text" required id="form3Example1" class="form-control" style="border: none; background-color: #f2f1f1;" />
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div data-mdb-input-init class="form-outline">
                      <label class="form-label" for="form3Example2">Last Name:</label>
                    <input name="lastname" onfocus="this.style.boxShadow = 'none'" type="text" required id="form3Example2" class="form-control" style="border: none; background-color: #f2f1f1;" />
                  </div>
                </div>
              </div>
  
              <!-- Email input -->
              <div data-mdb-input-init class="form-outline mb-4">
                  <label class="form-label" for="form3Example3">Email Address:</label>
                <input name="email" onfocus="this.style.boxShadow = 'none'" type="email" required id="form3Example3" class="form-control" style="border: none; background-color: #f2f1f1;"/>
              </div>
  
              <!-- Password input -->
              <div data-mdb-input-init class="form-outline mb-4">
                  <label class="form-label" for="form3Example4">Password:</label>
                <input name="password" onfocus="this.style.boxShadow = 'none'" type="password" required id="form3Example4" class="form-control" style="border: none; background-color: #f2f1f1;"/>
              </div>
  
              <!-- Submit button -->
              <button type="submit" name="submit" class="btn cartHover btn-block mb-4 " style=" width: 100%; padding: 5px 20px;">
                Sign up
              </button>
            </form>
            <!-- Register buttons -->
            <div class="text-center">
              <p>Already have an account? <a href="login.php">Login</a> </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Design Block -->

<!-- ..................... Signup Section End ......................................  -->

<!-- .............. Footer Section Start ............................... -->


  <section>
  <?php include('footer.php'); ?>
    
  </section>
  
  <!-- .............. Footer Section End ............................... -->
  
  <script src="/js/bootstrap.js"></script>
  </body>
  
  </html>