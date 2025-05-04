<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}

// Include the database connection
include("db_connect.php");

// Delete user logic
if (isset($_GET['delete'])) {
    $user_id = intval($_GET['delete']); // Sanitize input

    // First, delete all feedback associated with this user
    $delete_feedback_query = "DELETE FROM feedback WHERE user_id='$user_id'";
    mysqli_query($conn, $delete_feedback_query);

    // Then, delete the user
    $delete_user_query = "DELETE FROM users WHERE id='$user_id'";
    
    if (mysqli_query($conn, $delete_user_query)) {
        // Redirect to the same page after deletion
        header("Location: manage_users.php");
        exit();
    } else {
        // Display an error message
        echo "Error deleting user: " . mysqli_error($conn);
    }
}

// Fetch users from the database
$query = "SELECT * FROM users ORDER BY created_at DESC"; // Fetch all users ordered by date
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Savory Haven</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
</head>
<body>
    <div class="container" style="margin-top: 200px; background-color:#F4A460;">
        <h1>Manage Users</h1>
        <a href="admin_dashboard.php" class="btn btn-primary">Back to Dashboard</a>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                            <td>
                                <a href="manage_users.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                <!-- Add other actions such as Edit here if necessary -->
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
