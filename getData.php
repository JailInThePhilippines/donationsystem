<?php
// getData.php

// Include your database connection file
include_once('connection.php');

// Handle the database query
$query = "SELECT MONTH(date) as month, COUNT(*) as donationCount 
          FROM donation 
          GROUP BY MONTH(date)";

try {
    // Prepare the statement
    $stmt = $conn->prepare($query);

    // Execute the statement
    $stmt->execute();

    $data = [];

    // Initialize the data array with zero counts for each month
    $months = range(1, 12);
    $data = array_fill_keys($months, 0);

    // Fill in the actual counts based on the query result
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Use the count directly from the query result
    $data[$row['month']] = $row['donationCount'];
    // Log the data being retrieved
    error_log('Month: ' . $row['month'] . ', Count: ' . $row['donationCount']);
}


    // Return the data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} catch (PDOException $e) {
    // Handle database errors
    error_log("Error: " . $e->getMessage());
    echo json_encode(['error' => 'Database query error']);
}
?>
