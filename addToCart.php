<?php 
include('connect.php');
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    $_SESSION['redirect_location'] = $_SERVER['REQUEST_URI'];
    echo "<script>alert('Please login first to add items into cart'); window.location='login.php' </script>";
    exit();
}

$user_id = $_SESSION['user_id'];
$action = $_GET['action'] ?? '';
$product_id = $_GET['product_id'] ?? '';
$quantity = $_GET['quantity'] ?? 1;

if ($action=='add' && !empty($product_id)) {
    
    global $con;

    // Check if item is already in the cart
    $checkCart = mysqli_query($con,"SELECT * FROM cart WHERE user_id='$user_id' AND product_id = '$product_id'");

    if ($checkCart && mysqli_num_rows($checkCart)>0) {
       mysqli_query($con,"UPDATE cart SET quantity = quantity + $quantity WHERE user_id='$user_id' AND product_id = '$product_id'");
       echo "<script>
                alert('Product is already in cart. Its quantity is updated.');
                window.location='cart.php';
              </script>";
    }else{

        $res = mysqli_query($con,"INSERT INTO cart(user_id , product_id , quantity) VALUES ('$user_id','$product_id','$quantity')");
       
        if ($res) {
            echo "<script>
            alert('Product is added to cart.');
             window.location='cart.php';
          </script>";
        }else{
            echo "<script>
                    alert('Product is not added due to some issue.');
                    window.location='index.php';
                  </script>";
        }

    }

}

?>