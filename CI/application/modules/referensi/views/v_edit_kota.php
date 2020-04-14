<?php 
if($this->session->flashdata('error_kota')){ 
	$error = $this->session->flashdata('error_kota');
?>
<div class="alert alert-<?php echo $error['tipe'];?> ">
  	<?php echo $error['msg'];?>
</div>
<?php } ?>
<form method="POST" action="<?php echo base_url('referensi/save_kota'); ?>" enctype="multipart/form-data" target="_self">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="sel_provinsi">Provinsi:</label>
				<select class="form-control" id="sel_provinsi" name="sel_provinsi">
					<?php
					foreach ($ls_provinsi->result() as $key => $value) {
						$selected = '';
						if($value->id == $ls_kota->id_provinsi){
							$selected = 'selected';
						}
						echo "<option value='".$value->id."' ".$selected.">".$value->nama."</option>";
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="kode_kota">Kode Kota:</label>
				<input type="text" class="form-control" id="kode_kota" name="kode_kota" value="<?php echo $ls_kota->kode?>" required>
				<input type="hidden" name="aksi" value="edit">
				<input type="hidden" name="enc" value="<?php echo $enc;?>">
			</div>
			<div class="form-group">
				<label for="nama_kota">Nama Kota:</label>
				<input type="text" class="form-control" id="nama_kota" name="nama_kota" value="<?php echo $ls_kota->nama?>" required>
			</div>
			<div class="form-group">
				<?php
				if($ls_kota->aktif==1){
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
		<a href="<?php echo base_url('referensi/kota');?>" class="btn btn-danger">Batal</a>
	</div>
</form>
<script type="text/javascript">
	$(document).ready( function () {
    	$('#sel_provinsi').select2({ width: '100%' });
	} );
</script>