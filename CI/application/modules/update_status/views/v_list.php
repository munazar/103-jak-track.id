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
	        		<th>#</th>
	        		<th>Umur</th>
	        		<th>Sifat</th>
	        		<th>Jenis Kelamin</th>
	        		<th>Sex Partner</th>
	        		<th>Status HIV</th>
	        		<th>Test HIV</th>
	        		<th>Kondisi HIV</th>
	        		<th>Tanpa Kondom</th>
	        		<th>Penyakit</th>
	        		<th>Imbalan</th>
	        		<th>Jarum Suntik</th>
	        		<th>Paksaan</th>
	        		<th>Berganti Pasangan</th>
	        		<th>Tidak Pernah</th>
	        		<th>Tanpa Kondom 2</th>
	        		<th>Penyakit 2</th>
	        		<th>Imbalan 2</th>
	        		<th>Jarum Suntik 2</th>
	        		<th>Paksaan 2</th>
	        		<th>Berganti Pasangan 2</th>
	        		<th>Tidak Pernah 2</th>
	        		<th>CAM</th>
	        		<th>UID</th>
	        		<th>Site</th>
	        		<th>Score</th>
	        		<th>Start Date</th>
	        		<th>Submit Date</th>
	        		<th>Network ID</th>
	      		</tr>
	    	</thead>
	    	<tbody>
	      		<?php
	      		// if(!empty($ls_data)){
	      		// 	foreach ($ls_data->result() as $row) {
	      		// 		echo "<tr>";
	      		// 		echo "	<td>".$row->enc."</td>";
	      		// 		echo "	<td>".$row->umur."</td>";
	      		// 		echo "	<td>".$row->id_sifat."</td>";
	      		// 		echo "	<td>".$row->id_gender."</td>";
	      		// 		echo "	<td>".$row->id_sex_partner."</td>";
	      		// 		echo "	<td>".$row->id_status_HIV."</td>";
	      		// 		echo "	<td>".$row->id_test_HIV."</td>";
	      		// 		echo "	<td>".$row->id_kondisi_HIV."</td>";
	      		// 		echo "	<td>".$row->tanpa_kondom."</td>";
	      		// 		echo "	<td>".$row->pms."</td>";
	      		// 		echo "	<td>".$row->imbalan."</td>";
	      		// 		echo "	<td>".$row->jarum_suntik."</td>";
	      		// 		echo "	<td>".$row->paksaan."</td>";
	      		// 		echo "	<td>".$row->berganti_pasangan."</td>";
	      		// 		echo "	<td>".$row->tidak_pernah."</td>";
	      		// 		echo "	<td>".$row->tanpa_kondom_2."</td>";
	      		// 		echo "	<td>".$row->pms_2."</td>";
	      		// 		echo "	<td>".$row->imbalan_2."</td>";
	      		// 		echo "	<td>".$row->jarum_suntik_2."</td>";
	      		// 		echo "	<td>".$row->paksaan_2."</td>";
	      		// 		echo "	<td>".$row->berganti_pasangan_2."</td>";
	      		// 		echo "	<td>".$row->cam."</td>";
	      		// 		echo "	<td>".$row->uid."</td>";
	      		// 		echo "	<td>".$row->site."</td>";
	      		// 		echo "	<td>".$row->score."</td>";
	      		// 		echo "	<td>".$row->start_date."</td>";
	      		// 		echo "	<td>".$row->submit_date."</td>";
	      		// 		echo "	<td>".$row->network_id."</td>";
	      		// 		echo "</tr>";
	      		// 	}
	      		// }
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
    	append_table("<?php echo base_url();?>update_status/get_list","tbl_update_status", {})
	} );
</script>