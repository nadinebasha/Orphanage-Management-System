<?php
class Guardian {
    public static function getByUserId($conn, $user_id) {
        $stmt = $conn->prepare("SELECT * FROM guardians WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function exists($conn, $user_id) {
        $stmt = $conn->prepare("SELECT * FROM guardians WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($conn, $user_id, $first_name, $last_name, $phone, $email) {
        $stmt = $conn->prepare("INSERT INTO guardians (user_id, first_name, last_name, phone, email) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$user_id, $first_name, $last_name, $phone, $email]);
    }
    public static function getAll($conn) {
        return $conn->query("SELECT * FROM guardians")->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function update($conn, $id, $first_name, $last_name, $phone, $email) {
        $stmt = $conn->prepare("UPDATE guardians SET first_name=?, last_name=?, phone=?, email=? WHERE guardian_id=?");
        return $stmt->execute([$first_name, $last_name, $phone, $email, $id]);
    }
    
    public static function delete($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM guardians WHERE guardian_id=?");
        return $stmt->execute([$id]);
    }
    
}
