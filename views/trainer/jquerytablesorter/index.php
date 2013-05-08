<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
  <title>CloudApps</title>
  <link rel="stylesheet" href="../../../css/bootstrap.css" type="text/css" >
  <link rel="stylesheet" href="css/jq.css" type="text/css" media="print, projection, screen" />
  <link rel="stylesheet" href="themes/blue/style.css" type="text/css" media="print, projection, screen" />
  <script type="text/javascript" src="jquery-latest.js"></script>
  <script type="text/javascript" src="jquery.tablesorter.pager.js"></script>
  <script type="text/javascript" src="jquery2.tablesorter.js"></script>

  <script type="text/javascript">
  
  $(function() {
    $("table")
      .tablesorter({widthFixed: true, widgets: ['zebra']})
      .tablesorterPager({container: $("#pager")});
  });
  
  </script>
  
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
          <a class="brand" href="../../../index.php">PT4U Home</a>
           
          
        </div>
      </div>
</div>


        
    <div class="container">
       <div class="hero-unit">
        <h3> Trainer View </h3>
        
  <?php $errorMessage = strip_tags((trim($_GET['dumvalue'])));
 ?>        
     
  <form>   
    Trainer List <select name='trainer' onchange='this.form.submit()'>
        <option value= ""> Select Trainer </option> 
  <?php
   $conn = mysql_connect("cloudapps.cbkmdimoancr.us-west-2.rds.amazonaws.com", "user", "password13") or die (mysql_error());
      mysql_select_db ("cloudapps");
$sql22="SELECT * FROM trainer";
      $result22 = mysql_query($sql22) or die('error table');    
      while ($row22 = mysql_fetch_array($result22)) {
    
        echo'Client list<option value="'.$row22['trainer_id'].'"> '.$row22['trainer_name'].' </option>';
      }
      mysql_close($conn); 
  ?>      
   </select>
    <noscript><input type="submit" value="Submit"></noscript>
    </form>
     
        
<?php $trainerid = strip_tags((trim($_GET['trainer']))); ?>        
         
<?php  setcookie("trainer", $trainerid, time()+3600); ?>


      
<!--Select Client -->      
<form>
        Client List<select name='myfield' onchange='this.form.submit()'>
        <option value= ""> Select Client </option> 
<?php

$conn = mysql_connect("cloudapps.cbkmdimoancr.us-west-2.rds.amazonaws.com", "user", "password13") or die (mysql_error());
      mysql_select_db ("cloudapps");
      
$sql22="SELECT t.trainer_name, t.trainer_id, c.client_fname, c.client_lname, c.client_id
        FROM trainer t, client c, trainer_client tc
          WHERE tc.trainer_id = '$trainerid' 
            AND c.client_id = tc.client_id
              AND t.trainer_id = tc.trainer_id";
      $result22 = mysql_query($sql22) or die('error table');    
      while ($row22 = mysql_fetch_array($result22)) {
    
        echo'<option value="'.$row22['client_id'].'"> '.$row22['client_fname'].' &nbsp; '.$row22['client_lname'].' </option>';
      }
        mysql_close($conn); 
?>


</select>
<noscript><input type="submit" value="Submit"></noscript>
</form>
     
     <?php $tag = strip_tags((trim($_GET['myfield']))); ?>

<?php 
     

      if ($tag != null) {
      $conn = mysql_connect("cloudapps.cbkmdimoancr.us-west-2.rds.amazonaws.com", "user", "password13") or die (mysql_error());
      mysql_select_db ("cloudapps");
      
      
      //retrieve matching records
      $sql="SELECT *
        FROM trainer t, client c, trainer_client tc
          WHERE c.client_id ='$tag'
            AND c.client_id = tc.client_id
              AND t.trainer_id = tc.trainer_id";
      $result = mysql_query($sql) or die('error table');
      
      // get number of records found 
      $numrows = mysql_num_rows($result);

      if($numrows != 0) {
      while ($row = mysql_fetch_array($result)) {
      
      echo '<h3>Client</h3>';
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
      
     
      
      /*Image link needs to be replaced*/
      
      }
      
    echo "<table>
      
      
      <tr>
      
        <th>Client comments</th>
        <th></th>
        <th>Trainer comments</th>
        
      
      </tr>";
      
      

       $sql1="SELECT *
        FROM trainer t, client c, trainer_client tc
          WHERE c.client_id ='$tag' 
            AND c.client_id = tc.client_id
              AND t.trainer_id = tc.trainer_id";
      $result1 = mysql_query($sql1) or die('error table');
      
  echo'<form action="insertComments.php" method="post">';    
     while ($row1 = mysql_fetch_array($result1)) {
       
        echo '<tr>';
      echo '<td><textarea cols="60" rows="5" readonly> '.$row1['client_comments'].' </textarea></td>';
      echo '<td style="padding-right: 40px;"></td>';
      echo '<td><textarea cols="60" rows="5"  name="tcomments"> '.$row1['trainer_comments'].' </textarea></td>';
      echo '</tr>';
      }
      ?>
          <input type="hidden" name="cid" value="<?php echo $tag;?>">
          <input type="hidden" name="tid" value="<?php echo $_COOKIE['trainer'];?>">
         
        <?php echo '</table>';
  echo ' <button style="float:right;" type="submit" class="btn">Submit</button> </form>';
      
      
      
      if ($tag != null) {
          
      $sql2="SELECT * FROM client, readings 
          where client.client_id ='$tag'
            and client.client_id = readings.client_id";
      $result2 = mysql_query($sql2) or die('error table');
      
      //Add else if to check whether result is empty
      echo '<h3>Readings</h3>';
      echo "<table id='tablesorter-demo' class='tablesorter' border='0' cellpadding='0' cellspacing='1'>
      
      <thead>
      <tr>
      
        <th>Client Name</th>
        <th>Date</th>
        <th>Weight</th>
        <th>Left Bicep</th>
        <th>Right Bicep</th>
        <th>Chest</th>
        <th>Waist</th>
        <th>Hips</th>
        <th>Left Thigh</th>
        <th>Right Thigh</th>
      
      </tr>
      </thead>
      <tbody>        
      ";
          
      
      while ($row2 = mysql_fetch_array($result2)) {
    
        echo "<tr>";
        echo ('<td>'.$row2['client_fname'].'  &nbsp; '.$row2['client_lname'].'</td><td>'.$row2['date'].'</td>
            </td><td>'.$row2['weight'].'</td><td>'.$row2['l_bicep'].'</td><td>'.$row2['r_bicep'].'</td><td>'.$row2['chest'].'</td><td> '.$row2['waist'].'</td>
            <td>'.$row2['hips'].'</td><td>'.$row2['l_thigh'].'</td><td>'.$row2['r_thigh'].'</td>');  
          echo "</tr>";
        

      }
      
        echo "</tbody></table>";
      
      
      
      
    echo'  <div id="pager" class="pager">
  <form>
    <img src="addons/pager/icons/first.png" class="first"/>
    <img src="addons/pager/icons/prev.png" class="prev"/>
    <input type="text" class="pagedisplay"/>
    <img src="addons/pager/icons/next.png" class="next"/>
    <img src="addons/pager/icons/last.png" class="last"/>
    <select class="pagesize">
      <option selected="selected"  value="10">10</option>
      <option value="20">20</option>
      <option value="30">30</option>
      <option  value="40">40</option>
    </select>
  </form>
</div>';}

else {echo 'No Readings';}





}
      
        
      else {
        echo "No suggestions found.";
        // close database connection
        mysql_close($conn); 
        
        }
        }
        
        
if ( $errorMessage == '2') {
  
   echo '<div class="error"> Please contact the administrator. <br />
 </div>';

 } 
         

?>
</div>

</div>
</body>
</html>
  