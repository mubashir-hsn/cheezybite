<?php
include('connect.php');
include('./functions/getProducts.php');

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$cart_count = 0;

if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    $cart_count = countCartItems($_SESSION['user_id']);     // Count total cart items
}

$authUser = isset($_SESSION['login']) && $_SESSION['login'] == true;
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';
$user_email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

$currentPage = basename($_SERVER['PHP_SELF']); // Get current page name like 'index.php'
?>



<nav class="navbar navbar-expand-lg relative fixed-top shadow-lg" style="background-color: #ffcb04; height: 80px; z-index: 999;">
  <div class="container-fluid px-3 d-flex justify-content-between align-items-center">

    <!-- Left: Logo and Toggler -->
    <div class="d-flex align-items-center">
      <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu"
        aria-controls="mobileMenu" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <a class="navbar-brand" href="./index.php">
        <img src="./logo/logo1.png" alt="Logo" style="width: 120px; height: 80px; margin-top: -8px;">
      </a>
    </div>

    <!-- Center: Desktop Menu -->
    <ul class="navbar-nav mx-auto d-none d-lg-flex" style="font-weight: 500;">
      <li class="nav-item"><a class="nav-link <?= ($currentPage === 'index.php') ? 'active' : '' ?>" href="./index.php">Home</a></li>
      <li class="nav-item"><a class="nav-link <?= ($currentPage === 'menu.php') ? 'active' : '' ?>" href="./menu.php">Menu</a></li>
      <li class="nav-item"><a class="nav-link <?= ($currentPage === 'about.php') ? 'active' : '' ?>" href="./about.php">About Us</a></li>
      <li class="nav-item"><a class="nav-link <?= ($currentPage === 'contact.php') ? 'active' : '' ?>" href="./contact.php">Contact</a></li>
    </ul>

    <!-- Right: Cart + User -->
    <div class="d-flex align-items-center">
      
      <!-- Cart Icon -->
      <a href="./cart.php" class="me-3 text-dark position-relative" title="Cart">
        <i class="bi bi-cart" style="font-size: 1.5rem;"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
          <?= $cart_count ?? 0 ?>
        </span>
      </a>

      <!-- Authenticated User Dropdown -->
      <?php if ($authUser): ?>
        <div class="dropdown">
          <a class="dropdown-toggle d-flex align-items-center text-decoration-none" href="#" role="button" id="userDropdown"
             data-bs-toggle="dropdown" aria-expanded="false">
            <img src="./images/u3.png" alt="User" class="rounded-circle" style="width: 35px; height: 35px; object-fit: cover; margin-right: 8px;">
            <span class="text-capitalize fw-semibold" style="color: #b50101;">
              <?= htmlspecialchars($user_name) ?>
            </span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <?php if ($role === 'admin'): ?>
              <li><a class="dropdown-item" href="./admin/dashboard.php">Dashboard</a></li>
            <?php else: ?>
              <li><a class="dropdown-item" href="./profile.php">Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="./orders.php">Orders</a></li>
            <?php endif; ?>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="./logout.php">Logout</a></li>
          </ul>
        </div>
      <?php else: ?>
        <a href="./login.php" class="btn btn-dark" style="padding: 8px 25px;">Login</a>
      <?php endif; ?>
    </div>
  </div>
</nav>


<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel" style="background-color: #ffcb04;">
  <div class="offcanvas-header p-0 border-2 border-bottom border-dark pb-1 pt-2 d-flex justify-content-between align-items-center">
    <a class="navbar-brand" href="./index.php">
      <img src="./logo/logo1.png" alt="Logo" style="width: 120px; height: 70px;">
    </a>
    <button type="button" class="btn-close pe-5" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="navbar-nav ps-4" style="font-weight: 500;">
      <li class="nav-item"><a class="nav-link <?= ($currentPage === 'index.php') ? 'active' : '' ?>" href="./index.php">Home</a></li>
      <li class="nav-item"><a class="nav-link <?= ($currentPage === 'menu.php') ? 'active' : '' ?>" href="./menu.php">Menu</a></li>
      <li class="nav-item"><a class="nav-link <?= ($currentPage === 'about.php') ? 'active' : '' ?>" href="./about.php">About Us</a></li>
      <li class="nav-item"><a class="nav-link <?= ($currentPage === 'contact.php') ? 'active' : '' ?>" href="./contact.php">Contact</a></li>
    </ul>
  </div>
</div>
