<?php
require_once __DIR__ . '/../controllers/StaffController.php';
StaffController::handleRequest();
$staff = StaffController::getAllStaff();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Staff</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container">
    <h1 class="mt-4 text-center">Manage Staff</h1>

    <div class="d-flex justify-content-between mb-3">
        <a href="admin_dashboard.php" class="btn btn-secondary">← Back</a>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staffModal">+ Add Staff</button>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Name</th>
                <th>Salary</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($staff as $s): ?>
                <tr>
                    <td><?= $s['user_id'] ?></td>
                    <td><?= $s['username'] ?></td>
                    <td><?= $s['email'] ?></td>
                    <td><?= $s['role'] ?></td>
                    <td><?= $s['first_name'] . ' ' . $s['last_name'] ?></td>
                    <td><?= $s['salary'] ?></td>
                    <td><?= $s['phone'] ?></td>
                    <td><a href="?delete=<?= $s['user_id'] ?>" class="btn btn-danger btn-sm">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="modal fade" id="staffModal" tabindex="-1" aria-labelledby="staffModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Staff</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3"><label>Username</label><input type="text" name="username" class="form-control" required></div>
                    <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
                    <div class="mb-3"><label>First Name</label><input type="text" name="first_name" class="form-control" required></div>
                    <div class="mb-3"><label>Last Name</label><input type="text" name="last_name" class="form-control" required></div>
                    <div class="mb-3"><label>Salary</label><input type="number" name="salary" class="form-control" required></div>
                    <div class="mb-3"><label>Phone</label><input type="text" name="phone" class="form-control" required></div>
                    <div class="mb-3"><label>Role</label>
                        <select name="role" class="form-control">
                            <option value="teacher">Teacher</option>
                            <option value="nurse">Nurse</option>
                        </select>
                    </div>
                    <input type="hidden" name="temp_password" value="default123">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Staff</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
