<?php
	include '../db_conn.php';
	$user = new user();
	$uid=$_GET['uid'];
	$result = $user->view_user($uid);
	extract($result);
?>

<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
			.input_label{
				border-bottom: none;
				padding-top: 0px;
				border-bottom: solid 2px rgb(255,90,0);
				width: 200px;
				margin-bottom: -10px;
			}
		</style>
	</head>
	<body>
		<form name="upd_form" id="upd_form" action="" method="POST">
			<table class='table'>
				<tr>
					<td>
						<input type='hidden' value='<?php $uid?>' id='uid'>
						<label class='input_label'>Firstname</label>
					</td>
					<td>
						<label class='input_label'>Lastname</label>
					</td>
					<td>
						<label class='input_label'>Username</label>
					</td>
				</tr>
				<tr>
					<td>
						<input type='text' class='form-control' name='fname' id='fn' value="<?php echo $firstname?>" required>
					</td>
					<td>
						<input type='text' class='form-control' name='lname' id='ln' value="<?php echo $lastname?>" required>
					</td>
					<td>
						<input type="text" class="form-control" id="un" value="<?php echo $username?>" disabled >
					</td>
				</tr>
				<tr>
					<td>
						<label class='input_label'>Type</label>
					</td>
					<td>
						<label class="input_label">Area</label>
					</td>
					<td>
						<label class="input_label">Password</label>
					</td>
				</tr>
				<tr>
					<td>
						<select class='form-control utype' id='ut'>
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
					<td>
						<select class='form-control' id='ua' <?php echo ($user_type==1)?'disabled':'';?>>
							<?php
								foreach($user->get_areas() as $value){
									$selected = ($value['id']==$area ? 'selected' : '');
									echo '<option value="'.$value['id'].'" '.$selected.' >'.$value['name'].'</option>';
								}
							?>
						</select>
					</td>
					<td>
						<button class='btn btn-default' onclick="reset_pass('<?php echo $uid?>')">
							Reset Password
						</button>
					</td>
				</tr>
				<tr>
					<td>
						<label class="input_label">Type</label>
					</td>
				</tr>
				<tr>
					<td>
						<select class='form-control' id='us'>
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
					<td></td>
					<td>
						<button class='btn btn-warning form-control' id='ch_upd' type='button' onclick='upd_user("<?php echo $uid;?>")'>Done</button>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>
