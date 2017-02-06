<?php
	include '../db_conn.php';

	$docu = new document();
?>

<!DOCTYPE HTML5.0>
<html>
	<body>
		<table class="table table-condensed">
			<thead>
				<th>Name</th>
				<th>Directory</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php
					$documents = $docu->get_searchResults($_GET['keyword'], $_GET['area']);
					foreach ($documents as $row) {
						?>
						<tr>
							<?php
								foreach ($row as $key => $value) {
									echo "<td>".$value."</td>";
								}
							 ?>
						</tr>
						<?php
					}
				 ?>
			</tbody>
		</table>
	</body>
</html>
