<?php
include('connect.php');



if (!function_exists('getProductByCategory')) {
    function getProductByCategory($category)
    {
        global $con;
        $sql = "SELECT * FROM products WHERE category = '$category'";

        $res = mysqli_query($con, $sql);
        if ($res && mysqli_num_rows($res) > 0) {

            while ($rows = mysqli_fetch_assoc($res)) {

                echo '
    <div class="col-lg-3 col-md-4 col-sm-6 col-9" style="margin-top: 20px;">
        <div class="card p-2" style="box-shadow : 0px 0px 10px rgba(0,0,0,0.1); display: flex; justify-content: center; align-items: center; width: 100%; height: 100%; position: relative; background-color: #ffffff; border: 2px solid white; border-radius: 12px; cursor: pointer;" ">
            <img src="./images/' . $rows['image'] . '" class="card-img-top image-responsive" style="width: 95%; border-radius: 12px;" alt="...">
            <span class="d-flex justify-content-center align-items-center" style="width: 42px; height: 42px; position: absolute; top: 15px; right: 20px; background-color: lightyellow; border-radius: 50%;"><img src="./logo/heart.svg" alt="" style="width: 22px;"></span>
            <div class="card-body d-flex justify-content-center align-items-center flex-column">
              <h5 class="card-title mt-2" style="font-weight: 700; font-size: 16px;">' . $rows['name'] . '</h5>
              <p class="card-text text-muted" style="font-size: 11px; text-align: center;">' . $rows['description'] . '</p>   
              <p class="mt-auto" style="font-size: 15px; text-align: center; width: 100%; font-weight: bold; color: red; border-top: 1px solid gainsboro; padding-top: 15px;">Rs. ' . $rows['price'] . '</p>
              <a href="detail.php?p_id=' . $rows['id'] . '" class="cartHover btn rounded-pill cart-btn" style="font-size: 15px; margin-top: -8px;">Add To Cart</a>
            </div>
        </div>
     </div> 
    
            ';
            }
        } else {
            echo "<script>alert('No product found.');</script>";
        }
    }
}




if (!function_exists('getUniqueProduct')) {
    function getUniqueProduct()
    {
        global $con;
        if (!isset($_GET['category'])) {
            if (isset($_GET['p_id'])) {
                $pid = $_GET['p_id'];
                $sql = "SELECT * from products where id = '$pid';";
                $res = mysqli_query($con, $sql);
                $num = mysqli_num_rows($res);
                if ($num == 0) {
                    echo "<h1 class= 'h4 text-danger py-2 text-center'>Product not found.</h1>";
                }


                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $price = $row['price'];
                    $desc = $row['description'];
                    $image = $row['image'];
                    $category = $row['category'];

                    echo '
            
            <div class="container bg-white p-5 rounded-3 mt-5">
  <div class="row">
    <!-- Product Images -->
    <div class="col-md-6 mb-4">
      <img src="./images/' . $image . '" alt="Product" class="img-fluid rounded mb-3 product-image" id="mainImage">
    </div>

    <!-- Product Details -->
    <div class="col-md-6">
      <h2 class="mb-3 pt-2" style="font-family: Agbalumo; color: #c50303; border-bottom: 2px solid #b50101; padding-bottom: 10px;">' . $name . '</h2>
      <p class="mb-3 pt-3">
      ' . $desc . '. </br></br>
       <span class=" text-secondary">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Alias distinctio nulla, nisi, pariatur qui eaque, dolor error voluptate numquam tempore consectetur fugiat recusandae reiciendis veniam mollitia dolore vero magnam neque!
       </span>
      </p>
      <p class="mb-4"> <b class=" text-danger">Category</b>: ' . $category . '</p>
      <div class="d-flex justify-content-between">
        <div class="text-dark">
           <span class="h4 me-2 text-dark">Rs ' . $price . '</span>
        </div>
        <div class="pe-5">
            <label for="quantity" class="form-label">Choose Quantity:</label>
            <input type="number" class="form-control" id="quantity" value="1" min="1" style="width: 120px;">
         </div>
        </div>

        <div>
           <a href="addToCart.php?action=add&product_id=' . $id . '&quantity=" id="addToCart" class="cartHover cart-btn btn btn-lg mb-3 me-2">
              Add To Cart
            </a>
        </div>  
        </div>
    </div>
  </div>
</div> ';
                }
            }
        }
    }
}


if (!function_exists('getCartItems')) {
    function getCartItems($user_id)
{
    global $con;

    $sql = mysqli_query($con, "SELECT cart.* , p.name , p.image , p.price FROM cart JOIN products AS p ON cart.product_id = p.id WHERE cart.user_id = '$user_id'");
    while ($row = mysqli_fetch_assoc($sql)) {

        echo '
        <div class="col-12 col-md-10 d-flex justify-content-between align-items-center bg-white py-4 px-3 rounded-2 shadow-sm">
        <div class="d-flex gap-3 align-items-center">
            <!-- product image -->
            <div>
                <img src="./images/' . $row['image'] . '" width="50" height="40">
            </div>

            <!-- product Name & price -->
            <div class="d-flex flex-column">
                <h6 class="fw-medium">' . $row['name'] . ' <small>(x' . $row['quantity'] . ')</small></h6>
                <span class="fw-medium text-muted" style="font-size: 13px; margin-top: -8px;">Rs. ' . $row['price'] * $row['quantity'] . '</span>
            </div>
        </div>
        <!-- Delete btn -->
        <div>
            <a href="cart.php?action=remove&p_id=' . $row['id'] . '" class="material-symbols-outlined p-2 rounded-2 text-white text-decoration-none" style="background-color: #ff4d6d;">
                delete
            </a>
        </div>
    </div> ';
    }
}
}


if (!function_exists('countCartItems')) {
    function countCartItems($user_id)
{
    global $con;

    $res = mysqli_query($con, "SELECT COUNT(*) AS total_items FROM cart WHERE user_id = '$user_id'");
    if ($res) {
        $row = mysqli_fetch_assoc($res);
        return $row['total_items'] ?? 0;
    } else {
        // Debugging message
        die("Error in countCartItems query: " . mysqli_error($con));
    }

    return 0;
}
}


if (!function_exists('getTotalPrice')) {
    function getTotalPrice($user_id)
    {
        global $con;
        $query = "SELECT SUM(products.price*cart.quantity) AS total_price FROM cart 
                  JOIN products ON cart.product_id = products.id WHERE cart.user_id = '$user_id'";
        $res = mysqli_query($con, $query);
        if ($res) {
            $row = mysqli_fetch_assoc($res);
            return $row['total_price'] ?? 0;
        }
        return 0;
    }
    
}

