<?php
include_once('connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags for character set and viewport -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link to the main stylesheet -->
    <link rel="stylesheet" href="mainPage.css">

    <!-- Title and favicon for the page -->
    <title>SaveIT-Hub</title>
    <link rel="icon" href="heartLogo.png" type="image/png">
</head>

<body>
    <!-- Overlay for modals -->
    <div id="overlay" class="overlay"></div>

    <!-- Main container for the page -->
    <div class="container">

        <!-- Navbar container -->
        <div class="navbar-container">
            <!-- Navbar -->
            <div class="navbar">

                <!-- Navbar left section with title and tagline -->
                <div class="navbar-left">
                    <div class="title-container">
                        <div class="titleHeader">Save</div>
                        <div class="titleHeaderTwo">IT</div>
                        <div class="titleHeaderThree">HUB</div>
                    </div>
                    <div class="titleTagLine">Saving Today for Tomorrow</div>
                </div>

                <!-- Navbar right section with menu items -->
                <div class="navbar-right">
                    <div class="rightHeader">MAIN</div>
                    <div class="rightHeader">ABOUT US</div>
                    <div class="rightHeader">HOME</div>
                    <div class="rightHeader">SERVICES</div>
                    <div class="rightHeader">DID YOU KNOW?</div>
                </div>

                <!-- Navbar end section with login and signup buttons -->
                <div class="navbar-end">
                    <a class="login" id="loginBtn">LOGIN</a>
                    <a class="signup" id="signupBtn">SIGNUP</a>
                </div>
            </div>
        </div>

        <!-- Body container -->
        <div class="body-container">
            <!-- First section of body content -->
            <div class="bodyContent">
                <!-- Circular image container -->
                <div class="circular-image-container">
                    <img class="circular-image" src="https://muslimhands.ca/_ui/images/fc575db486cb.jpg" alt="Philippine Kids Image">
                </div>

                <!-- Text content section -->
                <div class="text-content">
                    <div class="bodyHeader">SAVING TODAY</div>
                    <div class="bodyHeaderTwo">FOR TOMORROW</div>
                    <div class="bodyHeaderThree">Be a hero in your community. Every signup brings</div>
                    <div class="bodyHeaderThreeSub">us one step closer to a world with less waste and</div>
                    <div class="bodyHeaderThreeSubTwo">more compassion.</div>
                </div>
            </div>

            <!-- Button container -->
            <div class="buttonContainer">
                <div class="bodyLogin" id="bodyLoginBtn">LOGIN</div>
                <div class="bodySignup" id="bodySignupBtn">SIGNUP</div>
                <div class="donateButton" id="bodyDonateNowBtn">DONATE NOW</div>
            </div>

            <!-- Second section of body content -->
            <div class="secondBodyContainer">
                <!-- Second content section -->
                <div class="secondContent">
                    <div class="secondBody">A PLATFORM</div>
                    <div class="secondBodyTwo">THAT CARES</div>
                    <div class="secBodyDesc">Did you know that every year, millions of tons of</div>
                    <div class="secBodyDesc">food go to waste while people in our communities</div>
                    <div class="secBodyDesc">go hungry? By signing up in SaveIT HUB, you</div>
                    <div class="secBodyDesc">become part of the solution.</div>
                    <div class="secBodyDescTwo">Together, we can make a meaningful impact on our</div>
                    <div class="secBodyDescThree">environment and help those in need.</div>
                </div>

                <!-- Image container -->
                <div class="imageContainer">
                    <img class="imageOne" src="http://images.says.com/uploads/story_source/source_image/442652/b2c9.jpg" alt="Image 1">
                    <img class="imageTwo" src="https://www.sonkonews.com/wp-content/uploads/2021/01/Poverty-in-kenya-1536x1152.jpg" alt="Image 2">
                    <img class="imageThree" src="https://www.rappler.com/tachyon/r3-assets/AC59DA376D074337B888A3F51F2EED99/img/B1420C497C4545DDA56207FB8B732EF9/poverty-poor-community-navotas-august-2-2017-001.jpg" alt="Image 3">
                    <img class="imageFour" src="https://resources.stuff.co.nz/content/dam/images/1/2/3/d/k/s/image.related.StuffLandscapeSixteenByNine.1420x800.123d93.png/1418108583011.jpg" alt="Image 4">
                    <img class="imageFive" src="https://media.interaksyon.com/wp-content/uploads/2021/12/tondo-manila-poverty.jpg" alt="Image 5">
                </div>
            </div>

            <!-- Third section of body content -->
            <div class="thirdBodyContainer">
                <!-- Third image container -->
                <div class="thirdImageContainer">
                    <img class="donate" src="donate.png" alt="donate">
                    <img class="communityEngagement" src="community.png" alt="people">
                    <img class="book" src="book.png" alt="book">
                </div>

                <!-- Third content section -->
                <div class="thirdContent">
                    <div class="donation">DONATION</div>
                    <div class="communityEngagementText">COMMUNITY ENGAGEMENTS</div>
                    <div class="educationalResources">EDUCATIONAL RESOURCES</div>
                </div>
            </div>

            <!-- Broken line container -->
            <div class="brokenLineContainer">
                <div class="brokenLineOne"></div>
                <div class="services">SERVICES</div>
                <div class="brokenLineTwo"></div>
            </div>
        </div>

        <!-- Footer container -->
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

    <!-- Login Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="welcome">WELCOME</h2>
                <h3 class="subWelcome">Login to your account to continue</h3>
                <button class="closeModal" onclick="closeModal('loginModal')">X</button>
            </div>
            <div class="modal-body">
                <!-- Login form -->
                <form action="Login.php" id="loginForm" method="post">
                    <!-- Username input -->
                    <div class="input-container">
                        <label for="username"></label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required>
                    </div>

                    <!-- Password input with eye icon -->
                    <div class="input-container">
                        <label for="password"></label>
                        <div class="password-container">
                            <input type="password" id="password" name="password" placeholder="Enter your password" required>
                            <span class="eye-icon" id="eyeIcon">&#128064;</span>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button class="submit" type="submit" name="loginForm">Login</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Signup Modal -->
    <div id="signupModal" class="modal-two">
        <div class="modal-content-two">
            <div class="modal-header">
                <h2>Sign Up</h2>
                <h3>Create an account to continue</h3>
            </div>
            <div class="modal-body-two">
                <!-- Signup form with username, email, password, and eye icon -->
                <form action="Registration.php" id="signupForm" method="post">
                    <input type="text" id="newUsername" name="newUsername" placeholder="Username" required>
                    <input type="email" id="newEmail" name="newEmail" placeholder="Email" required>
                    <div class="password-input">
                        <input type="password" id="newPassword" name="newPassword" placeholder="Password" required>
                        <span class="eye-iconTwo" id="eyeIconTwo">&#128064;</span>
                    </div>
                    <button class="submitTwo" type="submit" name="signupForm">Sign Up</button>
                </form>

                <!-- Close modal button -->
                <button class="closeModalTwo" onclick="closeModal('signupModal')">X</button>
            </div>
        </div>
    </div>

    <!-- Style for the eye icon -->
    <style>
        .password-container {
            position: relative;
            display: flex;
            align-items: center;
            height: 50px;
        }

        .eye-icon {
            position: absolute;
            right: 10px;
            cursor: pointer;
            user-select: none;
            height: 10px;
            margin-top: -60px;
        }

        .password-input {
            position: relative;
            display: flex;
            align-items: center;
            height: 50px;
        }

        .eye-iconTwo {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            margin-top: -40px;
        }
    </style>

    <!-- Script for page functionality -->
    <script src="mainPage.js" defer></script>
</body>
</html>