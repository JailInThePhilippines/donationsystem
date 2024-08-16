<?php
session_start();
include 'connection.php';

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = 'Guest';
}
try {
    $stmt = $conn->prepare("SELECT userID FROM users WHERE username = ?");
    $stmt->execute([$username]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {

        $userID = $result['userID'];
        $_SESSION['userID'] = $userID;
    }
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

function fetchComments($postId) {
    global $conn;  

    try {
        $stmt = $conn->prepare("SELECT pc.*, u.username FROM forum_comments pc
        JOIN users u ON pc.userID = u.userID
        WHERE pc.post_id = ?");
        $stmt->execute([$postId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
}

$stmt = $conn->prepare("SELECT forum_posts.*, users.username 
                      FROM forum_posts 
                      JOIN users ON forum_posts.userID = users.userID");
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

$currentUserId = $_SESSION['userID'];
$_SESSION['username'] = $username; 

function getUserProfileImageForCommunities($userID, $conn)
{
    $stmt = $conn->prepare("SELECT filename FROM images WHERE userID = :userID ORDER BY upload_timestamp DESC LIMIT 1");
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result ? 'uploads/' . $result['filename'] : '';
}

$userProfileImage = getUserProfileImageForCommunities($userID, $conn);

function getUserProfileImage($userID, $conn) {
    try {
        $stmt = $conn->prepare("SELECT filename FROM images WHERE userID = :userID ORDER BY upload_timestamp DESC LIMIT 1");
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? 'uploads/' . $result['filename'] : '';
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="community.css">
    <title>Communities</title>
    <link rel="icon" href="heartLogo.png" type="image/png">
</head>
<body>
<div id="overlay" class="overlay"></div>
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
    <div class="container-forum">
        <div class="forum">
        <form method="post" action="postReply.php">
            <textarea class="contents" name="content" placeholder="What's on your mind?"></textarea>
            <button class="postbtn" type="submit">Post</button>
        </form>
        </div>
    </div>

    <div class="per-post-container">
    <div class="per-post">
        <?php foreach ($posts as $post): ?>
            <div class="post-box">
            <div class="post">
    <?php
    // Get the profile image for the user who posted the forum post
    $postUserProfileImage = getUserProfileImage($post['userID'], $conn);

    // Check if the post user has a profile image
    if (!empty($postUserProfileImage)) {
        // Display the uploaded profile image with the specified style
        echo '<img src="' . $postUserProfileImage . '" alt="Profile Image" style="background-color: yellowgreen; border-radius: 50%; width: 30px; height: 30px; text-align: center; line-height: 30px; margin-left: 10px;">';
    } else {
        // Display the initial with the specified style
        $initial = strtoupper(substr($post['username'], 0, 1));
        echo '<div class="userInitial">' . $initial . '</div>';
    }
    ?>
    <p class="username"><?php echo $post['username']; ?></p>
    <p class="content"><?php echo $post['content']; ?></p>
    <p class="timestamp"><?php echo $post['timestamp']; ?></p>
</div>

                <button class="like-btn" data-post-id="<?php echo $post['post_id']; ?>">Like</button>
                <button class="comment-btn" data-post-id="<?php echo $post['post_id']; ?>" onclick="toggleCommentModal(<?php echo $post['post_id']; ?>)">Comment</button>
                

                <div id="commentModal_<?php echo $post['post_id']; ?>" class="modal comment-modal hidden">
    <div class="modal-content">
        <div class="comment-form-container">
            <h2 class="AddComText">Add a Comment</h2>
            <form method="post" action="addComment.php">
                <div class="form-group1">
                    <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
                    <label for="comment">Your Comment:</label>
                    <textarea name="comment" class="commentArea" placeholder="Write your comment here"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn">Post Comment</button>
                </div>
            </form>
        </div>
    </div>
</div>

                <?php
                if ($post['userID'] == $currentUserId):
                ?>
<form id="deleteForm_<?php echo $post['post_id']; ?>" method="post" action="deletePost.php">
    <input type="hidden" name="postId" value="<?php echo $post['post_id']; ?>">
    <button class="delete-post-btn" type="submit">Delete Post</button>
</form>

            <?php endif; ?>

                <div class="mgaReply">
                    <?php

                    $comments = fetchComments($post['post_id']);
                    foreach ($comments as $comment):
                        ?>
                        <div class="comment-box">
                            <p><strong><?php echo $comment['username']; ?>:</strong> <?php echo $comment['content']; ?></p>
                            <span class="comment-timestamp"><?php echo $comment['timestamp']; ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    </div>
    </div>
</div>


<script>
    // Display logout button
    document.querySelector('#logout_btn').style.display = 'inline-block';

// Function to open the comment modal
// Function to toggle the comment modal visibility
function toggleCommentModal(postId) {
    var modal = document.getElementById('commentModal_' + postId);

    // Check the current display style
    var currentDisplayStyle = window.getComputedStyle(modal).display;

    // Toggle the display style
    modal.style.display = (currentDisplayStyle === 'none') ? 'block' : 'none';
}


</script>

</body>
</html>
