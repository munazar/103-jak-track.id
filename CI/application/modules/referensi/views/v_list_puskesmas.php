<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>resources/vendor/clockpicker/bootstrap-clockpicker.min.css" >

<style type="text/css">
	
	.imagePreview {
	    background-position: center center;
	  	background-color:#fff;
	    background-size: cover;
	  	background-repeat:no-repeat;
	    display: inline-block;
	  	box-shadow:0px -3px 6px 2px rgba(0,0,0,0.2);
	}
	.btn_upload_img
	{
	  display:block;
	  border-radius:0px;
	  box-shadow:0px 4px 6px 2px rgba(0,0,0,0.2);
	  margin-top:-5px;
	}
	.imgUp
	{
	  margin-bottom:15px;
	}
</style>
<div class="row">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#frm_puskesmas">
	  	Tambah Data
	</button>
</div>
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
	<div class="table-responsive">
	 	<table class="table table-bordered table-sm table-hover" id="tbl_puskesmas">
	    	<thead class='thead-light'>
	      		<tr>
	      			<th width="5%" class="text-center">No</th>
	        		<th width="20%" class="text-center">Puskesmas</th>
	        		<th width="30%" class="text-center">Alamat</th>
	        		<th width="15%" class="text-center">Deskripsi</th>
	        		<th width="10%" class="text-center">Aktif</th>
	        		<th width="5%" class="text-center"><i class="far fa-sticky-note"></i></th>
	      		</tr>
	    	</thead>
	    	<tbody>
	      		<?php
	      		if(!empty($ls_puskesmas)){
	      			$i=1;
	      			foreach ($ls_puskesmas->result() as $row) {
	      				echo "<tr>";
	      				echo "	<td align='right'>".$i."</td>";
	      				echo "	<td>".$row->nama."</td>";
	      				if(strlen($row->alamat)>40){
	      					$desc = substr($row->alamat, 0, 40)."...";	
	      				}else{
	      					$desc = $row->alamat;
	      				}
	      				echo "	<td title='".$row->alamat."'>".$desc."</td>";
	      				if(strlen($row->deskripsi)>15){
	      					$desc = substr($row->deskripsi, 0, 10)."...";	
	      				}else{
	      					$desc = $row->deskripsi;
	      				}
	      				echo "	<td title='".$row->deskripsi."'>".$desc."</td>";
	      				
	      				if($row->aktif==1)$aktif = 'Aktif'; else $aktif = 'Tidak Aktif';
	      				echo "	<td>".$aktif."</td>";
	      				echo "	<td class='text-center'><a href='#' class='edit_form' data-toggle='modal' data-target='#frm_puskesmas' enc='".encrypt_val($row->id)."'><i class='fas fa-edit'></i></a></td>";
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
<div class="modal" id="frm_puskesmas" data-backdrop="static">
  	<div class="modal-dialog">
    	<div class="modal-content">
    		<form method="POST" action="save_puskesmas" enctype="multipart/form-data" target="_self">
      			<div class="modal-header">
        			<h4 class="modal-title">Tambah Data Puskesmas</h4>
        			<button type="button" class="close" data-dismiss="modal" onclick="clear_form()">&times;</button>
      			</div>
      			<div class="modal-body">
      				<div class='row'>
      					<div class="col-md-4 imgUp">
							<div class="imagePreview">
								<img id='profile_img' class="img-responsive img-rounded img-thumbnail btn-file" src="<?php echo base_url('resources/img/pkm_res/logo_puskesmas.png');?>" alt="Logo">
							</div>
							<label class="btn btn-outline-secondary btn_upload_img">
								Upload
							</label>
							<input type="file" name="file_logo" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<label for="nama_puskesmas">Nama Puskesmas:</label>
								<input type="text" class="form-control" id="nama_puskesmas" name="nama_puskesmas" value="" required>
								<input type="text" class="form-control" id="enc" name="enc" value="" hidden>
							</div>
							<div class="form-group">
								<label for="alamat_puskesmas">Alamat:</label>
								<textarea class="form-control" id="alamat_puskesmas" name="alamat_puskesmas" required></textarea>
							</div>
						</div>
      				</div>
					<div class="form-group">
						<label for="telp1">Telp Puskesmas:</label>
						<div class="row">
							<div class="col-md-6">
								<input type="text" class="form-control" id="telp1" name="telp1" value="" required placeholder="Telp 1">
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" id="telp2" name="telp2" value="" placeholder="Telp 2">	
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="sel_kecamatan">Kecamatan:</label>
						<select class="form-control" id="sel_kecamatan" name="sel_kecamatan" >
							<?php
							foreach ($ls_kecamatan->result() as $key => $value) {
								echo "<option value='".$value->id."'>".$value->nama."</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="deskripsi">Deskripsi:</label>
						<textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="jam_buka">Jam Buka:</label>
								<input type="text" class="form-control time" id="jam_buka" name="jam_buka" value="" placeholder="jam buka layanan">
							</div>		
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="jam_tutup">Jam Tutup:</label>
								<input type="text" class="form-control time" id="jam_tutup" name="jam_tutup" value="" placeholder="jam tutup layanan">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="checkbox">
								  <label><input type="checkbox" value="Y" name="sabtu_tutup" id="sabtu_tutup"> Sabtu Tutup</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="layanan_hari">Jadwal Layanan(hari):</label>
								<input type="text" class="form-control" id="layanan_hari" name="layanan_hari" value="" placeholder="jumlah hari layanan">
							</div>		
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="sel_interval">Interval Layanan(menit):</label>
								<select class="form-control" id="sel_interval" name="sel_interval">
									<option value=30 selected>Tiap 30 Menit</option>
									<option value=60>Tiap 60 Menit</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="short_url">Url Pendek</label>
								<select class="form-control" id="short_url" name="short_url">
									<option value=''></option>
									<?php
									foreach ($ls_short_url->result() as $key => $value) {
										echo "<option value='".$value->s."'>".$value->s."</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="sel_aktif">Aktif</label>
								<select class="form-control" id="sel_aktif" name="sel_aktif">
									<option value=0>Tidak Aktif</option>
									<option value=1 selected>Aktif</option>
								</select>
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
<script src="<?php echo base_url();?>resources/vendor/clockpicker/bootstrap-clockpicker.min.js"></script>
<script type="text/javascript">
	function clear_form(){
		$('#profile_img').attr('src', url+"resources/img/pkm_res/logo_puskesmas.png");
		$('#frm_puskesmas input[type=text], #frm_puskesmas textarea').each(function(){
			$(this).val('');
		})
		$('#sel_aktif').val(1);
		$('#sel_interval').val(30);
		$('#sel_kecamatan').val('');
		$('#sel_kecamatan').trigger('change');
		$('.modal-title').text('Tambah Data Puskesmas');
		$('#sabtu_tutup').attr('checked', false);
	}
	function loading_logo(file, teks){
		$("#profile_img").hide();
		$(".btn_upload_img").text("Loading Logo");
		$("#profile_img").on("load", function() {
			$(".btn_upload_img").text(teks);
	        $("#profile_img").show();
	    }).attr('src', file);
	}
	$('.time').clockpicker({donetext: 'Pilih'}); 
	$(document).ready( function () {
		$('#frm_puskesmas').on('hidden.bs.modal', function () {
		    clear_form();
		})
		var	img_file='logo_puskesmas.png';
    	client_side('tbl_puskesmas');
    	$('#sel_kecamatan').select2({ width: '100%' });
    	$('.edit_form').on('click', function(){
    		var enc = $(this).attr('enc');
    		clear_form();
    		img_file='logo_puskesmas.png';
    		$('.modal-title').text('Edit Data Puskesmas');
    		openLoadingDialog();
    		$.post( url+"referensi/ajax_get_puskesmas", { enc: enc})
			.done(function( response ) {
		    	var obj = JSON.parse(response);
		    	if(obj.st==1){
		    		if(obj.data.file_logo==null){
		    			obj.data.file_logo = 'logo_puskesmas.png';
		    		}
		    		img_file=obj.data.file_logo;
		    		loading_logo(url+"resources/img/pkm_res/"+obj.data.file_logo, 'Upload');
			    	$('#enc').val(enc);
			    	$('#nama_puskesmas').val(obj.data.nama);
			    	$('#alamat_puskesmas').val(obj.data.alamat);
			    	$('#telp1').val(obj.data.telp1);
			    	$('#telp2').val(obj.data.telp2);
			    	$('#deskripsi').val(obj.data.deskripsi);
			    	$('#sel_aktif').val(obj.data.aktif);
			    	$('#sel_interval').val(obj.data.interval_menit);
			    	$('#layanan_hari').val(obj.data.layanan_hari);
			    	$('#sel_kecamatan').val(obj.data.id_kecamatan);
					$('#sel_kecamatan').trigger('change');
					$('#short_url').val(obj.data.short_url);
					$('#jam_buka').val(obj.data.jam_buka);
					$('#jam_tutup').val(obj.data.jam_tutup);
					if(obj.data.sabtu_tutup=='Y')
						$('#sabtu_tutup').attr('checked', true);
					else
						$('#sabtu_tutup').attr('checked', false);
		    	}
		    	closeLoading();
			});

    	})
		$('.btn_upload_img').click(function(){
			if($.trim($(this).text())=='Upload')
				$('.uploadFile').trigger('click');
			else{
				$('.uploadFile').replaceWith( $('.uploadFile').val('').clone( true ) );
				loading_logo(url+"resources/img/pkm_res/"+img_file, 'Upload');
			}
		})
	    $(document).on("change",".uploadFile", function(){
	    	var uploadFile = $(this);
	        var files = !!this.files ? this.files : [];
	        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
	 
	        if (/^image/.test( files[0].type)){ // only image file
	            var reader = new FileReader(); // instance of the FileReader
	            reader.readAsDataURL(files[0]); // read the local file
	 
	            reader.onloadend = function(){ // set image data as background of div
	            	loading_logo(this.result, 'Cancel');

	            }
	        }
	      
	    });
	} );
</script>