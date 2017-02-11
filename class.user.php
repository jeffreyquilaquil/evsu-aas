<?php
	class user{
		public $db;
		public function __construct(){
			$this->db = new mysqli(db_server,db_username, db_password, db_database);

			if(mysqli_connect_errno()){
				echo "
					<script type='text/javascript'>
						alert('Cannot establish connection to database.');
					</script>
				";
				exit;
			}
		}

		// Registration of users
		public function reg_user($fname,$lname,$uname,$pword,$type,$area){

				$reg_user_sql="INSERT INTO tbl_users SET firstname='$fname', lastname='$lname', username='$uname', password='$pword',user_type='$type',user_status=1,area='$area',f_login=1";
				$reg_user=$this->db->query($reg_user_sql) or die(mysqli_error());

		}

		public function view_user($user_id){
			$fetch_user_sql="SELECT *, area_name FROM tbl_users LEFT JOIN tbl_areas ON tbl_areas.area_id = tbl_users.area WHERE user_id = '$user_id' ";
			$fetch_user=$this->db->query($fetch_user_sql) or mysqli_error();
			$result=$fetch_user->fetch_assoc();
			return $result;
		}

		public function get_user_area(){
			if ($_SESSION['user_type']==1) {
				return 1;
			}else{
				return $_SESSION['area'];
			}
		}

		// For checking login
		public function check_user($uname,$pword){
			$check_user_sql = "SELECT * FROm tbl_users WHERE username = '$uname' AND password = '$pword'";

			// Check results;
			$query=$this->db->query($check_user_sql);
			$user=$query->fetch_assoc();
			$row=$query->num_rows;

			if ($row==1) {

				$_SESSION['login']=true;
				$_SESSION['id']=$user['user_id'];
				$_SESSION['type']=$user['user_type'];
				$_SESSION['user_name']=$user['firstname']." ".$user['lastname'];
				$_SESSION['uname']=$user['username'];
				$_SESSION['pword']=$user['password'];
				$_SESSION['user_id']=$user['user_id'];
				$_SESSION['user_type']=$user['user_type'];
				$_SESSION['area']=$user['area'];
				header('location:index.php');
			}else{
				echo "<script type='text/javascript'>alert('Wrong username or password.');</script>";
			}
		}

		public function get_nav(){
			$admin_priv="";
			if ($_SESSION['user_type']==1) {
				$admin_priv = "
					<td id='acct_nav' class='navs' onclick='display_div(3)'>Accounts</td>
					<td id='arch_nav' class='navs' onclick='display_div(4)'>Archives</td>
					<td id='area_nav' class='navs' onclick='display_div(5)' style='width:10%;'>Areas</td>
				";
			}

			echo"
				<table style='background:#3090C3;color:white;'>
					<tr>
						<td id='doc_nav' class='navs active' onclick='display_div(2)'>Documents</td>
						$admin_priv
					</tr>
				</table>
			";

		}

		public function get_session(){
			return $_SESSION['login'];
		}

		public function sel_area(){
			$sql=$this->db->query("SELECT * FROM tbl_areas");
			while($row=$sql->fetch_assoc()){
				extract($row);
				echo "<option value='{$area_id}'>$area_name</option>";
			}

		}

		public function get_name(){

			$uid=$_SESSION['user_id'];
			$sql="SELECT * FROM tbl_users WHERE user_id = '$uid'";
			$query=$this->db->query($sql);
			$result=$query->fetch_assoc();
			return $result;
		}

		public function logout(){
			$_SESSION['login']=FALSE;
			session_destroy();
		}

		public function user_list(){
			$sel_users_sql="SELECT user_id, concat(firstname,' ',lastname) as 'name',username, user_type, user_status, area_name FROM tbl_users LEFT JOIN tbl_areas ON tbl_areas.area_id=tbl_users.area";
			$sel_users=$this->db->query($sel_users_sql) or mysqli_error();

			while ($result=$sel_users->fetch_assoc()) {
				extract($result);
				$user_type=($user_type==1?'Admin':'Chairman');
				$user_status=($user_status==1?'Active':'Inactive');

				echo "
					<tr>
						<td>$name</td>
						<td>$username</td>
						<td>$area_name</td>
						<td>$user_type</td>
						<td>$user_status</td>
						<td><button onclick='edit_user(".$user_id.")'><i class='fa fa-edit'><i></button></td>
					</tr>
				";
			}
		}

		public function update_user($user_id, $lastname, $firstname, $assigned_area, $user_type, $user_status){
			$upd_user_sql="UPDATE tbl_users SET firstname='$firstname', lastname='$lastname', area='$assigned_area', user_type='$user_type', user_status='$user_status' WHERE user_id='$user_id'";
			$upd_user=$this->db->query($upd_user_sql) or mysql_error();
		}
		public function upd_user_self($uid, $p_fn, $p_ln){
			$query=$this->db->query("UPDATE tbl_users SET firstname='$p_fn', lastname='$p_ln' WHERE user_id = '$uid'");
		}
		public function change_pass($user_id, $pass){
			$query=$this->db->query("UPDATE tbl_users SET password = '$pass' WHERE user_id = '$user_id'");
		}

		public function get_areas($id = ""){
			$sel_area_sql="SELECT * FROM tbl_areas";
			$sel_area=$this->db->query($sel_area_sql);

			$area_array=[];
			while ($result=$sel_area->fetch_assoc()) {
				extract($result);
				if(!empty($id) && $id == $area_id){
					return ['id'=>$area_id, 'name'=>$area_name];
				}
				array_push($area_array,['id'=>$area_id,'name'=>$area_name]);
			}

			return $area_array;
		}

		public function register_area($name, $no){
			$this->db->query("INSERT INTO tbl_areas SET area_name='$name', SET area_no='$no'");
			$id = $this->db->query("SELECT area_id FROM tbl_areas ORDER BY area_id DESC");
			$id = $id->fetch_assoc() or mysql_error();
			mkdir("../files/area ".$id['area_id']);
		}

		public function update_area($id, $name){
			 $this->db->query("UPDATE tbl_areas SET area_name = '$name' WHERE area_id = '$id'");
		}

		public function get_questions(){
			$query=$this->db->query("SELECT * FROM tbl_questions");
			while ($result=$query->fetch_assoc()) {
				extract($result);
				echo "<option value='{$qid}'>$question</option>";
			}
		}

		public function get_unames(){
			$sel_uname_sql="SELECT username FROM tbl_users";
			$sel_uname=$this->db->query($sel_uname_sql) or mysqli_errno();
			$uname_arr=array();
			while ($result=$sel_uname->fetch_assoc()) {
				array_push($uname_arr,$result['username']);
			}
			$uname_arr=implode(',', $uname_arr);
			return $uname_arr;
		}

		public function get_flNames(){
			$query=$this->db->query("SELECT concat(firstname,' ',lastname) as 'name' FROM tbl_users");
			$names_arr=array();
			while ($res=$query->fetch_assoc()) {
				array_push($names_arr,$res['name']);
			}
			$names_arr=implode(',', $names_arr);
			return $names_arr;

		}

		public function get_ids(){
			$query=$this->db->query("SELECT user_id FROM tbl_users");
			$ids_arr=array();
			while ($res=$query->fetch_assoc()) {
				array_push($ids_arr,$res['user_id']);
			}
			$ids_arr=implode(",",$ids_arr);
			return $ids_arr;
		}
	}
?>
