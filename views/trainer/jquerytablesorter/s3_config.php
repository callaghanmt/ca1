<?php
// Bucket Name
$bucket="cloudapps-files";

if (!class_exists('S3'))require_once('S3.php');

//AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJ25XZEZNELSWR4MQ');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');

//set up S3 for data transfer
$s3 = new S3(awsAccessKey, awsSecretKey);
$s3->putBucket($bucket, S3::ACL_PUBLIC_READ);
  
//AWS RDS details
$DB_NAME = 'cloudapps';
$DB_HOST = 'cloudapps.cbkmdimoancr.us-west-2.rds.amazonaws.com';
$DB_USER = 'user';
$DB_PASS = 'password13';
  
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
  
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }

  
  

  

  
  
?>