<?php
	include'../db_conn.php';

	$docu=new document();
	$user=new user();

	$user_id=$_SESSION['user_id'];


	if ($_GET['type']=='increment_download') {
		$docu->increment_download($_GET['file_id'],$_SESSION['user_id']);
	}

	if($_GET['type']=="notify"){

		$docu->notify_admin($_GET['file_id'], $user_id);
	}

	if ($_GET['type']=="ChangePass") {
		$pass=$_GET['pass'];
		$user->change_pass($user_id, $pass);
	}

	if ($_GET['type']=="AD") {

		$docu->allow_download($_GET['nid']);

		$nid = $_GET['nid'];
		$docu->allow_download($nid);
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

	if ($_GET['type']=="new-folder") {
		$docu->create_folder($_GET['dir'], $_GET['name'], $_GET['area']);
	}

	if($_GET['type'] == "update-folder"){
		$docu->update_folder($_GET['id'], $_GET['name']);
	}

	if($_GET['type'] == 'folder-ifexist'){
		$folder_exist = $docu->sel_query("SELECT fldr_id FROM tbl_folders WHERE name = '".$_GET['name']."' AND dir = '".$_GET['dir']."' AND area = '".$_GET['area']."'");
		if( !empty($folder_exist) ){
			echo "true";
		}
	}

	if ($_GET['type']=="delete file") {
		$docu->del_file($_GET['file_id']);
	}

	if($_GET['type']=="view_download"){
		$docu->view_download($_GET['file_id']);
	}

	if($_GET['type']=='area_reg'){
		$user->register_area($_GET['name'], $_GET['no']);
	}

	if($_GET['type']=='area_upd'){
		$user->update_area($_GET['id'], $_GET['name']);
	}
?>
