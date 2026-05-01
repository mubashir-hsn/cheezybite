<?php
// Reusable admin sidebar partial with active-link detection
// $current refers to the current script filename (e.g., index.php)
$current = basename($_SERVER['PHP_SELF']);

function a_link($href, $label, $current) {
    $file = basename($href);
    $active = ($file === $current) ? ' active' : '';
    echo "<a href=\"$href\" class=\"$active\">$label</a>";
}
?>
<aside class="sidebar">
  <a href="../index.php" class="admin-brand">
    <img src="../logo/logo.jpg" alt="CheezyBite">
    <span>CheezyBite</span>
  </a>
  <?php a_link('index.php', 'Dashboard', $current); ?>
  <?php a_link('add_product.php', 'Add Product', $current); ?>
  <?php a_link('manage_products.php', 'Manage Products', $current); ?>
  <?php a_link('users.php', 'Users', $current); ?>
  <?php a_link('orders.php', 'Orders', $current); ?>
  <?php a_link('support.php', 'Support', $current); ?>
  <a href="../logout.php">Logout</a>
</aside>
