<?php
require_once __DIR__ . '/../controllers/RoomController.php';
RoomController::handleRequest();
$rooms = RoomController::getAllRooms();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Rooms</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="container">
    <h1 class="mt-4 text-center">Manage Rooms</h1>

    <div class="d-flex justify-content-between">
        <a href="admin_dashboard.php" class="btn btn-secondary mb-3">← Back </a>
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#roomModal">+ Add Room</button>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Room Number</th>
                <th>Capacity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rooms as $room): ?>
                <tr>
                    <td><?= $room['room_id'] ?></td>
                    <td><?= $room['room_number'] ?></td>
                    <td><?= $room['capacity'] ?></td>
                    <td>
                        <a href="?delete=<?= $room['room_id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="modal fade" id="roomModal" tabindex="-1" aria-labelledby="roomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="room_id">
                    <div class="mb-3">
                        <label>Room Number</label>
                        <input type="text" name="room_number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Capacity</label>
                        <input type="number" name="capacity" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Room</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
