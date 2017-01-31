<?php
	include '../db_conn.php';
	$docu= new document();
	$area=$_GET['area'];
	$dir=$_GET['dir'];
?>
<!DOCTYPE html5.0>
<html>
	<head>
	</head>
	<body>
		<?php
			if($_SESSION['area']==$area || $_SESSION['user_type']==1){
		?>
		<table>
 			<td>
				<button id='n-folder' onclick='create_folder("<?php echo $area;?>")'>New Folder <i class='fa fa-folder-o'></i></button>
			</td>
			<td><button id='upload' onclick='upload_modal("<?php echo $area;?>")'>Upload File <i class='fa fa-upload'></i></button></td>
		</table>
		<?php } ?>
		<table class='table table-striped'>
			<thead>
				<th>Name</th>
				<th>Date</th>
				<th>Type</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php $docu->get_docu($area, $dir)?>
			</tbody>
		</table>
	</body>	
</html>