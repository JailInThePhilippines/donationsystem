<?php

include_once('connection.php');

// Start the session if not already started
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signupForm'])) {
    // Signup form submitted
    $newUsername = $_POST['newUsername'];
    $newEmail = $_POST['newEmail'];
    $newPassword = $_POST['newPassword'];

    // Check if the username already exists
    $checkUsernameQuery = "SELECT COUNT(*) FROM users WHERE username = :username";
    $checkUsernameStmt = $conn->prepare($checkUsernameQuery);
    $checkUsernameStmt->bindParam(':username', $newUsername);
    $checkUsernameStmt->execute();

    $usernameCount = $checkUsernameStmt->fetchColumn();

    // Check if the email is already used
    $checkEmailQuery = "SELECT COUNT(*) FROM users WHERE email = :email";
    $checkEmailStmt = $conn->prepare($checkEmailQuery);
    $checkEmailStmt->bindParam(':email', $newEmail);
    $checkEmailStmt->execute();

    $emailCount = $checkEmailStmt->fetchColumn();

    if ($usernameCount > 0) {
        // Username already taken, show an alert using JavaScript and prevent form submission
        echo '<script>alert("Username is already taken. Please choose a different username.");</script>';
        echo '<script>window.location.href = "mainPage.php";</script>';
        exit(); // Stop further execution
    } elseif ($emailCount > 0) {
        // Email already used, show an alert using JavaScript and prevent form submission
        echo '<script>alert("Email is already used. Please use a different email.");</script>';
        echo '<script>window.location.href = "mainPage.php";</script>';
        exit(); // Stop further execution
    } else {
        // Username and email are unique, proceed with the registration

        // Use prepared statements to prevent SQL injection
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->bindParam(':username', $newUsername);
        $stmt->bindParam(':email', $newEmail);
        $stmt->bindParam(':password', $hashedPassword);

        // Execute the statement
        $stmt->execute();

        // Set user information in the session
        $_SESSION['userID'] = $conn->lastInsertId(); // Assuming the ID is auto-incremented
        $_SESSION['username'] = $newUsername;

        // Redirect to dashboard.php
        header("Location: dashboard.php");
        exit();
    }
}
?>
