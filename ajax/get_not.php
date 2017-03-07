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
		$docu->get_not($_SESSION['user_id'],$_SESSION['area']);
	?>
</table>
<script type="text/javascript">
		$(document).on('click','.n_li',function(){
			$(this).removeAttr('style');
			pass_spec_data({'nid':$(this).data('nid')},'seen');
			switch ($(this).data('status')) {
				case 0:
					$('#download_from_notif').modal('toggle');
					$('#download_from_notif .modal-body span').text( $(this).children('.file').text() )
					$('#download_from_notif .modal-footer a').attr('href', $(this).find('input').val() )
					alert_message('Download Successful')
					$('#download_from_notif').modal('toggle');
					break;
				case 1:
					if( $(this).data('admin')==1 ){
						$("#allow_download .modal-body > span.file").text($(this).children('.file').text());
						$("#allow_download .modal-body > span.name").text($(this).children('.name').text());
						$("#btn_ADC").attr('onclick',"reject_download("+$(this).data('nid')+")");
						$("#btn_AD").attr("onclick","allow_download("+$(this).data('nid')+")");
						$("#allow_download").modal('toggle');
					}else{
						alert_message('File being reviewed');
					}
					break;
				case 2:
					if( $(this).data('admin')==1 ){
						alert_message($(this).children('.name').text()+' request to download the file '+$(this).children('.file').text()+' was denied.');
					}else{
						alert_message('Your request to download the file '+$(this).children('.file').text()+' was denied.');
					}
					break;


			}
		});

</script>
