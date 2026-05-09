<?php
require_once __DIR__ . '/../controllers/ReportController.php';
require_once "auth.php";
requireLogin();

$report = ReportController::getReportData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <a href="admin_dashboard.php" class="btn btn-secondary mb-4">← Back</a>
    <h1 class="text-center mb-4">📊 Orphanage Reports</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card border-primary text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Orphans</h5>
                    <p class="display-5 text-primary fw-bold"><?= $report['orphans'] ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-success text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Donations</h5>
                    <p class="display-6 text-success fw-bold">$<?= number_format($report['donations'], 2) ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-warning text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Approved Adoptions</h5>
                    <p class="display-5 text-warning fw-bold"><?= $report['adoptions'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
