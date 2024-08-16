<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $con = new PDO('mysql:host=localhost;dbname=saveithub', 'root', '');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $userID = $_SESSION['userID'];
        
        echo 'Debug: userID from session: ' . $userID . '<br>';

        $selectedTopic = $_POST['topic'];

        if ($selectedTopic === 'motivational') {
            $topicId = 1;
        } elseif ($selectedTopic === 'educational') {
            $topicId = 2;
        } else {
            $topicId = 0;
        }

        $content = $_POST['content'];


        $stmt = $con->prepare("INSERT INTO forum_posts (userID, content) VALUES ( ?, ?)");
        $stmt->execute([$userID, $content]);

        header('Location: discussion_page.php');
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

?>
