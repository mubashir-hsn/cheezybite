<?php
require_once __DIR__ . '/auth.php';
require_admin();
include_once __DIR__ . '/../connect.php';

$category = isset($_GET['category']) ? mysqli_real_escape_string($con, $_GET['category']) : 'all';
$sql = "SELECT * FROM products";
if ($category !== 'all') {
  $sql .= " WHERE category = '" . $category . "'";
}
$sql .= " ORDER BY id DESC";
$res = mysqli_query($con, $sql);

?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Products</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/admin.css">
  </head>
  <body>
    <div class="admin-container">
      <?php include __DIR__ . '/sidebar.php'; ?>
      <main class="main">
        <div class="container">
          <h3 style="font-family:Agbalumo;color:#b50101;border-bottom: 2px solid #b50101" class="w-100 pb-1">Manage Food Items</h3>
          <div class="d-flex justify-content-between align-items-center gap-3 mt-3 mb-2">
            <div>
              <form method="get" id="filterForm" class="d-flex align-items-center gap-2">
                <label class="mb-0">Category:</label>
                <select name="category" class="form-select form-select-sm" onchange="document.getElementById('filterForm').submit()">
                  <option value="all" <?php echo ($category=='all')?'selected':''; ?>>All</option>
                  <option value="starter" <?php echo ($category=='starter')?'selected':''; ?>>starter</option>
                  <option value="exclusive" <?php echo ($category=='exclusive')?'selected':''; ?>>exclusive</option>
                  <option value="topdeal" <?php echo ($category=='topdeal')?'selected':''; ?>>topdeal</option>
                </select>
              </form>
            </div>
            <div>
              <a href="add_product.php" class="btn btn-sm cartHover">Add New</a>
            </div>
          </div>

          <div class="row">
            <?php if ($res && mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) { ?>
              <div class="col-md-6 col-sm-12" style="margin-top: 12px;">
                <div class="product-list-card">
                  <img src="../images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                  <div class="info">
                    <h5><?php echo htmlspecialchars($row['name']); ?></h5>
                    <p class="mt-2" style="font-weight:700; color:var(--accent);">Rs. <?php echo $row['price']; ?></p>
                  </div>
                  <div class="actions">
                    <a href="edit_product.php?p_id=<?php echo $row['id']; ?>" class="btn-edit-small" title="Edit"><i class="bi bi-pencil"></i></a>
                    <button type="button" data-id="<?php echo $row['id']; ?>" class="btn-delete-large btn-delete-product"> <i class="bi bi-trash"></i> </button>
                  </div>
                </div>
              </div>
            <?php }
            } else { echo '<p>No products found.</p>'; } ?>
          </div>
        </div>
      </main>
    </div>
    <script src="../js/bootstrap.js"></script>
    <script src="js/admin.js"></script>
  </body>
  </html>
