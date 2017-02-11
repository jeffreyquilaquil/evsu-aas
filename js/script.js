$(document).ready(function(){
	 directory = [];
	$(document).on('click','.nextDir',function(){
		directory.push($(this).data('fname'));
	});
	$(document).on('click','.prevDir',function(){
		directory.pop();
	});

	$(document).on('change','#d-sel',function(){
		area = $(this).val();
		$('#anchor').val('0');
	});

	// Document and folder search
	$('#search_bar').keyup(function(){
		if( $(this).val() == '' ){
			$.ajax({
				data:'area='+$("#d-sel").val()+'&dir=0',
				url:'ajax/dload_doc.php',
			}).done(function(resp){
				$("#doc_div > div").html(resp);
			});
			return false;
		}
		$.ajax({
			data:'keyword='+$(this).val()+"&area="+$("#d-sel").val(),
			url:'ajax/search_doc.php'
		}).done(function(resp){
			$("#doc_div > div").html(resp);
		});
	});

	// Download Button
	$.fn.increment_download=function(file_id){
		pass_spec_data( {'file_id':file_id}, 'increment_download');
		alert_message("Download Successful");
	 };

	$.fn.notify_admin=function(file_id){
		$('#docu_btn'+file_id).removeAttr('onclick');
		$('#docu_btn'+file_id+' button').css('background','#ecdf34');
		$('#docu_btn'+file_id+' i').removeClass('fa-ban').addClass('fa-exclamation');

		pass_spec_data({'file_id':file_id},'notify');
		alert_message("Admin notified");
	}

	$.fn.view_download=function(file_id){
		var resp = pass_spec_data( {'file_id':file_id},'view_download');
		$('#view-download .modal-body > div').html(resp);
		$('#view-download').modal('toggle');
	}

// Folder Functions
// Create Folder
	$(document).on('click','.new-folder',function(){
		var modal = "#modal-folder";
		$(modal).attr('data-op','create');
		$(modal).attr('data-area', $(this).data('area') );
		$(modal).attr('data-dir', $(this).data('dir') );
		$(modal+' .modal-body > label').html('New Folder Name');
		$(modal).modal('toggle');
	});

// Update Folder
	$(document).on('click','.manage-folder',function(){
		var modal = '#modal-folder';
		$(modal).attr('data-op','manage');
		$(modal).attr('data-id', $(this).data('id') );
		$(modal+' .modal-body > label').html('Update Name');
		$(modal+' .modal-body > input').val( $(this).data('name') );
		$(modal).modal('toggle');
	});

// Save Folder
	$('#modal-folder .btn-info').click(function(){
		if( $('#modal-folder').data('op') == 'create' ){
			var param = {
				'area': $('#modal-folder').data('area'),
				'dir': $('#modal-folder').data('dir'),
				'name': $('#modal-folder input').val(),
			};
			var type = 'new-folder';
		}

		if( $('#modal-folder').data('op') == 'manage' ){
			var param = {
				'id' : $('#modal-folder').data('id'),
				'name' : $('#modal-folder input').val()
			}

			var type = 'update-folder';
		}

		pass_spec_data(param, type);
		alert_message("Folder created");
		$("#modal-folder").modal('toggle');
		$("#modal-folder input").val('');

		$.ajax({
			url:'ajax/dload_doc.php',
			data:'area='+$('#modal-folder').data('area')+'&dir='+$('#modal-folder').data('dir'),
			async:false,
		}).done(function(response){
			$("#doc_div > div").html(response);
		})

	});


	$.fn.download_backup=function(){
		alert("Succesfull backup download");
	}

	// Show or hide elements
	$(".blind-ul").toggle('blind');
	var toggle_area=false;

	$('#areas').click(function(){
		$('.blind-area').toggle('blind');

		if (toggle_area) {
			$('#areas i').removeClass('fa fa-toggle-left');
			$('#areas i').addClass('fa fa-toggle-down');
			toggle_area=false;
		}else{
			$('#areas i').removeClass('fa fa-toggle-down');
			$('#areas i').addClass('fa fa-toggle-left');
			toggle_area=true;
		}
	});

	$(document).on("change",".utype",function(){
		if ($(this).val()==1) {
			$("#ua").attr("disabled","");
		}else{
			$("#ua").removeAttr("disabled");
		}
	});
});
// Mga outside functions kay maarte man ini hra

// Function for passing data into spec_function.php
function pass_spec_data(param ,type){
	var data = '';
	for(var key in param){
		data += key +'='+param[key]+'&';
	}
	data += 'type='+type;
	var output = "";
	$.ajax({
		data:data,
		url:'ajax/spec_functions.php',
		async:false
	}).done(function(resp){
		output = resp;
	});
		return output;
}

function alert_message(message){
	$("#message_alert p").text(message);
	$("#message_alert").modal('toggle');
	setTimeout(function(){
		$("#message_alert").modal('hide');
	}, 2000);
}

// Removing and resetting the list of selected file list
function remove_upload(){
	fnameArr = [];
	fsizeArr = [];
	ftypeArr = [];
	fdetailsArr = [];
	i=0;
}

// check file if it exist using XML Http Request
function check_file_exist(file){
	var http = new XMLHttpRequest();
	http.open('HEAD',file,false);
	http.send();
	return http.status == 404;
}

// Actually this is just to initialize the variables and arrays and not reset the upload list.
// I'm just lazy to rewrite the code but not lazy to write this comment
// Assasination Classroom

remove_upload();
var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'pickfiles',
	url:'ajax/upload_docu.php',
	init : {
		PostInit: function(){
			remove_upload();
			document.getElementById('filelist').innerHTML = '';
			document.getElementById('uploadfiles').onclick = function(){
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			if(directory.length > 0){
				var fDirectory = directory.join('/') + "/";
			}else{
				fDirectory = "";
			}

			plupload.each(files, function(file){
				if($.inArray(file.name,fnameArr) < 0){

					function add_file(){
						fnameArr.push(file.name);
						fsizeArr.push(plupload.formatSize(file.size));
						ftypeArr.push(file.type);
						$('#filelist').append('<tr class="upload-row" data-id="'+i+'"><td id="'+file.id+'" class="filename">'+file.name+'<b></b></td><td>' + plupload.formatSize(file.size) + '</td><td><input type="checkbox" class="fle_Chk" id="fleChk'+i+'" data-id="'+i+'"> Yes</td><td><div><button id="name_div_button'+i+'" style="background:white;border-radius:3px;" onclick="show_user_list('+i+')" disabled>User List</button><div class="name_div" id="name_div'+i+'" ></div></div></td><td><button onclick="remove_row()" class="btn btn-warning" data-id="'+i+'"><i class="fa fa-times"></i></button></td></tr>');
						for(var ii = 0;ii<id_arr.length;ii++){
							$("#name_div"+i).append("<input class='chk_name file_user"+i+"' type='checkbox' value='"+id_arr[ii]+"' style='margin-right:7px;margin-left:4px;'>"+name_arr[ii]+"<br>");
						}
					}

					if(check_file_exist("files/area "+area+"/"+fDirectory + file.name)){
						add_file();
					}else{
						if(window.confirm("File already exist, replace with new file?")){
							add_file();
						}
					}
				}
				i++;
			});
		},

		UploadProgress: function(up, file) {
			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '  <span class="percent">'+file.percent+'%</span> Complete';
		},

		BeforeUpload: function(up, file){
			var i = fnameArr.indexOf(file.name);
			var restricted = false;
			var uList = [];

			// check file if it is restricted for download by users
			// if yes, check who are the users that are allowed to download file.
			if($('#fleChk'+i).is(':checked')){
				restricted = true;
				// check each user if it has been selected for the download
				$('#name_div'+i+' .chk_name').each(function(){
					if($(this).is(':checked')){
						uList.push($(this).val());
					}
				});

				uList = uList.join(',');
			}

			fDirectory = directory.join('/');
			fdetailsArr.push(
				fdetails = {'restricted':restricted,'uList':uList,'area':area,'directory':fDirectory, 'type': ftypeArr[i], 'name':fnameArr[i], 'dir':$('#anchor').val() ,'size':fsizeArr[i]}
			);

			$.ajax({
				url:"ajax/uploadDetails.php",
				data:fdetailsArr[i],
				dataType:'JSON'
			});
		},

		FileUploaded: function(up, file){
			alert_message ('Upload is Done');
		},

		Error: function(up, err){
			document.getElementById('errorList').appendChild(document.createTextNode("\n Error : "+err.message));
		}
	}
});
uploader.init();
