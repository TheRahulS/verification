<?php
session_start();
// Check if the user is logged in and the 'name' session variable is set
if (isset($_SESSION['email']) && isset($_SESSION['name'])) {
    $name = $_SESSION['name'];
} else {
    // Redirect to the login page if the user is not logged in
    header('Location: Login.php');
    exit; // Make sure to exit to prevent further execution of the page
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
</head>
<body>
    <h1>Welcome, <?php echo $name; ?></h1>
    <p>click here to go <a href="Logout.php">Logout</a></p>
    <!-- Other content of your profile page -->
</body>
</html>