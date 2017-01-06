<?php
	include 'db_conn.php';
	session_start();
	$user_id=$_GET['uid'];
	$user = new user();
	$result = $user->view_user($user_id);
	extract($result);

	if (isset($_POST['lastname'])) {
		extract($_REQUEST);
		$user->update_user($user_id, $lastname,$firstname,$assigned_area,$user_type,$user_status);
		echo "<script type='text/javascript'>alert_message('Account has successfully been updated', 'accounts.php');</script>";
		#header('location:accounts.php');
	}
?>
<html>
	<head>
		<style type="text/css">
			html{
				height: 90%;
			}
			 *{
				color:white;
			}
			.labels{ 
				padding-bottom:0px; 
			}
			.labels label{
				border-bottom:solid 2px white; 
				width: 150px;
			}
			.inputs{
				border-top: none;
				padding-top:0px; 
				border-top: none;
			}
			.form-control{
				background: none;
				color: white;
				outline: none;
			}
		</style>
	</head>
	<body>
		<form action='' id='frm_update' method="POST">
		<table class='table table-condense'>
			<tr>
				<td class='labels'><label>Firstname</label></td>
				<td class='labels'><label>Lastname</label></td>
				<td class='labels'><label>Username</label></td>
			</tr>
			<tr>
				<td style='border-top:none;padding-top:0px;'><input type='text' name='firstname' class='form-control' value="<?php echo $firstname; ?>" required></td>
				<td style='border-top:none;padding-top:0px;'><input type='text' name='lastname' class='form-control' value="<?php echo $lastname; ?>" required></td>
				<td style='border-top:none;padding-top:0px;'><input type='text' name='username' class='form-control' value="<?php echo $username; ?>" disabled style='background:none'></td>
			</tr>
			<tr>
				<td class='labels'><label>Assigned Area</label></td>
				<td class='labels'><label>User Type</label></td>
				<td class='labels'><label>User Status</label></td>
			</tr>
			<tr>
				<td style='border-top:none;padding-top:0px;'>
					<select class='form-control' name='assigned_area'>
						<option value="<?php echo $area?>"><?php echo $area_name?></option>
						<?php $user->get_areas()?>
					</select>
				</td>
				<td style='border-top:none;padding-top:0px;'>
					<select class='form-control' name='user_type'>
						<?php
							if ($user_type==1) {
								echo "
									<option value='1'>Administrator</option>
									<option value='2'>Chairman</option>
								";
							}else{
								echo "
									<option value='2'>Chairman</option>
									<option value='1'>Administrator</option> 
								";
							}
						?>
					</select>
				</td>
				<td style='border-top:none;padding-top:0px;'>
					<select name='user_status' class='form-control'>
						<?php
							if($user_status==1){
								echo "
									<option value='1'>Active</option>
									<option value='0'>Inactive</option>
								";
							}else{
								echo "
									<option value='0'>Inactive</option>
									<option value='1'>Active</option>
								";
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><button class='btn btn-default' style='background:black;color:white;' type='button' onclick='submit_form()'>Update</button></td>
			</tr>		
		</table>
		</form>
	</body>
</html>

<script type="text/javascript">

	function submit_form(){
		if ($("#frm_update").valid()) {
			$("#frm_update").submit();
		};
	}
</script>