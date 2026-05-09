<?php
require_once "LoginStrategy.php";

class GuardianLogin implements LoginStrategy {
    public function redirect() {
        header("Location: dashboard.php");
        exit;
    }
}
