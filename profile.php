<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once('connection.php');

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // Get the username from the session
    $username = $_SESSION['username'];
} else {
    // Default to a generic username or an empty string
    $username = 'Guest';
}

function getUserProfileImage($userID, $pdo) {
    $stmt = $pdo->prepare("SELECT filename FROM images WHERE userID = :userID ORDER BY upload_timestamp DESC LIMIT 1");
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? 'profile_images' . $result['filename'] : '';
}

// Get the logged-in user's ID from the session
$userID = isset($_SESSION['userID']) ? $_SESSION['userID'] : null;

// Get the user's profile image filename
$userProfileImage = getUserProfileImage($userID, $conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFILE</title>
    <link rel="icon" href="heartLogo.png" type="image/png">
    <link rel="stylesheet" href="profile.css">
</head>

<body>
    <div class="container">
        <div class="navbar-container">
            <div class="navbar">
                <div class="navbar-right">
                    <button class="rightHeader" onclick="redirectTo('dashboard.php')">HOME</button>
                    <button class="rightHeader" onclick="redirectTo('profile.php')">PROFILE</button>
                    <button class="rightHeader" onclick="redirectTo('discussion_page.php')">COMMUNITIES</button>
                    <button class="rightHeader" onclick="redirectTo('userDonation.php')">DONATE</button>
                    <button class="rightHeader" onclick="redirectTo('educationalResources.php')">EDUCATE</button>
                    <button class="logout" onclick="redirectTo('mainPage.php')">LOGOUT</button>
                </div>
            </div>
        </div>
        <div class="box-container">
            <div class="box">
                <div id="circular-container" onclick="uploadImage()">
                    <input type="file" id="image-input" accept="image/*" style="display: none;">
                    <?php if (!empty($userProfileImage)) : ?>
                        <img id="uploaded-image" src="<?php echo $userProfileImage; ?>" alt="Profile Image">
                    <?php else : ?>
                        <!-- Default image or placeholder if no profile image exists -->
                        <img id="uploaded-image" src="default-image.jpg" alt="Default Image">
                    <?php endif; ?>
                </div>
                <div class="userName" id="userName"><?php echo $username; ?></div>
                <div class="userID">USER ID: <?php echo $userID; ?></div>
                <div class="reminder">You may upload a profile picture if none</div>
            </div>
        </div>
        <div class="history-container">
            <div class="history">
                <div class="historyTitle">DONATION HISTORY</div>
                <div class="historyBox">
                    <?php
                    // Fetch and display user's donation history
                    $stmt = $conn->prepare("
                        SELECT 
                            donorName, 
                            date, 
                            donorLocation, 
                            donationType, 
                            CASE WHEN cashAmount <> 0 THEN cashAmount END as cashAmount,
                            CASE WHEN donatedResources <> '' THEN donatedResources END as donatedResources,
                            CASE WHEN customAmountInput <> 0 THEN customAmountInput END as customAmountInput,
                            preferredCommunity, 
                            donationID 
                        FROM donation 
                        WHERE userID = :userID
                          AND (cashAmount <> 0 OR donatedResources <> '' OR customAmountInput <> 0)
                    ");
                    $stmt->bindParam(':userID', $userID);
                    $stmt->execute();

                    // Loop through donation records and display them
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<div class="donation-entry">';
                        echo '<p><strong>Name:</strong> ' . $row['donorName'] . '</p>';
                        echo '<p><strong>Date:</strong> ' . $row['date'] . '</p>';
                        echo '<p><strong>Address:</strong> ' . $row['donorLocation'] . '</p>';
                        echo '<p><strong>Donation Type:</strong> ' . $row['donationType'] . '</p>';
                        
                        // Check for NULL values before echoing Cash Amount
                        if ($row['cashAmount'] !== null) {
                            echo '<p><strong>Cash Amount:</strong> ' . $row['cashAmount'] . '</p>';
                        }
                    
                        // Check for NULL values before echoing donatedResources
                        if ($row['donatedResources'] !== null) {
                            echo '<p><strong>Donation:</strong> ' . $row['donatedResources'] . '</p>';
                        }
                    
                        // Check for NULL values before echoing Custom Amount Input
                        if ($row['customAmountInput'] !== null) {
                            echo '<p><strong>Cash Amount:</strong> ' . $row['customAmountInput'] . '</p>';
                        }
                    
                        echo '<p><strong>Preferred Community:</strong> ' . $row['preferredCommunity'] . '</p>';
                        echo '<p><strong>Donation ID:</strong> ' . $row['donationID'] . '</p>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        function redirectTo(url) {
            // Add an additional check to see if the URL is for logging out
            if (url === 'mainPage.php') {
                // Use fetch to notify the server about the logout
                fetch('logout.php')
                    .then(response => response.text())
                    .then(data => {
                        console.log('Server Response:', data);
                        // Redirect to the main page after the logout
                        window.location.href = url;
                    })
                    .catch(error => {
                        console.error('Error logging out:', error);
                        // Handle errors, such as displaying an error message to the user.
                    });
            } else {
                // Redirect to other pages without logging out
                window.location.href = url;
            }
        }

        function uploadImage() {
            // Trigger the hidden file input when the container is clicked
            document.getElementById('image-input').click();
        }

        // Handle image selection
        document.getElementById('image-input').addEventListener('change', function () {
            const fileInput = this;
            const circularContainer = document.getElementById('circular-container');
            const uploadedImage = document.getElementById('uploaded-image');

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    uploadedImage.src = e.target.result;

                    circularContainer.style.backgroundColor = 'transparent';
                    circularContainer.style.border = 'none';
                    uploadedImage.style.display = 'block';
                };

                reader.readAsDataURL(fileInput.files[0]);

                uploadImageToServer(fileInput.files[0]);
            }
        });

        function uploadImageToServer(file) {
        const formData = new FormData();
        formData.append('image', file);

    // Use fetch to send the image to the server
        fetch('upload.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text()) // Read the response as plain text
            .then(data => {
                console.log('Server Response:', data);
            // Handle the response as needed
                alert("Image Uploaded Successfully"); // Display a custom success message
            })
            .catch(error => {
                console.error('Error uploading image:', error);
            // Handle errors, such as displaying an error message to the user.
            });
    }   

    </script>
</body>
</html>