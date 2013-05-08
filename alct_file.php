<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<HTML>
<HEAD>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/parsley.js"></script>
<TITLE>Upload a file</TITLE>
</HEAD>
<BODY>
  
<?php
  //allocate file to client
  
  //db details
  include('s3_config.php');
  
  $msg='';

   
  if($_SERVER['REQUEST_METHOD'] == "POST")
   
  {
   $cl = $_POST['client'];
   $fl = $_POST['filename'];
    
   $sql = "SELECT * FROM Client_links WHERE client_id = ".$cl. " AND new_filename = '".$fl."'";
   $sqlin = "INSERT INTO Client_links (client_id, new_filename) VALUES (".$cl. ",'".$fl."')";
   
   $result = $mysqli->query($sql) or die($mysqli->error.__LINE__);
  
   $numrows = $result->num_rows;
    
   if ($numrows == 0)
   {
     mysqli_query($mysqli, $sqlin);
     $msg='File allocated to client';
   }
    else
      {
          $msg = 'That file has aleady been allocated to the client. Try again please...';
      }
    
        //echo $sqlin;
  
   
    
  
  }
    
  $result1 = mysqli_query($mysqli,"SELECT * FROM client");
  $result2 = mysqli_query($mysqli,"SELECT * FROM files");
  
 ?>
<div class="navbar navbar-inverse navbar-fixed-top">
<div class="navbar-inner">
<div class="container">
<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</a>
<a class="brand" href="../index.php" target="_blank">PT4U Home</a>
          
</div>
</div>
</div>

<div class="container">
<div class="hero-unit">

<h2>Allocate a file to a client</h2> <br />


<form action="" method='post' data-validate="parsley" enctype="multipart/form-data">

<table border="0">
<tr>
<td>Choose your client</td>
<td>
 <?php
   echo '<select name = "client">';
  while($row = mysqli_fetch_array($result1))
  {
    echo "<option value='".$row['client_id']."'>".$row['client_fname']."</option>";
  
  } 
  echo '</select>';
  ?>
</td
</tr>
<tr>
<td>Choose the file</td>
<td>
 <?php
 echo '<select name = "filename">';
  while($row = mysqli_fetch_array($result2))
  {
    echo "<option value='".$row['filename']."'>".$row['orig_filename']."</option>";
  
  } 
  echo '</select>';
 ?> 
  
</td>
</tr>
<tr>
<td>
<input type='submit' value='Allocate File'/>  
</td>
</tr>
</table>

<?php
mysqli_close($mysqli);
  
echo $msg;
?>
</div>
</div>
</BODY>
</HTML>

