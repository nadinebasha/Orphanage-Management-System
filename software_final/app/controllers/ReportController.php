<?php
require_once __DIR__ . '/../models/Report.php';
require_once __DIR__ . '/../../config/db_connection.php';
require_once __DIR__ . '/../models/Report.php';

class ReportController {
    public static function getReportData() {
        global $conn;

        return [
            'orphans' => Report::getTotalOrphans($conn),
            'donations' => Report::getTotalDonations($conn),
            'adoptions' => Report::getTotalApprovedAdoptions($conn)
        ];
    }
    public static function getAllReports() {
        global $conn;
        return Report::getAll($conn);
    }
    public static function getAttributesForOrphan($orphan_id) {
        global $conn;
        return Report::getAttributesForOrphan($conn, $orphan_id);
    }
    public static function saveReport() {
        global $conn;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orphan_id = $_POST['orphan_id'];
            $report = $_POST['report'];
            $nurse_id = $_SESSION['user_id'];

            $stmt = $conn->prepare("INSERT INTO nurse_reports (orphan_id, nurse_id, report) VALUES (?, ?, ?)");
            $stmt->execute([$orphan_id, $nurse_id, $report]);

            header("Location: nurse_dashboard.php");
            exit;
        }
    }
}
