var folderURL = '';
var folderURL2 = '';

$(document).ready(function(){
	if (user_type==1) {
		area = 1;
	}
	var areaya = 1;

	$("#doc_div").slideDown(function(){
		show_area("1","#doc_div span");
		f_ajax(areaya, "ajax/dload_doc.php","#doc_div div","0");
	});

	$(document).on('change','#d-sel',function(){
		areaya = $(this).val();
		f_ajax($(this).val(),"ajax/dload_doc.php","#doc_div div","0");
		show_area(areaya,"#doc_div span");
		array_numb=["0"];
		folderURL = "";
	});

	$(document).on('click','.nextDir',function(){

		folderURL += $(this).data('fname')+"/";
		array_numb.push($(this).data('fid'));
		anchor = array_numb.length-1;
		$("#anchor").val($(this).data('fid'));
		f_ajax($("#d-sel").val(), "ajax/dload_doc.php","#doc_div > div",$(this).data('fid'));
	});

	$("#btn_reg").click(function(){
		f_ajax($("#d-sel").val(), "ajax/register.php","#acct_div > div",$(this).data('fid'));
	});

	$('#area_div .btn_regArea').click(function(){
		f_ajax(0,"ajax/register_area.php","#area_div > div",0);
	});

});

function show_area(area,disp){
	$(disp).text(area);
}

function remove_upload(){
	f_ajax($("#d-sel").val(), "ajax/dload_doc.php","#doc_div > div",(array_numb[array_numb.length-1]));
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

function display_div(div){
		$("#search_div").slideUp();
		$(".navs").removeClass('active');
		$(".navs").css('background','#3090C3');

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

		if(div==5){
			$("#area_nav").addClass('active');
			$("#area_div").slideDown(function(){
				f_ajax("1", "ajax/area_list.php","#area_div div","0");
			});
		}else{
			$("#area_div").slideUp();
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
	var d="area="+area+"&name="+name+"&dir="+anchor+"&dir_name="+folderURL+"&type=new_folder";
	$.ajax({
		url:'ajax/spec_functions.php',
		data:d
	}).done(function(r){

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

// Management of user accounts
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

// Management of areas
function edit_area(area_no){
	var data = 'areaNo='+area_no;
	$.ajax({
		data:data,
		url:"ajax/manage_area.php"
	}).done(function(r){
		$("#area_div div").html(r);
	});
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
		var param = {
			'pass' : $('#cp_cp').val()
		};
		var type = "ChangePass";
		pass_spec_data(param, type);
		$("#change_pass").modal('toggle');
		alert_message("Your password has been changed.");
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

			$(" #doc_div, #acct_div ,#bckup_div, #area_div").slideUp();
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
