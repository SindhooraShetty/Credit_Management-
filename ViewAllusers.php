<?php
session_start();
include 'connection.php';
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
// Perform database query
$query = "SELECT * FROM creditmanagement";
$result_set = mysqli_query($connection, $query);
?>


<!doctype html>
<html>
<head>
   <meta charset="utf-8">
   <title> User list</title>
   <style media="screen">
     .main{
      color:white;
       text-align: center;
       margin-left: auto;
       margin-right: auto;
     }a{
       color: inherit;
     }
     p{
       color:white;
       text-align:left;
     }

     body{
       margin: 0 auto;
      	width: 70%;
      	font: 100% Georgia, "Times New Roman", Times, serif;
       background-color: black;
     }

   </style>

 </head>
  <body>

<p><i>Select user that wants to tranfer credits:</i></p>
<p><i>Given are the list of users :</i></p>
<div class="main">

<table border="1" class="abc">
<tr>
  <td><strong>User Name </strong></td>
  <td><strong>Email</strong></td>
  <td><strong>credits</strong></td>
</tr>

<?php


$allUsers= array();

if (sizeof($result_set)>0) {
  while($row = mysqlI_fetch_array($result_set)){
    $allUsers[]=$row;
    echo "<tr><td><a href='transfer.php?q=$row[u_name]'>" . $row['u_name'] . "</a></td><td> " . $row['u_email'] . "</td><td>"  . $row['credits'] . "</td></tr>";  //$row['index'] the index here is a field name
  }
  // code...
}
$_SESSION["allUsers"] = $allUsers;
?>
</table>

</div>
  </body>

</html>
<?php
//  Release returned data
mysqli_free_result($result_set);

//. Close database connection
mysqli_close($connection);

?>
