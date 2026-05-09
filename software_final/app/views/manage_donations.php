<?php
require_once __DIR__ . '/../controllers/DonationController.php';

DonationController::handleAdminActions();
$donations = DonationController::getAllDonations();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Donations</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container">
    <h1 class="mt-4 text-center">Manage Donations</h1>

    <div class="d-flex justify-content-between">
        <a href="admin_dashboard.php" class="btn btn-secondary mb-3">← Back</a>
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#donationModal">+ Add Donation</button>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Donor Name</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($donations as $donation): ?>
                <tr>
                    <td><?= $donation['donation_id'] ?></td>
                    <td><?= $donation['donor_name'] ?></td>
                    <td><?= $donation['amount'] ?></td>
                    <td><?= $donation['description'] ?></td>
                    <td><?= $donation['date'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="modal fade" id="donationModal" tabindex="-1" aria-labelledby="donationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="donationModalLabel">Add Donation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="donation_id">
                    <div class="mb-3">
                        <label class="form-label">Donor Name:</label>
                        <input type="text" name="donor_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount:</label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description:</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date:</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Donation</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
