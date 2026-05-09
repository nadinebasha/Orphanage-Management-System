<?php
require_once "auth.php"; 
require_once __DIR__ . '/../../config/db_connection.php';
require_once __DIR__ . '/../controllers/OrphanController.php';
require_once __DIR__ . '/../controllers/OrphanAttributeController.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: login.php");
    exit;
}

$orphans = OrphanController::getAllOrphans();
$attributes = OrphanAttributeController::getAttributesByCategory('academic');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h1 class="text-center mb-4">Teacher Dashboard</h1>
    <a href="logout.php" class="btn btn-danger mb-3">Logout</a>

    <div class="card">
        <div class="card-header">Assign Grades</div>
        <div class="card-body">
            <form method="post" action="save_grades.php">
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
                        <label><?= htmlspecialchars($attr['name']) ?> Grade</label>
                        <input type="text" name="attributes[<?= $attr['attribute_id'] ?>]" class="form-control">
                    </div>
                <?php endforeach; ?>

                <button type="submit" class="btn btn-primary">Submit Grades</button>
            </form>
            <br>
            <a href="view_grades.php" class="btn btn-info">View Submitted Grades</a>
            <br><br>
            <a href="manage_attributes.php" class="btn btn-info">Manage Subjects</a>
            <br><br>
            <a href="manage_activities.php" class="btn btn-info">View Activities</a>
        </div>
    </div>
</body>
</html>
