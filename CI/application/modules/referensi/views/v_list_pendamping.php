<div class="row">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#frm_pendamping">
	  	Tambah Data
	</button>
</div>
<?php 
if($this->session->flashdata('error_pendamping')){ 
	$error = $this->session->flashdata('error_pendamping');
?>
<br>
<div class="alert alert-<?php echo $error['tipe'];?> ">
  	<?php echo $error['msg'];?>
</div>
<?php } ?>
<div class="row">
	<div class="table-responsive">
	 	<table class="table table-bordered table-sm table-hover" id="tbl_pendamping">
	    	<thead class='thead-light'>
	      		<tr>
	      			<th width="5%" class="text-center">No</th>
	        		<th width="50%" class="text-center">Pendamping</th>
	        		<th width="20%" class="text-center">Handphone</th>
	        		<th width="20%" class="text-center">CSO Asal</th>
	        		<th width="5%" class="text-center"><i class="far fa-sticky-note"></i></th>
	      		</tr>
	    	</thead>
	    	<tbody>
	      		<?php
	      		if(!empty($ls_pendamping)){
	      			$i=1;
	      			foreach ($ls_pendamping->result() as $row) {
	      				echo "<tr>";
	      				echo "	<td align='right'>".$i."</td>";
	      				echo "	<td>".$row->nm_cso_pendamping."</td>";
	      				echo "	<td>".$row->no_hp."</td>";
	      				echo "	<td>".$row->cso_asal."</td>";
	      				echo "	<td class='text-center'><a href='#' class='edit_form' data-toggle='modal' data-target='#frm_pendamping' enc='".encrypt_val($row->id)."'><i class='fas fa-edit'></i></a></td>";
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
<div class="modal" id="frm_pendamping">
  	<div class="modal-dialog">
    	<div class="modal-content">
    		<form method="POST" action="save_pendamping" enctype="multipart/form-data" target="_self">
      			<div class="modal-header">
        			<h4 class="modal-title">Tambah Data Ref Pendamping</h4>
        			<button type="button" class="close" data-dismiss="modal" onclick="clear_form()">&times;</button>
      			</div>
      			<div class="modal-body">
      				<div class="form-group">
						<label for="sel_kategori">Kategori Pendamping:</label>
						<select class="form-control" id="sel_kategori" name="sel_kategori" required>
							<option value=''></option>
							<?php
							foreach ($ls_kategori->result() as $key => $value) {
								echo "<option value='".$value->id."'>".$value->nama."</option>";
							}
							?>
						</select>
					</div>
      				<div class="form-group">
						<label for="nama_pendamping">Nama Pendamping:</label>
						<input type="text" class="form-control" id="nama_pendamping" name="nama_pendamping" value="" placeholder="nama pendamping" required>
						<input type="text" class="form-control" id="enc" name="enc" value="" hidden>
					</div>
					<div class="form-group">
						<label for="alamat_pendamping">Alamat:</label>
						<textarea class="form-control" id="alamat_pendamping" name="alamat_pendamping" placeholder="alamat"></textarea>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="handphone">Handphone:</label>
								<input type="text" class="form-control" id="handphone" name="handphone" value="" placeholder="no handphone" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="email">Email:</label>
								<input type="email" class="form-control" id="email" name="email" value="" placeholder="email" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="sel_pkm_asal">PKM Asal:</label>
						<select class="form-control" id="sel_pkm_asal" name="sel_pkm_asal" >
							<?php
							foreach ($ls_puskesmas->result() as $key => $value) {
								echo "<option value='".$value->id."'>".$value->nama."</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="cso_asal">CSO Asal:</label>
						<select class="form-control" id="cso_asal" name="cso_asal" required>
							<option></option>
							<?php
							foreach ($ls_cso->result() as $key => $value) {
								echo "<option value='".$value->kd_lembaga."'>".$value->nm_lembaga."</option>";
							}
							?>
						</select>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="kd_sufix">Kode Sufix:</label>
								<input type="text" class="form-control" id="kd_sufix" name="kd_sufix" value="" placeholder="kode sufix">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="kd_cso_pendamping">Kode CSO Pendamping:</label>
								<input type="text" class="form-control" id="kd_cso_pendamping" name="kd_cso_pendamping" value="" placeholder="kode cso">
							</div>
						</div>
					</div>
      			</div>
      			<div class="modal-footer">
      				<button type="submit" class="btn btn-primary">Simpan</button>
        			<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="clear_form()">Batal</button>
      			</div>
      		</form>
    	</div>
  	</div>
</div>
<!-- End Modal -->
<script src="<?php echo base_url();?>resources/vendor/datatables/server-side.js"></script>
<script type="text/javascript">
	function clear_form (){
		$('#frm_pendamping input[type=text],#frm_pendamping input[type=email]').each(function(){
			$(this).val('');
		})
		$('textarea').val('');
		$('#sel_pkm_asal').val(1);
    	$('#sel_pkm_asal').trigger('change');
		$('.modal-title').text('Tambah Data Ref Pendamping');
	}
	
	$(document).ready( function () {
    	client_side('tbl_pendamping');
    	$('#sel_pkm_asal, #cso_asal').select2({ width: '100%' });
    	$('.edit_form').on('click', function(){
    		var enc = $(this).attr('enc');
    		clear_form();
    		$('.modal-title').text('Edit Data Ref Pendamping');
    		openLoadingDialog();
    		$.post( url+"referensi/ajax_get_pendamping", { enc: enc})
			.done(function( response ) {
		    	var obj = JSON.parse(response);
		    	if(obj.st==1){
			    	$('#enc').val(enc);
			    	$('#nama_pendamping').val(obj.data.nm_cso_pendamping);
			    	$('#alamat_pendamping').val(obj.data.alamat);
			    	$('#handphone').val(obj.data.no_hp);
			    	$('#email').val(obj.data.email);
			    	$('#sel_pkm_asal').val(obj.data.id_puskesmas);
			    	$('#cso_asal').val(obj.data.cso_asal);
			    	$('#sel_pkm_asal, #cso_asal').trigger('change');
			    	$('#kd_sufix').val(obj.data.kd_sufix);
			    	$('#kd_cso_pendamping').val(obj.data.kd_cso_pendamping);
			    	$('#sel_kategori').val(obj.data.kategori_id);
			    	
		    	}
		    	closeLoading();
			});
    	})
	} );
</script>