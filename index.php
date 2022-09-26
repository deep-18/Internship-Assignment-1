<?php
	session_start();
	require("D:/php/htdocs/Authentication-webapp/includes/db_connection.php");
?>
<?php
	
	if(isset($_POST['submit'])){

		$username = mysqli_real_escape_string($connection,$_POST['username']);
		$password = mysqli_real_escape_string($connection,$_POST['password']);
		
		$query = "SELECT utype FROM login where username='$username' && password='$password'";
		$utype = mysqli_query($connection,$query);

		if (mysqli_num_rows($utype) == 0){
			echo "<script>alert('Incorrect Username/Password');</script>";
		}else{
			$_SESSION['username'] = $username;
		}

		while ($row = $utype->fetch_assoc()) {
			if($row['utype'] == "student"){
				if (isset($_SESSION['username'])) {
    				header("Location: edit_profile.php");
    			}
			} else {
				echo "<script>alert('👎Incorrect Username/Password👎');</script>";
			}
		}
	}
?>
<?php
require_once 'vendor/autoload.php';
$redirectURL = 'http://localhost/authentication-webapp/index.php';

$client = new Google_Client();
$client->setClientId($clientId);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectURL);
$client->addScope('profile');
$client->addScope('email');

if(isset($_GET['code'])){
    $token=$client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);
    $gauth = new Google_Service_Oauth2($client);
    $google_info = $gauth->userinfo->get();
    $email =$google_info->email;
    $name =$google_info->name;
    echo "<script>alert('$name');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta Http-Equiv="Expires" Content="0">
    <link rel="icon" type="image/gif/png" href="assets/img/BVM-1.png">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <title>Login Page</title>
  </head>
  <body>
	  <div id="login-page" style="margin-left: 200px;">
	  	<div class="container">
	  	      <form class="form-login" action="index.php" method="post">
		        <h2 class="form-login-heading" style="background: deeppink">Sign in now</h2>
		        <div class="login-wrap">
		            <input type="text" class="form-control" name="username" placeholder="User ID"  autocomplete="off" autofocus>
		            <br>
		            <input type="password" class="form-control" name="password" autocomplete="off" placeholder="Password">
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="index.php#myModal"> Forgot Password?</a>
		                </span>
		            </label>
		            <input type="submit" name="submit" value="SIGN IN" class="btn btn-theme btn-block">

		        </form>
            <div style="text-align: center; font-size: large; padding-top: 5px">
            <?php
                    echo "<a href='".$client->createAuthUrl()."'>Login with Google</a>";
            ?>
            </div>
            <div style="text-align: center; font-size: large; padding-top: 5px">
            <?php
                $link = "addUser.php";
            echo "<a href='".$link."'>Register Here</a>";
            ?>
            </div>
        </div>
		
		          <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Forgot Password ?</h4>
		                      </div>
		                      <form class="form-login" action="sendmailfunction.php" method="post">
		                      <div class="modal-body">
		                          <p>Enter your e-mail address below to reset your password.</p>
		                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
		
		                      </div>
		                      <div class="modal-footer">
		                          <input type="reset" value="CLEAR" class="btn btn-theme">
		                          <input type="submit" name="email_submit" value="SUBMIT" class="btn btn-theme">
		                      </div>
		                  </form>
		                  </div>
		              </div>
		          </div>
	

		      </form>	  	
	  	
	  	</div>
	  </div>

    
    
    <script src="assets/js/jquery.js"></script>
	<script src="assets/js/jquery-1.8.3.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
	<script src="assets/js/jquery.scrollTo.min.js"></script>
	<script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
	<script src="assets/js/jquery.sparkline.js"></script>


	
	<script src="assets/js/common-scripts.js"></script>

	<script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
	<script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/back-image.jpg", {speed: 500});
    </script>


  </body>
</html>
