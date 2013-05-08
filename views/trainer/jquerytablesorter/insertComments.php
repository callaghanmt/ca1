<?php

echo $cid = $_POST["cid"];
echo $tid = $_POST["tid"];
$trainerComments = trim($_POST["tcomments"]);
echo $trainerComments;

if ($cid != NULL) {

$DB_NAME = 'cloudapps';
$DB_HOST = 'cloudapps.cbkmdimoancr.us-west-2.rds.amazonaws.com';
$DB_USER = 'user';
$DB_PASS = 'password13';


$con= mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
   header('Location: index.php?trainer='.$tid.'&myfield='.$cid.'&dumvalue=2');
  }

  $sql= "UPDATE trainer_client SET trainer_comments = '$trainerComments' WHERE trainer_id = $tid AND client_id = $cid";
  
  mysqli_query($con, $sql);

  mysqli_close($con);

// This results in an error.
// The output above is before the header() call
header('Location: index.php?trainer='.$tid.'&myfield='.$cid.'&dumvalue=1');

}

else {

header('Location: index.php?trainer='.$tid.'&myfield='.$cid.'&dumvalue=2');

}



?>