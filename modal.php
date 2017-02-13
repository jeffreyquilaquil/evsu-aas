<div class="modal fade" id="download_alert" tabindex="-1" aria-hidden="true" role="dialog" aria-labelledBy="myDownloadModal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type='button' class='close' data-dismiss='modal' aria-label><span aria-hidden='true'>&times;</span>
				</button>
				<i class="fa fa-cloud-download"></i> Download
			</div>
			<div class="modal-body">
				<p></p>
			</div>
			<div class="modal-footer">
				<a> <button class='btn btn-info'></button></a>

			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-folder" tabindex="-1" aria-hidden="true" role="dialog" aria-labelledBy="CreateNewFolder">
	<div class="modal-dialog modal-sm">
		<span id="span" hidden></span>
		<div class="modal-content">
			<div class="modal-header">
				<button type='button' class='close' data-dismiss='modal' aria-label><span aria-hidden='true'>&times;</span>
				</button>
				<i class="fa fa-folder"></i> Folder Management
			</div>
			<div class="modal-body">
				<label for="folder-name"></label>

				<input class='form-control' type='text' id='new_folder' name='folder-name'>
			</div>
			<div class="modal-footer">
				<button class="btn btn-info">Submit</button>
				<button class="btn btn-success" data-dismiss='modal'>Cancel</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="view-download" tabindex="-1" aria-hidden="true" role="dialog" aria-labelledBy="ViewDownloadStatus">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-body">
				<div></div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="file-upload" tabindex="-1" aria-hidden="true" role="dialog" aria-labelledBy="MyUploadModal">
	<div class="modal-dialog modal-lg">
		<div class='modal-content'>
			<div class="modal-header">
				<button type='button' class='close' data-dismiss='modal' aria-label onclick='remove_upload()'><span aria-hidden='true'>&times;</span>
				</button>
				<i class='fa fa-upload'></i>File Upload</div>
			<div class="modal-body">
				<button class="btn btn-info" id="pickfiles"><i class="fa fa-plus"></i> Select Files</button>
				<button class="btn btn-info" id="uploadfiles"><i class="fa fa-upload"></i> Upload</button>
				<span style="color:red;font-weight:bold">*For multiple files, press ctrl then click file.</span>
				</br>
				<table class="table table-striped">
					<thead>
						<th width="50%">Filename</th>
						<th width="10%">Size</th>
						<th width="10%">Restriction</th>
						<th width="20%">User List</th>
						<th width="10%">Action</th>
					</thead>
					<tbody id="filelist">

					</tbody>
				</table>
				<pre id="errorList"></pre>
			</div>
			<div class="modal-footer"></div>
		</div>
	</div>
</div>

<!-- Allowing download -->
<div class='modal fade' id='allow_download' tabindex='-1' aria-hidden='true' role='dialog' aria-labelledBy='myAllowDownloadModal'>
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type='button' class='close' data-dismiss='modal' aria-label><span aria-hidden='true'>&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Allow Download for <span></span>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default pull-right" id='btn_ADC'>Reject</button>
				<button class="btn btn-default pull-right" id="btn_AD" style='margin-right:5px;'>Allow</button>
			</div>
		</div>
	</div>
</div>

<!-- Changing password. Obviously -->
<div class='modal fade' id="change_pass" tabindex="-1" aria-hidden="true" role="dialog" aria-labelledBy="myChangePassModal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">Change Password
				<button type='button' class="close" data-dismiss="modal" aria-label>
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="something.php" method="GET" name="frm_cp" id="frm_cp">
					<input type='hidden' value="<?php echo $_SESSION['pword']?>" id="cp_orp">
					<input class='form-control' name="cp_op" type="password" id="cp_op" required placeholder="Old Password">
					<br>
					<input type="password" class="form-control" name="cp_np" id="cp_np" required placeholder="New Password">
					<br>
					<input type="password" class="form-control" name="cp_cp" id="cp_cp" required placeholder="Confirm New Password">
					<input type='file' name='cp_file' id="cp_file">
					<input type='file' name='cp_file'>
				</form>
			</div>
			<div class="modal-footer">
				<button type='button' data-dismiss='modal' class="btn btn-default pull-right">Cancel</button>
				<button type='button' id="cp_but" class="btn btn-default pull-right" style="margin-right:5px;">Update</button>
			</div>
		</div>
	</div>
</div>

<!-- For setting backup interval -->
<div class="modal fade set_backup" tabindex='-1' aria-hidden="true" role="dialog" aria-labelledBy="BstaModalIniHya">
	<div class="modal-dialog modal-sm">
		<div class='modal-content'>
			<div class="modal-header">
				<button type='button' class="close" data-dismiss="modal" aria-label>
					<span aria-hidden="true">&times;</span>
				</button>				Set Backup Days Interval
			</div>
			<div class="modal-body">
				Days before next backup:
				<select class="form-control" id='slc_bckup'>
					<?php
						for ($i=1; $i < 100; $i++) {
							echo "<option value='{$i}'>{$i}</option>";
						}
					?>
				</select>
			</div>
			<div class='modal-footer'>
				<button class='btn btn-default pull-right' id='btn_hisetBckup'>Done</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="manage-folder" tabindex="-1" aria-hidden="true" role="dialog" aria-labelledBy="GeneralModal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label>
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<label>Folder Name</label>
				<input type="text" class="form-control">
				<input type="button" class="btn btn-default">Edit</button> |
				<input type="button" class="btn btn-danger">Remove</button>
			</div>
		</div>
	</div>
</div>

<!-- Last ni dapat -->
<div class='modal fade' id='message_alert' tabindex='-1' aria-hidden='true' role='dialog' aria-labelledBy='myAlertModal'>
	<div class='modal-dialog modal-sm'>
		<div class='modal-content'>
			<div class='modal-header'><i class='fa fa-warning' style='font-size:15px'></i> Alert</div>
			<div class='modal-body'><p></p></div>
			<div class='modal-footer'><button class=' btn btn-default' data-dismiss='modal'>Okay</button></div>
		</div>
	</div>
</div>
