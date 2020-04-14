<?php 
if($this->session->flashdata('error_kecamatan')){ 
	$error = $this->session->flashdata('error_kecamatan');
?>
<div class="alert alert-<?php echo $error['tipe'];?> ">
  	<?php echo $error['msg'];?>
</div>
<?php } ?>
<form method="POST" action="<?php echo base_url('referensi/save_kecamatan'); ?>" enctype="multipart/form-data" target="_self">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="sel_provinsi">Provinsi:</label>
				<select class="form-control" id="sel_provinsi" name="sel_provinsi">
					<?php
					foreach ($ls_provinsi->result() as $key => $value) {
						$selected = '';
						if($value->id == $ls_kecamatan->id_provinsi){
							$selected = 'selected';
						}
						echo "<option value='".$value->id."' ".$selected.">".$value->nama."</option>";
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="sel_provinsi">Kabupaten/Kotamadya:</label>
				<select class="form-control" id="sel_kota" name="sel_kota" required>
					<?php
					foreach ($ls_kota->result() as $key => $value) {
						$selected = '';
						if($value->id_provinsi == $ls_kecamatan->id_provinsi){
							if($value->id == $ls_kecamatan->id_kota){
								$selected = 'selected';
							}
							echo "<option value='".$value->id."' ".$selected.">".$value->nama."</option>";
						}
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="kode_kecamatan">Kode Kecamatan:</label>
				<input type="text" class="form-control" id="kode_kecamatan" name="kode_kecamatan" value="<?php echo $ls_kecamatan->kode?>" required>
				<input type="hidden" name="aksi" value="edit">
				<input type="hidden" name="enc" value="<?php echo $enc;?>">
			</div>
			<div class="form-group">
				<label for="nama_kecamatan">Nama Kecamatan:</label>
				<input type="text" class="form-control" id="nama_kecamatan" name="nama_kecamatan" value="<?php echo $ls_kecamatan->nama?>" required>
			</div>
			<div class="form-group">
				<?php
				if($ls_kecamatan->aktif==1){
					$tidak_aktif='';
					$aktif='selected';
				}else{
					$tidak_aktif='selected';
					$aktif='';
				}
				?>
				<select class="form-control" id="sel_aktif" name="sel_aktif">
					<option value=0 <?php echo $tidak_aktif;?>>Tidak Aktif</option>
					<option value=1 <?php echo $aktif;?>>Aktif</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<button type="submit" class="btn btn-primary">Simpan</button>&nbsp&nbsp
		<a href="<?php echo base_url('referensi/kecamatan');?>" class="btn btn-danger">Batal</a>
	</div>
</form>
<script src="<?php echo base_url('resources/'); ?>js/referensi.js"></script>
<script type="text/javascript">
	$(document).ready( function () {
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