<?php 
require_once "auth.php"; 
requireLogin(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">User Dashboard</h1>
    <div class="list-group">
        <a href="view_orphans.php" class="list-group-item list-group-item-action">View Orphans</a>
        <a href="request_adoption.php" class="list-group-item list-group-item-action">Request Adoption</a>
        <a href="donate.php" class="list-group-item list-group-item-action">Donate</a>
    </div>
    <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
</div>

</body>
</html>
