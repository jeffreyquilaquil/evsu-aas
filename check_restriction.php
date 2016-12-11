<?php
	$uid = $_GET['user_id'];
	$fid = $_GET['file_id'];

	@mysql_connect('localhost:3306', 'root','');
	mysql_select_db('aas_db');

	$sql = mysql_query("SELECT status FROM tbl_notify WHERE file_id = '$fid' AND user_id = '$uid'");
	$result =mysql_fetch_array($sql);
	echo $result['status'];
?>