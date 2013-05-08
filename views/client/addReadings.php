<?php
  require_once('../../ajaxCRUD/preheader.php'); // <!-- this include file MUST go first before any HTML/output-->

  #the code for the class
  include_once ('../../ajaxCRUD/ajaxCRUD.class.php'); // <!-- this include file MUST go first before any HTML/output-->

  #create an instance of the class
    $tblClient = new ajaxCRUD("Client", "client", "client_id", "../../ajaxCRUD/");
  $tblReadings = new ajaxCRUD("Readings", "readings", "client_id", "../../ajaxCRUD/");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
  <title>CloudApps</title>
    <link rel="stylesheet" href="../../css/bootstrap.css" type="text/css" >
  <link rel="stylesheet" href="../../css/par.css" type="text/css" >
  <link rel="stylesheet" href="../../ajaxCRUD/css/default.css" type="text/css" >
  <link rel="stylesheet" href="../../css/jq.css" type="text/css" media="print, projection, screen" />
  <link rel="stylesheet" href="../../themes/blue/style.css" type="text/css" media="print, projection, screen" /> 


    <!-- these js/css includes are ONLY to make the calendar widget work (fldDateMet);
       these includes are not necessary for the class to work!! -->
    <link rel="stylesheet" href="../../ajaxCRUD/examples/includes/jquery.ui.all.css">
    <script src="../../ajaxCRUD/examples/includes/jquery.ui.core.js"></script>
    <script src="../../ajaxCRUD/examples/includes/jquery.ui.widget.js"></script>
    <script src="../../ajaxCRUD/examples/includes/jquery.ui.datepicker.js"></script>
    
  <script type="text/javascript" src="../../js/jquery.js"></script>
  <script type="text/javascript" src="../../js/parsley.js"></script>
</head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="../../../../index.php" target="_blank">CloudApps Home</a>
          
        </div>
      </div>
</div>

  <div class="container">
    <div class="hero-unit">
    
  <?php $errorMessage = strip_tags((trim($_GET['dumvalue']))); ?>
  
    
  <h3>Add Readings and Edit Client </h3>

      <form>
client list<select name='myfield' onchange='this.form.submit()'>
<option value= ""> Select Client </option> 
<?php

$conn = mysql_connect("cloudapps.cbkmdimoancr.us-west-2.rds.amazonaws.com", "user", "password13") or die (mysql_error());
      mysql_select_db ("cloudapps");
$sql22="SELECT client_id, client_fname, client_lname FROM client";
      $result22 = mysql_query($sql22) or die('error table');    
      while ($row22 = mysql_fetch_array($result22)) {
    
        echo'Client list<option value="'.$row22['client_id'].'"> '.$row22['client_fname'].' &nbsp; '.$row22['client_lname'].' </option>';
      }
      mysql_close($conn); 
?>


</select>
<noscript><input type="submit" value="Submit"></noscript>
</form>
     
<?php 
   $tag = strip_tags((trim($_GET['myfield']))); 
?>

<h4> Add Readings </h4>     
     
<form action="insertReadings.php" method="post" data-validate="parsley">
  <input type="hidden" name="cid" value="<?php echo $tag;?>"><br>
  
  Weight<input type="number" name="weight" data-required="true"> Left Bicep <input type="number" name="lbicep" data-required="true"> Right Bicep <input type="number" name="rbicep" data-required="true"><br />
  Chest <input type="number" name="chest" data-required="true"> Waist <input type="number" name="waist" data-required="true"> Hips <input type="number" name="hips" data-required="true"><br />
    Left Thigh<input type="number" name="lthigh" data-required="true"> Right Thigh <input type="number" name="rthigh" data-required="true"> New Photo <input type="text" name="newphoto"><br />
  <button type="submit" class="btn">Submit</button>
</form>

<?php 

 if ( $errorMessage == '2') {
	
   echo '<div class="error"> Please contact the administrator. <br /> </div>';

 } 

?>

  </div>      
    </div>  
</body>
</html>