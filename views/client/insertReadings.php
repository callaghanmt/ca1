<?php

echo $cid = $_POST["cid"];
echo $weight = $_POST["weight"];
echo $lbicep = $_POST["lbicep"];
echo $rbicep = $_POST["rbicep"];
echo $chest = $_POST["chest"];
echo $waist = $_POST["waist"];
echo $hips = $_POST["hips"];
echo $lthigh = $_POST["lthigh"];
echo $rthigh = $_POST["rthigh"];
trim($newphoto = $_POST["newphoto"]);

// Evaluates as true because $var is set
if (isset($newphoto)) {
    $newphoto = 'empty';
}

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
  header('Location: addReadings.php?myfield='.$cid.'&dumvalue=2');
  }

mysqli_query($con,"INSERT INTO readings (client_id, date, weight, l_bicep, r_bicep, chest, waist, hips, l_thigh, r_thigh, new_photo)
VALUES ($cid, CURDATE(), $weight, $lbicep, $rbicep, $chest, $waist, $hips, $lthigh, $rthigh, '$newphoto')");

mysqli_close($con);

// This results in an error.
// The output above is before the header() call
header('Location: clientView.php?myfield='.$cid.'&dumvalue=1');

}

else {

header('Location: addReadings.php?myfield='.$cid.'&dumvalue=2');

}



?>