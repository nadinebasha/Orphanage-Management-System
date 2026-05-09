<?php
require_once __DIR__ . '/../controllers/GuardianController.php';
GuardianController::handleCrudRequest();
$guardians = GuardianController::getAllGuardians();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Guardians</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container">
    <h1 class="mt-4 text-center">Manage Guardians</h1>

    <div class="d-flex justify-content-between">
        <a href="admin_dashboard.php" class="btn btn-secondary mb-3">← Back</a>
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#guardianModal">+ Add New Guardian</button>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($guardians as $g): ?>
                <tr>
                    <td><?= $g['guardian_id'] ?></td>
                    <td><?= $g['first_name'] . " " . $g['last_name'] ?></td>
                    <td><?= $g['phone'] ?></td>
                    <td><?= $g['email'] ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editGuardian(<?= $g['guardian_id'] ?>, '<?= $g['first_name'] ?>', '<?= $g['last_name'] ?>',  '<?= $g['phone'] ?>', '<?= $g['email'] ?>')">Edit</button>
                        <a href="manage_guardians.php?delete=<?= $g['guardian_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="modal fade" id="guardianModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Guardian Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <input type="hidden" name="guardian_id" id="guardian_id">
                        <div class="mb-3">
                            <label>First Name:</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Last Name:</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Phone:</label>
                            <input type="text" name="phone" id="phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email:</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function editGuardian(id, firstName, lastName, phone, email) {
            document.getElementById('guardian_id').value = id;
            document.getElementById('first_name').value = firstName;
            document.getElementById('last_name').value = lastName;
            document.getElementById('phone').value = phone;
            document.getElementById('email').value = email;
            new bootstrap.Modal(document.getElementById('guardianModal')).show();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
