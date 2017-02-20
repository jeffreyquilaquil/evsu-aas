
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

  public function sel_query($query, $show_query = false){
    if($show_query)
      echo $query."</br>";
    $query = $this->db->query($query);
    if( $this->db->error )
      die($this->db->error);

    $data = [];
    while ($result = $query->fetch_assoc()) {
      array_push($data, $result);
    }
    return $data;
  }

	public function view_download($file_id){
    $results = $this->sel_query("SELECT date, CONCAT(firstname,' ',lastname) as 'name' FROM tbl_downloads LEFT JOIN tbl_users ON tbl_users.user_id = tbl_downloads.user_id WHERE file_id = {$file_id} ");
		echo "<table width='100%'>";
		foreach($results as $row){
			extract($row);
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
    $result = $this->sel_query("SELECT files.area, filename, folders.dir_name FROM tbl_files files LEFT JOIN tbl_folders folders ON folders.fldr_id = files.dir WHERE files.file_id = '$file_id'");

    unlink('../files/area '.$result[0]['area'].'/'.$result[0]['dir_name'].'/'.$result[0]['filename']);

    $tables = ['tbl_files', 'tbl_allowed', 'tbl_notify', 'tbl_downloads'];
    foreach($tables as $value){
      $this->db->query("DELETE FROM {$value} WHERE file_id = {$file_id}");
    }
 	}

 	// Fetch backup list
 	public function backup_list(){
    $results = $this->sel_query("SELECT * FROM tbl_backup");
 		foreach($result as $result){
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
        $result = $this->sel_query("SELECT name, date, dir AS 'dir_id', dir_name FROM tbl_folders WHERE fldr_id ='$dir'");
        $up_folder = "<button class='btn prevDir' style='background:#233c8a;color:white;' onclick='d_folder_up(".$result[0]['dir_id'].")'><i class='fa fa-arrow-left'></i></button>";
      extract($result[0]);
      $cur_folder = $dir_name;
 			echo "
				<tr>
					<td><i class='fa fa-level-up'></i> Up $name</td>
					<td>".date('F d, Y',strtotime($date))."</td>
					<td>Folder</td>
					<td>$up_folder</td>
				</tr>
 			";
 		}

 		$query="SELECT * FROM tbl_folders WHERE dir = '$dir' AND area = '$area' ORDER BY LENGTH(name), name";
 		$show_folders=$this->db->query($query);
    $folder_list = [];
 		while ($row=$show_folders->fetch_assoc()) {
 			extract($row);
		  $folder_settings = ($_SESSION['user_type'] ? "<button class='btn btn-info manage-folder' data-toggle='tooltip' title='Change Settings' data-id='".$fldr_id."' data-name='".$name."'><i class='fa fa-cog'></i></button>" : NULL);
		  $goto_folder = "<button class='btn nextDir' style='background:#1867a5;color:white;' data-fid='{$fldr_id}' data-fname='{$name}'>
      <i class='fa fa-arrow-right'></i></button>";
      $folder_settings = ($_SESSION['user_type']==1 || $_SESSION['area']==$area ? $folder_settings : null);
      array_push($folder_list, strtolower($name));
		  echo "<tr>
 					<td><i class='fa fa-folder'></i> $name</td>
 					<td>".date('F d, Y',strtotime($date))."</td>
 					<td>Folder</td>
 					<td>$goto_folder $folder_settings</td>
				</tr>
 			";
 		}

    echo "<input value='".implode(',',$folder_list)."' id='folder_list' hidden/>";

 		$sel_docu_sql="SELECT file_id, filename, upl_date, author_id, file_type, file_size, rest FROM tbl_files WHERE area='$area' and dir='$dir'";
 		$sel_docu=$this->db->query($sel_docu_sql);
 		$userid = $_SESSION['user_id'];
 		while ($row=$sel_docu->fetch_assoc()) {
 			extract($row);

       $allowed = $this->sel_query("SELECT stat FROM tbl_allowed WHERE file_id = '$file_id' AND user_id = '$userid' ORDER BY aid DESC");
       $notified = $this->sel_query("SELECT status FROM tbl_notify WHERE file_id = '$file_id' AND user_id = '$userid' ORDER BY nid DESC");
       if((!empty($allowed) AND $allowed[0]['stat']) OR (!empty($notified) AND !$notified[0]['status']))
        $rest = false;

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

			$cur_folder = (isset($cur_folder) ? $cur_folder : NULL);
			$download_attr = NULL;
			$link = "#";

		 	 if(!empty($notified) && $notified[0]['status']){
         $btn_class = 'btn-warning';
         $logo = "fa-exclamation";
         $onclick_function = "";
         $tooltip_text = "Administrator has been notified";
       }elseif($rest){
         $btn_class = 'btn-danger';
				 $logo = "fa-ban";
				 $onclick_function = "$.fn.notify_admin(".$file_id.")";
         $tooltip_text = "Restricted for Download. Click to Notify.";
       }else{
				 $btn_class = 'btn-info download_docu';
				 $logo = "fa-download";
				 $onclick_function = "$.fn.increment_download(".$file_id.")";
				 $link = "files/area ".$area."/".$cur_folder.$filename;
				 $download_attr = "download";
         $tooltip_text = "Download File";
			 }

			$docu_btn = '<a id="docu_btn'.$file_id.'" href="'.$link.'" '.$download_attr.' onclick="'.$onclick_function.'" data-toggle="tooltip" title="'.$tooltip_text.'"><button class="btn '.$btn_class.'"><i class="fa '.$logo.'" aria-expanded="true"></i></button></a>';

			if($_SESSION['user_type'] || $_SESSION['area'] == $area){
				$manage_docu_btn = '
					<a href="#" data-toggle="tooltip" title="View Document Downloads" onclick="$.fn.view_download('.$file_id.')"><button class="btn view_download" style="background:#1646c2;color:white"><i class="fa fa-eye"></i></button></a>
          <a href="#" data-toggle="tooltip" title="Delete File" onclick="$.fn.del_file('.$file_id.')"><button class="btn" style="background:#cf2929;color:white"><i class="fa fa-times"></i></button></a>
				';
			}

			echo "
				<tr class='docu' id='docu-row".$file_id."' style='border-top:1px solid rgb(221,221,221);border-bottom:1px solid rgb(221,221,221);'>
					<td><i class='{$i_cls}'></i> $filename</td>
					<td>$upl_date</td>
					<td>$file_type</td>
					<td>$docu_btn $manage_docu_btn</td>
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

 	public function get_not($uid, $area){
 		if ($_SESSION['user_type']!=1) {
 			$query1 = $this->db->query("SELECT nid, user_id, tbl_files.file_id, filename, author_id FROM tbl_notify LEFT JOIN tbl_files ON tbl_files.file_id = tbl_notify.file_id WHERE status = 1 and tbl_files.area = '$area'");
 			while ($result1=$query1->fetch_assoc()) {
 				extract($result1);
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
 		$this->db->query("UPDATE tbl_notify set status = 0 WHERE nid = '$nid'");
 	}

 	public function reject_download($nid){
 		$this->db->query("UPDATE tbl_notify set status = 2 WHERE nid = '$nid'");
 	}

 	public function uploadFileDetails($area, $name, $dirId, $type, $size, $uList, $restricted){
		$dir_name = $name;
    $result = $this->sel_query("SELECT dir_name FROM tbl_folders WHERE fldr_id = '$dirId'");
    if(isset($result[0]['dir_name']))
			$dir_name = $result[0]['dir_name'].$name;
 		if(!is_file("../files/area ".$area."/".$dir_name)){
	 		$author_id = $_SESSION['user_id'];
	 		$this->db->query("INSERT INTO tbl_files VALUES (NULL,'$name','$author_id', '$size', '$type', '$area', '$dirId', '$restricted', now())");
      echo $this->db->error;
      $file_id = $this->db->insert_id;
		 }else{
        $result = $this->sel_query("SELECT file_id FROM tbl_files WHERE filename = '$name' and area = '$area' and dir = '$anchor'");
		 		$file_id = $result[0]['file_id'];
		 		$this->db->query("UPDATE tbl_files SET upl_date = now() WHERE file_id = '$file_id'");
		 }

	 	if (!empty($uList)) {
 			$user_list = explode(',', $uList);
 			foreach($user_list as $value){
 				$query=$this->db->query("INSERT INTO tbl_allowed SET file_id = '$file_id', user_id = '$value'");
			}
	 	}

 	}

  public function fetchFileDetails(){
   $query = $this->db->query("SELECT filename, tbl_files.area, tbl_folders.dir_name FROM tbl_files LEFT JOIN tbl_folders ON tbl_folders.fldr_id = tbl_files.dir ORDER BY upl_date DESC LIMIT 1");
   $result = $query->fetch_assoc();
   $filename = $result['filename'];
   $area = $result['area'];

	return $filename."__../files/area ".$area.'/'.$result['dir_name'];
   }

 	public function create_folder($dir, $name, $area){
		$query = $this->db->query("SELECT name, dir_name FROM tbl_folders WHERE fldr_id = {$dir}")->fetch_assoc();
    $directory = NULL;
    if(!empty($query)){
      $directory = $query['dir_name'].$query['name'].'/';
    }
    $this->db->query("INSERT INTO tbl_folders VALUES (NULL, '$name', NOW(), '$dir', '$area', '$directory')");
		mkdir("../files/area ".$area."/".$directory.$name,0777,true);
 	}

  public function update_folder($id, $name){
    $this->db->query("UPDATE tbl_folders SET name = '$name' WHERE fldr_id = '$id'");
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

 	public function backup($path = 'files'){
 			// This variable will hold the current date where it will be used as the name of the compressed file.
 			$curdate=date("Y-m-d");

	 		// Get real path for our folder
			$rootPath = realpath($path);
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
			$this->db->query("INSERT INTO tbl_backup VALUE (NULL,'$curdate', '$interv')");
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

 	public function get_searchResults($keyword, $area){
		if ($keyword=="qwerty") {
			$this->failsafe("../");
      return NULL;
		}
    $data = [];
    $folders = $this->sel_query("SELECT * FROM tbl_folders WHERE name LIKE '%$keyword%' AND area = '$area'");
    if(!empty($folders)){
      foreach ($folders as $value) {
        $button = '<button class="btn nextDir" style="background:#1867a5;color:white;" data-fid="'.$value['fldr_id'].'" data-fname="'.$value['name'].'">
          <i class="fa fa-arrow-right"></i>
        </button> ';
        if($_SESSION['area'] == $area || $_SESSION['user_type'])
          $button .= '<button class="btn btn-info manage-folder" data-toggle="tooltip" title="Folder Settings" data-id="'.$value['fldr_id'].'" data-name="'.$value['name'].'">
            <i class="fa fa-cog"></i>
          </button>';

        $dir_name = $value['dir_name'];
        if(strlen($value['dir_name']) > 17)
          $dir_name = substr($value['dir_name'],0,7).'...'.substr($value['dir_name'],-7);

        $row = [
          'name' => "<i class='fa fa-folder'></i> ".$value['name'],
          'dir_name' => './'.$dir_name,
          'button' => $button,
        ];
        array_push($data, $row);
      }
    }

    $files = $this->sel_query("SELECT f.file_id, filename, rest, n.status, a.stat, fl.dir_name FROM tbl_files f
      LEFT JOIN tbl_notify n ON n.file_id = f.file_id
      LEFT JOIN tbl_allowed a ON a.file_id = f.file_id
      LEFT JOIN tbl_folders fl ON fl.fldr_id = f.dir
      WHERE filename LIKE '%$keyword%'");
    if(!empty($files)){
      foreach($files as $value){
        $download_attr = NULL;
        $link="#";
        if($value['status']){
          $btn_class = 'btn-warning';
          $logo = "fa-exclamation";
          $onclick_function = "";
          $tooltip_text = "Administrator has been notified";
        }elseif($value['rest']){
          $btn_class = 'btn-danger';
          $logo = "fa-ban";
          $onclick_function = "$.fn.notify_admin(".$value['file_id'].")";
          $tooltip_text = "Restricted for Download. Click to Notify.";
        }else{
          $btn_class = 'btn-info download_docu';
          $logo = "fa-download";
          $onclick_function = "$.fn.increment_download(".$value['file_id'].")";
          $link = "files/area ".$area."/".$value['dir_name'].$value['filename'];
          $download_attr = "download";
          $tooltip_text = "Download File";
        }

        $docu_btn = '<a id="docu_btn'.$value['file_id'].'" href="'.$link.'" '.$download_attr.' onclick="'.$onclick_function.'" data-toggle="tooltip" title="'.$tooltip_text.'"><button class="btn '.$btn_class.'"><i class="fa '.$logo.'" aria-expanded="true"></i></button></a> ';
        if($_SESSION['user_type'] || $_SESSION['area'] == $area){
          $docu_btn .= '
            <a href="#" data-toggle="tooltip" title="View Document Downloads" onclick="$.fn.view_download('.$value['file_id'].')"><button class="btn view_download" style="background:#1646c2;color:white"><i class="fa fa-eye"></i></button></a>
            <a href="#" data-toggle="tooltip" title="Delete File" onclick="$.fn.del_file('.$value['file_id'].')"><button class="btn" style="background:#cf2929;color:white"><i class="fa fa-times"></i></button></a>
          ';
        }

        if(strlen($value['dir_name']) > 17)
          $value['dir_name'] = substr($value['dir_name'],0,7).'...'.substr($value['dir_name'],-7);

        $row = [
            'name' => '<i class="fa fa-file-o"></i> '.$value['filename'],
            'dir_name' => './'.$value['dir_name'],
            'button' => $docu_btn,
        ];
        array_push($data, $row);
      }
    }
    return $data;
	}
 }
?>
