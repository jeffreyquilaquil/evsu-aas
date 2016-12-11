<?php
@mysql_connect('localhost:3306','root','');
mysql_select_db('aas_db');

	$area=$_GET['area'];
	$name=$_GET['name'];
	$dir=$_GET['dir'];

	$sql1 = mysql_query("SELECT * FROM tbl_folders WHERE name='$name' AND area = '$area' AND dir = '$dir'") or die(mysql_error());
	mysql_num_rows($sql1);
	if (mysql_num_rows($sql1)>0) {
		echo 0;
	}else{
		$sql2=mysql_query("INSERT INTO tbl_folders (name, dir, area,date) value ('$name', '$dir', '$area',now())") or die(mysql_error());
		echo 1;
	}
?>