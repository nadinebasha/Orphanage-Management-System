<?php
class Staff {
    public static function getAll($conn) {
        $stmt = $conn->query("SELECT * FROM users WHERE role IN ('teacher', 'nurse')");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($conn, $username, $email, $password, $role, $first_name, $last_name, $salary, $phone) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role, first_name, last_name, salary, phone, is_temp_password)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1)");
        return $stmt->execute([$username, $email, $hashed, $role, $first_name, $last_name, $salary, $phone]);
    }

    public static function delete($conn, $user_id) {
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        return $stmt->execute([$user_id]);
    }
}
