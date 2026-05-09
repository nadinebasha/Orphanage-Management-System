<?php
session_start();
require_once __DIR__ . '/../../config/db_connection.php';
require_once __DIR__ . '/../models/OrphanAttribute.php';
require_once __DIR__ . '/../controllers/OrphanController.php';

if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['teacher', 'admin'])) {
    header("Location: login.php");
    exit;
}

$orphans = OrphanController::getAllOrphans();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Orphan Grades</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h1 class="text-center mb-4">All Orphan Grades</h1>
    <a href="<?= $_SESSION['role'] === 'admin' ? 'admin_dashboard.php' : 'teacher_dashboard.php' ?>" class="btn btn-secondary mb-3">← Back</a>

    <?php foreach ($orphans as $orphan): ?>
        <div class="card mb-3">
            <div class="card-header">
                <?= $orphan['first_name'] . ' ' . $orphan['last_name'] ?>
            </div>
            <div class="card-body">
                <?php
                $attributes = OrphanAttribute::getAttributes($conn, $orphan['orphan_id']);
                $hasGrades = false;
                foreach ($attributes as $attr) {
                    if ($attr['name'] === 'Math' || $attr['name'] === 'Science' || $attr['name'] === 'English') {
                        echo "<strong>{$attr['name']}:</strong> {$attr['value']}<br>";
                        $hasGrades = true;
                    }
                }
                if (!$hasGrades) echo "<em>No grades assigned yet.</em>";
                ?>
            </div>
        </div>
    <?php endforeach; ?>
</body>
</html>
