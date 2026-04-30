<?php
require_once __DIR__ . '/auth.php';
require_admin();
include_once __DIR__ . '/../connect.php';

$res = mysqli_query($con, "SELECT o.*, u.first_name,u.last_name FROM orders o LEFT JOIN users u ON o.user_id = u.id ORDER BY o.id DESC");

?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Orders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/admin.css">
  </head>
  <body>
    <div class="admin-container">
      <aside class="sidebar">
        <a href="../index.php" class="admin-brand">
          <img src="../logo/logo.jpg" alt="CheezyBite">
          <span>CheezyBite</span>
        </a>
        <a href="index.php">Dashboard</a>
        <a href="add_product.php">Add Product</a>
        <a href="manage_products.php">Manage Products</a>
        <a href="users.php">Users</a>
        <a href="orders.php">Orders</a>
        <a href="../logout.php">Logout</a>
      </aside>
      <main class="main">
        <div class="container">
          <h3 style="font-family:Agbalumo;color:#b50101;">Orders</h3>
          <div class="table-responsive mt-3">
            <table class="table admin-table table-sm align-middle">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Customer</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Placed At</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($res && mysqli_num_rows($res)>0) {
                  $sn = 1;
                  while ($row = mysqli_fetch_assoc($res)) { ?>
                    <tr>
                      <td><?php echo $sn++; ?></td>
                      <td><?php echo htmlspecialchars($row['first_name'].' '.$row['last_name']); ?></td>
                      <td>Rs <?php echo $row['total_price'] ?? $row['total'] ?? '0'; ?></td>
                      <td>
                        <form class="d-flex gap-2 order-status-form" data-id="<?php echo $row['id']; ?>">
                          <input type="hidden" name="action" value="update_order_status">
                          <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                          <select name="status" class="form-select form-select-sm">
                            <?php $status = $row['status'] ?? 'pending';
                            foreach (['pending','processing','completed','cancelled'] as $s) {
                              $sel = ($s===$status)?'selected':''; echo "<option value=\"$s\" $sel>".ucfirst($s)."</option>";
                            }
                            ?>
                          </select>
                          <button class="btn btn-sm btn-primary">Save</button>
                        </form>
                      </td>
                      <td><?php echo $row['order_date'] ?? ''; ?></td>
                       <td>
                         <a class="btn btn-sm btn-outline-secondary" href="../order_detail.php?order_id=<?php echo $row['id']; ?>" title="View"><i class="bi bi-eye"></i></a>
                       </td>
                    </tr>
                <?php }
                } else { echo '<tr><td colspan="6">No orders found.</td></tr>'; } ?>
              
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
    <script src="../js/bootstrap.js"></script>
    <script src="js/admin.js"></script>
  </body>
  </html>
