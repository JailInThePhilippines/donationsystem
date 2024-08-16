<?php
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

function getUserProfileImageForEducation($userID, $conn)
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
$userProfileImage = getUserProfileImageForEducation($userID, $conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="educationalResources.css">
    <title>Learn to Save-It!</title>
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
        <div class="image-container">
            <img class="bookshelf" src="bookshelf.jpg" alt="books">
            <div class="title-containerTwo">
                <div class="titleText">EDUCATIONAL</div>
                <div class="titleTextTwo">RESOURCES</div>
            </div>
        </div>
        <div class="mainBody">
            <div class="articles"><u>ARTICLES</u></div>
            <button class="articleOne" onclick="redirectTo('https://education.nationalgeographic.org/resource/conserving-earth/')"></button>
            <button class="articleTwo" onclick="redirectTo('https://study.com/academy/lesson/conservation-of-resources-responsibility-action.html')"></button>
            <button class="articleThree" onclick="redirectTo('https://rightsofnature.org.ph/ways-to-conserve-natural-resources/')"></button>
            <button class="articleFour" onclick="redirectTo('https://www.masterclass.com/articles/how-to-conserve-natural-resources')"></button>
            <div class="textContainer">
                <div class="articleOneText">Conserving Earth</div>
                <div class="articleTwoText">Saving Resources</div>
                <div class="articleThreeText">Natural tips: Saving Resources</div>
                <div class="articleFourText">Conventional Tips</div>
            </div>
        </div>
        <div class="bottomContent">
            <div class="bottomTitle-container">
                <div class="bottomTitle">POPULAR RESEARCH PAPERS</div>
            </div>
            <div class="bodyContainer">
                <button class="articleFive" onclick="redirectTo('https://www.mdpi.com/2071-1050/12/14/5524')"></button>
                <button class="articleSix" onclick="redirectTo('https://www.jstor.org/stable/29738805')"></button>
                <button class="articleSeven" onclick="redirectTo('https://www.ingentaconnect.com/content/whp/ev/1998/00000007/00000003/art00004')"></button>
                <button class="articleEight" onclick="redirectTo('https://www.jswconline.org/content/73/4/100A.short')"></button>
                <button class="articleNine" onclick="redirectTo('https://journals.sagepub.com/doi/abs/10.1068/d170133')"></button>
                <button class="articleTen" onclick="redirectTo('https://www.sciencedirect.com/science/article/abs/pii/S0272494420306666')"></button>
                <div class="scrollToTop-container">
                    <button class="scrollToTop" onclick="smoothScrollToTop()">BACK TO TOP</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function redirectTo(url) {
            window.location.href = url;
        }

        function smoothScrollToTop() {
            // Smooth scroll to top logic
            const duration = 500; // Duration of the scroll animation in milliseconds
            const start = performance.now();
            const from = window.scrollY || document.documentElement.scrollTop;

            function scrollStep(timestamp) {
                const time = timestamp - start;
                const percent = Math.min(time / duration, 1);

                document.body.scrollTop = from + (0 - from) * percent;
                document.documentElement.scrollTop = from + (0 - from) * percent;

                if (time < duration) {
                    requestAnimationFrame(scrollStep);
                }
            }

            requestAnimationFrame(scrollStep);
        }
    </script>
</body>
</html>
