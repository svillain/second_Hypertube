<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once("setup.php");
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['id'])) {
  header ('Location: ./');
}

$torrent_id = $_GET['torrent_id'];
$movie_title = $_GET['title'];

$db->exec("USE hypertube");
$query = $db->prepare("SELECT * FROM users WHERE id = :id");
$query->bindParam(":id", $_SESSION['id']);
$query->execute();
$data = $query->fetch(PDO::FETCH_ASSOC);
$username = $data['username'];

?>
<!DOCTYPE html>
<html lang="en">
	<title>Hypertube</title>
	<head>
		<link rel="icon" type="image/png" sizes="192x192" href="/Hypertube/clap.png">
		
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/Hypertube/clap.png">
		<meta name="theme-color" content="#ffffff">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/video.css">

 		<script 
			src="https://unpkg.com/popper.js">
  		</script>
		<script
			src="https://code.jquery.com/jquery-3.3.1.js"
			integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
			crossorigin="anonymous">
  		</script>
  		<script 
			src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
			integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" 
			crossorigin="anonymous">
  		</script>

  		<link 
			rel="stylesheet" 
			href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
			integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
			crossorigin="anonymous">
  		<link 
			rel="stylesheet" 
			href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" 
			integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" 
			crossorigin="anonymous">
  		<link 
			href="https://stackpath.bootstrapcdn.com/bootswatch/4.2.1/cyborg/bootstrap.min.css" 
			rel="stylesheet" 
			integrity="sha384-e4EhcNyUDF/kj6ZoPkLnURgmd8KW1B4z9GHYKb7eTG3w3uN8di6EBsN2wrEYr8Gc" 
			crossorigin="anonymous">
	</head>
	<body>
		<div class="container-fluid">
	  		<div class="row">
				<div class="column">
					<p style="color: white; align: center;">
					<div>
						<form action="user/commentinfo.php?torrent_id=<?php echo $torrent_id.'&title='.$movie_title; ?>" method=POST id="commentform" accept-charset="UTF-8">
						<center>
							<textarea rows="4" style="background-color: #333; color: white; width: 97.5vw; box-sizing: border-box; margin-left: auto; margin-right: auto;" name="comment_text" form="commentform" required placeholder="Hey, say something :D (max chars:255)"></textarea>
							<button class="btn" style="width: 97.5vw; box-sizing: border-box;" type="submit" name="submit" required>comment</button>
						</center>
						</form>
					</div>
					</p>
				</div>
	  		</div>  
	  	</br> 
			<p style="color: white; align: center">
			  <?php
			  
				$stmt = $db->prepare("SELECT * FROM user_comments WHERE torrent_id = '$torrent_id' ORDER BY id DESC");
				$stmt->execute();

				echo '
				
				<p style="color: white";>
				  <center><b>COMMENTS</b></center>
				</p>
				
				<div>';
				
				while ($com = $stmt->fetch()) {
				  $userid = $com['userid'];
				  $stmt2 = $db->prepare("SELECT * FROM users WHERE id = $userid ORDER BY id DESC");
				  $stmt2->execute();

				  $user = $stmt2->fetch();
				  echo '
				  <div class="dialogbox">
					<div class="body">
					  <span class="tip tip-left"></span>
					  <div class="message">
						<span>
						  <img src="'.$user['picture'].'" width=50px height=50px> '.$user['username'].': '.$com['comment_text'] . '<br />
						</span>
					  </div>
					</div>
				  </div>
					';
				}
				echo '</div>';
			  ?>
			</p>

		
	</div>
</div>
<script>

function showUser(str) {
	if (str == "") {
		document.getElementById("txtHint").innerHTML = "";
		return;
	} else {
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("newcomment").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","user/realtimecomment.php?com="+str,true);
		xmlhttp.send();
	}
}
</script>

	<script>
		function myFunction() {
		  var x = document.getElementById("myTopnav");
		  if (x.className === "topnav") {
			x.className += " responsive";
		  } else {
			x.className = "topnav";
		  }
		}
	</script>

	<script>
		function openNav() {
		  document.getElementById("mySidenav").style.width = "250px";
		}
		
		function closeNav() {
		  document.getElementById("mySidenav").style.width = "0";
		}
	</script>
	<script type="text/javascript">
		function googleTranslateElementInit() {
  			new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
		}
	</script>

	<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</body>
</html>