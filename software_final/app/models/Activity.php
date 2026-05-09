<?php
class Activity {
    public static function getAll($conn) {
        return $conn->query("SELECT * FROM activities")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($conn, $name, $description, $date, $location) {
        $stmt = $conn->prepare("INSERT INTO activities (name, description, date, location) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $description, $date, $location]);
    }

    public static function update($conn, $id, $name, $description, $date, $location) {
        $stmt = $conn->prepare("UPDATE activities SET name=?, description=?, date=?, location=? WHERE activity_id=?");
        return $stmt->execute([$name, $description, $date, $location, $id]);
    }

    public static function delete($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM activities WHERE activity_id=?");
        return $stmt->execute([$id]);
    }
}
