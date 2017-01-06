<?php
	include '../db_conn.php';
	$docu= new document();
	
?>
<style type="text/css">
	.n_li{
		border-top:1px solid black;
		border-bottom: 1px solid black;
		font-size: 12px; 
		cursor: pointer;
	}

</style>
<table style='width:100%' class='tbl_not'>
	<?php
		echo $docu->get_not($_SESSION['user_id'],$_SESSION['area']);
	?>
</table>
