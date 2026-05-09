<?php
require_once __DIR__ . '/../controllers/OrphanController.php';
OrphanController::handleRequest();
$orphans = OrphanController::getAllOrphans();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Orphans</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="container">
    <h1 class="mt-4 text-center">Manage Orphans</h1>

    <div class="d-flex justify-content-between">
        <a href="admin_dashboard.php" class="btn btn-secondary mb-3">← Back</a>
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#orphanModal">+ Add Orphan</button>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th>Medical History</th>
                <th>Admission Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orphans as $orphan): ?>
                <tr>
                    <td><?= $orphan['orphan_id'] ?></td>
                    <td><?= $orphan['first_name'] ?></td>
                    <td><?= $orphan['last_name'] ?></td>
                    <td><?= $orphan['dob'] ?></td>
                    <td><?= $orphan['medical_history'] ?></td>
                    <td><?= $orphan['admission_date'] ?></td>
                    <td>
                        <a href="?delete=<?= $orphan['orphan_id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="modal fade" id="orphanModal" tabindex="-1" aria-labelledby="orphanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Orphan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="orphan_id">
                    <div class="mb-3">
                        <label>First Name</label>
                        <input type="text" name="first_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Last Name</label>
                        <input type="text" name="last_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Medical History</label>
                        <textarea name="medical_history" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Admission Date</label>
                        <input type="date" name="admission_date" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Orphan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
