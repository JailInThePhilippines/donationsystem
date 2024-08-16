<?php
// Start the session to access session variables
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once('connection.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $date = $_POST['donationDate'];
    $donorLocation = $_POST['donorLocation'];
    $donationType = $_POST['donationType'];
    $donatedResources = isset($_POST['donatedResources']) ? $_POST['donatedResources'] : null; // Updated variable name

    // Handle cashAmount based on the selected option
    $cashAmount = ($_POST['cashAmount'] === 'custom') ? $_POST['customAmountInput'] : $_POST['cashAmount'];
    $customAmountInput = isset($_POST['customAmountInput']) ? $_POST['customAmountInput'] : null;

    // $foodMaterials = isset($_POST['foodMaterials']) ? $_POST['foodMaterials'] : null; // Remove this line

    $preferredCommunity = $_POST['preferredCommunity'];

    // Use the session variable for the logged-in username
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';

    // Fetch the userID from the users table based on the donorName
    $fetchUserIDSql = "SELECT userID FROM users WHERE username = :donorName LIMIT 1";
    $stmtFetchUserID = $conn->prepare($fetchUserIDSql);
    $stmtFetchUserID->bindParam(':donorName', $username);
    $stmtFetchUserID->execute();
    $userID = $stmtFetchUserID->fetchColumn();

    // Prepare and execute the SQL query using PDO
    $sql = "INSERT INTO donation (donorName, date, donorLocation, donationType, donatedResources, cashAmount, customAmountInput, preferredCommunity, userID)
    VALUES (:donorName, :date, :donorLocation, :donationType, :donatedResources, :cashAmount, :customAmountInput, :preferredCommunity, :userID)";

    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':donorName', $username);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':donorLocation', $donorLocation);
    $stmt->bindParam(':donationType', $donationType);
    $stmt->bindParam(':donatedResources', $donatedResources); // Updated variable name
    $stmt->bindParam(':cashAmount', $cashAmount);
    $stmt->bindParam(':customAmountInput', $customAmountInput);
    // $stmt->bindParam(':foodMaterials', $foodMaterials); // Remove this line
    $stmt->bindParam(':preferredCommunity', $preferredCommunity);
    $stmt->bindParam(':userID', $userID);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Set a session variable to indicate successful donation
        $_SESSION['donation_success'] = true;
    } else {
        echo "Error: " . $stmt->errorInfo()[2]; // Display detailed error message
    }

    // Close the statements
    $stmt = null;
    $stmtFetchUserID = null;

    // Redirect to the main page or wherever you want
    header("Location: donation.php");
    exit();
}
?>
