<?php
include "../db_conn.php";
$area=$_GET['area'];
$dir = $_GET['dir'];
?>
<!DOCTYPE HTML>
<html>
	<head>
	</head>
	<body>
		<table class="table table-striped">
			<thead>
				<th width="80%">Name</th>
				<th>Action</th>
			</thead>
			<?php
				$doc=new document;
				$doc->download_status($area, $dir);
			?>
		</table>
	</body>
</html>
