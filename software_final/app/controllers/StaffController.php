<?php
require_once __DIR__ . '/../models/Staff.php';
require_once __DIR__ . '/../../config/db_connection.php';

class StaffController {
    public static function handleRequest() {
        global $conn;

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['temp_password'];
            $role = $_POST['role'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $salary = $_POST['salary'];
            $phone = $_POST['phone'];

            Staff::create($conn, $username, $email, $password, $role, $first_name, $last_name, $salary, $phone);
            header("Location: manage_staff.php");
            exit;
        }

        if (isset($_GET['delete'])) {
            Staff::delete($conn, $_GET['delete']);
            header("Location: manage_staff.php");
            exit;
        }
    }

    public static function getAllStaff() {
        global $conn;
        return Staff::getAll($conn);
    }
}
