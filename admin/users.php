<?php
require_once __DIR__ . '/auth.php';
require_admin();
include_once __DIR__ . '/../connect.php';

$res = mysqli_query($con, "SELECT * FROM users ORDER BY id DESC");

?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users</title>
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
          <h3 style="font-family:Agbalumo;color:#b50101;border-bottom: 2px solid #b50101" class="w-100 pb-1">All Users</h3>
          <div class="table-responsive mt-3">
            <table class="table admin-table table-sm align-middle">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($res && mysqli_num_rows($res) > 0) {
                  $sn = 1;
                  while ($row = mysqli_fetch_assoc($res)) { ?>
                    <tr>
                      <td><?php echo $sn++; ?></td>
                      <td><strong><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></strong></td>
                      <td><?php echo htmlspecialchars($row['email']); ?></td>
                      <td><?php echo htmlspecialchars($row['role'] ?? 'user'); ?></td>
                      <td>
                        <button data-id="<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary btn-toggle-role" title="Toggle Role"><i class="bi bi-arrow-repeat"></i></button>
                        <button data-id="<?php echo $row['id']; ?>" class="btn btn-sm btn-danger btn-delete-user" title="Delete"><i class="bi bi-trash"></i></button>
                      </td>
                    </tr>
                <?php }
                } else { echo '<tr><td colspan="5">No users found.</td></tr>'; } ?>
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
