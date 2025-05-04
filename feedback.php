<?php
session_start();
include("db_connect.php"); // Ensure this includes the correct database connection file

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: user_login.php"); // Redirect to login page if not logged in
    exit();
}

// Handle feedback submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $feedback = $_POST['feedback'];
    $user_id = $_SESSION['user_id']; // Assuming you store user_id in session

    // Prepare the SQL statement to insert feedback
    $stmt = $conn->prepare("INSERT INTO feedback (user_id, feedback) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $feedback); // "i" for integer and "s" for string

    if ($stmt->execute()) {
        echo "<script>alert('Feedback submitted successfully!');</script>";
    } else {
        echo "<script>alert('Error submitting feedback. Please try again.');</script>";
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
</head>
<body>
    <div class="container">
        <h2>Feedback</h2>
        <form method="POST" action="feedback.php">
            <div class="form-group">
                <label for="feedback">Your Feedback:</label>
                <textarea name="feedback" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Feedback</button>
        </form>
        <br>
        <p><a href="user_dashboard.php">Back to Dashboard</a></p>
        <p><a href="contact.php">contact us</a></p>
    </div>
</body>
</html>
