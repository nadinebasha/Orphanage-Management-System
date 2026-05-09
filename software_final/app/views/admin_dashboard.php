<?php 
require_once "auth.php"; 

if ($_SESSION['role'] !== "admin") {
    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Admin Dashboard</h1>
    <div class="list-group">
        <a href="manage_orphans.php" class="list-group-item list-group-item-action">Manage Orphans</a>
        <a href="manage_adoption.php" class="list-group-item list-group-item-action">Manage Adoption Requests</a>
        <a href="manage_guardians.php" class="list-group-item list-group-item-action">Manage Guardians</a>
        <a href="manage_staff.php" class="list-group-item list-group-item-action">Manage Staff</a>
        <a href="manage_rooms.php" class="list-group-item list-group-item-action">Manage Rooms</a>
        <a href="manage_donations.php" class="list-group-item list-group-item-action">Manage Donations</a>
        <a href="manage_activities.php" class="list-group-item list-group-item-action">Manage Activity</a>
        <a href="view_nurse_reports.php" class="list-group-item list-group-item-action">View Medical Reports</a>
     <a href="view_grades.php" class="list-group-item list-group-item-action">View Submitted Grades</a>
        <a href="reports.php" class="list-group-item list-group-item-action">Reports</a>
        <a href="view_login_logs.php" class="list-group-item list-group-item-action">View Login Logs</a>
    </div>
    <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
</div>

</body>
</html>
