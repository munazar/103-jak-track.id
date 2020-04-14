<div class="row">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#frm_upload">
	  	Upload File
	</button>
</div>
<?php 
if($this->session->flashdata('error_upload')){ 
	$error = $this->session->flashdata('error_upload');
?>
<br>
<div class="alert alert-<?php echo $error['tipe'];?> ">
  	<?php echo $error['msg'];?>
</div>
<?php } ?>
<div class="row">
	<div class="table-responsive">
	 	<table class="table table-bordered table-sm" id="tbl_update_status">
	    	<thead class='thead-light'>
	      		<tr>
	      			<th>No</th>
	        		<th>KPS Group</th>
	        		<th>Campaign Code</th>
	        		<th>UID</th>
	        		<th>Result</th>
	        		<th>Site From</th>
	        		<th>Nama</th>
	        		<th>Tanggal Lahir</th>
	        		<th>Kode Reservasi</th>
	        		<th>No HP</th>
	        		<th>Email</th>
	        		<th>Puskesmas/Klinik</th>
	        		<th>Tanggal Reservasi</th>
	        		<th>Jam Reservasi</th>
	        		<th>Status</th>
	        		<th>Keperluan</th>
	        		<th>Pendamping</th>
	        		<th>Tanggal Akses</th>
	      		</tr>
	    	</thead>
	    	<tbody>
	      		
	    	</tbody>
	  	</table>
	</div>
</div>
<!-- The Modal -->
<div class="modal" id="frm_upload">
  	<div class="modal-dialog">
    	<div class="modal-content">
    		<form method="POST" action="<?php echo base_url();?>upload_excel/upload_status2" enctype="multipart/form-data" target="_self">
      			<div class="modal-header">
        			<h4 class="modal-title">Update Status</h4>
        			<button type="button" class="close" data-dismiss="modal">&times;</button>
      			</div>
      			<div class="modal-body">
        			<div class="form-group">
    					<label for="email">File:</label>
    					<input type="file" class="form-control" name="fileform" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
  					</div>
      			</div>
      			<div class="modal-footer">
      				<button type="submit" class="btn btn-primary">Submit</button>
        			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      			</div>
      		</form>
    	</div>
  	</div>
</div>
<!-- End Modal -->
<script src="<?php echo base_url();?>resources/vendor/datatables/server-side.js"></script>
<script type="text/javascript">
	$(document).ready( function () {
    	append_table("<?php echo base_url();?>update_status/get_list2","tbl_update_status", {})
	} );
</script>