<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: user_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Savory Haven</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body style="background:#e0ba7e">
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['user']; ?>!</h1>
        <p>Feel free to leave feedback about our restaurant below:</p>
        
        <form action="feedback.php" method="post">
            <div class="form-group">
                <textarea class="form-control" name="feedback" placeholder="Write your feedback here..." required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit Feedback</button>
        </form>
        
        <br>
        <a href="logout.php" class="btn btn-danger">Logout</a>
        <a href="Index.php" class="btn btn-primary">Back to Home page</a>
        <a href="contact.php" class="btn btn-primary">contact us</a>

    </div>
</body>
</html>
