<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['role']);
}


function hasRole($role) {
    return isLoggedIn() && $_SESSION['role'] === $role;
}


function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}


function requireRole($requiredRole, $fallback = 'login.php') {
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit();
    }

    if ($_SESSION['role'] !== $requiredRole) {
        header("Location: $fallback");
        exit();
    }
}
