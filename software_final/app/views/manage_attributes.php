<?php
session_start();
require_once __DIR__ . '/../../config/db_connection.php';
require_once __DIR__ . '/../controllers/OrphanAttributeController.php';

if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['nurse', 'teacher'])) {
    header("Location: login.php");
    exit;
}

$attributes = OrphanAttributeController::manageAttributes();
$category = $_SESSION['role'] === 'nurse' ? 'medical' : 'academic';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Attributes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h1 class="text-center mb-4">Manage <?= ucfirst($category) ?> Attributes</h1>
    <a href="<?= $category === 'medical' ? 'nurse_dashboard.php' : 'teacher_dashboard.php' ?>" class="btn btn-secondary mb-3">← Back</a>

    <form method="post" class="mb-4">
        <div class="input-group">
            <input type="text" name="name" class="form-control" placeholder="New Attribute Name" required>
            <button type="submit" class="btn btn-primary">Add Attribute</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Attribute Name</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($attributes as $index => $attr): ?>
                <tr>
    <td><?= $index + 1 ?></td>
    <td>
        <form method="post" class="d-flex">
            <input type="hidden" name="update_id" value="<?= $attr['attribute_id'] ?>">
            <input type="text" name="update_name" value="<?= htmlspecialchars($attr['name']) ?>" class="form-control me-2" required>
            <button type="submit" class="btn btn-sm btn-warning">Update</button>
        </form>
    </td>
    <td><?= ucfirst($category) ?></td>
    <td>
        <a href="?delete=<?= $attr['attribute_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
    </td>
</tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
