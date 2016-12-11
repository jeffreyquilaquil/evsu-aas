<?php
	include 'db_conn.php';
	session_start();
	$document=new document();
?>
<html>
	<head>
		<style type="text/css">
			html{
				color:white;
				height: 90%;
			}
			*, h4{
				color: white;
			}
		</style>
	</head>
	<body>
		<h4>List of Document Backups</h4>
		<a href="set_backup.php"><button class='btn btn-default pull-right'>Set Backup Interval</button></a>
		<br><br>
		<table class='table table-condense' style='width:300px;margin-left:auto;margin-right:auto;border:solid 2px white;border-radius:5px;'>
			<thead>
				<th style='text-align:center'>Backup Date</th>
				<th style='text-align:center'>Action</th>
			</thead>
			<tbody>
				<?php $document->backup_list();?>
			</tbody> 
		</table>
	</body>
</html>
<script type="text/javascript">

</script>