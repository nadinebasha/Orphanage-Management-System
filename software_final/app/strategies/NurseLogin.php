<?php
require_once "LoginStrategy.php";

class NurseLogin implements LoginStrategy {
    public function redirect() {
        header("Location: nurse_dashboard.php");
        exit;
    }
}
