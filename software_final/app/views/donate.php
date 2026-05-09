<?php
session_start();
require_once __DIR__ . '/../controllers/DonationController.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $success = DonationController::handleUserDonation();
    if (!$success) {
        $error = "Failed to process donation.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Make a Donation</h1>

    <?php if ($success): ?>
        <div class="alert alert-success">Donation made successfully!</div>
    <?php elseif ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="post" class="mt-4">
        <div class="mb-3">
            <label class="form-label">Your Name:</label>
            <input type="text" name="donor_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Amount:</label>
            <input type="number" name="amount" class="form-control" required min="1">
        </div>

        <div class="mb-3">
            <label class="form-label">Description:</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Donate</button>
    </form>
    <br>
    <a href="dashboard.php" class="btn btn-secondary mb-3">← Back</a>
</div>
</body>
</html>
