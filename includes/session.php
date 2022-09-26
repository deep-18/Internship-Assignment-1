<?php
   include('/D:/php/htdocs/Authentication-webapp/includes/db_connection.php');
   session_start();
   
   $user_check = $_SESSION['username'];
   
   $query = mysqli_query($connection,"SELECT username FROM login WHERE username = '$user_check' ");
   $row = mysqli_fetch_array($query,MYSQLI_ASSOC);
   $login_session = $row['username'];
   
   if(!isset($_SESSION['username'])){
      header("location: index.php");
   }
?>