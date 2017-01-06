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
<<<<<<< HEAD
	<link rel="stylesheet" href="css/footer-distributed-with-address-and-phones.css">

=======
>>>>>>> 130510f3927dfa86a848824eb300a3d41502740d

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
<<<<<<< HEAD
				<div class="pull-left" style='color:white;font-size:25px;margin-top:10px;margin-left:-20px;font-family:Matura MT Script Capitals;text-shadow: 2px 2px 4px #000000;'><img src="images-slider/EVSULogo.png" style="height:30px;width:30px;">
					EVSU-CC Quality Assurance Archiving System
=======
				<div class="pull-left" style='color:white;font-size:17px;margin-top:0px;mmargin-left:-20px;'>
					<img src="css/evsu-logo.png">
					EVSU-CC Quality Assurance Archiiving System
>>>>>>> 130510f3927dfa86a848824eb300a3d41502740d
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

			<!-- Areas -->
			<div id='area_div'>
				<h3><span>Areas</span></h3>
				<div></div>
			</div>

				</div>
			</div>
		</div>
<<<<<<< HEAD
		
			<!-- The content of the page would go here.
					footer starts here
			 -->

		<footer class="footer-distributed">

			<div class="footer-left">
				<div class="pull-left">
					<img src="css/Banner.png" alt="" style="wdith:150px;height:150px;float:left;margin-left:-80px;">
				</div>
				<p class="footer-links">
					<a href="#">Home</a>
					·
					<a href="#">Blog</a>
					·
					<a href="#">Pricing</a>
					·
					<a href="#">About</a>
					·
					<a href="#">Faq</a>
					·
					<a href="#">Contact</a>
				</p>

				<p class="footer-company-name">Evsu-cc Quality Assurance Archiving System &copy; 2016</p>
			</div>

			<div class="footer-center">

				<div>
					<i class="fa fa-map-marker"></i>
					<p><span>Barugohay Norte</span>Carigara, Leyte</p>
				</div>

				<div>
					<i class="fa fa-phone"></i>
					<p>+1 555 123456</p>
				</div>

				<div>
					<i class="fa fa-envelope"></i>
					<p><a href="#">evsucc@support.com</a></p>
				</div>

				<div>
					<i class="fa fa-user"></i>
					<p><span><b>Developed by:</b><br><a href="https://www.facebook.com/jerson.apostol.71">Jerson Apostol</a> &emsp;
						<a href="#">Karlo Aruta </a>&emsp;
						<a href="#">Ivy Sabay</a> &emsp;
						<a href="#"><a href="#">Herbert Burdan</a> &emsp;
						<a href="#"><a href="#">Rona Darnayla </a>
						</a></span><br></p>
						<p><span><img src="css/evsu-logo.png" alt="" style="width:30px;height:30px;">
							Eastern Visayas State University Carigara Campus <br>All rights reserve &copy; 2016</span></p>
				</div>

			</div>

			<div class="footer-right">

				<p class="footer-company-about">
					<span>EVSU-Carigara Campus/PHILOSPHY</span>
					&emsp;&emsp;EVSU Carigara Campus addresses its academic endeavors towards the development of the socio-economic condition of Region VIII by emphasizing the development of human resources as a necessary input of production and growth. It plays a major role in providing the human resources for industrial agri-business enterprises as well as small, medium and large-scale industries, which are components for regional development.
				</p>

				<div class="footer-icons">

					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
					<a href="#"><i class="fa fa-linkedin"></i></a>
					<a href="#"><i class="fa fa-github"></i></a>

				</div>

			</div>

		</footer>
					<!-- End of Footer here -->

=======
		<div id="footer">
			<div>
				<div id="footer" class="pull-left" style="color:white;font-size:18px;margin-bottom:10px;">
					<span>Courtesy of Sabay, Ivy et. al.</span>
				</div>
			</div>
		</div>
>>>>>>> 130510f3927dfa86a848824eb300a3d41502740d
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
