<div class="row">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#frm_upload">
	  	Tambah
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
	 	<table class="table table-bordered table-sm" id="tbl_group">
	    	<thead class='thead-light'>
	      		<tr>
	      			<th>No</th>
	        		<th>Nama Group</th>
	        		<th>Deskripsi</th>
	        		<th>Enable</th>
	        		<th><i class="far fa-sticky-note"></i></th>
	      		</tr>
	    	</thead>
	    	<tbody>
	      		<?php
	      		if(!empty($ls_data)){
	      			$i=1;
	      			foreach ($ls_data->result() as $row) {
	      				echo "<tr>";
	      				echo "	<td>".$i."</td>";
	      				echo "	<td>".$row->name."</td>";
	      				echo "	<td>".$row->description."</td>";
	      				echo "	<td>".$row->enable."</td>";
	      				echo "	<td>".$i."</td>";
	      				echo "</tr>";
	      				$i++;
	      			}
	      		}
	      		?>
	    	</tbody>
	  	</table>
	</div>
</div>
<!-- The Modal -->
<div class="modal" id="frm_upload">
  	<div class="modal-dialog">
    	<div class="modal-content">
    		<form method="POST" action="<?php echo base_url();?>upload_excel/upload_status" enctype="multipart/form-data" target="_self">
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
    	client_side('tbl_group');
	} );
</script>