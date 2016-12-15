<?php
	include "../db_conn.php";
	$s = $_GET['s'];
	$docu = new document()
?>

<!DOCTYPE HTML5.0>
<html>
	<body>
		<table class="table table-condensed">
			<thead>
				<th>Name</th>
				<th>Date</th>
				<th>Type</th>
				<th>Size</th>
			</thead>
			<tbody>
				<?php
					$docu->get_searchResults($s);
				?>
			</tbody>
		</table>
	</body>
</html>