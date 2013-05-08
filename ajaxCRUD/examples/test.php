<?php

	require_once('../preheader.php'); // <-- this include file MUST go first before any HTML/output

	#the code for the class
	include_once ('../ajaxCRUD.class.php'); // <-- this include file MUST go first before any HTML/output

	#create an instance of the class
    $tblClient = new ajaxCRUD("Client", "client", "client_id", "../");
?>

<?php

	$tblClient->showTable();
?>



