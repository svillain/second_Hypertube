<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "config.php";
$redirecturl = "http://localhost:8080/Hypertube/fb-callback.php";
$permissions = ['email'];
$loginurl = $helper->getLoginUrl($redirecturl, $permissions);
$gloginurl = $client->createAuthUrl();
$loginurl42 = "https://api.intra.42.fr/oauth/authorize?client_id=61d50a325b359a90c18726e2bf5c95c8c914ce04f80cd5a0b26c7a0af166d397&redirect_uri=http%3A%2F%2Flocalhost%3A8080%2FHypertube%2F42-callback.php&response_type=code";

if (isset($_GET['email'])) {
  echo "<script type='text/javascript'>alert('Please check your email to verify your account');</script>";
}

if (isset($_GET['err'])) {
  echo "<script type='text/javascript'>alert('Username and password do not match or Account is not yet verified.');</script>";
}
?>
<!DOCTYPE html>
<html>
  <title>Hypertube</title>
  <head>
    <link rel="apple-touch-icon" sizes="57x57" href="/Hypertube/images/clap.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/Hypertube/images/clap.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/Hypertube/images/clap.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/Hypertube/images/clap.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/Hypertube/images/clap.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/Hypertube/images/clap.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/Hypertube/images/clap.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/Hypertube/images/clap.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/Hypertube/images/clap.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/Hypertube/images/clap.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/Hypertube/images/clap.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/Hypertube/images/clap.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/Hypertube/images/clap.png">
    <link rel="manifest" href="/manifest.json">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/Hypertube/images/clap.png">
    <meta name="theme-color" content="#ffffff">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
  <!-- Google Traduction -->
    <div id="google_translate_element"></div>
  <!-- Fin Google Traduction -->

  <!-- Menu : Sign in or Sign up -->
    <button class="tablink" onclick="openPage('Sign-in', this, 'transparent')" id="defaultOpen">Sign-in</button>
    <button class="tablink" onclick="openPage('Sign-up', this, 'transparent')">Sign-up</button>
  <!-- Fin Menu : Sign in or Sign up -->

  <!-- Container Sign in -->
    <div id="Sign-in" class="tabcontent">
      <div class="container_signin">
        <form action="login.php" method="POST">
        <div class="row">
          <h2 style="margin-left: 60%">Sign-in with Social Media or Manually</h2>
	        <div class="vl">
		        <span class="vl-innertext">or</span>
	        </div>

          <!-- Sign in with social media -->
	          <div class="col">
		          <a href="<?php echo $loginurl ?>" class="fb btn">
		            <i class="fa fa-facebook fa-fw"></i> Sign-in with Facebook
		          </a>
		          <a href="<?php echo $loginurl42 ?>" class="twitter btn">
		            <i class="fa fa-twitter fa-fw"></i> Sign-in with 42
		          </a>
		          <a href="<?php echo $gloginurl ?>" class="google btn"><i class="fa fa-google fa-fw">
		            </i> Sign-in with Google
		          </a>
	          </div>
          <!-- Fin Sign in with social media -->

          <!-- Sign in manually -->
            <div class="col">
              <div class="hide-md-lg">
                <p>Or Sign-in manually:</p>
              </div>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Sign-in">
            </div>
          <!-- Fin Sign in manually -->

        </div>
      </form>
    </div>

    <!-- Forgot Password -->
    <div class="bottom-container">
      <div class="row">
        <div class="col"></div>
          <div class="col">
            <a href="#" style="color:white" class="btn">Forgot password?</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin Forgot Password -->
  <!-- Fin Container Sign in -->

  <!-- Container Sign up -->
  <div id="Sign-up" class="tabcontent">
    <div class="container_signup">
      <form action="register.php" method="POST">
        <div class="row">
          <h2 style="margin-left: 60%">Sign-up with Social Media or Manually</h2>
          <div class="vl_signup">
            <span class="vl-innertext">or</span>
          </div>

          <!-- Sign up with social media -->
          <div class="col_signup">
            <a href="<?php echo $loginurl ?>" class="fb btn">
              <i class="fa fa-facebook fa-fw"></i> Sign-up with Facebook
            </a>
            <a href="<?php echo $loginurl42 ?>" class="twitter btn">
              <i class="fa fa-twitter fa-fw"></i> Sign-up with 42
            </a>
            <a href="<?php echo $gloginurl ?>" class="google btn"><i class="fa fa-google fa-fw">
              </i> Sign-up with Google
            </a>
          </div>
          <!-- Fin Sign up with social media -->

          <!-- Sign up manually -->
          <div class="col">
            <div class="hide-md-lg">
              <p>Or Sign-up manually:</p>
            </div>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="first_name" placeholder="First Name" required>
            <input type="text" name="last_name" placeholder="Last Name" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="password2" placeholder="Repeat Password" required>
            <input type="submit" value="Sign-up">
          </div>
          <!-- Fin Sign up manually -->

        </div>
      </form>
    </div>
  </div>
  <!-- Fin Container Sign up -->
<script>
  function openPage(pageName,elmnt,color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = color;
  }
  // Get the element with id="defaultOpen" and click on it
  document.getElementById("defaultOpen").click();
</script>

  <!-- Copyright -->
  <center>
    <div style="height: 1%, background-color: transparent;">Made with ♡ by svillain © 2019 Copyright</div>  
  </center> 
  <!-- Copyright -->
 
</body>
</html>
<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
  }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<?php
require_once("setup.php");

//* Verify mail *\\
if (isset($_GET['code'])) {
  $query = "SELECT id FROM users WHERE token = :tok and verified = :zero";
  $stmt = $db->prepare( $query );
  $zero = '0';
  $code = trim($_GET['code']);
  $stmt->bindParam(':zero', $zero);
  $stmt->bindParam(':tok', $code);
  $stmt->execute();
  $num = $stmt->rowCount();
  if ($num > 0) {
    $query = "UPDATE users set verified = '1' where token = :verification_code";
    $line = $db->prepare($query);
    $line->bindParam(':verification_code', $code);
    if ($line->execute())
      echo "<script type='text/javascript'>alert('Account successfully verified.');</script>";
    else {
			echo "Failed to verify email";
			exit;
		}
  }
  else {
    echo "<script type='text/javascript'>alert('Account successfully verified.');</script>";
		exit;
	}
}
?>    