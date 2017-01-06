<?php
include_once "db_conn.php";
	if(!isset($_SESSION['user_id'])){
		header('location:login.php');
	}
	include_once "db_conn.php";
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
	<head>
		<title>Monitoring Page</title>
	</head>
	<body>
		<div id="menu">
			<div>
				<div class="pull-left" style='color:white;font-size:17px;margin-top:10px;margin-left:-20px;'>
					<img src="css/evsu-logo.png">
					EVSU-CC Quality Assurance Archiving System
				</div>
				<div class="pull-right">
					<ul>
						<li id="notifications" style="margin-right:10px;">
							<button id="not_but">
								<i class="fa fa-bell">
								<span style="color:red;font-weight:bold;right:-5px;top:-5px;">
									<?php $docu->notification_count($_SESSION['user_id'], $_SESSION['area']); ?>
								</span>
								</i>
							</button>
						</li>
						<li id="profile">
							<?php
								$user_details = $user->get_name();
								extract($user_details);
							?>
							<button id="prof_but"><?php echo $firstname." ".$lastname;?></button>
							<div class="disp_hide" id="prof_div">
								<style type="text/css">
									#p-tbl{
										margin-top: 5px;
									}
									#p-tbl td{
										background: none;
									}
									.p_label{
										text-align: :right;
										height: 1px;
										vertical-align: bottom;
									}
									.p_label label{
										margin-bottom: 0px;
										margin-top: 10px;
									}
									.p_input{
										margin-top: 0px;
									}
									.p_input input{
										text-align: right;
										top:-1px;
										background: none;
									}
									#p-tbl button{
										margin-top: 15px;
									}
								</style>
								<form id="p-frm">
									<table id="p-tbl">
										<tr><td colspan="2" class="p_label"><label>Firstname</label></td></tr>
										<tr><td colspan="2" class="p_input" style="margin-top:0px;"><input type="text" class="form-control" id="p-fn" value="<?php echo $firstname?>" required name="p_fn"></td></tr>
										<tr><td colspan="2" class="p_label"><label>Lastname</label></td></tr>
										<tr><td colspan="2" class="p_input"><input type="text" class="form-control" name="p_ln" id="p-ln" value="<?php echo $lastname?>" required></td></tr> 
										<tr style="margin-top:10px">
											<td><button type="button" class="btn form-control" id="p_mcp">Change Pass</button></td>
										</tr>
									</table>
								</form>
							</div>
						</li>
						<li>
							<button id="btn_logout"><i class="fa fa-sign-out"></i></button>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div id="container">
			<div class="row">
				<div class="col-sm-12">
					<?php
						$user->get_nav();
					?>

					<div class="tab-pane active" id="view_div">
						<p style='color:white'>Monitor Div</p>
					</div>

					<div class="tab-pane" id="doc_div">
						<p style='color:white'>Document Div</p>
					</div>

					<div class="tab-pane" id="acct_div">
						<span style='color:white'>Account Div</span>
					</div>

					<div class="tab-pane" id="bckup_div">
						<span style='color:white'>Backup Div</span>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript">
		var area = <?php echo json_encode($area)?>;
		var user_type = <?php echo json_encode($_SESSION['user_type'])?>;
		var uname_arr = <?php echo json_encode($unames)?>;
		var name_arr = <?php echo json_encode($names)?>;
		var id_arr = <?php echo json_encode($ids)?>;
	</script>
	<script type="text/javascript" src="js/script2.js"></script>
</html>