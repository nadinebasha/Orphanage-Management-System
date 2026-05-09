<?php
require_once "auth.php"; 
require_once __DIR__ . '/../../config/db_connection.php';
require_once __DIR__ . '/../controllers/OrphanController.php';
require_once __DIR__ . '/../controllers/OrphanAttributeController.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'nurse') {
    header("Location: login.php");
    exit;
}

$orphans = OrphanController::getAllOrphans();
$attributes = OrphanAttributeController::getAttributesByCategory('medical');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nurse Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h1 class="text-center mb-4">Nurse Dashboard</h1>
    <a href="logout.php" class="btn btn-danger mb-3">Logout</a>

    <div class="card mb-4">
        <div class="card-header">Assign Medical Info</div>
        <div class="card-body">
            <form method="post" action="save_bloodtype.php">
                <div class="mb-3">
                    <label>Choose Orphan</label>
                    <select name="orphan_id" class="form-select" required>
                        <?php foreach ($orphans as $o): ?>
                            <option value="<?= $o['orphan_id'] ?>">
                                <?= $o['first_name'] . ' ' . $o['last_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <?php foreach ($attributes as $attr): ?>
                    <div class="mb-3">
                        <label><?= htmlspecialchars($attr['name']) ?></label>
                        <input type="text" name="attributes[<?= $attr['attribute_id'] ?>]" class="form-control">
                    </div>
                <?php endforeach; ?>

                <button type="submit" class="btn btn-primary">Save Medical Info</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Write Medical Report</div>
        <div class="card-body">
            <form method="post" action="save_report.php">
                <div class="mb-3">
                    <label>Choose Orphan</label>
                    <select name="orphan_id" class="form-select" required>
                        <?php foreach ($orphans as $o): ?>
                            <option value="<?= $o['orphan_id'] ?>">
                                <?= $o['first_name'] . ' ' . $o['last_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Medical Report</label>
                    <textarea name="report" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit Report</button>
            </form>
            <br>
            <a href="view_nurse_reports.php" class="btn btn-info">View Submitted Reports</a>
            <br><br>
            <a href="manage_attributes.php" class="btn btn-info">Manage Medical Information</a>

        </div>
    </div>
</body>
</html>
