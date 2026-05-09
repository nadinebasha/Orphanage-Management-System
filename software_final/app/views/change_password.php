<?php
session_start();
require_once __DIR__ . '/../controllers/AuthController.php';
$errors = AuthController::changePassword();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Your Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2 class="text-center mb-4">Change Your Password</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger"><?= implode("<br>", $errors) ?></div>
    <?php endif; ?>

    <form method="post" class="mx-auto" style="max-width: 400px;">
        <div class="mb-3">
            <label>New Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Update Password</button>
    </form>
</body>
</html>
