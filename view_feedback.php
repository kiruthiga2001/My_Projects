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
    $delete_user_query = "DELETE FROM users WHERE id='$username'";
    $delete_user_query = "DELETE FROM users WHERE id='$feedback'";
    $delete_user_query = "DELETE FROM users WHERE id='$created_at'";

    
    if (mysqli_query($conn, $delete_user_query)) {
        // Redirect to the same page after deletion
        header("Location: view_feedback.php");
        exit();
    } else {
        // Display an error message
        echo "Error deleting user: " . mysqli_error($conn);
    }
}


// Fetch feedback from the database, joining with the users table to get usernames
$query = "SELECT feedback.id, users.username, feedback.feedback, feedback.created_at 
          FROM feedback 
          JOIN users ON feedback.user_id = users.id 
          ORDER BY feedback.created_at DESC"; 

$result = mysqli_query($conn, $query);

// Check for query errors
if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback - Savory Haven</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
</head>
<body>
    <div class="container" style="margin-top: 20px;">
        <h1>Feedback</h1>
        <a href="admin_dashboard.php" class="btn btn-primary">Back to Dashboard</a>

        <table class="table table-bordered mt-3">
            <thead style= "background:#e0ba7e;">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Feedback</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody style= "background:#e0ba7e;">
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['feedback']); ?></td>
                            <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                            <td>
                            <a href="view_feedback.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete user feedback?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No feedback found.</td>
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
