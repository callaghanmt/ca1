<html>
  <head>
     <title>Select a trainer</title>
  </head>
  <body>
     <?php 
   
  include('s3_config.php');   
       
       
  $result1 = mysqli_query($mysqli,"SELECT * FROM trainer");
  
  echo '<select>';
  while($row = mysqli_fetch_array($result1))
  {
    echo "<option value='".$row['trainer_id']."'>".$row['trainer_name']."</option>";
  
  } 
  echo '</select>';
  echo '<br />';
       
       
  mysqli_close($mysqli);    
       
       
       
       
       ?>
  </body>
</html>