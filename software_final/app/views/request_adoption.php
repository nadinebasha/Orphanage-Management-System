<?php
session_start();
require_once __DIR__ . '/../controllers/AdoptionRequestController.php';
require_once __DIR__ . '/../controllers/GuardianController.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'guardian') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$guardian = GuardianController::getGuardianByUserId($user_id);

if (!$guardian) {
    header("Location: register_guardian.php");
    exit();
}

$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $success = AdoptionRequestController::handleUserRequest($guardian['guardian_id']);
    if (!$success) {
        $error = "Failed to submit request.";
    }
}

$orphans = AdoptionRequestController::getAllOrphans();
$requests = AdoptionRequestController::getGuardianRequests($guardian['guardian_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Request Adoption</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <a href="dashboard.php" class="btn btn-secondary mb-3">← Back</a>
    <h1 class="text-center">Request Adoption</h1>

    <?php if ($success): ?>
        <div class="alert alert-success">Adoption request submitted successfully!</div>
    <?php elseif ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="post" class="mt-4">
        <div class="mb-3">
            <label class="form-label">Choose an Orphan:</label>
            <select name="orphan_id" class="form-control" required>
                <?php foreach ($orphans as $o): ?>
                    <option value="<?= $o['orphan_id'] ?>">
                        <?= $o['first_name'] . ' ' . $o['last_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit Request</button>
    </form>

    <h2 class="mt-5">My Adoption Requests</h2>
    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>Orphan</th>
                <th>Request Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requests as $r): ?>
                <tr>
                    <td><?= $r['first_name'] . ' ' . $r['last_name'] ?></td>
                    <td><?= $r['request_date'] ?></td>
                    <td><?= $r['status'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
