<?php 
session_start();

function getUserProfileImageForDonation($userID, $conn)
{
    $stmt = $conn->prepare("SELECT filename FROM images WHERE userID = :userID ORDER BY upload_timestamp DESC LIMIT 1");
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result ? 'uploads/' . $result['filename'] : '';
}

?>