<?php
session_start();
require_once __DIR__ . '/../controllers/ActivityController.php';
ActivityController::handleRequest();
$activities = ActivityController::getAllActivities();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Activities</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="container">
    <h1 class="mt-4 text-center">Manage Activities</h1>

    <div class="d-flex justify-content-between">
        <a href="<?= $_SESSION['role'] === 'admin' ? 'admin_dashboard.php' : 'teacher_dashboard.php' ?>" class="btn btn-secondary mb-3">← Back</a>
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#activityModal">+ Add Activity</button>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Date</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($activities as $activity): ?>
                <tr>
                    <td><?= $activity['activity_id'] ?></td>
                    <td><?= $activity['name'] ?></td>
                    <td><?= $activity['description'] ?></td>
                    <td><?= $activity['date'] ?></td>
                    <td><?= $activity['location'] ?></td>
                    <td>
                        <a href="?delete=<?= $activity['activity_id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="modal fade" id="activityModal" tabindex="-1" aria-labelledby="activityModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Activity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="activity_id">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Location</label>
                        <input type="text" name="location" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Activity</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
