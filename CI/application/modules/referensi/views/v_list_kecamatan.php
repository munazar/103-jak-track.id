<div class="row">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#frm_kecamatan">
	  	Tambah Data
	</button>
</div>
<?php 
if($this->session->flashdata('error_kecamatan')){ 
	$error = $this->session->flashdata('error_kecamatan');
?>
<br>
<div class="alert alert-<?php echo $error['tipe'];?> ">
  	<?php echo $error['msg'];?>
</div>
<?php } ?>
<div class="row">
	<div class="table-responsive">
	 	<table class="table table-bordered table-sm table-hover" id="tbl_kecamatan">
	    	<thead class='thead-light'>
	      		<tr>
	      			<th width="5%" class="text-center">No</th>
	        		<th width="15%" class="text-center">Kode</th>
	        		<th width="30%" class="text-center">Kecamatan</th>
	        		<th width="25%" class="text-center">Kabupaten/Kotamadya</th>
	        		<th width="25%" class="text-center">Provinsi</th>
	        		<th width="15%" class="text-center">Aktif</th>
	        		<th width="10%" class="text-center"><i class="far fa-sticky-note"></i></th>
	      		</tr>
	    	</thead>
	    	<tbody>
	      		<?php
	      		if(!empty($ls_kecamatan)){
	      			$i=1;
	      			foreach ($ls_kecamatan->result() as $row) {
	      				echo "<tr>";
	      				echo "	<td align='right'>".$i."</td>";
	      				echo "	<td class='text-center'>".$row->kode."</td>";
	      				echo "	<td>".$row->nama."</td>";
	      				echo "	<td>".$row->nama_kota."</td>";
	      				echo "	<td>".$row->nama_provinsi."</td>";
	      				if($row->aktif==1)$aktif = 'Aktif'; else $aktif = 'Tidak Aktif';
	      				echo "	<td>".$aktif."</td>";
	      				echo "	<td class='text-center'><a href='v_kecamatan/".encrypt_val($row->id)."'><i class='fas fa-edit'></i></a></td>";
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
<div class="modal" id="frm_kecamatan">
  	<div class="modal-dialog">
    	<div class="modal-content">
    		<form method="POST" action="save_kecamatan" enctype="multipart/form-data" target="_self">
      			<div class="modal-header">
        			<h4 class="modal-title">Tambah Data kecamatan</h4>
        			<button type="button" class="close" data-dismiss="modal">&times;</button>
      			</div>
      			<div class="modal-body">
      				<div class="form-group">
						<label for="sel_provinsi">Provinsi:</label>
						<select class="form-control" id="sel_provinsi" name="sel_provinsi" >
							<?php
							foreach ($ls_provinsi->result() as $key => $value) {
								echo "<option value='".$value->id."'>".$value->nama."</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="sel_provinsi">Kabupaten/Kotamadya:</label>
						<select class="form-control" id="sel_kota" name="sel_kota" required>
						</select>
					</div>
        			<div class="form-group">
						<label for="kode_kecamatan">Kode kecamatan:</label>
						<input type="text" class="form-control" id="kode_kecamatan" name="kode_kecamatan" value="" required>
						<input type="hidden" class="form-control" name="aksi" value="add">
					</div>
					<div class="form-group">
						<label for="nama_kecamatan">Nama kecamatan:</label>
						<input type="text" class="form-control" id="nama_kecamatan" name="nama_kecamatan" value="" required>
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
    	client_side('tbl_kecamatan');
    	$('#sel_provinsi,#sel_kota').select2({ width: '100%' });
    	$('#sel_provinsi').on('change', function(){
			openLoadingDialog();
			$('#sel_kota').empty();
			$.post( url+"referensi/ajax_get_kota", { enc: $(this).val()})
			.done(function( response ) {
		    	var obj = JSON.parse(response);
		    	if(obj.st==1){
		    		// $('#sel_kota').append("<option></option>");
		    		for(var i in obj.data){
			    		$('#sel_kota').append("<option value="+obj.data[i].id+">"+obj.data[i].nama+"</option>");
			    	}
			    	closeLoading();
		    	}
			});
		});
	} );
</script>