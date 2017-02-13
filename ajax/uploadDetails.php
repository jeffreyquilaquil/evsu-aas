<?php

	include '../db_conn.php';

	$docu = new document();

	$uList = "";
	if(isset($_GET['uList'])){
		$uList = $_GET['uList'];
	}



	$restricted = ($_GET['restricted'] ? 1 : 0);
	$docu->uploadFileDetails($_GET['area'], $_GET['name'], $_GET['dir'], $_GET['type'], $_GET['size'], $uList, $restricted);

?>
