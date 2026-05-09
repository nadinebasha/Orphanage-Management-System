<?php
require_once __DIR__ . '/../models/Activity.php';
require_once __DIR__ . '/../../config/db_connection.php';

class ActivityController {
    public static function handleRequest() {
        global $conn;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['activity_id'] ?? null;
            $name = $_POST['name'];
            $desc = $_POST['description'];
            $date = $_POST['date'];
            $location = $_POST['location'];

            if ($id) {
                Activity::update($conn, $id, $name, $desc, $date, $location);
            } else {
                Activity::create($conn, $name, $desc, $date, $location);
            }
            header("Location: manage_activities.php");
            exit;
        }

        if (isset($_GET['delete'])) {
            Activity::delete($conn, $_GET['delete']);
            header("Location: manage_activities.php");
            exit;
        }
    }

    public static function getAllActivities() {
        global $conn;
        return Activity::getAll($conn);
    }
}
