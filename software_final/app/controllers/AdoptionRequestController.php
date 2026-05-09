<?php
require_once __DIR__ . '/../models/AdoptionRequest.php';
require_once __DIR__ . '/../../config/db_connection.php';

class AdoptionRequestController {
    public static function handleRequest() {
        global $conn;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['request_id'] ?? null;
            $orphan_id = $_POST['orphan_id'];
            $guardian_id = $_POST['guardian_id'];
            $date = $_POST['request_date'];
            $status = $_POST['status'];

            if ($id) {
                AdoptionRequest::update($conn, $id, $orphan_id, $guardian_id, $date, $status);
            } else {
                AdoptionRequest::create($conn, $orphan_id, $guardian_id, $date, $status);
            }

            header("Location: manage_adoption.php");
            exit;
        }

        if (isset($_GET['delete'])) {
            AdoptionRequest::delete($conn, $_GET['delete']);
            header("Location: manage_adoption.php");
            exit;
        }
    }

    public static function getAllRequests() {
        global $conn;
        return AdoptionRequest::getAll($conn);
    }

    public static function getAllOrphans() {
        global $conn;
        return $conn->query("SELECT * FROM orphans")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAllGuardians() {
        global $conn;
        return $conn->query("SELECT * FROM guardians")->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function handleUserRequest($guardian_id) {
        global $conn;
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $orphan_id = $_POST['orphan_id'];
    
            $stmt = $conn->prepare("INSERT INTO adoption_requests (orphan_id, guardian_id, request_date, status) VALUES (?, ?, NOW(), 'Pending')");
            return $stmt->execute([$orphan_id, $guardian_id]);
        }
    
        return false;
    }
    
    public static function getGuardianRequests($guardian_id) {
        global $conn;
        $stmt = $conn->prepare("
            SELECT a.request_id, o.first_name, o.last_name, a.request_date, a.status
            FROM adoption_requests a
            JOIN orphans o ON a.orphan_id = o.orphan_id
            WHERE a.guardian_id = ?
        ");
        $stmt->execute([$guardian_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
