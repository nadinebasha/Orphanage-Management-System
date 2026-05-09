<?php
session_start();
class DashboardController {
    public function index() {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }
        include '../app/views/dashboard.php';
    }
}
?>