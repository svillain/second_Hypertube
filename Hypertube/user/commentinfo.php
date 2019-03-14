<?php
    session_start();
    require_once('../setup.php');

    if (isset($_GET['torrent_id']) && isset($_SESSION['id'])){
        try {
            $torrent_id = $_GET['torrent_id'];
            $movie_title = $_GET['title'];
            $userid = sanitize($_SESSION['id']);
            $comment_text = substr(trim(sanitize($_POST['comment_text'])), 0, 255);
            echo 'after the try <br>';
            if ($comment_text !== '') {
                $sql = "INSERT INTO user_comments (torrent_id, userid, comment_text) 
                VALUES (:torrent_id ,:userid, :comment_text)";
                $stmt = $db->prepare("$sql");
                echo 'exec <br>';
                $stmt->bindParam(':userid', $userid);
                $stmt->bindParam(':torrent_id', $torrent_id);
                $stmt->bindParam(':comment_text', $comment_text);
                echo 'exec <br>';
                $stmt->execute();
            }
            echo 'before header <br>';
            header("Location: ../video.php?torrent_id=".$torrent_id."&title=".$movie_title);
            exit();
        }
        catch (PDOException $e) {
            echo "failed: " . $e->getMessage() . "<br>";
            exit();
            header("Location: ../video.php?torrent_id=".$torrent_id."&error=");
            exit();
        }
    } 
    else {
        header("Location: /Hypertube");
        exit();
    }

function sanitize($string) {
    $cleanstring = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    return $cleanstring;
}

function desanitize($string) {
    $oldstring = htmlspecialchars_decode($string, ENT_QUOTES, 'UTF-8');
    return $oldstring;
}