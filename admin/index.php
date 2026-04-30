<?php
require_once __DIR__ . '/auth.php';
require_admin();
include_once __DIR__ . '/../connect.php';

// fetch counts
$products_count = 0;
$orders_count = 0;
$users_count = 0;

$res = mysqli_query($con, "SELECT COUNT(*) AS total FROM products");
if ($res) {
    $row = mysqli_fetch_assoc($res);
    $products_count = $row['total'] ?? 0;
}

$res = mysqli_query($con, "SELECT COUNT(*) AS total FROM orders");
if ($res) {
    $row = mysqli_fetch_assoc($res);
    $orders_count = $row['total'] ?? 0;
}

$res = mysqli_query($con, "SELECT COUNT(*) AS total FROM users");
if ($res) {
    $row = mysqli_fetch_assoc($res);
    $users_count = $row['total'] ?? 0;
}

// prepare chart data - sales by date (last 7 days)
$chart_labels = [];
$chart_data = [];
$res = mysqli_query($con, "SELECT DATE(order_date) AS d, SUM(total_price) AS s FROM orders GROUP BY DATE(order_date) ORDER BY DATE(order_date) DESC LIMIT 7");
if ($res) {
    $tmp = [];
    while ($r = mysqli_fetch_assoc($res)) {
        $tmp[] = $r;
    }
    $tmp = array_reverse($tmp);
    foreach ($tmp as $r) {
        $chart_labels[] = $r['d'];
        $chart_data[] = $r['s'] ?: 0;
    }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/admin.css">
    <style>
      body { background: #f5f4f4; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <div class="container-fluid">
          <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
              <h3 style="font-family:Agbalumo;color:#b50101;">Dashboard</h3>
            </div>
          </div>

          <div class="row g-3 mb-4">
            <div class="col-md-4">
              <div class="card card-stat p-3 shadow-sm">
                <h6>Total Products</h6>
                <h2><?php echo $products_count; ?></h2>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-stat p-3 shadow-sm">
                <h6>Total Orders</h6>
                <h2><?php echo $orders_count; ?></h2>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-stat p-3 shadow-sm">
                <h6>Total Users</h6>
                <h2><?php echo $users_count; ?></h2>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card p-3 shadow-sm">
                <h6>Sales (recent)</h6>
                <div class="chart-container">
                  <canvas id="salesChart"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>

    <script>
      const labels = <?php echo json_encode($chart_labels); ?>;
      const data = <?php echo json_encode($chart_data); ?>;
      const ctx = document.getElementById('salesChart').getContext('2d');
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{
            label: 'Sales',
            data: data,
            backgroundColor: 'rgba(197,5,3,0.1)',
            borderColor: 'rgba(197,5,3,0.9)',
            tension: 0.3,
            fill: true
          }]
        },
        options: { responsive:true, maintainAspectRatio:false }
      });
    </script>
    <script src="../js/bootstrap.js"></script>
    <script src="js/admin.js"></script>
  </body>
  </html>
