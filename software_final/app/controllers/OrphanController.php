<?php
require_once __DIR__ . '/../models/Orphan.php';
require_once __DIR__ . '/../../config/db_connection.php';

class OrphanController {
    public static function handleRequest() {
        global $conn;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['orphan_id'] ?? null;
            $first = $_POST['first_name'];
            $last = $_POST['last_name'];
            $dob = $_POST['dob'];
            $history = $_POST['medical_history'];
            $admission = $_POST['admission_date'];

            if ($id) {
                Orphan::update($conn, $id, $first, $last, $dob, $history, $admission);
            } else {
                Orphan::create($conn, $first, $last, $dob, $history, $admission);
            }

            header("Location: manage_orphans.php");
            exit;
        }

        if (isset($_GET['delete'])) {
            Orphan::delete($conn, $_GET['delete']);
            header("Location: manage_orphans.php");
            exit;
        }
    }

    public static function getAllOrphans() {
        global $conn;
        return Orphan::getAll($conn);
    }
    
}
