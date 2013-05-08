<?php
$cid = $_GET['cid'];  

require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_line.php');
require_once( "jpgraph/jpgraph_date.php" );
 
// Size of the overall graph
$width=700;
$height=500;
 
// Create the graph and set a scale.
// These two calls are always required
  $graph = new Graph($width,$height);
  $graph->SetScale( 'datlin' );
  
  
  //DB connection
  
$DB_NAME = 'cloudapps';
$DB_HOST = 'cloudapps.cbkmdimoancr.us-west-2.rds.amazonaws.com';
$DB_USER = 'user';
$DB_PASS = 'password13';
  
//initialise some arrays
$i=0;
$s=0;
$wt = array();
$bm = array();
$ht = array();
$bs = array();
$ct = array();
$ws = array();
$hs = array();
$ts = array();
$de = array();
 
$link= new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
  
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
 
$query = "SELECT client_id, date, weight, l_bicep, r_bicep, chest, waist, hips, l_thigh, r_thigh FROM readings WHERE client_id =".$cid;
  //echo $query;
    
  
if ($stmt = mysqli_prepare($link, $query)) {

    /* execute statement */
    mysqli_stmt_execute($stmt);

    /* bind result variables */
   mysqli_stmt_bind_result($stmt, $client_id, $date, $weight, $l_bicep, $r_bicep, $chest, $waist, $hips, $l_thigh, $r_thigh);
  
    /* fetch values */
    while (mysqli_stmt_fetch($stmt)) 
    
    {
       $wt[$i] =$weight;
       //echo $weight;
       //$ht[$i] = $height;
       //$bm[$i] = $weight[$i] / ($height[$i] * $height[$i]);
       $bs[$i] = ceil(($l_bicep + $r_bicep) / 2);
       $ct[$i] = $chest;
       $ws[$i] = $waist;
       $hs[$i] = $hips;
       $ts[$i] = ceil (($l_thigh + $r_thigh) / 2);
       //echo $thighs;
       $de[$i] = $date;
      
       $i++;
       $s++;
    }

    /* close statement */
    mysqli_stmt_close($stmt);

}

mysqli_close($link);

  //$graph->xaxis->SetLabelFormatString('$de', true);
  $graph->xaxis->SetTickLabels($de);
  $graph->xaxis->SetLabelAngle(90);
  

  
// Create the linear plot
  $lineplot = new LinePlot($wt);
  $lineplot1 = new LinePlot($bs);
  $lineplot2 = new LinePlot($ct);
  $lineplot3 = new LinePlot($ws);
  $lineplot4 = new LinePlot($hs);
  $lineplot5 = new LinePlot($ts);

  
  // Add the plot to the graph
  $graph->Add($lineplot);
  $graph->Add($lineplot1);
  $graph->Add($lineplot2);
  $graph->Add($lineplot3);
  $graph->Add($lineplot4);
  $graph->Add($lineplot5);


  //set legend 
  $lineplot->SetLegend("weight");
  $lineplot1->SetLegend("biceps");
  $lineplot2->SetLegend("chest");
  $lineplot3->SetLegend("waist");
  $lineplot4->SetLegend("hips");
  $lineplot5->SetLegend("thighs");
  
  $graph->legend->SetAbsPos(10,10,'right','top');
  $graph->xaxis->title->Set('Date');
  $graph->xaxis->title->SetMargin(30);
 
  
  $graph->title->Set('Body Measurements');
  
  
// Display the graph
  $graph->Stroke();
  
?>  
  
