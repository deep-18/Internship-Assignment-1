<?php
  session_start();
  if (isset($_SESSION['username'])) {
      include('header.html');
      include('side-column.html');
      include('D:/php/htdocs/Authentication-webapp/includes/db_connection.php');
      include('D:/php/htdocs/Authentication-webapp/includes/functions.php');

      $username = $_SESSION['username'];
      $query = "SELECT * FROM user WHERE name = '$username'";
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "authentication";
// Create connection
      $connection = new mysqli($servername, $username, $password, $dbname);
      if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
      }
      $result = mysqli_query($connection, $query);

      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              $name = $row['name'];
              $email = $row['email'];
              $phone = $row['phone'];
              $address = $row['address'];
              $bio = $row['bio'];
              $password = $row['password'];
          }
      } else {
          echo "<script>alert('wrong user');</script>";
      }

		if (isset($_POST['submit'])) {

            $username = $_SESSION['username'];
            echo "<script>alert('$username');</script>";
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $bio = $_POST['bio'];
            $password = $_POST['password'];

			$query = "UPDATE user SET email = '$email',phone = '$phone', address = '$address', bio = '$bio', password = '$password' 
            WHERE name = '$username'";
      		$result = mysqli_query($connection,$query);
		
			if ($result){
				echo "<script>alert('Data updated');</script>";
			}else{
				echo "<script>alert('Sorry! couldn't able to update');</script>";
			}
		}
		
?>
<section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i>Edit Profile</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel" style="margin:200px; margin-top:10px;">
                  	  <h1 class="mb"><center>Form Edit</center></h1>
                  	  			<!--	<h4>  -->

                      <form class="form-horizontal style-form" action="edit_profile.php" method="POST">
                          <div class="form-group">

                              <label class="col-sm-2 col-sm-2 control-label">Name</label>
                              <div class="col-sm-10" style="margin-bottom: 10px;">
                                  <input type="text" class="form-control" value="<?php echo $name; ?>" name="name" required>
                              </div>

                              <label class="col-sm-2 col-sm-2 control-label">Email Id</label>
                              <div class="col-sm-10" style="margin-bottom: 10px;">
                                  <input type="text" class="form-control" value="<?php echo $email; ?>" name="email">
                              </div>

                              <label class="col-sm-2 col-sm-2 control-label">Mobile No</label>
                              <div class="col-sm-10" style="margin-bottom: 10px;">
                                  <input type="text" class="form-control" value="<?php echo $phone; ?>" name="phone" required pattern="[2-9]{1}[0-9]{9}" title="First character should 2,5,8 or 9 and length is 10 digit">
                              </div>

                              <label class="col-sm-2 col-sm-2 control-label">Address</label>
                              <div class="col-sm-10" style="margin-bottom: 10px;">
                                  <input type="text" class="form-control" value="<?php echo $address; ?>" name="address" required>
                              </div>

                              <label class="col-sm-2 col-sm-2 control-label">Bio</label>
                              <div class="col-sm-10" style="margin-bottom: 10px;">
                                  <input type="text" class="form-control" value="<?php echo $bio; ?>" name="bio" required>
                              </div>

                              <label class="col-sm-2 col-sm-2 control-label">Password</label>
                              <div class="col-sm-10" style="margin-bottom: 10px;">
                                  <input type="text" class="form-control" value="<?php echo $password; ?>" name="password" required>
                              </div>

                              	<input type="submit"style="margin-bottom:10px; width: 96%; margin-left:15px;" class="btn btn-success btn-lg btn-block" name="submit">
		                   	
                            	
                      
                              <!-- /form-panel -->
          		</div><!-- /col-lg-12 -->
                      </form>
                    </div>
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
<script>
 
        $(function(){
              $('select.styled').customSelect();
          });
      </script>
              
    </section>
    <?php }else{
  header('Location: index.php');
}?>