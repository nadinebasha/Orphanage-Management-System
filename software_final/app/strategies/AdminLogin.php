<?php
require_once "LoginStrategy.php";

class AdminLogin implements LoginStrategy {
    public function redirect() {
        header("Location: admin_dashboard.php");
        exit;
    }
}
