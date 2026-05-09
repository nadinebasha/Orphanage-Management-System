<?php
class User {
    public static function exists($conn, $username, $email) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function createGuardian($conn, $username, $email, $password) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'guardian')");
        if ($stmt->execute([$username, $email, $hashed])) {
            return $conn->lastInsertId();
        }
        return false;
    }
    public static function findByUsername($conn, $username) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function authenticate($username, $password) {
        global $conn;
    
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user && password_verify($password, $user['password'])) {
            return $user; 
        }
    
        return false;
    }
    
    
    public function redirectDashboard($role) {
        switch ($role) {
            case 'admin':
                header("Location: admin_dashboard.php");
                break;
            case 'guardian':
                header("Location: dashboard.php");
                break;
            case 'nurse':
                header("Location: nurse_dashboard.php");
                break;
            case 'teacher':
                header("Location: teacher_dashboard.php");
                break;
            default:
                header("Location: login.php");
        }
        exit;
    }
    public static function createStaffUser($conn, $username, $email, $password, $role) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role, is_temp_password) VALUES (?, ?, ?, ?, 1)");
        return $stmt->execute([$username, $email, $hashed, $role]);
    }
    
    public static function updatePassword($conn, $user_id, $new_password) {
        $hashed = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET password = ?, is_temp_password = 0 WHERE user_id = ?");
        return $stmt->execute([$hashed, $user_id]);
    }
    
}
