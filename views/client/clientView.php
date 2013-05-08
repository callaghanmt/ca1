<?php
  require_once('../../ajaxCRUD/preheader.php'); // <!-- this include file MUST go first before any HTML/output-->
  $bucket = 'cloudapps-files';
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
  
<script type="text/javascript">
// Popup window code
function newPopup(url) {
  popupWindow = window.open(
    url,'popUpWindow','height=500,width=700,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
}
</script>

</head>
<body>

<?php $tag1 = strip_tags((trim($_GET['dumvalue'])));


  ?>


<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="../../../../index.php" target="_blank">PT4U Home</a>
          
        </div>
      </div>
</div>

  <div class="container">
    <div class="hero-unit">
    
  <h3>Client View</h3>  
  
      <form>
client list<select name='myfield' onchange='this.form.submit()'>
<option value= ""> Select Client </option> 
<?php
$sql22="SELECT client_id, client_fname, client_lname FROM client";
      $result22 = mysql_query($sql22) or die('error table');    
      while ($row22 = mysql_fetch_array($result22)) {
    
        echo'Client list<option value="'.$row22['client_id'].'"> '.$row22['client_fname'].' &nbsp; '.$row22['client_lname'].' </option>';
      }
?>


</select>
<noscript><input type="submit" value="Submit"></noscript>
</form>
     
     <?php $tag = strip_tags((trim($_GET['myfield']))); ?>

<?php

if ($tag1 == '1') {
  
  echo '<div class="report"> Client details successfully modified </div>';
  
  } 

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
  //$tblClient->displayAs("client_photo", "Photo");
  
  
  $tblReadings->showOnly("client_id, date, weight, l_bicep, r_bicep, chest, waist, hips, l_thigh, r_thigh");
  
  #how you want the fields to visually display in the table header
    $tblReadings->displayAs("client_id", "Client ID (remove)");
  $tblReadings->displayAs("date", "Date");
  $tblReadings->displayAs("weight", "Weight");
  $tblReadings->displayAs("l_bicep", "Left Bicep");
  $tblReadings->displayAs("r_bicep", "Right Bicep");
  $tblReadings->displayAs("chest", "Chest Size");
  $tblReadings->displayAs("waist", "Wasit Size");
  $tblReadings->displayAs("hips", "Hip");
  $tblReadings->displayAs("l_thigh", "Left Thigh");
  $tblReadings->displayAs("r_thigh", "Right Thigh");
  //$tblReadings->displayAs("new_photo", "Photo");
  
  
  #use if you only want to show a few of the fields (not all)
  //$tblFriend->showOnly("fldName, fldAddress, fldState, fldOwes");

  #use if you want to rearrange the order your fields display (different from table schema)
  //$tblFriend->orderFields("pkFriendID, fldAddress, fldName, fldState");

  #set the number of rows to display (per page)
  $tblClient->setLimit(2);
    $tblReadings->setLimit(5);
  
  
  
  $tblClient->addWhereClause("WHERE (client_id = $tag)");
  $tblReadings->addWhereClause("WHERE (client_id = $tag)");
  
  $tblClient->disallowDelete();
  $tblReadings->disallowDelete();

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

  #show CSV export button
  $tblReadings->showCSVExportOption();

  #use if you want to move the add form to the top of the page
  $tblClient->disallowAdd();
  $tblReadings->disallowAdd();

  #order the table by any field you want
  $tblClient->addOrderBy("ORDER BY client_lname");

      $conn = mysql_connect("cloudapps.cbkmdimoancr.us-west-2.rds.amazonaws.com", "user", "password13") or die (mysql_error());
      mysql_select_db ("cloudapps");
      
      
      //retrieve matching records
      $sql="SELECT * FROM client where client_id=$tag";
      $result = mysql_query($sql) or die('');
      
      // get number of records found 
      $numrows = mysql_num_rows($result);

      if($numrows != 0) {
      while ($row = mysql_fetch_array($result)) {
      
      
      echo'
  <div class="row-fluid">
          <div class="span4">          
        
      
        <img src="http://cloudapps-files.s3.amazonaws.com/photo.jpg" class="img-polaroid" alt="text" height="200" width="200"></div>
      
      <div class="span7"><p> <b>Name:</b> '.$row['client_fname'].' &nbsp; '.$row['client_lname'].' &nbsp; 
      <abbr title="Phone"><b>Tel No:</b></abbr> '.$row['client_phone'].' &nbsp; <b>Email:</b><a href="mailto:#">'.$row['client_email'].'</a> </p>
      <p><b>Height:</b> '.$row['client_height'].' &nbsp; <b>Date of birth:</b> '.$row['client_dob'].'  </p>
          
      <address>
      <b>Address</b><br />
      '.$row['client_addr1'].'<br>
      '.$row['client_addr2'].', '.$row['client_town'].'<br>
      '.$row['client_pcode'].'
      
      </address>
      </div></div>
      ';    
      }
      }  
      else {
        echo "No suggestions found.";
        // close database connection
        }
  
  $tblClient->showTable();
  
  $tblReadings->showTable();
  
  //display matching files
  $sql2 = "SELECT * FROM files WHERE filename IN (SELECT new_filename FROM Client_links WHERE client_id =".$tag.")";
 
  $i=0;
  $result2 = mysql_query($sql2) or die('');
     
      // get number of records found 
      $numrows2 = mysql_num_rows($result2);
     
     
      if($numrows2 != 0) {
        echo '<h3>Your Files</h3>
            <table border="1">
            <tr>
            <th>Filetype</th>
            <th>Description</th>
            </tr>'; 
        
      while ($i < $numrows2) 
      {
        $ft=mysql_result($result2,$i,"filetype");
        $de=mysql_result($result2,$i,"description");
        $fn=mysql_result($result2,$i,"filename");
        $s3file='http://'.$bucket.'.s3.amazonaws.com/'.$fn;
        
        echo '<tr>';
        echo '<td>'.$ft.'</td>'.'<td><a href="'.$s3file.'">'.$de.'</a></td>';
        echo '</tr>';
        $i++;
      }
        echo '</table>';
      }
  
  
  
  mysql_close($conn); 
?>
      <br/>
<a href="JavaScript:newPopup('<?php echo 'http://cloudapps1.aws.af.cm/draw_graph.php?cid='.$tag.'';?>');">Have a look at your personal progress</a>
  
  </div>      
    </div>  
</body>
</html>











