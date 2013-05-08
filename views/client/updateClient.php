<?php

echo $cid = $_POST["cid"];
echo $fname = $_POST["fname"];
echo $lname = $_POST["lname"];
echo $addr1 = $_POST["addr1"];
echo $addr2 = $_POST["addr2"];
echo $town = $_POST["town"];
echo $pcode = $_POST["pcode"];
echo $email = $_POST["email"];
echo $phone = $_POST["phone"];
echo $dob = $_POST["dob"];
echo $height = $_POST["height"];
echo $photo = $_POST["photo"];

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
  }

mysqli_query($con,"UPDATE client SET client_fname = '$fname', client_lname = '$lname', client_addr1 = '$addr1', 
            client_addr2 = '$addr2', client_town = '$town', client_pcode = '$pcode', client_email = '$email', client_phone = '$phone', client_dob = '$dob', client_height = $height, 
             client_photo = '$photo' WHERE client_id = '$cid'");

mysqli_close($con);

// This results in an error.
// The output above is before the header() call
header('Location: clientView.php?myfield='.$cid.'&dumvalue=1');

}

else {

header('Location: editClient.php?myfield='.$cid.'');

}



?>