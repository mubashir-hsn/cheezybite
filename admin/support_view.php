<?php
require_once __DIR__ . '/auth.php';
require_admin();
include_once __DIR__ . '/../connect.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    header('Location: support.php'); exit();
}

$res = mysqli_query($con, "SELECT s.*, u.first_name, u.last_name, u.email AS user_email FROM support s LEFT JOIN users u ON s.user_id = u.id WHERE s.id = $id LIMIT 1");
if (!$res || mysqli_num_rows($res) == 0) { header('Location: support.php'); exit(); }
$row = mysqli_fetch_assoc($res);

// handle status update from this page
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_ticket_status') {
    $status = mysqli_real_escape_string($con, $_POST['status'] ?? 'open');
    mysqli_query($con, "UPDATE support SET status='$status' WHERE id=$id");
    header('Location: support_view.php?id='.$id);
    exit();
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ticket #<?php echo $row['id']; ?></title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/admin.css">
  </head>
  <body>
    <div class="admin-container">
      <?php include __DIR__ . '/sidebar.php'; ?>
      <main class="main">
        <div class="container">
          <h3 style="font-family:Agbalumo;color:#b50101;border-bottom: 2px solid #b50101" class="w-100 pb-1">Ticket #<?php echo $row['id']; ?></h3>
          <div class="card mt-3 border-0">
            <div class="card-body">
              <h5> <span class=" text-muted h6">Subject:</span> <?php echo htmlspecialchars($row['subject']); ?></h5>
              <p> <span class=" text-muted h6">From:</span> <?php echo htmlspecialchars($row['name'] ?? ($row['first_name'].' '.$row['last_name'])); ?> &lt;<?php echo htmlspecialchars($row['email'] ?? $row['user_email']); ?>&gt;</p>
              <hr>
              <p>
                <span class="text-muted h6">Message:</span> <br>
                <?php echo nl2br(htmlspecialchars($row['message'])); ?></p>
              <hr>
              <form method="post" class="d-flex gap-2 align-items-center">
                <input type="hidden" name="action" value="update_ticket_status">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <label class="mb-0 me-2">Status:</label>
                <select name="status" class="form-select form-select-sm" style="width:150px">
                  <?php foreach (['open','closed'] as $s) { $sel = ($s === ($row['status'] ?? 'open')) ? 'selected' : ''; echo "<option value=\"$s\" $sel>".ucfirst($s)."</option>"; } ?>
                </select>
                <button class="btn cartHover btn-sm">Save</button>
              </form>
            </div>
          </div>
        </div>
      </main>
    </div>
    <script src="../js/bootstrap.js"></script>
    <script src="js/admin.js"></script>
  </body>
  </html>
