<?php
include 'connection.php';
session_start();
if (!isset($_SESSION['userID'])) {
    header('Location: signin.php');
    exit();
}

if (isset($_POST['postId']) && is_numeric($_POST['postId'])) {
    $postId = intval($_POST['postId']);

    try {
        $con = new PDO('mysql:host=localhost;dbname=saveithub', 'root', '');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if the user has permission to delete the post
        $currentUserId = $_SESSION['userID'];
        $stmt = $con->prepare("SELECT userID FROM forum_posts WHERE post_id = ?");
        $stmt->execute([$postId]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($post['userID'] == $currentUserId) {
            // User has permission to delete the post
            $stmt = $con->prepare("DELETE FROM forum_posts WHERE post_id = ?");
            $stmt->execute([$postId]);

            if ($stmt->rowCount() > 0) {

                header('Location: discussion_page.php');
                exit();
            } else {
                echo "Post not found or could not be deleted.";
                exit();
            }
        } else {
            echo "You do not have permission to delete this post.";
            exit();
        }
    } catch (PDOException $e) {

        echo "Database error: " . $e->getMessage();
        exit();
    }
} else {
    echo "Invalid postId.";
    exit();
}
?>
