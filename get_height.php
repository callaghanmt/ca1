<?php
 //DB connection
  
$DB_NAME = 'cloudapps';
$DB_HOST = 'cloudapps.cbkmdimoancr.us-west-2.rds.amazonaws.com';
$DB_USER = 'user';
$DB_PASS = 'password13';

  
$db= new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
  
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}
    
 //Get height for selected client
$sql= "SELECT client_height FROM client WHERE client_id = 7";

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
    }
  
echo 'Total results: ' . $result->num_rows;
  
$row = mysqli_fetch_assoc($result);

$cl_ht = $row['client_height'];

mysqli_free_result($result);  
mysqli_close($link);
  
  
  
  
  
  ?>