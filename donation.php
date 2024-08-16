<?php

include_once('connection.php');
include_once('donationBackend.php');

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // Get the username from the session
    $username = $_SESSION['username'];
} else {
    // Default to a generic username or an empty string
    $username = 'Guest';
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
    <link rel="stylesheet" href="donation.css">
    <title>Donation Center</title>
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
                <div class="title">Donate Now</div>
                <div class="description">
                    By joining forces with us, you become an integral part of a transformative journey that seeks to impact the lives of hundreds and thousands of individuals in Olongapo City. <br>
                    Together, we aspire to create positive change and uplift communities. Your generous donation not only supports our existing initiatives but also opens up new possibilities for reaching even more people in need.
                </div>
                <div class="descriptionT">
                    Every contribution, regardless of size, plays a crucial role in making a difference. Your support empowers us to implement sustainable projects that address key issues and enhance the well-being of the community. 
                    From education and healthcare to livelihood programs, your donation paves the way for a brighter future.
                </div>
                <div class="descriptionTh">
                    Thank you for considering this opportunity to make a meaningful impact. Your generosity will touch the lives of individuals and families, fostering positive change and contributing to the growth and development of Olongapo City. Join us in this transformative journey and be a catalyst for a better tomorrow.
                </div>
                <div class="descriptionF">You can make a difference. Donate Today.</div>
                <div class="bodyMain">
                    <div class="donationContainer">
                        <div class="donationForm">
                            <form action="donationProcessor.php" method="post" id="donationForm">
                                <div class="info">Donor's Profile</div>
                                <div class="form-groupO">
                                    <label for="donorName" class="donorName" >Name</label>
                                    <input type="text" id="donorName" name="donorName" class="form-control" placeholder="Enter your name" required>
                                </div>
                                <div class="form-groupT">
                                    <label for="donationDate" class="date">Date</label>
                                    <input type="date" id="donationDate" name="donationDate" class="form-control" required>
                                </div>
                                <div class="form-groupTh">
                                    <label for="donorLocation" class="location">Address</label>
                                    <input type="text" id="donorLocation" name="donorLocation" class="form-control" placeholder="Enter your address" required>
                                </div>
                                <hr>
                                <div class="donationInfo">Donation</div>
                                <div class="form-groupF">
                                    <label for="donationType" class="donationType">Donation Type</label>
                                    <select id="donationType" name="donationType" class="form-control" onchange="updateDonationOptions()" required>
                                        <option value="food">Food</option>
                                        <option value="materials">Materials</option>
                                        <option value="cash">Cash</option>
                                    </select>
                                </div>
                                <div id="quantityInput" style="display: none;" class="extension">
                                    <label for="donatedResources" class="extend">Please specify the donation</label>
                                    <input type="text" id="donatedResources" name="donatedResources" class="form-control" placeholder="Specify your donation">
                                </div>
                                <div id="cashOptions" style="display: none;" class="extension">
                                    <label for="cashAmount" class="extendT">Cash Amount</label>
                                    <select id="cashAmount" name="cashAmount" class="form-control" onchange="updateCustomAmount()">
                                        <option value="">0</option>
                                        <option value="50">50 pesos</option>
                                        <option value="1000">1000 pesos</option>
                                        <option value="5000">5000 pesos</option>
                                        <option value="custom">Custom</option>
                                    </select>
                                    <div id="customAmount" style="display: none;">
                                        <label for="customAmountInput" class="extendTh">Custom Amount</label>
                                        <input type="text" id="customAmountInput" name="customAmountInput" class="form-control" placeholder="Enter custom amount">
                                    </div>
                                </div>
                                <div id="foodMaterialsInput" style="display: none;">
                                    <label for="foodMaterials">Quantity</label>
                                    <input type="text" id="foodMaterials" name="foodMaterials" class="form-control" placeholder="Enter quantity">
                                </div>
                                <div class="form-groupFi">
                                    <label for="preferredCommunity" class="preferredCom">Preferred Community</label>
                                    <select id="preferredCommunity" name="preferredCommunity" class="form-control" required>
                                        <option value="Old Cabalan, Olongapo City">Old Cabalan, Olongapo City</option>
                                        <option value="Barretto, Olongapo City">Barretto, Olongapo City</option>
                                        <option value="Gordon Heights, Olongapo City">Gordon Heights, Olongapo City</option>
                                        <option value="Kalaklan, Olongapo City">Kalaklan, Olongapo City</option>
                                    </select>
                                </div>
                                <button type="submit" class="submit-button">DONATE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="donation.js" defer></script>
    <script>
        // Check if the session variable is set
        <?php
        if (isset($_SESSION['donation_success']) && $_SESSION['donation_success']) {
            // Reset the session variable
            $_SESSION['donation_success'] = false;

            // Show an alert
            echo "window.alert('Donation Successful!');";

            // Redirect after the user clicks "Okay"
            echo "window.location.href = 'donation.php';";
        }
        ?>
    </script>
</body>

</html>
