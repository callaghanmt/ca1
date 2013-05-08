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
  <link rel="stylesheet" href="../../ajaxCRUD/css/default.css" type="text/css" >
  <link rel="stylesheet" href="../../css/jq.css" type="text/css" media="print, projection, screen" />
  <link rel="stylesheet" href="../../themes/blue/style.css" type="text/css" media="print, projection, screen" /> 
  <link rel="stylesheet" href="../../css/par.css" type="text/css" >

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

<?php include("../../navlinks.html"); ?>


  <div class="container">
    <div class="hero-unit">
      
<?php $tag = strip_tags((trim($_GET['myfield']))); ?>   
 <?php $errorMessage = strip_tags((trim($_GET['dumvalue']))); ?>   
    
<h3>Edit Client</h3>

<form>
Client List<select name='myfield' onchange='this.form.submit()'>
<option value= "<?php echo $tag;?>"> Select Client </option> 
<?php

$conn = mysql_connect("cloudapps.cbkmdimoancr.us-west-2.rds.amazonaws.com", "user", "password13") or die (mysql_error());
      mysql_select_db ("cloudapps");
$sql22="SELECT * FROM client";
      $result22 = mysql_query($sql22) or die('error table');    
      while ($row22 = mysql_fetch_array($result22)) {
    
        echo'Client list<option value="'.$row22['client_id'].'"> '.$row22['client_fname'].' &nbsp; '.$row22['client_lname'].' </option>';
         
      }
     
?>
        
</select>
<noscript><input type="submit" value="Submit"></noscript>
</form>

<?php

      $sql22="SELECT * FROM client WHERE client_id = $tag";
      $result22 = mysql_query($sql22) or die('');    
      while ($row22 = mysql_fetch_array($result22)) {
        
        $fname = ''.$row22['client_fname'].'';
        $lname = ''.$row22['client_lname'].'';
        $addr1 = ''.$row22['client_addr1'].'';
        $addr2 = ''.$row22['client_addr2'].'';
        $town =  ''.$row22['client_town'].'';
        $pcode = ''.$row22['client_pcode'].'';
        $email = ''.$row22['client_email'].'';
        $phone = ''.$row22['client_phone'].'';
        $dob = ''.$row22['client_dob'].'';
        $height = ''.$row22['client_height'].'';
        $photo = ''.$row22['client_photo'].''; 
        
      }
      
?>       

<form action="updateClient.php" method="post" data-validate="parsley">
  <input type="hidden" name="cid" value="<?php echo $tag;?>"><br>
   First Name <input type="text" name="fname" data-required="true" value="<?php echo $fname;?>"> Last Name <input type="text" name="lname" value="<?php echo $lname;?>" data-required="true"> <br />
   Address Line 1 <input type="text" name="addr1" value="<?php echo $addr1;?>" data-required="true"> Address Line 2<input type="text" name="addr2" value="<?php echo $addr2;?>" data-required="true"> <br />
   Town <input type="text" name="town" value="<?php echo $town;?>" data-required="true"> Postcode <input type="text" name="pcode" value="<?php echo $pcode;?>" data-required="true"> <br />
   Email <input type="text" name="email" value="<?php echo $email;?>" data-trigger="change" data-required="true" data-type="email"> Phone No <input type="number" name="phone" value="<?php echo $phone;?>" data-rangelength="[11,20]" data-required="true"> 
   Date of Birth <input type="text" name="dob" value="<?php echo $dob;?>" data-type="dateIso" data-required="true"><br />
   Height <input type="number" name="height" value="<?php echo $height;?>" data-required="true"> Photo <input type="text" name="photo" value="<?php echo $photo;?>"><br />
  <button type="submit" class="btn">Submit</button>
</form>
<?php 

  mysql_close($conn); 

  if ( $errorMessage == '2') {
	
    echo '<div class="error"> Please contact the administrator. <br /> </div>';

 } 

?>

  </div>      
    </div>  
</body>
</html>