<<<<<<< HEAD
$(document).ready(function(){
	 directory = [];
	$(document).on('dblclick','.nextDir',function(){
		directory.push($(this).data('fname'));
	});
	$(document).on('dblclick','.prevDir',function(){
		directory.pop();
	});

	$(document).on('click', '.docu,.doc_dload,.folder', function(){
		$(".docu, .doc_dload,.folder").css('background','none');
		if ($(this).data('rest')==0 || user_type == 1 || $(this).data('fldr')=='fldr' || $(this).data('ald')==1 || $(this).data('notify')==0) {
			$(this).css('background','rgb(208, 227, 252)'); //skyblue
		}else{
			if($(this).data('notify')==1) {
				$(this).css('background','rgb(255, 255, 111)'); //yellow
			}else if ($(this).data('rest')==1 || $(this).data('notify')==2){
				$(this).css('background','rgb(241, 75, 84)');//red
			}
		}
	});

	$(document).on('change','#d-sel',function(){
		area = $(this).val();
		$('#anchor').val('0');
	});

	 $(document).on('dblclick','.docu',function(){
		file_id=$(this).data('fid');1
		$("#download_alert .modal-footer > a").removeAttr("download");
		$("#download_alert .modal-footer > a").removeAttr('onclick');
		if ($(this).data('rest')==0 || user_type == 1 || $(this).data('notify')==0) {
			let filePath = directory.join('/');
			 var d_link = "files/area "+$(this).data('area')+"/"+filePath+"/"+$(this).data('name');
			 console.log(d_link);
			 $("#download_alert .modal-body > p").html($(this).data('name'));
			 $("#download_alert .modal-footer > a").attr('href',d_link);
			 $("#download_alert .modal-footer > a").attr("download",'');
			 $("#download_alert .modal-footer > a").attr('onclick','$.fn.download_docu('+file_id+')');
			 var text = "Download";
		 }else{
			if ($(this).data('notify')==1) {
				$("#download_alert .modal-body > p").html("The Administrator has already been notified about your request.");
				var text = "Okay, I'll wait";
			}else if ($(this).data("rest")==1) {
				$("#download_alert .modal-body > p").html("This document is restricted for download.Notify the Administrator for your request");
				$("#download_alert .modal-footer > a").attr('onclick','$.fn.notify_docu('+file_id+')');
				var text = "Notify";
			};

			$("#download_alert .modal-footer > a").attr('data-dismiss','modal');
		}

		$("#download_alert .modal-footer a > button").text(text);
		$("#download_alert").modal('show');
	});

	$.fn.download_docu=function(){
		$("#download_alert").modal("hide");
		var increment="file_id="+file_id+"&type=download";
		$.ajax({
			url:"ajax/spec_functions.php",
			data:increment,
		}).done(function(){
			alert_message("Document was successfully downloaded");
		});
	 };

	$.fn.notify_docu=function(file_id){
		var notify='file_id='+file_id+'&type=notify';
		$.ajax({
			data:notify,
			url:'ajax/spec_functions.php',
		}).done(function(){
			alert_message('The Admin/Author has been notified about the requested download.');
			$("#download_alert").modal('hide');
		});
	}

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
			console.log(fdetails);

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
=======
$(document).ready(function(){
	 directory = [];
	$(document).on('dblclick','.nextDir',function(){
		directory.push($(this).data('fname'));
	});
	$(document).on('dblclick','.prevDir',function(){
		directory.pop();
	});

	$(document).on('click', '.docu,.doc_dload,.folder', function(){
		$(".docu, .doc_dload,.folder").css('background','none');
		if ($(this).data('rest')==0 || user_type == 1 || $(this).data('fldr')=='fldr' || $(this).data('ald')==1 || $(this).data('notify')==0) {
			$(this).css('background','rgb(208, 227, 252)'); //skyblue
		}else{
			if($(this).data('notify')==1) {
				$(this).css('background','rgb(255, 255, 111)'); //yellow
			}else if ($(this).data('rest')==1 || $(this).data('notify')==2){
				$(this).css('background','rgb(241, 75, 84)');//red
			}
		}
	});

	$(document).on('change','#d-sel',function(){
		area = $(this).val();
		$('#anchor').val('0');
	});

	 $(document).on('dblclick','.docu',function(){
		file_id=$(this).data('fid');1
		$("#download_alert .modal-footer > a").removeAttr("download");
		$("#download_alert .modal-footer > a").removeAttr('onclick');
		if ($(this).data('rest')==0 || user_type == 1 || $(this).data('notify')==0) {
			let filePath = directory.join('/');
			 var d_link = "files/area "+$(this).data('area')+"/"+filePath+"/"+$(this).data('name');
			 console.log(d_link);
			 $("#download_alert .modal-body > p").html($(this).data('name'));
			 $("#download_alert .modal-footer > a").attr('href',d_link);
			 $("#download_alert .modal-footer > a").attr("download",'');
			 $("#download_alert .modal-footer > a").attr('onclick','$.fn.download_docu('+file_id+')');
			 var text = "Download";
		 }else{
			if ($(this).data('notify')==1) {
				$("#download_alert .modal-body > p").html("The Administrator has already been notified about your request.");
				var text = "Okay, I'll wait";
			}else if ($(this).data("rest")==1) {
				$("#download_alert .modal-body > p").html("This document is restricted for download.Notify the Administrator for your request");
				$("#download_alert .modal-footer > a").attr('onclick','$.fn.notify_docu('+file_id+')');
				var text = "Notify";
			};

			$("#download_alert .modal-footer > a").attr('data-dismiss','modal');
		}

		$("#download_alert .modal-footer a > button").text(text);
		$("#download_alert").modal('show');
	});

	$.fn.download_docu=function(){
		$("#download_alert").modal("hide");
		var increment="file_id="+file_id+"&type=download";
		$.ajax({
			url:"ajax/spec_functions.php",
			data:increment,
		}).done(function(){
			alert_message("Document was successfully downloaded");
		});
	 };

	$.fn.notify_docu=function(file_id){
		var notify='file_id='+file_id+'&type=notify';
		$.ajax({
			data:notify,
			url:'ajax/spec_functions.php',
		}).done(function(){
			alert_message('The Admin/Author has been notified about the requested download.');
			$("#download_alert").modal('hide');
		});
	}

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

		},

		Error: function(up, err){
			document.getElementById('errorList').appendChild(document.createTextNode("\n Error : "+err.message));
		}
	}
});

uploader.init();
>>>>>>> 130510f3927dfa86a848824eb300a3d41502740d
