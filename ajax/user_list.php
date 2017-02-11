<?php
include '../db_conn.php';
$user=new user();
if (isset($_GET['reg'])) {
	extract($_REQUEST);
	$user->reg_user($fname, $lname, $uname, 'abcd1234', $type, $area);
	echo "
		<script type='text/javascript'>
			alert_message('Registration successful');
		</script>
	";
}

if (isset($_GET['upd'])) {
	extract($_REQUEST);
	$user->update_user($uid, $lname, $fname, $area, $type, $status);
	echo "
		<script type='text/javascript'>
			alert_message('Update successful');
		</script>
	";
}
?>
<!doctype HTML5.0>
<html>
	<head></head>
	<body>
		<table class='table table-striped'>
			<thead>
				<th>Name</th>
				<th>Username</th>
				<td>Area</td>
				<th>Type</th>
				<th>Status</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php $user->user_list();?>
			</tbody>
		</table>
	</body>
</html>
	<script type="text/javascript">
		// $("table").DataTable({
		// 	"paging":false,
		// 	"info":false
		// });
	</script>
