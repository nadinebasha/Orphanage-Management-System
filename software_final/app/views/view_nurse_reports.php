<?php
session_start();
require_once __DIR__ . '/../../config/db_connection.php';
require_once __DIR__ . '/../controllers/ReportController.php';

if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['nurse', 'admin'])) {
    header("Location: login.php");
    exit;
}

$reports = ReportController::getAllReports();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Medical Reports</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h1 class="text-center mb-4">Submitted Medical Reports</h1>
    <a href="<?= $_SESSION['role'] === 'admin' ? 'admin_dashboard.php' : 'nurse_dashboard.php' ?>" class="btn btn-secondary mb-3">← Back</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Orphan</th>
                <th>Nurse</th>
                <th>Report</th>
                <th>Medical Info</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reports as $index => $r): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($r['orphan_fname'] . ' ' . $r['orphan_lname']) ?></td>
                    <td><?= htmlspecialchars($r['nurse_name']) ?></td>
                    <td><?= nl2br(htmlspecialchars($r['report'])) ?></td>
                    <td>
                    <?php
                    $attrs = ReportController::getAttributesForOrphan($r['orphan_id']);
                    if (empty($attrs)) {
                        echo "Not Assigned";
                    } else {
                        foreach ($attrs as $attr) {
                            echo "<strong>" . htmlspecialchars($attr['name']) . ":</strong> " . htmlspecialchars($attr['value']) . "<br>";
                        }
                    }
                    ?>
                    </td>
                    <td><?= $r['created_at'] ?></td>
                </tr>
                
            <?php endforeach; ?>
            
        </tbody>
    </table>
</body>
</html>
