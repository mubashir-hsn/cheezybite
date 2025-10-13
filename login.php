
<?php

include('connect.php'); 

 session_start();

// checked if user already login
 if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    header("location: index.php");
    exit();
 };

 if ($_SERVER['REQUEST_METHOD']=='POST') {
     if (isset($_POST['email']) && isset($_POST['password'])) {
      
      $email = mysqli_real_escape_string($con,$_POST['email']);
      $pass = $_POST['password'];

      $user = "SELECT * FROM users WHERE email='$email'";
      $res= mysqli_query($con,$user);

      if ($res && mysqli_num_rows($res)==1) {
        
        $data= mysqli_fetch_assoc($res);

        if (password_verify($pass,$data['password'])) {
          $_SESSION['login']=true;
          $_SESSION['email']=$email;
          $_SESSION['user_id']=$data['id'];
          $_SESSION['user_name']=$data['first_name'];
          $_SESSION['role']=$data['role'];
          $_SESSION['createdAt']=$data['created_at'];

          if (isset($_SESSION['redirect_location'])) {
            $redirect = $_SESSION['redirect_location'];
            unset($_SESSION['redirect_location']);
            header("location: $redirect");
            
          }else{
            header("location: index.php ");
            exit();
          }

        }else{
        echo "<script>alert('Invalid email or password.');</script>";
      }

      }else{
        echo "<script>alert('Invalid email or password.');</script>";
      }

     }else{
      echo "<script>alert('Please fill all fields.');</script>";
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
    <title>Login</title>
</head>
<body>

    <!-- ......Navbar Section Start ..................................    -->
    <header>
    <?php include('navbar.php'); ?>
    </header>

  <!-- ...... Navbar Section End ..............................................................  -->

  <!-- ....... Login Section Start ........................................    -->

  <section class="login-block" style="margin-top: 7rem;">
      <div class="container">
        <div class="row mt-5 d-flex justify-content-center align-items-center">
          <div class="col-md-7 col-lg-5 login-sec p-5" style="border-radius: 10px; box-shadow: 0px 0px 20px #00000021;">
            <h2 class="text-center" style="font-family: Agbalumo; color: #b50101 ;">Login Now</h2>
            <form class="login-form mt-5" method="post" action="login.php">
              <div class="form-group p-2">
                <label for="exampleInputEmail1" style="padding-bottom:5px;">Email:</label>
                <input name="email" onfocus="this.style.boxShadow = 'none'" type="email" required class="form-control" placeholder="" style="border: none; background-color: #f2f1f1;">
    
              </div>
              <div class="form-group p-2">
                <label for="exampleInputPassword1" style="padding-bottom:5px;">Password:</label>
                <input name="password" onfocus="this.style.boxShadow = 'none'" type="password" required class="form-control" placeholder="" style="border: none; background-color: #f2f1f1;"> 
              </div>
            <button type="submit" class="btn cartHover mt-2 ml-2" style="width: 100%; padding:8px 20px">Login</button>
            </form>
            <div class="copy-text mt-3">Don't have an account? <a href="signup.php"> Signup</a>.</div>
         </div>
        </div>
      </div>
    </section>

  <!-- ....... Login Section End ........................................    -->

  <!-- .............. Footer Section Start ............................... -->

<section>
<?php include('footer.php'); ?>
    
  </section>
  
  <!-- .............. Footer Section End ............................... -->
  

    <script src="/js/bootstrap.js"></script>
</body>
</html>

