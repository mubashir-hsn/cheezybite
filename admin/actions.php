<?php
require_once __DIR__ . '/auth.php';
require_admin();
include_once __DIR__ . '/../connect.php';

// Detect AJAX requests
$isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') || (isset($_POST['ajax']) && $_POST['ajax'] == '1');

// Basic router for admin actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'delete_product') {
        $id = intval($_POST['id'] ?? 0);
        $success = false;
        if ($id) {
            // get image name
            $r = mysqli_query($con, "SELECT image FROM products WHERE id=$id");
            if ($r && mysqli_num_rows($r)) {
                $row = mysqli_fetch_assoc($r);
                if (!empty($row['image'])) {
                    @unlink(__DIR__ . '/../images/' . $row['image']);
                }
            }
            $success = (bool) mysqli_query($con, "DELETE FROM products WHERE id=$id");
        }
        if ($isAjax) {
            header('Content-Type: application/json');
            echo json_encode(['success' => $success]);
            exit();
        }
        header('Location: manage_products.php');
        exit();
    }

    if ($action === 'delete_user') {
        $id = intval($_POST['id'] ?? 0);
        $success = false;
        if ($id) {
            $success = (bool) mysqli_query($con, "DELETE FROM users WHERE id=$id");
        }
        if ($isAjax) {
            header('Content-Type: application/json');
            echo json_encode(['success' => $success]);
            exit();
        }
        header('Location: users.php');
        exit();
    }

    if ($action === 'toggle_role') {
        $id = intval($_POST['id'] ?? 0);
        $success = false;
        $newRole = null;
        if ($id) {
            $r = mysqli_query($con, "SELECT role FROM users WHERE id=$id");
            if ($r && mysqli_num_rows($r)) {
                $row = mysqli_fetch_assoc($r);
                $current = $row['role'] ?? 'user';
                $new = ($current === 'admin') ? 'user' : 'admin';
                $success = (bool) mysqli_query($con, "UPDATE users SET role='$new' WHERE id=$id");
                if ($success) $newRole = $new;
            }
        }
        if ($isAjax) {
            header('Content-Type: application/json');
            echo json_encode(['success' => $success, 'role' => $newRole]);
            exit();
        }
        header('Location: users.php');
        exit();
    }

    if ($action === 'update_order_status') {
        $id = intval($_POST['id'] ?? 0);
        $status = mysqli_real_escape_string($con, $_POST['status'] ?? 'pending');
        $success = false;
        if ($id) {
            $success = (bool) mysqli_query($con, "UPDATE orders SET status='$status' WHERE id=$id");
        }
        if ($isAjax) {
            header('Content-Type: application/json');
            echo json_encode(['success' => $success, 'status' => $status]);
            exit();
        }
        header('Location: orders.php');
        exit();
    }

    if ($action === 'update_ticket_status') {
        $id = intval($_POST['id'] ?? 0);
        $status = mysqli_real_escape_string($con, $_POST['status'] ?? 'open');
        $success = false;
        if ($id) {
            $success = (bool) mysqli_query($con, "UPDATE support SET status='$status' WHERE id=$id");
        }
        if ($isAjax) {
            header('Content-Type: application/json');
            echo json_encode(['success' => $success, 'status' => $status]);
            exit();
        }
        header('Location: support.php');
        exit();
    }

}

// For GET, redirect to dashboard
header('Location: index.php');
exit();
