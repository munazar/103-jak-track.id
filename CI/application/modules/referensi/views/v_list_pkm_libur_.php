<?php 
if($this->session->flashdata('error_puskesmas')){ 
	$error = $this->session->flashdata('error_puskesmas');
?>
<br>
<div class="alert alert-<?php echo $error['tipe'];?> ">
  	<?php echo $error['msg'];?>
</div>
<?php } ?>
<div class="row">
	<div class="col-sm-6">
		<select class="form-control" id="sel_puskesmas" name="sel_puskesmas" >
			<option value=''>Pilih Puskesmas</option>
			<?php
			foreach ($ls_puskesmas->result() as $key => $value) {
				echo "<option value='".encrypt_val($value->id)."'>".$value->nama."</option>";
			}
			?>
		</select>
	</div>
	<div class="col-sm-6">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#frm_puskesmas">
		  	Tambah Data
		</button>
	</div>
</div>
<br>
<div class="row">
	<div class="table-responsive">
	 	<table class="table table-bordered table-sm table-hover" id="tbl_puskesmas">
	 		<thead class='thead-light'>
	      		<tr>
	      			<th width="5%" class="text-center">No</th>
	        		<th width="20%" class="text-center">Tanggal Libur</th>
	        		<th width="30%" class="text-center">Deskripsi</th>
	        		<th width="10%" class="text-center">Aktif</th>
	        		<th width="5%" class="text-center"><i class="far fa-sticky-note"></i></th>
	      		</tr>
	    	</thead>
	    	<tbody id='tbl_body'>
	    	</tbody>
	 	</table>
	 </div>
</div>

<!-- The Modal -->
<div class="modal" id="frm_puskesmas" data-backdrop="static">
  	<div class="modal-dialog">
    	<div class="modal-content">
    		<form method="POST" action="save_hari_libur" enctype="multipart/form-data" target="_self">
      			<div class="modal-header">
        			<h4 class="modal-title">Tambah Data Hari Libur</h4>
        			<button type="button" class="close" data-dismiss="modal" onclick="clear_form()">&times;</button>
      			</div>
      			<div class="modal-body">
					<div class="form-group">
						<label for="tanggal">Tanggal:</label>	
						<input type="text" class="form-control" id="tanggal" name="tanggal" value="" required placeholder="tanggal">
						<input type="text" class="form-control" id="enc" name="enc" value="" hidden>
					</div>
					<div class="form-group">
						<label for="deskripsi">Deskripsi:</label>
						<textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
					</div>
					
					<div class="form-group">
						<label for="sel_aktif">Aktif</label>
						<select class="form-control" id="sel_aktif" name="sel_aktif">
							<option value=0>Tidak Aktif</option>
							<option value=1 selected>Aktif</option>
						</select>
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
	function clear_form(){
		$('#frm_puskesmas input[type=text], #frm_puskesmas textarea').each(function(){
			$(this).val('');
		})
		$('#sel_aktif').val(1);
		$('.modal-title').text('Tambah Data Hari Libur');
	}
	$(function(){
		$('#sel_puskesmas').select2({ width: '100%' });
		client_side('tbl_puskesmas');
		$('#sel_puskesmas').change(function(){
			$('#page_title').text( "Setting Hari Libur - "+$("#sel_puskesmas option:selected").text());
			openLoadingDialog();
			table.destroy();
			$('#tbl_body').empty();
    		$.post( url+"referensi/ajax_get_libur_puskesmas", { enc: $(this).val()})
			.done(function( response ) {
		    	var obj = JSON.parse(response);
		    	var isi = obj.lsData;
		    	$('#tbl_body').append(isi);
		    	client_side('tbl_puskesmas');
		    	closeLoading();
			});
		})
		$(document).on("click", ".edit_form" , function() {
    		var enc = $(this).attr('enc');
    		clear_form();
    		$('.modal-title').text('Edit Data Hari Libur');
    		openLoadingDialog();
    		$.post( url+"referensi/ajax_get_hari_libur", { enc: enc})
			.done(function( response ) {
		    	var obj = JSON.parse(response);
		    	if(obj.st==1){
			    	$('#enc').val(enc);
			    	$('#tanggal').val(obj.data.tanggal);
			    	$('#deskripsi').val(obj.data.deskripsi);
			    	$('#sel_aktif').val(obj.data.aktif);
		    	}
		    	closeLoading();
			});
    	})
	})
</script>