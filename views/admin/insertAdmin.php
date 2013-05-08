<?php

$trainerID = $_POST["tid"];
$clientID = $_POST["cid"];

if ($trainerID != NULL && $clientID != NULL) {


$DB_NAME = 'cloudapps';
$DB_HOST = 'cloudapps.cbkmdimoancr.us-west-2.rds.amazonaws.com';
$DB_USER = 'user';
$DB_PASS = 'password13';

$con= mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  header('Location: trainerAll.php?dumvalue=2');
  }

mysqli_query($con,"INSERT INTO trainer_client (trainer_id, client_id, trainer_comments, client_comments)
VALUES ($trainerID, $clientID, NULL, NULL)");

mysqli_close($con);

  // This results in an error.
  // The output above is before the header() call
  header('Location: trainerAll.php?dumvalue=1');

}

else {

  header('Location: trainerAll.php?dumvalue=2');

}



?>