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


    <!-- these js/css includes are ONLY to make the calendar widget work (fldDateMet);
       these includes are not necessary for the class to work!! -->
    <link rel="stylesheet" href="../../ajaxCRUD/examples/includes/jquery.ui.all.css">
    <script src="../../ajaxCRUD/examples/includes/jquery.ui.core.js"></script>
    <script src="../../ajaxCRUD/examples/includes/jquery.ui.widget.js"></script>
    <script src="../../ajaxCRUD/examples/includes/jquery.ui.datepicker.js"></script>
    
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
          <a class="brand" href="../../index.php" target="_blank">CloudApps Home</a>
          
        </div>
      </div>
</div>

  <div class="container">
    <div class="hero-unit">
 <h2> Admin View </h2>
    
<?php

  #change orientation (if desired/needed for large number of fields in a table)
  //$tblFriend->setOrientation("vertical"); //if you want the table to arrange vertically

    #i can define a relationship to another table
    #the 1st field is the fk in the table, the 2nd is the second table, the 3rd is the pk in the second table, the 4th is field i want to retrieve as the dropdown value
    #http://ajaxcrud.com/api/index.php?id=defineRelationship
    //$tblFriend->defineRelationship("fkMarriedTo", "tblLadies", "pkLadyID", "fldName", "fldSort DESC"); //last var (sorting) is optional; see reference documentation

  #use if you only want to show a few of the fields (not all)
  $tblClient->showOnly("client_id, client_fname, client_lname, client_addr1, client_addr2, client_town, client_pcode, client_email, client_phone, client_dob, client_height");
  
  #how you want the fields to visually display in the table header
  $tblClient->displayAs("client_id", "Client ID");
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
  //$tblClient->displayAs("client_photo", "Photo");
  
  #use if you only want to show a few of the fields (not all)
  $tblReadings->showOnly("client_id, date, weight, l_bicep, r_bicep, chest, waist, hips, l_thigh, r_thigh, new_photo");
  
  #how you want the fields to visually display in the table header
  $tblReadings->displayAs("client_id", "Client ID");
  $tblReadings->displayAs("date", "Date");
  $tblReadings->displayAs("weight", "Weight");
  $tblReadings->displayAs("l_bicep", "Left Bicep");
  $tblReadings->displayAs("r_bicep", "Right Bicep");
  $tblReadings->displayAs("chest", "Chest Size");
  $tblReadings->displayAs("waist", "Wasit Size");
  $tblReadings->displayAs("hips", "Hip");
  $tblReadings->displayAs("l_thigh", "Left Thigh");
  $tblReadings->displayAs("r_thigh", "Right Thigh");
  $tblReadings->displayAs("new_photo", "Photo");

  #use if you want to rearrange the order your fields display (different from table schema)
  //$tblFriend->orderFields("pkFriendID, fldAddress, fldName, fldState");

  #set the number of rows to display (per page)
  $tblClient->setLimit(2);
    $tblReadings->setLimit(2);

    #set a filter box at the top of the table
    $tblClient->addAjaxFilterBox('client_lname', 20);

  #modify field with class
  $tblClient->modifyFieldWithClass("client_dob", "datepicker");
  //$tblClient->modifyFieldWithClass("client_pcode", "zip required");
  //$tblClient->modifyFieldWithClass("client_phone", "phone");
  $tblClient->modifyFieldWithClass("client_email", "email");

  
  #show CSV export button
  //$tblClient->showCSVExportOption();

  #use if you want to move the add form to the top of the page
  //$tblClient->disallowAdd();

  #order the table by any field you want
  $tblClient->addOrderBy("ORDER BY client_lname");  
  
  
    $tblClient->showTable();
  
    $tblReadings->showTable();
  
  mysql_close($conn); 
?>
  </div>      
    </div>  
</body>
</html>