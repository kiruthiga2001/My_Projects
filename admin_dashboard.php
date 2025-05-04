<?php
// Start the session
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    // Redirect to the admin login page if not logged in
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Savory Haven</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
</head>
<body>
    <div class="container" style="border: 1px solid #000; background: #e0ba7e; padding: 20px;">
        <h1>Welcome to the Admin Dashboard</h1>
        <p>You are logged in as <strong><?php echo htmlspecialchars($_SESSION['admin']); ?></strong></p>
        <a href="logout.php" class="btn btn-danger">Logout</a>
        
        <h2>Admin Functions</h2>
        <ul>
            <li><a href="view_feedback.php">View Feedback</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <!-- Add other admin functionalities here -->
        </ul>
    </div>
</body>
</html>
