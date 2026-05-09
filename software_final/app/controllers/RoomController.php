<?php
require_once __DIR__ . '/../models/Room.php';
require_once __DIR__ . '/../../config/db_connection.php';

class RoomController {
    public static function handleRequest() {
        global $conn;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['room_id'] ?? null;
            $number = $_POST['room_number'];
            $capacity = $_POST['capacity'];

            if ($id) {
                Room::update($conn, $id, $number, $capacity);
            } else {
                Room::create($conn, $number, $capacity);
            }

            header("Location: manage_rooms.php");
            exit;
        }

        if (isset($_GET['delete'])) {
            Room::delete($conn, $_GET['delete']);
            header("Location: manage_rooms.php");
            exit;
        }
    }

    public static function getAllRooms() {
        global $conn;
        return Room::getAll($conn);
    }
}
