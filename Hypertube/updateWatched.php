<?php

session_start();
include 'setup.php';
try {
	if (isset($_SESSION['logged_in'])) {
		if ($_SESSION['logged_in'] == 1) {
			$watchedMovie = true;
			$conn = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "USE ".$dbname;
			$stmt = $conn->prepare("SELECT * FROM been_viewed WHERE torrent_id=:movie_ID AND user_id=:user_ID");
			$stmt->bindParam(':movie_ID', $_POST['movieID']);
			$stmt->bindParam(':user_ID', $_SESSION['id']);
			$stmt->execute();
			$viewed = $stmt->fetch();
			if (!$viewed) {			
				$sql = "INSERT INTO been_viewed (torrent_id, user_id, watched)
						VALUES (:movie_ID, :user_ID, :watch)";
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(':movie_ID', $_POST['movieID']);
				$stmt->bindParam(':user_ID', $_SESSION['id']);
				$stmt->bindParam(':watch', $watchedMovie, PDO::PARAM_BOOL);
				$valid = $stmt->execute();
				if (!$valid)
					echo "0";
				else
					echo "1";
			}
			else {
				$stmt = $conn->prepare("UPDATE been_viewed SET date_added = now() WHERE torrent_id=:movie_ID AND user_id=:user_ID");
				$stmt->bindParam(':movie_ID', $_POST['movieID']);
				$stmt->bindParam(':user_ID', $_SESSION['id']);
				$valid = $stmt->execute();
				if (!$valid)
					echo "0";
				else
					echo "1";
			}			
		}
	}
}
catch(PDOException $e) {
	echo $stmt . "<br>" . $e->getMessage();
}
$conn = null;	

?>