<?php
require_once __DIR__ . '/auth.php';
require_admin();
include_once __DIR__ . '/../connect.php';

$res = mysqli_query($con, "SELECT s.*, u.first_name, u.last_name FROM support s LEFT JOIN users u ON s.user_id = u.id ORDER BY s.created_at DESC");

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Support Tickets</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/admin.css">
  </head>
  <body>
    <div class="admin-container">
      <?php include __DIR__ . '/sidebar.php'; ?>
      <main class="main">
        <div class="container">
          <h3 style="font-family:Agbalumo;color:#b50101;border-bottom: 2px solid #b50101" class="w-100 pb-1">Support Tickets</h3>
          <div class="table-responsive mt-3">
            <table class="table admin-table table-sm align-middle">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Customer</th>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Status</th>
                  <th>Submitted At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($res && mysqli_num_rows($res)>0) {
                  $sn = 1;
                  while ($row = mysqli_fetch_assoc($res)) {
                    // build customer display name
                    $custName = '';
                    if (!empty($row['first_name']) || !empty($row['last_name'])) {
                      $custName = trim(($row['first_name'] ?? '') . ' ' . ($row['last_name'] ?? ''));
                    } else {
                      $custName = $row['name'] ?? '';
                    }
                ?>
                    <tr>
                      <td><?php echo $sn++; ?></td>
                      <td><?php echo htmlspecialchars($custName); ?></td>
                      <td><?php echo htmlspecialchars($row['subject']); ?></td>
                      <td><?php echo htmlspecialchars(mb_strimwidth($row['message'],0,120,'...')); ?></td>
                      <td><?php echo htmlspecialchars(ucfirst($row['status'] ?? 'open')); ?></td>
                      <td><?php echo $row['created_at']; ?></td>
                      <td>
                        <a class="btn btn-sm btn-outline-secondary" href="support_view.php?id=<?php echo $row['id']; ?>" title="View"><i class="bi bi-eye"></i> View</a>
                      </td>
                    </tr>
                <?php }
                } else { echo '<tr><td colspan="6">No tickets found.</td></tr>'; } ?>
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
