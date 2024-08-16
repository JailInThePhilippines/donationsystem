<?php
// Start the session to access session variables
session_start();

include_once('connection.php');
include_once('dashboardBackend.php');

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // Get the username from the session
    $username = $_SESSION['username'];
} else {
    // Default to a generic username or an empty string
    $username = 'Guest';
}

// Call the getDonationPercentage function
$donationPercentage = getDonationPercentage($conn, $username);

// Get the logged-in user's ID from the session
$userID = isset($_SESSION['userID']) ? $_SESSION['userID'] : null;

// Get the user's profile image filename for the dashboard
$userProfileImage = getUserProfileImageForDashboard($userID, $conn);

$sql = "SELECT preferredCommunity, COUNT(*) AS donationCount FROM donation GROUP BY preferredCommunity ORDER BY donationCount DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$donationCounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="dashboard.css">
    <title>Dashboard</title>
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
                <div class="bodyLeft">
                    <div class="greeting">Hello, </div>
                    <div class="userName" id="userName"><?php echo $username; ?>!</div>
                </div>
                <div class="bodyRight">
                    <div class="graphicContainer">
                        <div class="graphic">
                            <!-- Updated code for the circular graphic -->
                            <div class="donationGraphic" id="donationGraphic">
                                <div class="donationFill" id="donationFill"></div>
                                <div class="donationText" id="donationText"><?php echo $donationPercentage; ?>%</div>
                            </div>
                            <div class="donationTitle">Your Donation</div>
                        </div>
                    </div>
                </div>
                <div class="mainBody">
                    <div class="totalRaised">TOTAL RAISED <br> OF SAVE IT - HUB <br> COMMUNITY</div>
                    <!-- Add this where you want the line graph to appear -->
                    <canvas id="lineChart" width="160" height="100"></canvas>
                    <div class="activeAreas">
    <div class="areas">ACTIVE AREAS</div>
    <?php foreach ($donationCounts as $donationCount): ?>
        <div class="<?php echo strtolower(str_replace(' ', '', $donationCount['preferredCommunity'])); ?> area">
            <?php echo strtoupper($donationCount['preferredCommunity']); ?>
            <!-- Display the numbers of donation in this area -->
            <span class="donationCount">(<?php echo $donationCount['donationCount']; ?>)</span>
        </div>
    <?php endforeach; ?>
</div>
                </div>
                <div class="communityOutreach">COMMUNITY OUTREACH</div>
                <div class="bottom">
                    <div class="imageContainer">
                        <img class="outreach" src="outreach.jpg" alt="OC outreach">
                        <img class="outreachTwo" src="outreachTwo.jpg" alt="OC outreach">
                        <img class="outreachThree" src="outreachThree.jpg" alt="OC outreach">
                    </div>
                    <div class="buttContainer">
                        <button class="readMore" onclick="redirectTo('educationalResources.php')">READ MORE</button>
                        <button class="watchNow" onclick="redirectTo('https://www.youtube.com/@BeastPhilanthropy')">WATCH NOW</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var donationPercentage = <?php echo $donationPercentage; ?>;
        updateDonationGraphic(donationPercentage);
        fetchDataAndDrawChart(); // Fetch data and draw the initial chart

        // dashboard.js
        function updateDonationGraphic(percentage) {
            var fillElement = document.getElementById('donationFill');
            var textElement = document.getElementById('donationText');

            // Calculate the angle based on the percentage
            var angle = (percentage / 100) * 360;

            // Update the fill color and border color based on the percentage
            if (percentage === 0) {
                fillElement.style.backgroundColor = 'blue'; // Default color for 0% donation
                fillElement.style.borderColor = 'blue';
            } else {
                fillElement.style.backgroundColor = 'green'; // Color for non-zero percentage
                fillElement.style.borderColor = 'green';
            }

            // Apply the rotation to the fill element
            fillElement.style.transform = 'rotate(' + angle + 'deg)';

            // Update the text content
            textElement.textContent = percentage + '%';
        }

        function fetchDataAndDrawChart() {
            console.log('Fetching overall donation data');
            // Use fetch to make a request to your server
            fetch('getData.php')
                .then(response => response.json())
                .then(data => {
                    console.log('Received data from server:', data);
                    updateLineChart(data);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        function updateLineChart(data) {
            console.log('Received data:', data);

            // Array to store the final data for the chart
            var chartData = [];

            // Loop through months from January to December
            for (var i = 1; i <= 12; i++) {
                // If data for the month exists, use it; otherwise, set count to 0
                var count = data[i] !== undefined ? data[i] : 0;

                // Add the count to the chart data array
                chartData.push(count);
            }

            var ctx = document.getElementById('lineChart').getContext('2d');

            // Create the chart with the processed data
            var lineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    datasets: [{
                        label: 'People donated over the past month',
                        data: chartData,
                        borderColor: 'skyblue',
                        borderWidth: 3,
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100
                        }
                    }
                }
            });
        }

        function redirectTo(url) {
            window.location.href = url;
        }
    </script>
</body>

</html>
