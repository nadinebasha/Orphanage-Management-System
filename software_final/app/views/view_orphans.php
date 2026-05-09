<?php 
require_once "auth.php"; 
requireLogin();
require_once __DIR__ . '/../../config/db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orphans</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Orphan List</h1>
    
    <table class="table table-bordered table-striped mt-4">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th>Medical History</th>
                <th>Admission Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                $stmt = $conn->query("SELECT * FROM orphans");
                while ($orphan = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>{$orphan['orphan_id']}</td>";
                    echo "<td>{$orphan['first_name']}</td>";
                    echo "<td>{$orphan['last_name']}</td>";
                    echo "<td>{$orphan['dob']}</td>";
                    echo "<td>{$orphan['medical_history']}</td>";
                    echo "<td>{$orphan['admission_date']}</td>";
                    echo "</tr>";
                }
            } catch (PDOException $e) {
                echo "<tr><td colspan='6' class='text-danger'>Error: " . $e->getMessage() . "</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="btn btn-secondary">← Back</a>
</div>

</body>
</html>
