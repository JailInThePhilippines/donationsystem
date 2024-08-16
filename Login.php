<?php
session_start();
// Include the database connection file
include_once('connection.php');

// Start the session to access session variables

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['loginForm'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform your login logic here
    // Example: Check the database for the username in the users table
    $query = "SELECT * FROM users WHERE username = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    // Fetch the user record
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if a user with the given username exists and verify the password
    if ($user && password_verify($password, $user['password'])) {
        // Set user information in the session
        $_SESSION['userID'] = $user['userID']; // Assuming 'id' is the column for the user ID
        $_SESSION['username'] = $user['username'];

        // Regenerate session ID to enhance security
        session_regenerate_id(true);

        // Redirect to dashboard.php
        header('Location: dashboard.php');
        exit;
    } else {
        // If login fails, you can redirect back to the login page with an error message
        echo '<script>alert("Invalid username or password. Please try again.");</script>';
        echo '<script>window.location.href = "mainPage.php";</script>';
        exit;
    }
}

// Handle other cases or display the login page
?>
