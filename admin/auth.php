<?php
// Admin auth guard - include at top of all admin pages
session_start();
include_once(__DIR__ . '/../connect.php');

function require_admin()
{
    // If not logged in, redirect to login and preserve intended location
    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
        $_SESSION['redirect_location'] = $_SERVER['REQUEST_URI'];
        header('Location: /login.php');
        exit();
    }

    // If role column not set or not admin, deny access
    $role = $_SESSION['role'] ?? 'user';
    if ($role !== 'admin') {
        // Redirect non-admin users to homepage
        header('Location: /cheezybite/index.php');
        exit();
    }
}

function is_admin()
{
    return (isset($_SESSION['role']) && $_SESSION['role'] === 'admin');
}

?>
