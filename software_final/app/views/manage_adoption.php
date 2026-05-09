<?php
require_once __DIR__ . '/../controllers/AdoptionRequestController.php';
AdoptionRequestController::handleRequest();
$requests = AdoptionRequestController::getAllRequests();
$orphans = AdoptionRequestController::getAllOrphans();
$guardians = AdoptionRequestController::getAllGuardians();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Adoption Requests</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="container">
    <h1 class="mt-4 text-center">Manage Adoption Requests</h1>

    <div class="d-flex justify-content-between">
        <a href="admin_dashboard.php" class="btn btn-secondary mb-3">← Back</a>
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#adoptionModal">+ Add Request</button>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Orphan</th>
                <th>Guardian</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requests as $r): ?>
                <tr>
                    <td><?= $r['request_id'] ?></td>
                    <td><?= $r['orphan_name'] ?></td>
                    <td><?= $r['guardian_name'] ?></td>
                    <td><?= $r['request_date'] ?></td>
                    <td><?= $r['status'] ?></td>
                    <td>
                    <button 
                        class="btn btn-warning btn-sm edit-btn"
                        data-bs-toggle="modal" 
                        data-bs-target="#adoptionModal"
                        data-id="<?= $r['request_id'] ?>"
                        data-orphan="<?= $r['orphan_id'] ?>"
                        data-guardian="<?= $r['guardian_id'] ?>"
                        data-date="<?= $r['request_date'] ?>"
                        data-status="<?= $r['status'] ?>"
                    >Edit</button>
                    <a href="?delete=<?= $r['request_id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="modal fade" id="adoptionModal" tabindex="-1" aria-labelledby="adoptionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Adoption Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                <input type="hidden" name="request_id" id="request_id">
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Orphan</label>
                        <select name="orphan_id" class="form-control" required>
                            <?php foreach ($orphans as $o): ?>
                                <option value="<?= $o['orphan_id'] ?>"><?= $o['first_name'] . ' ' . $o['last_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Guardian</label>
                        <select name="guardian_id" class="form-control" required>
                            <?php foreach ($guardians as $g): ?>
                                <option value="<?= $g['guardian_id'] ?>"><?= $g['first_name'] . ' ' . $g['last_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Date</label>
                        <input type="date" name="request_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Request</button>
                </div>
            </form>
        </div>
    </div>
    <script>
document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function () {
        document.querySelector('[name="request_id"]').value = this.dataset.id;
        document.querySelector('[name="orphan_id"]').value = this.dataset.orphan;
        document.querySelector('[name="guardian_id"]').value = this.dataset.guardian;
        document.querySelector('[name="request_date"]').value = this.dataset.date;
        document.querySelector('[name="status"]').value = this.dataset.status;
    });
});
</script>
</body>
</html>
