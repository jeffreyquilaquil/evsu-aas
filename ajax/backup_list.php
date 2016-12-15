<?php
	include_once("../db_conn.php");
	$docu = new document();
?>
<!DOCTYPE html 5.0>
<html>
	<body>
		<table class='table table-striped'>
			<thead>
				<th>Name</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php $docu->get_backup()?>
			</tbody>
		</table>
	</body>
		<script type="text/javascript">
		// $("table").DataTable({
		// 	"paging":false,
		// 	"ordering":false,
		// 	"info":false
		// });
	</script>
</html>