<?php
session_start();
include_once('connection.php');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', '1');

var_dump($_SESSION);  // Debugging statement

// Handle file upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $targetDir = "uploads/";  // Directory to store uploaded images
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);

    // Check for file upload errors
    if ($_FILES["image"]["error"] > 0) {
        echo 'File upload error: ' . $_FILES["image"]["error"];
        exit;
    }

    // Move the uploaded file to the target directory
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo 'Error moving uploaded file to target directory';
        exit;
    }

    // Store file information in the database
$imageName = $_FILES["image"]["name"];
$userID = isset($_SESSION['userID']) ? $_SESSION['userID'] : null;

// Check if the user is authenticated before proceeding
if ($userID === null) {
    echo 'Error: User not authenticated.';
    exit;
}

try {
    // Insert the image information into the database
    $stmt = $conn->prepare("INSERT INTO images (filename, userID) VALUES (:filename, :userID)");
    $stmt->bindParam(':filename', $imageName);
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();

    echo 'Image uploaded successfully';
} catch (PDOException $e) {
    echo 'Database Error: ' . $e->getMessage();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}


} else {
    echo 'Error uploading image';
}

?>
