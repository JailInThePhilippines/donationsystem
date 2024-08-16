<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'connection.php';

    $forum_posts = isset($_POST['post_id']) ? $_POST['post_id'] : null;

    // Retrieve data from the form
    $postId = $_POST['post_id'];  
    $commentContent = $_POST['comment'];

    try {
        $con = new PDO('mysql:host=localhost;dbname=saveithub', 'root', '');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $con->prepare("INSERT INTO forum_comments (post_id, userID, content, timestamp) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$postId, $_SESSION['userID'], $commentContent]);

        header("Location: discussion_page.php");
        exit();
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
} else {

    header('Location: error.php');
    exit();
}
?>
