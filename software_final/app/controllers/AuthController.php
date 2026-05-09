<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../../config/db_connection.php';
require_once __DIR__ . '/../strategies/AdminLogin.php';
require_once __DIR__ . '/../strategies/GuardianLogin.php';
require_once __DIR__ . '/../strategies/NurseLogin.php';
require_once __DIR__ . '/../strategies/TeacherLogin.php';
require_once __DIR__ . '/../decorators/UserLogin.php';
require_once __DIR__ . '/../decorators/LoginLogger.php';


class AuthController {
    public static function registerGuardian() {
        global $conn;
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = trim($_POST["username"]);
            $email = trim($_POST["email"]);
            $password = $_POST["password"];

            if (User::exists($conn, $username, $email)) {
                $errors[] = "Username or email already exists.";
            } else {
                $user_id = User::createGuardian($conn, $username, $email, $password);
                if ($user_id) {
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = 'guardian';
                    header("Location: register_guardian.php");
                    exit;
                } else {
                    $errors[] = "Registration failed.";
                }
            }
        }

        return $errors;
    }
    public static function login() {
        global $conn;
        $errors = [];
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            $baseLogin = new UserLogin(new User());
            $decoratedLogin = new LoginLogger($baseLogin);
    
            $user = $decoratedLogin->login($username, $password);
    
            if ($user) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
    
                if ($user['is_temp_password']) {
                    header("Location: change_password.php");
                } else {
                    $role = $user['role'];
                    switch ($role) {
                        case 'admin': $strategy = new AdminLogin(); break;
                        case 'guardian': $strategy = new GuardianLogin(); break;
                        case 'nurse': $strategy = new NurseLogin(); break;
                        case 'teacher': $strategy = new TeacherLogin(); break;
                        default: $strategy = new GuardianLogin();
                    }
                    $strategy->redirect();
                }
                exit;
            } else {
                $errors[] = "Invalid username or password.";
            }
        }
    
        return $errors;
    }
    
    
    public static function changePassword() {
        global $conn;
        $errors = [];
    
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit;
        }
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $new_password = $_POST['password'];
            $user_id = $_SESSION['user_id'];
    
            if (User::updatePassword($conn, $user_id, $new_password)) {
                session_destroy(); 
                header("Location: login.php");
                exit;
            } else {
                $errors[] = "Failed to update password.";
            }
        }
    
        return $errors;
    }
    
}
