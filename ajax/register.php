<?php
include '../db_conn.php';
$user=new user();
$uname_arr=$user->get_unames();
?>
<html>
<head>
		<style type="text/css">
			tr{
				border:none;
			}
			.input_label{
				border-top: none;
				padding-top: 0px;
				border-bottom: solid 2px rgb(31, 109, 211);;
				width: 200px;
				margin-bottom: -10px;
			}
		</style>
	</head>
	<body>
		<form action="" method="POST" id="reg_form" name="reg_form">
			<table class='table table-condense'>
				<tr >
					<td style='border:none;'>
						<label class="input_label">Firstname</label>
					</td>
					<td style='border:none;'>
						<label class="input_label">Lastname</label>
					</td>
					<td style='border:none;'>
						<label class="input_label">Username</label>
					</td>
				</tr>
				<tr >
					<td style='border:none;'>
						<input name='fname' required class='form-control' id='fn'>
					</td>
					<td style='border:none;'>
						<input name='lname' required class='form-control' id='ln'>
					</td>
					<td style='border:none;'>
					<input name='uname' required class='form-control' onblur='check_uname()' id='un'>
						<label id='unameCheck_err' for='uname' style='display:none'>Username no longer available.</label>
					</td>
				</tr>
				<tr >
					<td style='border:none;'>
						<label class='input_label'>Type</label>
					</td>
					<td style='border:none;'>
						<label class="input_label">Area</label>
					</td>
				</tr>
				<tr >
					<td style='border:none;'>
						<select name='utype' class="form-control utype" id='ut'>
							<option value="2">Chairman</option>
							<option value="1">Administrator</option>
						</select>
					</td>
					<td style='border:none;'>
						<select name="area" class="form-control" id='ua'>
							<?php
								foreach ($user->get_areas() as $value) {
									echo "<option value='".$value['id']."'>".$value['name']."</option>";
								}
							?>
						</select>
					</td>
					<td style='border:none;'>
						<button type='button' class='btn btn-info pull-right form-control' id="btn_form" onclick="check_form()">Done</button>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>
