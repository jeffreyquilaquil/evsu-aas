var folderURL = '';
var folderURL2 = '';

$(document).ready(function(){
	if (user_type==1) {
		area = 1;
		area_no = 1;
	}

	var areaya = 1;

	$("#doc_div").slideDown(function(){
		show_area(area_no,"#doc_div span");
		f_ajax(area, "ajax/dload_doc.php","#doc_div div","0");
	});

	$(document).on('change','#d-sel',function(){
		areaya = $(this).val();
		f_ajax($(this).val(),"ajax/dload_doc.php","#doc_div div","0");
		show_area( $(this).find(':selected').data('no'),"#doc_div span");
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

array_numb=["0"];
var anchor;
function d_folder_up(folder_id){
	array_numb.pop();
	$("#anchor").val(folder_id);
	f_ajax( $("#d-sel").val() , "ajax/dload_doc.php","#doc_div > div",folder_id);
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
		pass_spec_data(param, 'ChangePass');
		$("#change_pass").modal('toggle');
		alert_message("Your password has been changed.");
	};
});

//For the profile
$("#p-upd").click(function(){
	if ($("#p-frm").valid()) {
		var param = {
			'p_fn':$("#p-fn").val(),
			'p_ln': $('#p-ln').val()
		}
		pass_spec_data(param, 'p_upd');
		alert_message("Update success. Refresh to see update");
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
	pass_spec_data({'nid':nid}, 'AD');
	alert_message("The document available for download.");
	$("#allow_download").modal('toggle');

		// Fetch the count number of notifications after allowing or dis allowing user.
		$('#notifications p').html( pass_spec_data('','notification_count') );
}

	function reject_download(nid){
		pass_spec_data({'nid':nid},'ADC');
		alert_message("The user request, rejected.");
		$("#allow_download").modal('toggle');

		// Fetch the count number of notifications after allowing or dis allowing user.
		$('#notifications p').html( pass_spec_data('','notification_count') );
	}

	// archives
	$("#btn_hisetBckup").click(function(){
		pass_spec_data({ 'value':$("#slc_bckup").val() }, 'set_bckup');
	});

	// this will display the modal for setting the interval of the automatic backup
	$(".btn_shsetBackup").click(function(){
		$(".set_backup").modal('toggle');
	});

	// Send a request to the file "ajax/spec_functions.php"
	// Where it will try to look for the keyword to process the backup;
	$(".btn_doBackup").click(function(){
		pass_spec_data('','backup');
		alert_message("Successfull backup");
		f_ajax("1","ajax/backup_list.php","#bckup_div div","0");
  });

	// For the logout button
	// Ask first user if they are really logging out.
	$("#btn_logout").click(function(){
		var r = confirm("Are you sure you want to sign out?");
		if (r) {
			window.location.assign("logout.php");
		};
	});
