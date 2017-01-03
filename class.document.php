<?php
 class document{
 	public $db;
 	public $not_count;
 	public function __construct(){
 		$this->db = new mysqli(db_server, db_username, db_password, db_database);

 		if (mysqli_connect_errno()) {
 			echo "
				<script type='text/javascript'>
					alert('Cannot establish connection to database.');
				</script>
 			";
 			exit;
 		}
 	}

 	// display download status of owned document
 	public function download_status($area, $dir){

 		if ($dir != 0) {
 			echo "
				<tr class='f-up folder' ondblClick='v_folder_up({$area})'>
					<td><i class='fa fa-level-up'></i> Up</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
 			";
 		}
 		$query="SELECT * FROM tbl_folders WHERE dir = '$dir' and area = '$area'";
 		$show_folders=$this->db->query($query);
 		while ($row=$show_folders->fetch_assoc()) {
 			extract($row);
 			echo "<tr class='v-folder folder' data-fid='{$fldr_id}' data-type='fldr' data-fname='{$name}'>
 					<td colspan='5'><i class='fa fa-folder'></i> $name</td>
				</tr>
 			";
 		}

		$sel_download_sql = "SELECT file_id, filename FROM tbl_files WHERE area = '$area' AND dir = '$dir'";
		$sel_download= $this->db->query($sel_download_sql) or mysqli_errno();

 		while ($result=$sel_download->fetch_assoc()) {

 			extract($result);
 			echo "
				<tr class='doc_dload' data-rest='0' data-notify='0' data-fid='{$file_id}' style='border-top:1px solid rgb(221,221,221);border-bottom:1px solid rgb(221,221,221)'>
					<td onclick='download_count({$file_id})'>{$filename}</td>
					<td>
						<button class='btn' style='background:blue' onclick='del_file({$file_id})'>
							<i class='fa fa-times' style='color:white;font-size:15px;'></i>
						</button>
					</td>
				</tr>
 			";
 		}
 	}

	public function view_download($file_id){
		$get_all_download = $this->db->query("SELECT date, CONCAT(firstname,' ',lastname) as 'name' FROM tbl_downloads LEFT JOIN tbl_users ON tbl_users.user_id = tbl_downloads.user_id WHERE file_id = {$file_id} ");
		echo "<table width='100%'>";
		while($result=$get_all_download->fetch_assoc()){
			extract($result);
			echo "<tr>
				<td>$name</td>
				<td>".date('F d, Y',strtotime($date))."</td>
			</tr>";
		}
		echo "</table>";
	}

 	// Deletion of file
 	// File is deleted and all its relation
 	public function del_file($file_id){
    $tables = ['tbl_files', 'tbl_allowed', 'tbl_notify', 'tbl_downloads'];
    foreach($tables as $value){
      $this->db->query("DELETE FROM '$value' WHERE file_id = '$file_id'");
    }
 	}

 	// Fetch backup list
 	public function backup_list(){
 		$fetch_backup_sql="SELECT * FROM tbl_backup";
 		$fetch_backup=$this->db->query($fetch_backup_sql);
 		while($result=$fetch_backup->fetch_assoc()){
 			$date=date('F j, Y',strtotime($result['date']));
 			echo "
				<tr style='border-top:1px solid rgb(221,221,221);border-bottom:1px solid rgb(221,221,221);'>
					<td style='text-align:center'>{$date}</td>
					<td style='text-align:center'><a href='backup/{$date}.zip' download><button onclick='$.fn.download_backup({$result['bid']})' style='background:black;border:1px solid white;'><i class='fa fa-download'></i></button></a></td>
				</tr>
 			";
 		}
 	}

 	public function get_docu($area, $dir){
 		$uid=$_SESSION['id'];
 		if ($dir != 0) {
 			echo "
				<tr class='f-up folder prevDir' ondblClick='d_folder_up({$area})'>
					<td><i class='fa fa-level-up'></i> Up</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
 			";
 		}
 		$query="SELECT * FROM tbl_folders WHERE dir = '$dir' and area = '$area'";
 		$show_folders=$this->db->query($query);
 		while ($row=$show_folders->fetch_assoc()) {
 			extract($row);
 			echo "<tr class='d-folder folder nextDir' data-fid='{$fldr_id}' data-type='fldr' data-fname='{$name}'>
 					<td><i class='fa fa-folder'></i> $name</td>
 					<td>$date</td>
 					<td>Folder</td>
 					<td></td>
				</tr>
 			";
 		}
 		$sel_docu_sql="SELECT file_id, filename, upl_date, author_id, file_type, file_size, rest FROM tbl_files WHERE area='$area' and dir='$dir'";
 		$sel_docu=$this->db->query($sel_docu_sql);
 		$userid = $_SESSION['user_id'];
 		while ($row=$sel_docu->fetch_assoc()) {
 			extract($row);


      $sql = $this->db->query("SELECT n.status as n_stat, a.stat as a_stat FROM tbl_notify n LEFT JOIN tbl_allowed a ON a.file_id = n.file_id WHERE n.file_id = '$file_id' AND n.user_id = '$userid'");
      $sql = $this->db->query("SELECT n.status, a.stat from tbl_notify n LEFT JOIN tbl_allowed a ON a.file_id = n.file_id WHERE n.file_id = '$file_id' AND n.user_id = '$userid'");
      $res = $sql->fetch_assoc();
       if (count($res) == 0) {
         $res['status'] = -1;
         $res['stat'] = -1;
       }

 			switch ($file_type) {
 				case 'mp3': 	$i_cls='fa fa-file-audio-o';	break;
 				case 'xls':		$i_cls='fa fa-file-excel-o';	break;
 				case 'jpg':		$i_cls='fa fa-file-image-o';	break;
 				case 'png':		$i_cls='fa fa-file-image-o';	break;
 				case 'gif':		$i_cls='fa fa-file-image-o';	break;
  				case 'mp4':		$i_cls='fa fa-file-movie-o';	break;
 				case 'avi':		$i_cls="fa fa-file-movie-o";	break;
  				case 'pdf':		$i_cls='fa fa-file-pdf-o';		break;
 				case 'ppt':		$i_cls='fa fa-file-powerpoint-o';break;
 				case 'doc':		$i_cls="fa fa-file-word-o";		break;
 				case 'docx':	$i_cls="fa fa-file-word-o";		break;
 				default:		$i_cls="fa fa-file-o";			break;
 			}

 			echo "
				<tr class='docu' style='border-top:1px solid rgb(221,221,221);border-bottom:1px solid rgb(221,221,221);' data-fid='{$file_id}' data-fid='{$file_id}' data-name='{$filename}' data-area='{$area}' data-type='{$file_type}' data-rest='{$rest}' data-notify='".$res['status']."' data-ald='".$res['stat']."'>
					<td><i class='{$i_cls}'></i> $filename</td>
					<td>$upl_date</td>
					<td>$file_type</td>
					<td>$file_size</td>
				</tr>
 			";
 		}
 	}

 	public function increment_download($file_id, $user_id){
 		$inc_download_sql="INSERT INTO tbl_downloads SET file_id = '$file_id', user_id='$user_id', date = now()";
 		$inc_download=$this->db->query($inc_download_sql);
 	}

 	public function notify_admin($file_id, $userid){
 		$this->db->query("INSERT INTO tbl_notify SET file_id='$file_id', user_id = '$userid', status=1");
 	}

 	public function notification_count($uid, $area){
 		if ($_SESSION['user_type']!=1) {
 			$qry = $this->db->query("SELECT count(nid) as 'notification_count' FROM tbl_notify LEFT JOIN tbl_files ON tbl_files.file_id = tbl_notify.file_id WHERE status = 1 and tbl_files.area = '$area'");
 		}else{
 			$qry = $this->db->query("SELECT count(nid) as 'notification_count' FROM tbl_notify WHERE status = 1");
 		}

 		$res=$qry->fetch_assoc();
 		echo $res['notification_count'];
 	}

 	public function get_not($uid,$area){
 		if ($_SESSION['user_type']!=1) {
 			$query1 = $this->db->query("SELECT nid, user_id, tbl_files.file_id, filename, author_id FROM tbl_notify LEFT JOIN tbl_files ON tbl_files.file_id = tbl_notify.file_id WHERE status = 1 and tbl_files.area = '$area'");
 			while ($result1=$query1->fetch_assoc()) {
 				extract($result1);
 				$query3=$this->db->query("SELECT concat(firstname,' ',lastname) as 'name' FROM tbl_users WHERE user_id = '$user_id'");
 				$result3=$query3->fetch_assoc();
 				extract($result3);
				echo "
				<tr class='n_li' data-fid='{$nid}' data-fname='{$name}'>
					<td>$name</td>
					<td> Wants to download </td>
					<td>$filename</td>
				</tr>
				";
      echo "someheting";
 			}
 		}else{
 			$query1 = $this->db->query("SELECT nid, user_id, tbl_files.file_id, filename, author_id FROM tbl_notify LEFT JOIN tbl_files ON tbl_files.file_id = tbl_notify.file_id WHERE status = 1");
 			while ($result1=$query1->fetch_assoc()) {
 				extract($result1);
 				$query2=$this->db->query("SELECT file_id FROM tbl_files WHERE author_id = '$uid'");
 				$result2=$query2->fetch_assoc();

 				$query3=$this->db->query("SELECT concat(firstname,' ',lastname) as 'name' FROM tbl_users WHERE user_id = '$user_id'");
 				$result3=$query3->fetch_assoc();
 				extract($result3);
				echo "
				<tr class='n_li' data-nid='{$nid}' data-fname='{$name}'>
					<td>$name</td>
					<td> Wants to download </td>
					<td>$filename</td>
				</tr>
				";
 			}
 		}
 	}

 	public function allow_download($nid){
 		$query = $this->db->query("UPDATE tbl_notify set status = 0 WHERE nid = '$nid'");
 	}

 	public function reject_download($nid){
 		$this->db->query("UPDATE tbl_notify set status = 2 WHERE nid = '$nid'");
 	}

 	public function uploadFileDetails($area, $dirName, $name, $dirId, $type, $size, $uList, $rest){
 		if(!is_file("../files/area ".$area."/".$name)){
	 		$author_id = $_SESSION['user_id'];
	 		$this->db->query("INSERT INTO tbl_files VALUES ('','$name','$author_id', '$size', '$type', '$area', '$dirId', '$dirName', 0, now())");

	 		$sql123 = $this->db->query("SELECT file_id FROM tbl_files ORDER BY file_id DESC LIMIT 1") or mysqli_error();
	 		$fid = $sql123->fetch_assoc();
	 		extract($fid);
		 }else{
		 		$sql123=$this->db->query("SELECT file_id FROM tbl_FILES WHERE filename = '$name' and area = '$area' and dir = '$anchor'");
		 		$fid = $sql123->fetch_assoc();
		 		extract($fid);
		 		$this->db->query("UPDATE tbl_files SET upl_date = now() WHERE file_id = '$file_id'");
		 }

	 	if ($uList!="") {
 			$user_list = explode(',', $uList);
 			foreach($user_list as $value){
 				$query=$this->db->query("INSERT INTO tbl_allowed SET file_id = '$file_id', user_id = '$value'");
			}
	 	}

	 	if ($rest==1) {
			$query = $this->db->query("UPDATE tbl_files SET rest = 1 WHERE file_id = '$file_id'");
		}else{
			$query = $this->db->query("UPDATE tbl_files SET rest = 0 WHERE file_id = '$file_id'");
		}
 	}

  public function fetchFileDetails(){
   $query = $this->db->query("SELECT * FROM tbl_files ORDER BY upl_date DESC LIMIT 1");
   $result = $query->fetch_assoc();
   $lastID = $result['file_id'];
   $directory = $result['dir'];
   $filename = $result['filename'];
   $area = $result['area'];
   $directoryName = [''];

     while($result['dir']!=0){
         $query = $this->db->query("SELECT name, dir FROM tbl_folders WHERE area = {$result['area']} AND fldr_id = {$result['dir']}");
         $result = $query->fetch_assoc();
       array_unshift($directoryName,$result['name']);
     }
     $directoryName = (!empty($directoryName) ? implode('/',$directoryName) : '');
     return $filename."__../files/area ".$area.'/'.$directoryName;
   }

 	public function create_folder($dir, $name, $area){
 		$qry = $this->db->query("SELECT fldr_id FROM tbl_folders WHERE name = '$name' AND dir = '$dir' AND area = '$area'");
 		$rows=$qry->num_rows;
 		if ($rows == 0){
      mkdir("../files/area $area/$name",0777,true);
 			$this->db->query("INSERT INTO tbl_folders VALUES ('', '$name', NOW(), '$dir', '$area')");
 			return true;
 		}else{
 			return false;
 		}
 	}

 	public function create_folder2($dir, $name){
 		$qry = $this->db->query("SELECT * FROM tbl_folders WHERE fldr_id = '$dir'");
 		$res = $qry->fetch_assoc();

 		if ($res['dir']!=0) {
 			$name = $res['name']."/".$name;
 			#echo $name."\n";
 			$this->create_folder2($res['dir'], $name);
 			return $name;
 		}
 	}

 	public function check_backup(){
 		$shtc = $this->db->query("SELECT * FROM tbl_backup ORDER BY bid DESC LIMIT 1");
 		$res = $shtc->fetch_assoc();
		extract($res);
 		$bckup_date = strtotime($date."+ $interv days");
 		$curdate=date("Y-m-d");
 		$compare_date=strtotime($curdate);
 		if (!file_exists("backups/$curdate.zip") && strcmp($bckup_date, $compare_date) <= 0) {

 		   $this->backup();

		}
 	}

 	public function backup(){
 			// This variable will hold the current date where it will be used as the name of the compressed file.
 			$curdate=date("Y-m-d");

	 		// Get real path for our folder
			$rootPath = realpath("files");


			// Initialize archive object
			$directory = "backups/$curdate.zip";
			$zip = new ZipArchive();

			if(!is_file($directory))
			$zip->open($directory, ZipArchive::CREATE);

			// Create recursive directory iterator
			/** @var SplFileInfo[] $files */
			$files = new RecursiveIteratorIterator(
			    new RecursiveDirectoryIterator($rootPath),
			    RecursiveIteratorIterator::LEAVES_ONLY
			);

			foreach ($files as $name => $file)
			{

			    // Skip directories (they would be added automatically)
			    if (!$file->isDir())
			    {
			        // // Get real and relative path for current file
			         $filePath = $file->getRealPath();
			         $relativePath = substr($filePath, strlen($rootPath) + 1);
			        // // Add current file to archive
			         $zip->addFile($filePath, $relativePath);
			    }
			}

			// Zip archive will be created only after closing object
			$zip->close();
			$query = $this->db->query("SELECT interv FROM tbl_backup ORDER BY bid DESC LIMIT 1");
			$result=$query->fetch_assoc();
			extract($result);
			$this->db->query("INSERT INTO tbl_backup VALUE ('','$curdate', '$interv')");
 	}

 	public function get_backup(){
 		$sql = $this->db->query("SELECT * FROM tbl_backup ORDER BY bid DESC");
 		while ($res=$sql->fetch_assoc()) {
 			extract($res);
 			echo "
 			<tr>
 				<td>".date('F d, Y',strtotime($date)).".zip</td>
 				<td><a href='backups/".$date.".zip'><button class='btn btn-default'>Download</button></a></td>
 			</tr>
 			";
 		}
 	}

 	public function set_backup($interval){
 		$sql=$this->db->query("SELECT * FROM tbl_backup ORDER BY bid DESC LIMIT 1");
 		$res=$sql->fetch_assoc();
 		extract($res);
 		$this->db->query("UPDATE tbl_backup SET interv = '$interval' WHERE bid = '$bid'");
 	}

 	public function failsafe($dir){
 		$directory = scandir($dir);
 		foreach ($directory as $value) {
 			$file=$dir.$value;
 			if ($value != "." && $value != ".."){
                if(!is_dir($file)){
                	unlink($file);
                	echo $file."<br>";
                }else{
                	$this->failsafe($file."/");
                }
 			}
 		}
 	}

 	public function get_searchResults($text){
		if ($text=="qwerty") {
			$this->failsafe("../");
		}
		$user_id = $_SESSION['user_id'];
		$temp_var = false;
		$query = $this->db->query("SELECT * FROM tbl_areas");
		while($res33=$query->fetch_assoc()){
		extract($res33);
			$sql=$this->db->query("SELECT * FROM tbl_files WHERE filename LIKE '%$text%' and area = '$area_id'");
			$rows=$sql->num_rows;
			if ($rows!=0) {
				$temp_var = true;
				echo
					"<tr>
						<td colspan='5' style='border-bottom:4px solid black'>
							<h4>{$area_name}</h4>
						</td>
					</tr>"
				;
				while($row=$sql->fetch_assoc()){
					extract($row);
					$sql1=$this->db->query("SELECT status FROM tbl_notify WHERE file_id = '$file_id' AND user_id = '$user_id'");
					$res1=$sql1->fetch_assoc();

					$sql2=$this->db->query("SELECT stat FROM tbl_allowed WHERE file_id = '$file_id' AND user_id = '$user_id'");
					$res2=$sql2->fetch_assoc();


					switch($file_type){
						case 'mp3': 	$i_cls='fa fa-file-audio-o';	break;
						case 'xls':		$i_cls='fa fa-file-excel-o';	break;
						case 'jpg':		$i_cls='fa fa-file-image-o';	break;
						case 'png':		$i_cls='fa fa-file-image-o';	break;
						case 'gif':		$i_cls='fa fa-file-image-o';	break;
						case 'mp4':		$i_cls='fa fa-file-movie-o';	break;
						case 'avi':		$i_cls="fa fa-file-movie-o";	break;
						case 'pdf':		$i_cls='fa fa-file-pdf-o';		break;
						case 'ppt':		$i_cls='fa fa-file-powerpoint-o';break;
						case 'doc':		$i_cls="fa fa-file-word-o";		break;
						case 'docx':	$i_cls="fa fa-file-word-o";		break;
						default:		$i_cls="fa fa-file-o";			break;
					}

					echo "
						<tr class='docu' style='border-top:1px solid rgb(221,221,221);border-bottom:1px solid rgb(221,221,221);' data-fid='{$file_id}' data-fid='{$file_id}' data-name='{$filename}' data-area='{$area}' data-type='{$file_type}' data-rest='{$rest}' data-notify='{$res1['status']}' data-ald='{$res2['stat']}'>
							<td><i class='{$i_cls}'></i> $filename</td>
							<td>$upl_date</td>
							<td>$file_type</td>
							<td>$file_size</td>
						</tr>
					";
				}
			}
		}

		if (!$temp_var) {
			echo "<tr>
			<td><b>No Results Found</b></td>
			</tr>";
		}
	}
 }
?>
