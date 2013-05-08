<?php
	require_once('../preheader.php'); // <!-- this include file MUST go first before any HTML/output-->

	#the code for the class
	include_once ('../ajaxCRUD.class.php'); // <!-- this include file MUST go first before any HTML/output-->

	#create an instance of the class
    $tblClient = new ajaxCRUD("Client", "client", "client_id", "../");
	$tblReadings = new ajaxCRUD("Readings", "readings", "client_id", "../");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
	<title>CloudApps</title>
    <link rel="stylesheet" href="../../../../css/bootstrap.css" type="text/css" >
	<link rel="stylesheet" href="../../../../css/jq.css" type="text/css" media="print, projection, screen" />
	<link rel="stylesheet" href="../../../../themes/blue/style.css" type="text/css" media="print, projection, screen" /> 


		<!-- these js/css includes are ONLY to make the calendar widget work (fldDateMet);
			 these includes are not necessary for the class to work!! -->
		<link rel="stylesheet" href="includes/jquery.ui.all.css">
		<script src="includes/jquery.ui.core.js"></script>
		<script src="includes/jquery.ui.widget.js"></script>
		<script src="includes/jquery.ui.datepicker.js"></script>
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

<?php

	#change orientation (if desired/needed for large number of fields in a table)
	//$tblFriend->setOrientation("vertical"); //if you want the table to arrange vertically

    #i can define a relationship to another table
    #the 1st field is the fk in the table, the 2nd is the second table, the 3rd is the pk in the second table, the 4th is field i want to retrieve as the dropdown value
    #http://ajaxcrud.com/api/index.php?id=defineRelationship
    //$tblFriend->defineRelationship("fkMarriedTo", "tblLadies", "pkLadyID", "fldName", "fldSort DESC"); //last var (sorting) is optional; see reference documentation

	$tblClient->showOnly("client_id, client_fname, client_lname, client_addr1, client_addr2, client_town, client_pcode, client_email, client_phone, client_height");
	
    #how you want the fields to visually display in the table header
    $tblClient->displayAs("client_id", "Client ID (Remove)");
	$tblClient->displayAs("client_fname", "First name");
	$tblClient->displayAs("client_lname", "Last name");
	$tblClient->displayAs("client_addr1", "Address line 1");
	$tblClient->displayAs("client_addr2", "Address line 2");
	$tblClient->displayAs("client_town", "Town");
	$tblClient->displayAs("client_pcode", "Postcode");
	$tblClient->displayAs("client_email", "Email");
	$tblClient->displayAs("client_phone", "Phone number");
	$tblClient->displayAs("client_dob", "Date of birth");
	$tblClient->displayAs("client_height", "Height");
	$tblClient->displayAs("client_photo", "Photo");
	
	
	$tblReadings->showOnly("client_id, date, weight, l_bicep, r_bicep, chest, waist, hips, l_thigh, r_thigh, new_photo");
	
	#how you want the fields to visually display in the table header
    $tblReadings->displayAs("client_id", "Client ID (remove)");
	$tblReadings->displayAs("date", "Date");
	$tblReadings->displayAs("weight", "Wweight");
	$tblReadings->displayAs("l_bicep", "Left Bicep");
	$tblReadings->displayAs("r_bicep", "Right Bicep");
	$tblReadings->displayAs("chest", "Chest Size");
	$tblReadings->displayAs("waist", "Wasit Size");
	$tblReadings->displayAs("hips", "Hip");
	$tblReadings->displayAs("l_thigh", "Left Thigh");
	$tblReadings->displayAs("r_thigh", "Right Thigh");
	$tblReadings->displayAs("new_photo", "Photo");
	
	
	#use if you only want to show a few of the fields (not all)
	//$tblFriend->showOnly("fldName, fldAddress, fldState, fldOwes");

	#use if you want to rearrange the order your fields display (different from table schema)
	//$tblFriend->orderFields("pkFriendID, fldAddress, fldName, fldState");

	#set the number of rows to display (per page)
	$tblClient->setLimit(2);
    $tblReadings->setLimit(2);

    #set a filter box at the top of the table
    //$tblClient->addAjaxFilterBox('client_lname', 20);
   // $tblFriend->addAjaxFilterBox('fldDateMet');
   // $tblFriend->addAjaxFilterBox('fkMarriedTo');

	#allow picture to be a file upload
	
	//Need to route to the folder thats why it's not working
		//$tblClient->setFileUpload('client_photo','uploads/','uploads/');

	#format field output
	//$tblFriend->formatFieldWithFunction('fldOwes', 'addDollarSign');

	//$tblFriend->defineCheckbox("fldBestFriend", "Y", "N");

	#modify field with class
	$tblClient->modifyFieldWithClass("client_dob", "datepicker");
	//$tblClient->modifyFieldWithClass("client_pcode", "zip required");
	//$tblClient->modifyFieldWithClass("client_phone", "phone");
	$tblClient->modifyFieldWithClass("client_email", "email");

	#set allowable values for certain fields
	//$ratingVals   = array("0","1", "2","3","4","5");
    //$tblFriend->defineAllowableValues("fldFriendRating", $ratingVals);
/*
	$states = array(
				array("AL","Alabama"),
				array("AK","Alaska"),
				array("AZ","Arizona"),
				array("AR","Arkansas"),
				array("CA","California"),
				array("CO","Colorado"),
				array("CT","Connecticut"),
				array("DE","Delaware"),
				array("DC","District Of Columbia"),
				array("FL","Florida"),
				array("GA","Georgia"),
				array("HI","Hawaii"),
				array("ID","Idaho"),
				array("IL","Illinois"),
				array("IN","Indiana"),
				array("IA","Iowa"),
				array("KS","Kansas"),
				array("KY","Kentucky"),
				array("LA","Louisiana"),
				array("ME","Maine"),
				array("MD","Maryland"),
				array("MA","Massachusetts"),
				array("MI","Michigan"),
				array("MN","Minnesota"),
				array("MS","Mississippi"),
				array("MO","Missouri"),
				array("MT","Montana"),
				array("NE","Nebraska"),
				array("NV","Nevada"),
				array("NH","New Hampshire"),
				array("NJ","New Jersey"),
				array("NM","New Mexico"),
				array("NY","New York"),
				array("NC","North Carolina"),
				array("ND","North Dakota"),
				array("OH","Ohio"),
				array("OK","Oklahoma"),
				array("OR","Oregon"),
				array("PA","Pennsylvania"),
				array("RI","Rhode Island"),
				array("SC","South Carolina"),
				array("SD","South Dakota"),
				array("TN","Tennessee"),
				array("TX","Texas"),
				array("UT","Utah"),
				array("VT","Vermont"),
				array("VA","Virginia"),
				array("WA","Washington"),
				array("WV","West Virginia"),
				array("WI","Wisconsin"),
				array("WY","Wyoming")
				);

	$tblFriend->defineAllowableValues("fldState", $states);
*/
	#show CSV export button
	//$tblClient->showCSVExportOption();

	#use if you want to move the add form to the top of the page
	$tblClient->disallowAdd();

	#order the table by any field you want
	$tblClient->addOrderBy("ORDER BY client_lname");

	#some logic if we want to add a field automatically on add
	//$state = $_REQUEST['state'];
	//if ($state){
	//	$tblFriend->addWhereClause("WHERE fldState = \"$state\"");
	//	$tblFriend->omitAddField("fldState");
	//	$tblFriend->addValueOnInsert("fldState", $state);
	//}



	//echo "<h3>Twit CSS overriding delete functionality</h3>\n";


	

			
			$conn = mysql_connect("cloudapps.cbkmdimoancr.us-west-2.rds.amazonaws.com", "user", "password13") or die (mysql_error());
			mysql_select_db ("cloudapps");
			
			
			//retrieve matching records
			$sql="SELECT * FROM client where client_id=7";
			$result = mysql_query($sql) or die('error table');
			
			// get number of records found 
			$numrows = mysql_num_rows($result);

			if($numrows != 0) {
			while ($row = mysql_fetch_array($result)) {
			
			
			echo'
			<div class="row-fluid">
          <div class="span5">          
        
      
			<img src="anon.gif" class="img-polaroid" alt="text" height="200" width="200"></div>
			
			<div class="span5"><p class="lead"> '.$row['client_fname'].' &nbsp; '.$row['client_lname'].'  </p>
			<p class="lead"> '.$row['client_height'].' &nbsp; '.$row['client_dob'].'  </p>
					
			<address>
			'.$row['client_addr1'].'<br>
			'.$row['client_addr2'].', '.$row['client_town'].'<br>
			'.$row['client_pcode'].'<br>
			<abbr title="Phone">P:</abbr> '.$row['client_phone'].' <br>
			<a href="mailto:#">'.$row['client_email'].'</a>
			</address>
			</div></div>
			';
			
		  // $tblClient->showOnly("fldTitle, fldName, fldPhone");
			
			
			
			}
		
			
			}	
			else {
				echo "No suggestions found.";
				// close database connection
				}
				
	
	
		$tblClient->showTable();
	
	//	$tblClient->showTable();
	
	$tblReadings->showTable();

	//echo "<p>Above is a table of my friends. The javascript masking and validation are in the fields 'phone' and 'zip' (required). There's a datapicker on the 'Date we Met' field.</p>\n";

	#self-defined functions used for formatFieldWithFunction
	//function addDollarSign($val) {
		//return "$" . $val;
	//}
	
	mysql_close($conn); 
?>
	</div>			
		</div>	
</body>
</html>