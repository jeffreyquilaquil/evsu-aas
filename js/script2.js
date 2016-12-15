$(document).ready(function(){
	if (user_type==1) {
		area = 1;
	}
	show_area(area,"#view_div span");
	f_ajax(area, "ajax/view_doc.php","#view_div div","0");
	var areaya = 1;

	show_area("1","#doc_div span");
	f_ajax(areaya, "ajax/dload_doc.php","#doc_div div","0");

	var folderURL, folderURL2 = "";

	$(document).on('change','#v-sel',function(){
		f_ajax($(this).val(), "ajax/view_doc.php","#view_div div","0");
		show_area($(this).val(),"#view_div span");
		array_numb2=["0"];
		folderUrl = "";
	});

	$(document).on('change','#d-sel',function(){
		areaya = $(this).val();
		f_ajax($(this).val(),"ajax/dload_doc.php","#doc_div div","0");
		show_area(areaya,"#doc_div span");
		array_numb=["0"];
		folderURL = "";
	});

	$(document).on('dblclick','.d-folder',function(){
		folderURL += $(this).data('fname')+"/";
		array_numb.push($(this).data('fid'));
		anchor = array_numb.length-1;
		$("#anchor").val($(this).data('fid'));
		f_ajax($("#d-sel").val(), "ajax/dload_doc.php","#doc_div > div",$(this).data('fid'));
	});

	$(document).on('dblclick','.v-folder',function(){
		folderURL2 += $(this).data('fname')+"/";
		array_numb2.push($(this).data('fid'));
		anchor = array_numb2.length-1;
		f_ajax($("#v-sel").val(), "ajax/view_doc.php","#view_div > div",$(this).data('fid'));
	});

	$("#btn_reg").click(function(){
		f_ajax($("#d-sel").val(), "ajax/register.php","#acct_div > div",$(this).data('fid'));
	});
});

//to view files
function download_count(file_id){
	$.ajax({
		data:'file_id='+file_id+'&type=view_download',
		url:'ajax/spec_functions.php',
	}).done(function(r){
		console.log(r);
		$('#view-download .modal-body').html(r);
		$('#view-download').modal('toggle');
	});
}

function show_area(area,disp){
	$(disp).text(area);
}

function remove_upload(){
	f_ajax($("#d-sel").val(), "ajax/dload_doc.php","#doc_div > div",(array_numb.length-1));
	$("#filelist tr").remove();
}

function f_ajax(area,url,resp,dir){
	var d="area="+area+"&dir="+dir;
	$.ajax({
		data:d,
		url:url,
		async:false
	}).done(function(r){
		$(resp).html(r);
	});
}

function d_load(area){
	// var d="a="+area;
	// $.ajax({

	// });
}
function display_div(div){
		$("#search_div").slideUp();
		$(".navs").removeClass('active');
		$(".navs").css('background','#3090C3');
		if (div==1) {
			$("#view_nav").addClass('active');
			$("#view_div").slideDown(function(){

				 f_ajax(area, "ajax/view_doc.php","#view_div div");
				 show_area(area,"#view_div span");
			});
		}else{
			$("#view_div").slideUp();
		}

		if (div==2) {
			$("#doc_nav").addClass('active');
			$("#doc_div").slideDown(function(){

			});
		}else{
			$("#doc_div").slideUp();
		}

		if (div==3) {
			$("#acct_nav").addClass('active');
			$("#acct_div").slideDown(function(){

				f_ajax("1","ajax/user_list.php","#acct_div div","0");
			});
		}else{
			$("#acct_div").slideUp();
		}

		if(div==4){
			$("#arch_nav").addClass('active');
			$("#bckup_div").slideDown(function(){
				f_ajax("1","ajax/backup_list.php","#bckup_div div","0");
			});
		}else{
			$("#bckup_div").slideUp();
		}

		$(".active").css('background','rgb(31, 109, 152)');
	};
	$(".active").css('background','rgb(31, 109, 152)');

function create_folder(area){
anchor = array_numb.slice(-1)[0];
	$("#new-folder").modal('toggle');
	$("#new-folder .btn-info").attr('onclick','create_folder2('+area+')');
}

function create_folder2(area){
	anchor = array_numb.slice(-1)[0];
	var name=$("#new-folder .form-control").val();
	 var d="area="+area+"&name="+name+"&dir="+anchor+"&type=new_folder";
	$.ajax({
		url:'ajax/spec_functions.php',
		data:d
	}).done(function(r){
		console.log(r);
		if (r) {
			alert_message("Folder has been created");
			$("#new-folder").modal('hide');
		f_ajax(area, "ajax/dload_doc.php","#doc_div div",anchor);
		}else{
			alert_message("Folder already exist.");
		}
	});
}

// This code here is for the uploading of files. Feel free to UPDATE.

// File deletion
function del_file(file_id){
	var confirm = window.confirm("Are you sure you want to delete this file?");
	if (confirm) {
		var d = "file_id="+file_id+"&type=delete file";
		$.ajax({
			url:"ajax/spec_functions.php",
			data:d
		}).done(function(){
			f_ajax(area,"ajax/dload_doc.php","#doc_div div","0");
			f_ajax(area,"ajax/view_doc.php","#view_div div","0");

			alert_message("File has been deleted");
		});
	};
}

var file_upl=[0];
function upload_modal(area){
	$(".upload_row").remove();
	areaya=area;
	var i = file_upl.slice(-1)[0];
	$("#file-upload").modal({backdrop:'static',keyboard:false,});
}

$(".upload-row button").hover(function(){
	$(this).css('cursor','not-allowed');
});
$(document).on('change','.fle_Chk',function(){
	var div = $("#name_div_button"+$(this).data('id'));
	if ($(this).is(":checked")) {
		$(div).removeAttr('disabled');
		$(div).css('background','rgba(255,255,255,0.4)');
	}else{
		$(div).attr('disabled','');
		$(div).css('background','white');
		$(div).hover(function(){
			$(this).css('pointer','not-allowed');
		});
	}
});
function show_user_list(id){
	$("#name_div"+id).toggle('slide');

}

	// array of ID and name;
	id_arr=id_arr.split(',');
	name_arr=name_arr.split(',');

$(document).mouseup(function (e){
	if (!$('.name_div').is(e.target) && $('.name_div').has(e.target).length === 0) {
		$('.name_div').slideUp();
	};
});
function remove_row(id){
	$("#upload-row"+id).remove();
	file_upl.splice(id,1);
}

function upload_files(){
	var f_count = 0;
	var arr_id=[];
	for(i=0;i<file_upl.length;i++){
		if($("#file"+i).get(0).files.length != 0){
			f_count++;
			arr_id.push(i);
		}
	}

	// uploading those F****** Files
	// Loop through each file going to be uploaded

	var i = 0;
	while(i<arr_id.length){
		var fd = new FormData();
		var id = arr_id[i];
		anchor = array_numb.slice(-1)[0];
		// check if the filebox is not empty

		fd.append("rest",0);
		data_arr=[];
		flag = true;

		// Check if specific users can view this document
		// Or everyone
		if ($("#chkbx"+id).is(":checked")) {

			// Loop on each accounts and check if it is selected.
			// If true, add them to an array then append to form data
			$(".file_user"+id).each(function(){
				if($(this).is(":checked")){
					data_arr.push($(this).val());
				}
			});
			fd.append("rest",1);
		}

		 fd.append("user", data_arr);
		 fd.append("file", $("#file"+id)[0].files[0]);
		 fd.append("area",areaya);
		 fd.append("anchor",anchor);

		 var file_name = $("#file"+id).val();
		 file_name = file_name.split('\\').pop().split('/').pop();
		 file_name = "files/area "+areaya+"/"+file_name;

		 var upload = function(fd){
		 	$.ajax({
		 		url:"ajax/upload_docu.php",
		 		cache:false,
		 		data:fd,
		 		type:"POST",
		 		processData:false
		 	}).complete(function(){
		 		f_count++;
		 		// if (f_count == arr_id.length) {
		 		// 	f_ajax(areaya, "ajax/dload_doc.php","#doc_div div", anchor);
		 		// 	$("#file-upload").modal('hide');
		 		// 	$('.upload-row').remove();
		 		// 	alert_message("Successful upload of document.");
		 		// 	file_upl=[0];
		 		// };
		 	});
		 }

		var pass_data = "url="+file_name;
		$.ajax({
			url:"ajax/check_file.php",
			data:pass_data
		}).done(function(response){
			if (response=="true") {
				var confirm = window.confirm(file_name+" already exist, Replace file?");
			}else{
				upload(fd);
			}

			if (confirm) {
				upload(fd);
			};
		});
	i++;
	}
}

array_numb=["0"];
var anchor;
function d_folder_up(area){
	array_numb.pop();
	anchor = array_numb.slice(-1)[0];
	f_ajax(area, "ajax/dload_doc.php","#doc_div > div",anchor);
}
array_numb2=["0"];
function v_folder_up(area){
	array_numb2.pop();
	anchor1 = array_numb2.slice(-1)[0];
	f_ajax(area, "ajax/view_doc.php","#view_div > div",anchor1);
}

uname_arr=uname_arr.split(',');
function check_uname(){
	var new_uname = $("input[name='uname']").val();
	var regex = new RegExp("^"+new_uname+"$","i");
	$.each(uname_arr, function(index, value){
		if (regex.test(value)) {
			form_check=false;
			return false;
		}else{
			form_check=true;
			return true;
		}
	});
}

function check_form(){
	if ($("#reg_form").valid()) {
		if (form_check) {
			$("#unameCheck_err").css('display','none');
			var d = 'fname='+$("#fn").val()+"&lname="+$("#ln").val()+"&uname="+$("#un").val()+"&type="+$("#ut").val()+"&area="+$("#ua").val()+"&pword="+$("#pw").val()+"&sc_question="+$("#sq").val()+"&sc_answer="+$("#sa").val()+"&reg=1";

			$.ajax({
				data:d,
				url:"ajax/user_list.php"
			}).done(function(r){
				$("#acct_div div").html(r);

			});
		}else{
			$("#unameCheck_err").css("display",'block');
		}
	};
}

function edit_user(uid){
	var d = 'uid='+uid;
	$.ajax({
		data:d,
		url:"ajax/edit_user.php"
	}).done(function(r){
		$("#acct_div div").html(r);
	});
}

function upd_user(uid){
	if ($("#upd_form").valid()) {
		var d = "uid="+uid+"&fname="+$("#fn").val()+"&lname="+$("#ln").val()+"&area="+$("#ua").val()+"&type="+$("#ut").val()+"&status="+$("#us").val()+"&upd=1";
		$.ajax({
			data:d,
			url:"ajax/user_list.php"
		}).done(function(r){
			$("#acct_div div").html(r);
		});
	}
}


$(document).mouseup(function (e){
//For the user Profile
    if ($("#prof_but").is(e.target)) {
    	$("#prof_div").toggle('blind');
    }else if(!$("#prof_div").is(e.target) && $("#prof_div").has(e.target).length === 0){
    	$("#prof_div").slideUp();
    }
// For the notifications
    if ($("#not_but, #not_but > *").is(e.target)) {
    	$("#not_div").toggle('blind');
		$.ajax({
			url:"ajax/get_not.php"
		}).done(function(r){
			$("#not_div").html(r);
		});
    }else if(!$("#not_div").is(e.target) && $("#not_div").has(e.target).length === 0){
    	$("#not_div").slideUp();
    }
});

	// Change Pass
$("#p_mcp").click(function(){
	$("#change_pass").modal('toggle');
});

$("#frm_cp").validate({
	rules:{
		cp_op:{
			required:true,
			equalTo:"#cp_orp"
		},
		cp_np:{
			required:true,
			minlength:8,
			validPassword:true
		},
		cp_cp:{
			required:true,
			equalTo:"#cp_np"
		},
		cp_file:{
			filesize:500
		}
	},
	messages:{
		cp_op:{
			equalTo:"Please enter your old password."
		}
	}
});

$("#cp_but").click(function(){
	if ($("#frm_cp").valid()) {
		var d='pass='+$("#cp_cp").val()+"&type=ChangePass";
		$.ajax({
			url:"ajax/spec_functions.php",
			data:d,
		}).done(function(){
			$("#change_pass").modal('toggle');
			alert_message("Your password has been changed.");
		});
	};
});

//For the profile
$("#p-upd").click(function(){
	if ($("#p-frm").valid()) {
		var d = "type=p_upd&p_fn"+$("#p-fn").val()+"&p_ln="+$("#p-ln").val();
		$.ajax({
			type:"POST",
			data:d,
			url:"ajax/spec_functions.php",
		});
	};
});

	//For the notifications
$(document).on('click','.n_li',function(){
	$("#allow_download .modal-body > span").text($(this).data('fname'));
	//$("#btn_ADC").attr('onclick','reject_download("+$(this).data('nid')+")');
	$("#btn_ADC").attr('onclick',"reject_download("+$(this).data('nid')+")");
	$("#btn_AD").attr("onclick","allow_download("+$(this).data('nid')+")");
	$("#allow_download").modal('toggle');
});

function allow_download(nid){
	var d = "type=AD&nid="+nid;
	$.ajax({
		data:d,
		url:"ajax/spec_functions.php"
	}).done(function(){
		alert_message("The document is now allowed for download.");
		$("#allow_download").modal('hide');

		// Fetch the count number of notifications after allowing or dis allowing user.
		var data = "type=notification_count";
		$.ajax({
			url:"ajax/spec_functions.php",
			data:data
		}).done(function(r){
			$("#notifications p").html(r);
		});
	});
}

	function reject_download(nid){
		var d ='type=ADC&nid='+nid;
		$.ajax({
			data:d,
			url:"ajax/spec_functions.php"
		}).done(function(){
			alert_message("The users request has been rejected");
			$("#allow_download").modal('hide');

		// Fetch the count number of notifications after allowing or dis allowing user.
		var data = "type=notification_count";
		$.ajax({
			url:"ajax/spec_functions.php",
			data:data
		}).done(function(r){
			$("#notifications p").html(r);
		});
	});
	}

	// archives
	$("#btn_hisetBckup").click(function(){
		var d = "value="+$("#slc_bckup").val()+"&type=set_bckup";
		$.ajax({
			url:"ajax/spec_functions.php",
			data:d
		}).done(function(){
			$(".set_backup").modal('toggle');
		});
	});

	// this will display the modal for setting the interval of the automatic backup
	$(".btn_shsetBackup").click(function(){
		$(".set_backup").modal('toggle');
	});

	// Send a request to the file "ajax/spec_functions.php"
	// Where it will try to look for the keyword to process the backup;
	$(".btn_doBackup").click(function(){
		var d = "type=backup";
		$.ajax({
			url:"ajax/spec_functions.php",
			data:d
		}).done(function(r){
			console.log(r);
			alert_message("Successfull backup");
			f_ajax("1","ajax/backup_list.php","#bckup_div div","0");
		});
	});

	// Search
	$("#frm_search").submit(function(){
		// $("#search_div").slideDown(function(){
			var d = "s="+$("#frm_search input").val();
			$.ajax({
				url:"ajax/search_doc.php",
				data:d
			}).done(function(r){
				$("#search_div div").html(r);
			});

			$("#view_div, #doc_div, #acct_div ,#bckup_div").slideUp();
			$("#search_div").slideDown();

	});

	// For the logout button
	// Ask first user if they are really logging out.
	$("#btn_logout").click(function(){
		var r = confirm("Are you sure you want to sign out?");
		if (r) {
			window.location.assign("logout.php");
		};
	});
