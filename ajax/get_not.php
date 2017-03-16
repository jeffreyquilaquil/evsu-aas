<?php
	include '../db_conn.php';
	$docu= new document();

?>
<style type="text/css">
	.n_li{
		border-top:1px solid black;
		border-bottom: 1px solid black;
		font-size: 12px;
		cursor: pointer;
	}

</style>
<table style='width:100%' class='tbl_not'>
	<?php
		echo $docu->get_not();
	?>
</table>
<script type="text/javascript">
		var clicked = false;
		$(document).on('click','.n_li',function(){
			if(clicked == true)
				return false;

			$(this).removeAttr('style');
			pass_spec_data({'nid':$(this).data('nid')},'seen');
			switch ($(this).data('status')) {
				case 0:
					$('#download_from_notif .modal-body span').text( $(this).children('.file').text() )
					$('#download_from_notif .modal-footer a').attr('href', $(this).find('input').val() )
					$('#download_from_notif').modal('show');
					break;
				case 1:
					if( $(this).data('admin')==1 ){
						$("#allow_download .modal-body > span.file").text($(this).children('.file').text());
						$("#allow_download .modal-body > span.name").text($(this).children('.name').text());
						$("#btn_ADC").attr('onclick',"reject_download("+$(this).data('nid')+")");
						$("#btn_AD").attr("onclick","allow_download("+$(this).data('nid')+")");
						$("#allow_download").modal('show');
					}else{
						alert_message('File being reviewed');
					}
					break;
				case 2:
					if( $(this).data('admin')==1 ){
						alert_message($(this).children('.name').text()+' request to download the file '+$(this).children('.file').text()+' was denied.');
					}else{
						alert_message('Your request to download the file '+$(this).children('.file').text()+' was denied.', 1);
					}
					break;
					let notification_count = $("#not_div tr[data-seen='1']").length
					$('#not_but span').text( notification_count );s
			}
			clicked = true;
			setTimeout(function(){
				clicked = false;
			}, 200);
			console.log('string');
		});

</script>
