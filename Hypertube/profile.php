<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once("setup.php");
$db->query("USE ".$dbname);
$db->exec("USE hypertube");
$query = $db->prepare("SELECT * FROM users WHERE id = :id");
$query->bindParam(":id", $_SESSION['id']);
$query->execute();
$data = $query->fetch(PDO::FETCH_ASSOC);
$username = $data['username'];
$oauth = $data['oauth'];
$pp = $data['picture'];
?>
<!DOCTYPE html>
<html>
	<title>Hypertube</title>
	<head>
		<link rel="icon" type="image/png" sizes="192x192"  href="/Hypertube/images/clap.png">
		
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/Hypertube/images/clap.png">
		<meta name="theme-color" content="#ffffff">

		<script type="text/javascript" src="js/sort.js"></script>
		<script type="text/javascript" src="js/filter.js"></script>
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
			href="https://stackpath.bootstrapcdn.com/bootswatch/4.2.1/cyborg/bootstrap.min.css" 
			rel="stylesheet" 
			integrity="sha384-e4EhcNyUDF/kj6ZoPkLnURgmd8KW1B4z9GHYKb7eTG3w3uN8di6EBsN2wrEYr8Gc" 
			crossorigin="anonymous">
		<link href="css/style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
	<!-- Google Traduction -->
		<div id="google_translate_element"></div>
	<!-- Fin Google Traduction -->

	<!-- Topbar Navigation -->
		<div class="topnav" id="myTopnav">
			<a class="navbar-brand" href="#"><img src="<?php echo $pp?>" alt="profile picture" style="width:40px;"></a>
			<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><?php echo $username ?></a>
			<div class="dropdown-menu">
        		<a class="dropdown-item" href="./profile.php">My Profile</a>
        		<a class="dropdown-item" href="/Hypertube/logout.php">Logout</a>
    		</div>
			<center>
				<div class="topnav-centered">
					<a href="/Hypertube/home.php"><img src="images/logo_topnav.png" alt="logo" height="50%" width="50%"></a>
				</div>
			</center>
		</div><br>
	<!-- Fin Topbar Navigation -->

		<div id="result" class="card border-info mb-3"></div>
	</body>
</html>
<head>
	<title>Settings</title>
</head>
<body>
<center>
<!-- Change Picture -->	
	<h1 style="color: #3b7cd6;"> Change Profile Picture </h1>
	<form action="modProfileImg.php" method="post" enctype="multipart/form-data">
		Select image to upload:
		<input type="file" name="file" id="file">
		<input type="submit" value="Upload Image" name="submit">
	</form>
<!-- Fin Change Picture -->	

<!-- Change Username -->	
	<form action="modUsername.php" method="post">
	<h1 style="color: #3b7cd6;"> Change Username</h1>
  <label for="email" class="minor"><b>New Username</b></label>
  <input type="text" placeholder="Enter Username" name="newuser" required>
	<br /><br />
  <label for="email" class="minor"><b>Repeat Username</b></label>
  <input type="text" placeholder="Enter Username" name="newuser2" required>
	<br /><br />
  <button type="submit">change username</button>
 </div>
</form>
<!-- Fin Change Username -->	

<?php if ($oauth == 0): ?>

<!-- Change Password -->	
<form action="modPassword.php" method="post">
<div>
  <h1 style="color: #3b7cd6;">Change Password</h1>
  <label for="psw" class="minor" ><b>Old Password</b></label>
  <input type="password" placeholder="Enter Password" name="oldpasswd" required>
	<br /><br />
  <label for="psw" class="minor" ><b>New Password</b></label>
  <input type="password" placeholder="Enter Password" name="passwd" required>
	<br /><br />
	<label for="psw" class="minor" ><b>Repeat Password</b></label>
  <input type="password" placeholder="Enter Password" name="passwd2" required>
	<br /><br />
  <button type="submit">reset password</button>
 </div>
</form>
<!-- Fin Change Password -->	

<!-- Change Email -->	
<form action="modEmail.php" method="post">
	<div>
		<h1 style="color: #3b7cd6;">Change Email</h1>
				<label for="email" class="minor"><b>Old Email</b></label>
				<input type="text" placeholder="Enter Email" name="oldemail" required>
			<br /><br />
			<label for="email" class="minor"><b>New Email</b></label>
				<input type="text" placeholder="Enter Email" name="email1" required>
			<br /><br />
			<label for="email" class="minor"><b>Email</b></label>
				<input type="text" placeholder="Enter Email" name="email2" required>
			<br /><br />
			<button type="submit">change email</button>
	</div>
 </form>
<!-- Fin Change Email -->
</center>
</br>
<?php endif; ?>
	<script type="text/javascript">

			$("form").submit(function(event) {
				event.preventDefault();
				$.ajax( {
					url: $(this).attr("action"),
					type: $(this).attr("method"),
					data: new FormData(this),
					processData: false,
					contentType: false,
				});  
			});
	</script>
	<script type="text/javascript">
	function googleTranslateElementInit() {
  		new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
	}
	</script>

	<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>