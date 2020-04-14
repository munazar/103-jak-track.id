<div class="row">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#frm_provinsi">
	  	Tambah Data
	</button>
</div>
<?php 
if($this->session->flashdata('error_provinsi')){ 
	$error = $this->session->flashdata('error_provinsi');
?>
<br>
<div class="alert alert-<?php echo $error['tipe'];?> ">
  	<?php echo $error['msg'];?>
</div>
<?php } ?>
<div class="row">
	<div class="table-responsive">
	 	<table class="table table-bordered table-sm table-hover" id="tbl_provinsi">
	    	<thead class='thead-light'>
	      		<tr>
	      			<th width="5%" class="text-center">No</th>
	        		<th width="15%" class="text-center">Kode</th>
	        		<th width="55%" class="text-center">Provinsi</th>
	        		<th width="15%" class="text-center">Aktif</th>
	        		<th width="10%" class="text-center"><i class="far fa-sticky-note"></i></th>
	      		</tr>
	    	</thead>
	    	<tbody>
	      		<?php
	      		if(!empty($ls_provinsi)){
	      			$i=1;
	      			foreach ($ls_provinsi->result() as $row) {
	      				echo "<tr>";
	      				echo "	<td align='right'>".$i."</td>";
	      				echo "	<td class='text-center'>".$row->kode."</td>";
	      				echo "	<td>".$row->nama."</td>";
	      				if($row->aktif==1)$aktif = 'Aktif'; else $aktif = 'Tidak Aktif';
	      				echo "	<td>".$aktif."</td>";
	      				echo "	<td class='text-center'><a href='v_provinsi/".encrypt_val($row->id)."'><i class='fas fa-edit'></i></a></td>";
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
<div class="modal" id="frm_provinsi">
  	<div class="modal-dialog">
    	<div class="modal-content">
    		<form method="POST" action="save_provinsi" enctype="multipart/form-data" target="_self">
      			<div class="modal-header">
        			<h4 class="modal-title">Tambah Data Provinsi</h4>
        			<button type="button" class="close" data-dismiss="modal">&times;</button>
      			</div>
      			<div class="modal-body">
        			<div class="form-group">
						<label for="kode_provinsi">Kode Provinsi:</label>
						<input type="text" class="form-control" id="kode_provinsi" name="kode_provinsi" value="" required>
						<input type="hidden" class="form-control" name="aksi" value="add">
					</div>
					<div class="form-group">
						<label for="nama_provinsi">Nama Provinsi:</label>
						<input type="text" class="form-control" id="nama_provinsi" name="nama_provinsi" value="" required>
					</div>
					<div class="form-group">
						<select class="form-control" id="sel_aktif" name="sel_aktif">
							<option value=0>Tidak Aktif</option>
							<option value=1 selected>Aktif</option>
						</select>
					</div>
      			</div>
      			<div class="modal-footer">
      				<button type="submit" class="btn btn-primary">Simpan</button>
        			<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
      			</div>
      		</form>
    	</div>
  	</div>
</div>
<!-- End Modal -->
<script src="<?php echo base_url();?>resources/vendor/datatables/server-side.js"></script>
<script type="text/javascript">
	$(document).ready( function () {
    	client_side('tbl_provinsi');
	} );
</script>