<?php
require_once __DIR__ . '/auth.php';
require_admin();
include_once __DIR__ . '/../connect.php';

$msg = '';
$id = intval($_GET['p_id'] ?? 0);
if ($id <= 0) {
    header('Location: manage_products.php');
    exit();
}

$res = mysqli_query($con, "SELECT * FROM products WHERE id = $id");
if (!$res || mysqli_num_rows($res) == 0) {
    header('Location: manage_products.php');
    exit();
}
$prod = mysqli_fetch_assoc($res);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $desc = mysqli_real_escape_string($con, $_POST['description']);
    $price = floatval($_POST['price']);
    $category = mysqli_real_escape_string($con, $_POST['category']);

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tmp = $_FILES['image']['tmp_name'];
        $orig = basename($_FILES['image']['name']);
        $target = __DIR__ . '/../images/' . $orig;
        if (move_uploaded_file($tmp, $target)) {
            $image_sql = ", image='$orig'";
        } else {
            $image_sql = '';
        }
    } else {
        $image_sql = '';
    }

    $sql = "UPDATE products SET name='$name', description='$desc', price='$price', category='$category' $image_sql WHERE id=$id";
    if (mysqli_query($con, $sql)) {
        $msg = 'Updated successfully.';
        // refresh product
        $res = mysqli_query($con, "SELECT * FROM products WHERE id = $id");
        $prod = mysqli_fetch_assoc($res);
    } else {
        $msg = 'Error: ' . mysqli_error($con);
    }
}

?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/admin.css">
  </head>
  <body>
    <div class="admin-container">
      <?php include __DIR__ . '/sidebar.php'; ?>
      <main class="main">
        <div class="container">
          <h3 style="font-family:Agbalumo;color:#b50101;border-bottom: 2px solid #b50101" class="w-100 pb-1">Edit Item</h3>
          <?php if ($msg): ?><div class="alert alert-info"><?php echo $msg; ?></div><?php endif; ?>
          <form method="post" enctype="multipart/form-data" class="mt-3">
            <div class="mb-3">
              <label class="form-label">Name</label>
              <input name="name" value="<?php echo htmlspecialchars($prod['name']); ?>" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea name="description" class="form-control" rows="3"><?php echo htmlspecialchars($prod['description']); ?></textarea>
            </div>
            <div class="mb-3 row">
              <div class="col-md-4">
                <label class="form-label">Price</label>
                <input name="price" type="number" step="0.01" value="<?php echo $prod['price']; ?>" class="form-control" required>
              </div>
              <div class="col-md-4">
                <label class="form-label">Category</label>
                <select name="category" class="form-select">
                  <option <?php echo $prod['category']=='starter'?'selected':''; ?> value="starter">starter</option>
                  <option <?php echo $prod['category']=='exclusive'?'selected':''; ?> value="exclusive">exclusive</option>
                  <option <?php echo $prod['category']=='topdeal'?'selected':''; ?> value="topdeal">topdeal</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label">Image (leave blank to keep)</label>
                <input name="image" type="file" accept="image/*" class="form-control">
                <div class="mt-2"><img src="../images/<?php echo htmlspecialchars($prod['image']); ?>" style="height:80px;" alt="<?php echo htmlspecialchars($prod['name']); ?>" /></div>
              </div>
            </div>
            <button class="btn cartHover">Save Changes</button>
          </form>
        </div>
      </main>
    </div>
    <script src="../js/bootstrap.js"></script>
    <script src="js/admin.js"></script>
  </body>
  </html>
