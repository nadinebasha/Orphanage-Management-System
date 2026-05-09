<?php
require_once __DIR__ . '/../models/Guardian.php';
require_once __DIR__ . '/../../config/db_connection.php';

class GuardianController {
    public static function registerFromUserSession() {
        global $conn;
        $errors = [];

        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'guardian') {
            header("Location: login.php");
            exit;
        }

        $user_id = $_SESSION['user_id'];

        if (Guardian::exists($conn, $user_id)) {
            header("Location: dashboard.php");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $first = $_POST['first_name'];
            $last = $_POST['last_name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];

            if (Guardian::create($conn, $user_id, $first, $last, $phone, $email)) {
                header("Location: dashboard.php");
                exit;
            } else {
                $errors[] = "Failed to complete guardian registration.";
            }
        }

        return $errors;
    }

    public static function getGuardianByUserId($user_id) {
        global $conn;
        return Guardian::getByUserId($conn, $user_id);
    }
    public static function handleCrudRequest() {
        global $conn;
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST['guardian_id'] ?? null;
            $first = $_POST['first_name'];
            $last = $_POST['last_name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
    
            if ($id) {
                Guardian::update($conn, $id, $first, $last, $phone, $email);
            } else {
                Guardian::create($conn, null, $first, $last, $phone, $email);
            }
    
            header("Location: manage_guardians.php");
            exit;
        }
    
        if (isset($_GET['delete'])) {
            Guardian::delete($conn, $_GET['delete']);
            header("Location: manage_guardians.php");
            exit;
        }
    }
    
    public static function getAllGuardians() {
        global $conn;
        return Guardian::getAll($conn);
    }
    
}
