<?php

	include '../db_conn.php';

	$docu = new document();
	$directory = "";
	if(isset($_GET['directory'])){
		$directory .= $_GET['directory'];
	}
	$directory .='/';

	$uList = "";
	if(isset($_GET['uList'])){
		$uList = $_GET['uList'];
	}


	$docu->uploadFileDetails($_GET['area'], $directory, $_GET['name'], $_GET['dir'], $_GET['type'], $_GET['size'], $uList, $_GET['restricted']);

	$restricted = "0";
		if($_GET['restricted'] == true){
			$restricted = 1;
		}
	$docu->uploadFileDetails($_GET['area'], $directory, $_GET['name'], $_GET['dir'], $_GET['type'], $_GET['size'], $uList, $restricted);

?>
