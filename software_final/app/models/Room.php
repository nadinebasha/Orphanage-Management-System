<?php
class Room {
    public static function getAll($conn) {
        return $conn->query("SELECT * FROM rooms")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($conn, $room_number, $capacity) {
        $stmt = $conn->prepare("INSERT INTO rooms (room_number, capacity) VALUES (?, ?)");
        return $stmt->execute([$room_number, $capacity]);
    }

    public static function update($conn, $id, $room_number, $capacity) {
        $stmt = $conn->prepare("UPDATE rooms SET room_number=?, capacity=? WHERE room_id=?");
        return $stmt->execute([$room_number, $capacity, $id]);
    }

    public static function delete($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM rooms WHERE room_id=?");
        return $stmt->execute([$id]);
    }
}
