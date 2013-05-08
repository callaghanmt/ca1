<?php
  require_once('ajaxCRUD/preheader.php'); // <!-- this include file MUST go first before any HTML/output-->

  #the code for the class
  include_once ('ajaxCRUD/ajaxCRUD.class.php'); // <!-- this include file MUST go first before any HTML/output-->

  #create an instance of the class
  $tblFiles = new ajaxCRUD("Files", "files", "filename");
  
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<HTML>
<HEAD>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/parsley.js"></script>
<TITLE>View files</TITLE>
</HEAD>
<BODY>
 
     

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

<h2>List of files available:</h2> <br />
  
  <?php
  
  $tblFiles->showOnly("filetype, description");
  
  //how you want the fields to visually display in the table header
  
  $tblFiles->displayAs("filetype", "Type of File");
  $tblFiles->displayAs("description", "Description");
  
  //don't allow table adding
  
  $tblFiles->disallowAdd();
  
  $tblFiles->setLimit(10);
  
  //actually show the table
  
  $tblFiles->showTable();
  //mysql_close($conn);
  
  ?>

     
</div>
</div>
</BODY>
</HTML>



