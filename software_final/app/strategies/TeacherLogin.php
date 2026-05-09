<?php
require_once "LoginStrategy.php";

class TeacherLogin implements LoginStrategy {
    public function redirect() {
        header("Location: teacher_dashboard.php");
        exit;
    }
}
