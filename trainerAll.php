<?php
	require_once('../../ajaxCRUD/preheader.php'); // <!-- this include file MUST go first before any HTML/output-->

	#the code for the class
	include_once ('../../ajaxCRUD/ajaxCRUD.class.php'); // <!-- this include file MUST go first before any HTML/output-->

	#create an instance of the class
  
	$tblTrainer = new ajaxCRUD("Trainer", "trainer", "trainer_id", "../../ajaxCRUD/");
	
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


		<!-- these js/css includes are ONLY to make the calendar widget work (fldDateMet);
			 these includes are not necessary for the class to work!! -->
		<link rel="stylesheet" href="../../ajaxCRUD/examples/includes/jquery.ui.all.css">
		<script src="../../ajaxCRUD/examples/includes/jquery.ui.core.js"></script>
		<script src="../../ajaxCRUD/examples/includes/jquery.ui.widget.js"></script>
		<script src="../../ajaxCRUD/examples/includes/jquery.ui.datepicker.js"></script>
		
</head>
<body>

<?php include("../../navlinks.html"); ?>

<?php $tag = strip_tags((trim($_GET['dumvalue'])));


	?>

	<div class="container">
		<div class="hero-unit">
 <h2> Admin View </h2>
 
<h4> Trainer Details </h4>

<?php
	$tblTrainer->showOnly("trainer_id, trainer_name, trainer_phone, trainer_email");
	
	#how you want the fields to visually display in the table header
    $tblTrainer->displayAs("trainer_id", "Trainer ID");
	$tblTrainer->displayAs("trainer_name", "Trainer Name");
	$tblTrainer->displayAs("trainer_phone", "Phone No");
	$tblTrainer->displayAs("trainer_email", "Email");

	

	#set the number of rows to display (per page)
	  $tblTrainer->setLimit(5);
  

    #set a filter box at the top of the table
      $tblTrainer->addAjaxFilterBox('trainer_name', 20);
 
	
	#show CSV export button
	//$tblClient->showCSVExportOption();

	#use if you want to move the add form to the top of the page
	//$tblClient->disallowAdd();

	#order the table by any field you want
	//$tblClient->addOrderBy("ORDER BY client_lname");


;
	$tblTrainer->showTable();
	
?>


<h4> Allocate Trainer to Client </h4>		

	<form action="insertAdmin.php" method="post">
<select name='cid'>
<option value= ""> Select Client </option> 
<?php
$conn = mysql_connect("cloudapps.cbkmdimoancr.us-west-2.rds.amazonaws.com", "user", "password13") or die (mysql_error());
			mysql_select_db ("cloudapps");
$sql22="SELECT client_id, client_fname, client_lname FROM client
			WHERE client_id not in (SELECT c.client_id
										FROM trainer t, client c, trainer_client tc
											WHERE c.client_id = tc.client_id
												AND t.trainer_id = tc.trainer_id)";
			$result22 = mysql_query($sql22) or die('error table');		
			while ($row22 = mysql_fetch_array($result22)) {
		
				echo'Client list<option value="'.$row22['client_id'].'"> '.$row22['client_fname'].' &nbsp; '.$row22['client_lname'].' </option>';
			}
			
?>
</select>

<select name='tid'>
<option value= ""> Select Trainer </option> 
<?php
$conn = mysql_connect("cloudapps.cbkmdimoancr.us-west-2.rds.amazonaws.com", "user", "password13") or die (mysql_error());
			mysql_select_db ("cloudapps");
$sql22="SELECT trainer_id, trainer_name FROM trainer";
			$result22 = mysql_query($sql22) or die('error table');		
			while ($row22 = mysql_fetch_array($result22)) {
		
				echo'Client list<option value="'.$row22['trainer_id'].'"> '.$row22['trainer_name'].' </option>';
			}
			mysql_close($conn); 
?>
</select>
<button type="submit" class="btn">Submit</button>
</form>
		 
<?php 
	if ($tag == '1') {
	
	echo '<div class="report"> Allocated Client</div>';
	
	} 
 
 if ($tag == '2') {
	
	 
   echo '<div class="error"> Please contact the administrator. <br />
                             Note: Make sure you have selected a client and a trainer before submitting the form to allocate a trainer to a client. </div>';

	
	} 

 ?>		 

		
	</div>			
		</div>	
</body>
</html>