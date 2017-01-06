<?php
	include'../db_conn.php';

	$docu=new document();
	$user=new user();

	$user_id=$_SESSION['user_id'];

	if ($_GET['type']=='download') {
		$file_id=$_GET['file_id'];
		$docu->increment_download($file_id, $user_id);

	}

	if($_GET['type']=="notify"){
<<<<<<< HEAD
=======

>>>>>>> 130510f3927dfa86a848824eb300a3d41502740d
		$docu->notify_admin($_GET['file_id'], $user_id);
	}

	if ($_GET['type']=="ChangePass") {
		$pass=$_GET['pass'];
		$user->change_pass($user_id, $pass);
	}

	if ($_GET['type']=="AD") {
<<<<<<< HEAD
		$docu->allow_download($_GET['nid']);
=======
		$nid = $_GET['nid'];
		$docu->allow_download($nid);
		echo "something";
>>>>>>> 130510f3927dfa86a848824eb300a3d41502740d
	}

	if ($_GET['type']=="ADC"){
		$nid = $_GET['nid'];
		$docu->reject_download($nid);
	}

	if ($_GET['type']=="p_upd") {
		extract($_REQUEST);
		$user->upd_user_self($_SESSION['user_id'], $p_fn, $p_ln);
		header('location:index.php');
	}

	if ($_GET['type']=="set_bckup") {
		$interval = $_GET['value'];
		$docu->set_backup($interval);
	}

	if($_GET['type']=='backup'){
		$docu->backup("../files");
	}

	if ($_GET['type']=="new_folder") {
		$area = $_GET['area'];
		$name = $_GET['name'];
		$dir = $_GET['dir'];
		echo $docu->create_folder($dir, $name, $area);
	}

	if ($_GET['type']=="delete file") {
		$docu->del_file($_GET['file_id']);
	}

	if($_GET['type']=="view_download"){
		$docu->view_download($_GET['file_id']);
	}
?>
