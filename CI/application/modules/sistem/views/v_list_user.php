<div class="row">
	<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#frm_upload">
	  	Tambah
	</button> -->
</div>
<?php 
if($this->session->flashdata('error_v_user')){ 
	$error = $this->session->flashdata('error_v_user');
?>
<br>
<div class="alert alert-<?php echo $error['tipe'];?> ">
  	<?php echo $error['msg'];?>
</div>
<?php } ?>
<div class="row">
	<div class="table-responsive">
	 	<table class="table table-bordered table-sm" id="tbl_user">
	    	<thead class='thead-light'>
	      		<tr>
	      			<th>No</th>
	        		<th>Nama</th>
	        		<th>Username</th>
	        		<th>Email</th>
	        		<th>Telp</th>
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
	      				echo "	<td>".$row->fullname."</td>";
	      				echo "	<td>".$row->username."</td>";
	      				echo "	<td>".$row->email."</td>";
	      				echo "	<td>".$row->telp."</td>";
	      				echo "	<td><a href='v_user/".encrypt_val($row->userid)."'><i class='fas fa-edit'></i></a></td>";
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
    		<form method="POST" action="" enctype="multipart/form-data" target="_self">
      			<div class="modal-header">
        			<h4 class="modal-title">Tambah User</h4>
        			<button type="button" class="close" data-dismiss="modal">&times;</button>
      			</div>
      			<div class="modal-body">
        			
      			</div>
      			<div class="modal-footer">
      				<!-- <button type="submit" class="btn btn-primary">Submit</button> -->
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
    	client_side('tbl_user');
	} );
</script>