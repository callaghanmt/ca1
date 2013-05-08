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
include('s3_filecheck.php'); // getExtension Method
 
$description = '';
$msg='';

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $name = $_FILES['file']['name'];
      //echo $name;
    $size = $_FILES['file']['size'];
      //echo $size;
    $tmp = $_FILES['file']['tmp_name'];
      //echo $tmp;
    $ext = getExtension($name);
      //echo $ext;
    $description = $_POST['description'];

  
    if (($ext == 'doc') OR ($ext == 'docx') OR ($ext == 'DOC') OR ($ext == 'DOCX') OR ($ext == 'pdf') OR  ($ext == 'PDF') OR ($ext == 'mp4') OR  ($ext == 'MP4'))
    { 
      $filetype = 'doc';
    }
      else
    {
        $filetype = 'mov';
    }
     
 
    
    if(strlen($name) > 0)
    {
        // File format validation
        if(in_array($ext,$valid_formats))
        {
            // File size validation- approx 100MB
            if($size<(1024*1024*100))
            {
                include('s3_config.php');
                echo $link;
                //Rename image name with filename based on timestamp
                $actual_file_name = time().".".$ext;

                if($s3->putObjectFile($tmp, $bucket , $actual_file_name, S3::ACL_PUBLIC_READ) )
                {
                    $msg = "S3 Upload Successful."; 
                    $s3file='http://'.$bucket.'.s3.amazonaws.com/'.$actual_file_name;
                    //echo "<img src='$s3file'/>";
                    echo 'S3 File URL:'.$s3file;
                  
                    $sql = "INSERT INTO files (filename, orig_filename, filetype, description) 
                    VALUES ('$actual_file_name','$name','$filetype','$description')";
                    
                    echo '<br />';
                  //echo $sql;
                    echo '<br />';
                  
                    $result = $mysqli->query($sql) or die($mysqli->error.__LINE__);
                    mysqli_close($mysqli);
  
                }
                    else
                    $msg = "S3 Upload Fail.";

             }
                else
                $msg = "Maximum filesize is 100MB";

          }
            else
            $msg = "Invalid file, please upload your file.";

     }
            else
            $msg = "Please select your file.";

}
  
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

<h2>Upload your file here</h2> <br />


<form action="" method='post' data-validate="parsley" enctype="multipart/form-data">

<table border="0">
<tr>
<td>Choose your file</td>
<td><input type='file' name='file'/> </td>
</tr>
<tr>
<td>Enter a description (compulsory!)</td>
<td><input type = 'text' name = 'description' data-required='true' /></td>
</tr>
<tr>
<td>
<input type='submit' value='Upload File'/>  
</td>
</tr>
</table>

  
  
<?php echo $msg; ?>
</form>     
</div>
</div>
</BODY>
</HTML>



