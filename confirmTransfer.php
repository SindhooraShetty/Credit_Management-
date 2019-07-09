<?php
session_start();
include 'connection.php';
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if ($_POST['amount'] > $_SESSION['currentBalance']){
  echo "Insufficient Funds please try next time";
}else{
  $query1= 'UPDATE creditmanagement set credits = credits + '.$_POST['amount'].' where u_name="'.$_POST['to_user'].'"';
  $query2= 'UPDATE creditmanagement set credits = credits - '.$_POST['amount'].' where u_name="'.$_SESSION['currentUser'].'"';
  mysqli_query($connection, $query1);
  mysqli_query($connection, $query2);
 echo "Tranfer success";
}

 ?>
 <!doctype html>
 <html>
 <head>
   <meta charset="utf-8">
   <title> HOME PAGE
   </title>
 </head>
 <body>
   <p> <b>Go back to <a href="Home.php"> Home </a></b></p>
 </body>
 </html>
