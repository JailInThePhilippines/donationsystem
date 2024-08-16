<?php
include_once('connection.php');
include_once('donationProcessor.php');

function getDonationPercentage($conn, $username)
{
    // Count the number of donations for the logged-in user
    $donationCountQuery = "SELECT COUNT(*) AS donationCount FROM donation WHERE donorName = :logged_in_username OR donorName = :anonymous";
    $donationCountStatement = $conn->prepare($donationCountQuery);
    $donationCountStatement->bindParam(':logged_in_username', $username, PDO::PARAM_STR);
    $donationCountStatement->bindValue(':anonymous', 'Anonymous', PDO::PARAM_STR); // Use bindValue for constant values
    $donationCountStatement->execute();
    $donationCount = $donationCountStatement->fetch(PDO::FETCH_ASSOC)['donationCount'];

    // Calculate the donation percentage for the logged-in user
    $donationPercentage = min($donationCount * 1, 100); // Assume a maximum of 100%

    return round($donationPercentage, 2); // Round to two decimal places
}

function getUserProfileImageForDashboard($userID, $conn)
{
    $stmt = $conn->prepare("SELECT filename FROM images WHERE userID = :userID ORDER BY upload_timestamp DESC LIMIT 1");
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result ? 'uploads/' . $result['filename'] : '';
}
?>
