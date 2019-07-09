<?php
session_start();
include 'connection.php';

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$variable = $_GET['q'];
$_SESSION['currentUser']=$variable;
$query1= "SELECT credits from creditmanagement where u_name='".$variable."'";
$result_set = mysqli_query($connection, $query1);
if(sizeof($result_set)>0){
while ($row = mysqli_fetch_array($result_set)) {
    $currentBalance=$row[0];
}
}
$_SESSION['currentBalance']=$currentBalance;

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
      .form{
        text-align: center;
        margin-top: 200px;
        vertical-align: center;

      }
      body {
       margin: 0 auto;
       width: 40%;
       font: 50% Georgia, "Times New Roman", Times, serif;
       background-color: black;

      }
      p{
        color:white;
        text-align:ce;ntre;
        font-size: 2.0em;
      }
      a {
     color: inherit;
   }

    </style>
  </head>
  <body>


<form class="form" action="confirmTransfer.php" method="POST">
  <?php
echo '<p>Current balance for '.$variable.' is <strong>'.$currentBalance.'</strong></p>';
?>

  <p>Select user to transfer to from the drop down below</p>
<select name="to_user">
  <?php
  foreach($_SESSION['allUsers'] as $item){
        ?>
        <option value="<?php if( $item[0]!=$variable){echo strtolower($item[0]); ?>"><?php echo $item[0]; }?></option>
        <?php
        }
        ?>
      </select>
  <input type="number" max="<?php $currentBalance ?>" name="amount">
  <button type="submit" name="button">Confirm Transfer</button>
</form>

  </body>
</html>

<?php

mysqli_free_result($result_set);

mysqli_close($connection);



?>
