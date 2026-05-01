<?php
require_once __DIR__ . '/auth.php';
require_admin();
include_once __DIR__ . '/../connect.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $desc = mysqli_real_escape_string($con, $_POST['description']);
    $price = floatval($_POST['price']);
    $category = mysqli_real_escape_string($con, $_POST['category']);

    // handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tmp = $_FILES['image']['tmp_name'];
        $orig = basename($_FILES['image']['name']);
        $target = __DIR__ . '/../images/' . $orig;
        if (move_uploaded_file($tmp, $target)) {
            $image = $orig;
        } else {
            $image = '';
        }
    } else {
        $image = '';
    }

    $sql = "INSERT INTO products (name, description, price, category, image) VALUES ('$name','$desc','$price','$category','$image')";
    if (mysqli_query($con, $sql)) {
        $message = 'Product added successfully.';
    } else {
        $message = 'Error: ' . mysqli_error($con);
    }
}

?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Product</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/admin.css">
  </head>
  <body>
    <?php require_once 'auth.php'; ?>
    <div class="admin-container">
      <?php include __DIR__ . '/sidebar.php'; ?>
      <main class="main">
        <div class="container">
          <div class="card p-4 border-0">
            <h3 style="font-family:Agbalumo;color:#b50101;border-bottom: 2px solid #b50101" class="w-100 pb-1">Add New Food Item</h3>
            <?php if ($message): ?><div class="alert alert-info"><?php echo $message; ?></div><?php endif; ?>
            <form method="post" enctype="multipart/form-data" class="mt-3">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Name</label>
                  <input name="name" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Price</label>
                  <input name="price" type="number" step="0.01" class="form-control" required>
                </div>
                <div class="col-12">
                  <label class="form-label">Description</label>
                  <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Category</label>
                  <select name="category" class="form-select">
                    <option value="starter">starter</option>
                    <option value="exclusive">exclusive</option>
                    <option value="topdeal">topdeal</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Image</label>
                  <input name="image" type="file" accept="image/*" class="form-control">
                </div>
                <div class="col-12 text-end mt-2">
                  <button class="btn cartHover">Add Product</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </main>
    </div>
    <script src="../js/bootstrap.js"></script>
    <script src="js/admin.js"></script>
  </body>
  </html>
