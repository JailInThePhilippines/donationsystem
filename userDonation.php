<?php
// Start the session to access session variables
session_start();

include_once('connection.php');

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // Get the username from the session
    $username = $_SESSION['username'];
} else {
    // Default to a generic username or an empty string
    $username = 'Guest';
}

function getUserProfileImageForDonation($userID, $conn)
{
    $stmt = $conn->prepare("SELECT filename FROM images WHERE userID = :userID ORDER BY upload_timestamp DESC LIMIT 1");
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result ? 'uploads/' . $result['filename'] : '';
}

// Get the logged-in user's ID from the session
$userID = isset($_SESSION['userID']) ? $_SESSION['userID'] : null;

// Get the user's profile image filename for the dashboard
$userProfileImage = getUserProfileImageForDonation($userID, $conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="userDonation.css">
    <title>Donation</title>
    <link rel="icon" href="heartLogo.png" type="image/png">
</head>

<body>
    <div class="container">
        <div class="navbar-container">
            <div class="navbar">
                <div class="navbar-left">
                    <div class="title-container">
                        <div class="titleHeader">Save</div>
                        <div class="titleHeaderTwo">IT</div>
                        <div class="titleHeaderThree">HUB</div>
                    </div>
                    <div class="titleTagLine">Saving Today for Tomorrow</div>
                </div>
                <div class="navbar-right">
                    <div class="rightHeader"><a href="dashboard.php">HOME</a></div>
                    <div class="rightHeader"><a href="profile.php">PROFILE</a></div>
                    <div class="rightHeader"><a href="discussion_page.php">COMMUNITIES</a></div>
                    <div class="rightHeader"><a href="userDonation.php">DONATE</a></div>
                    <div class="rightHeader"><a href="educationalResources.php">EDUCATE</a></div>
                </div>
                <div class="navbar-end">
                    <div class="userName" id="userName"><?php echo $username; ?></div>
                    <?php
                    if (!empty($userProfileImage)) {
                        // Display the uploaded profile image with the specified style
                        echo '<img src="' . $userProfileImage . '" alt="Profile Image" style="background-color: yellowgreen; border-radius: 50%; width: 30px; height: 30px; text-align: center; line-height: 30px; margin-left: 10px;">';
                    } else {
                        // Display the initial with the specified style
                        $initial = strtoupper(substr($username, 0, 1));
                        echo '<div class="userInitial">' . $initial . '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="body-container">
            <div class="body">
                <div class="body-left-container">
                    <div class="body-left">
                        <div class="contentO">SAVE FOOD</div>
                        <div class="contentT">SHARE HOPE</div>
                        <div class="contentThO">DONATE</div>
                        <div class="contentThT"> YOUR</div>
                        <div class="contentThTh">SURPLUS</div>
                        <button class="donationButton" onclick="redirectToDonation()">DONATE NOW</button>

                        <script>
                            function redirectToDonation() {
                                window.location.href = "donation.php";
                            }
                        </script>

                        <div class="donorAmountInfo">
                            <div class="amountDonor">234K</div>
                            <div class="amountDonorT"> + Donors</div>
                            <div class="amountRaised">3.9m</div>
                            <div class="amountRaisedT"> + Money Raised</div>
                        </div>
                    </div>
                </div>
                <div class="body-right-container">
                    <div class="body-right">
                        <div class="rightContent">SAVE IT!</div>
                        <div class="image-container">
                            <img class="imageOne" src="https://shpbeds.org/wp-content/uploads/2023/03/Donation.png" alt="imageOne">
                            <img class="imageTwo" src="https://www.investopedia.com/thmb/qensYs-PhHbw8CJkt6aagK40VXk=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/girl-helping-hold-large-donation-check-in-community-center-944809242-339eb754474b4000b18363e19f9fc766.jpg" alt="imageTwo">
                            <img class="imageThree" src="https://randyandrayelynnjassman.com/wp-content/uploads/2018/06/Randy-and-Raylynn-Jassman-Children-Giving-Back-Blog-1024x680-1.jpg" alt="iamgeThree">
                            <div class="link">saveithub.com/donate</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footerContainer">
            <!-- Image footer section -->
            <div class="imageFooter">
                <img class="saveITLogo" src="SaveITLogo.png" alt="saveITHubLogo">
                <img class="gcLogo" src="gcLogo.png" alt="gcLogo">
            </div>

            <!-- Footer content section -->
            <div class="footerContent">
                <div class="teamName"></div>
                <div class="projectPurpose">This project is built in completion of partial requirements in Fundamentals of Database Systems</div>
            </div>
        </div>
    </div>
</body>
</html>
