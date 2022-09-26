<?php
    session_start();
    require("D:/php/htdocs/Authentication-webapp/includes/db_connection.php");
    include('header.html');

?>

<section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> Add Student</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel" style="margin:200px; margin-top:10px;">
                  	  <h1 class="mb"><center> Add Student</center></h1>
                  	  			<!--	<h4>  -->

                      <form class="form-horizontal style-form" method="post">
                          <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Name</label>
                            <div class="col-sm-10" style="margin-bottom: 10px;">
                                  <input type="text" name="name" required="required" class="form-control">
                            </div>


                             <label class="col-sm-2 col-sm-2 control-label">Email</label>
                             <div class="col-sm-10" style="margin-bottom: 10px;">
                                  <input type="email" name="email" required="required" class="form-control">
                              </div>

                              <label class="col-sm-2 col-sm-2 control-label">Password</label>
                              <div class="col-sm-10" style="margin-bottom: 10px;">
                                  <input type="password" name="password" required="required" class="form-control">
                              </div>

                             <label class="col-sm-2 col-sm-2 control-label">Mobile No</label>
                             <div class="col-sm-10" style="margin-bottom: 10px;">
                                  <input type="text" name="mob" pattern="[2-9]{1}[0-9]{9}" required="required" class="form-control">
                              </div>

                              <label class="col-sm-2 col-sm-2 control-label">Address</label>
                              <div class="col-sm-10" style="margin-bottom: 10px;">
                                  <input type="text" name="address" required="required" class="form-control">
                              </div>

                              <label class="col-sm-2 col-sm-2 control-label">Bio</label>
                              <div class="col-sm-10" style="margin-bottom: 10px;">
                                  <input type="text" name="bio" required="required" class="form-control">
                              </div>

                            <button type="submit" name="submit" style="margin-bottom:10px; width: 96%; margin-left:15px;" class="btn btn-success btn-lg btn-block">Add</button></td>
            </div>
                </div><!-- /form-panel -->
              </div><!-- /col-lg-12 -->
            </div>

    </section>
      </section>
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

    </body>
</html>

<?php
if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($connection,$_POST['name']);
    $email = mysqli_real_escape_string($connection,$_POST['email']);
    $password = mysqli_real_escape_string($connection,$_POST['password']);
    $mobile = mysqli_real_escape_string($connection,$_POST['mob']);
    $address = mysqli_real_escape_string($connection,$_POST['address']);
    $bio = mysqli_real_escape_string($connection,$_POST['bio']);

    $q1="INSERT INTO user (name,email,phone,address,bio,password) VALUES ('$name','$email','$mobile','$address','$bio','$password')";
    if (!mysqli_query($connection,$q1)) {
        echo "<script>alert('Data Not Added') </script>";
    } else {
        $q2="INSERT INTO login (username,password,utype) VALUES ('$name','$password','student')";
        if (mysqli_query($connection,$q2)) {
            echo "<script>alert('User added successfully') </script>";
        }

    }

}
?>
