<?php 
if($this->session->flashdata('error_provinsi')){ 
	$error = $this->session->flashdata('error_provinsi');
?>
<div class="alert alert-<?php echo $error['tipe'];?> ">
  	<?php echo $error['msg'];?>
</div>
<?php } ?>
<form method="POST" action="<?php echo base_url('referensi/save_provinsi'); ?>" enctype="multipart/form-data" target="_self">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="kode_provinsi">Kode Provinsi:</label>
				<input type="text" class="form-control" id="kode_provinsi" name="kode_provinsi" value="<?php echo $ls_provinsi->kode?>" required>
				<input type="hidden" name="aksi" value="edit">
				<input type="hidden" name="enc" value="<?php echo $enc;?>">
			</div>
			<div class="form-group">
				<label for="nama_provinsi">Nama Provinsi:</label>
				<input type="text" class="form-control" id="nama_provinsi" name="nama_provinsi" value="<?php echo $ls_provinsi->nama?>" required>
			</div>
			<div class="form-group">
				<?php
				if($ls_provinsi->aktif==1){
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
		<a href="<?php echo base_url('referensi/provinsi');?>" class="btn btn-danger">Batal</a>
	</div>
</form>