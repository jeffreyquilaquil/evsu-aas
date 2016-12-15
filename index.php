<?php
include_once "db_conn.php";
	if(!isset($_SESSION['user_id'])){
		header('location:login.php');
	}



	include_once 'modal.php';

	$user = new User();
	$docu = new document();

	$area=$user->get_user_area();
	$unames=$user->get_unames();
	$names=$user->get_flNames();
	$ids=$user->get_ids();
	$docu->check_backup();
?>
<html>
		<!-- External Stylesheets -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome/css/font-awesome.min.css">

	<!-- External Script -->
	<script type="text/javascript" src='js/jquery.js'></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src='js/tendina.min.js'></script>
	<script type="text/javascript" src='js/validate.js/jquery.validate.js'></script>
	<script type="text/javascript" src='js/validate.js/additional-methods.js'></script>
	<!--<script type="text/javascript" src="js/datatable/jquery.dataTables.js"></script> -->
	<script type="text/javascript" src="js/plupload.full.min.js"></script>

	<script type="text/javascript" src='js/script.js'></script>
	<head>
		<title>EVSU-CC Quality Assurance Archiiving System</title>
		<style type="text/css">
			.navs:hover{
				background: rgb(31, 109, 211);
			}
		</style>

	</head>
	<body>
		<div id="menu">
			<div>
				<div class="pull-left" style='color:white;font-size:17px;margin-top:0px;mmargin-left:-20px;'>
					<img src="css/evsu-logo.png">
					EVSU-CC Quality Assurance Archiiving System
				</div>
				<div class="pull-right">
					<ul>
						<li id='notifications' style='margin-right:10px;'>
							<button id='not_but' ><i class='fa fa-bell'><span style="color:red;font-weight:bold;right:-5px;top:-5px;"><?php $docu->notification_count($_SESSION['user_id'], $_SESSION['area']);?></span></i></button>
							<div id='not_div'>
								<img src="load.gif" class='load_gif' style='top:0;'>
							</div>
						</li>
						<li id="profile">
							<?php
								$user_details=$user->get_name();
								extract($user_details);
							?>
							<button id='prof_but'><?php echo $firstname." ".$lastname;?></button>
							<div class="disp_hide" id='prof_div'>
								<style type="text/css">
									#p-tbl{
										margin-top: 5px;
									}
									#p-tbl td{
										background: none;
									}
									.p_label{
										text-align: right;
										height: 1px;
										vertical-align: bottom;
									}
									.p_label label{
										margin-bottom: 0px;
										margin-top: 10px;
										font-size: 15px;
										margin-right: 12px;
									}
									.p_input{
										margin-top:0px;
									}
									.p_input input{
										text-align: right;
										top: -1px;
										background: none;
									}
									#p-tbl button{
										margin-top: 15px;
									}
								</style>
								<form id='p-frm'>
									<table id='p-tbl'>
										<tr><td colspan="2" class='p_label'><label>Firstname</label></td></tr>
										<tr><td colspan="2" class="p_input" style='margin-top:0px;'><input type='text' class='form-control' id='p-fn' value="<?php echo $firstname?>" required name="p_fn"></td></tr>
										<tr><td colspan="2" class='p_label'><label>Lastname</label></td></tr>
										<tr><td colspan="2" class="p_input"><input type="text" class="form-control" name='p_ln' id='p-ln' value="<?php echo $lastname?>" required></td></tr>
										<tr style="margin-top:10px;">
											<td><button type="button" class="btn form-control" id="p_mcp">Change Pass</button></td>
											<td><button id="p-upd" class="btn form-control" name="p_upd" type="button">Update</button></td>
										</tr>
									</table>
								</form>
							</div>
						</li>
						<li>
							<button id='btn_logout'><i class="fa fa-sign-out"></i></button>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div id="container">
			<div id="nav">
				<?php $user->get_nav()?>
			</div>

			<!-- Monitor -->
			<div id='view_div'>
				<h3>Area <span class='disp_area'></span></h3>

					<?php
						if ($_SESSION['user_type']==1) {
							echo "<select class='pull-right form-control' style='width:30%;' id='v-sel'>";
							$user->sel_area();
							echo"</select>";
						}
					?>
				<div>

				</div>
			</div>

			<!-- Documents -->
			<div id="doc_div">

				<h3>Area <span class='disp_area'></span></h3>
				<input type='hidden' id='anchor'>
					<?php
						echo"<select class='pull-right form-control' id='d-sel' style='width:30%;'>";
						$user->sel_area();
						echo "</select>";
					?>
				<div>

				</div>
			</div>

			<!-- Registration -->
			<div id='acct_div'>
				<h3><span>Accounts</span> <span style='font-size:11px;'>*Press the Account tab to view list of users.</span></h3>
				<button class='btn btn-info pull-right' id='btn_reg'>Register</button>
				<div>

				</div>
			</div>

			<!-- Backups -->
			<div id='bckup_div'>
				<h3><span>Archives</span></h3>
				<button class="btn btn-info  btn_shsetBackup">Setup</button>
				<button class="btn btn-info  btn_doBackup">Backup Now</button>
				<div>

				</div>
			</div>
		</div>
		<div id="footer">
			<div>
				<div id="footer" class="pull-left" style="color:white;font-size:18px;margin-bottom:10px;">
					<span>Courtesy of Sabay, Ivy et. al.</span>
				</div>
			</div>
		</div>
	</body>
</html>


<script type="text/javascript">
	var area = <?php echo json_encode($area);?>;
	var user_type = <?php echo json_encode($_SESSION['user_type']);?>;
	var uname_arr = <?php echo json_encode($unames);?>;
	var name_arr = <?php echo json_encode($names)?>;
	var id_arr = <?php echo json_encode($ids)?>;
</script>
<script type="text/javascript" src="js/script2.js"></script>
