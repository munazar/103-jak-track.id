<div class="row">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#frm_keperluan">
	  	Tambah Data
	</button>
</div>
<?php 
if($this->session->flashdata('error_keperluan')){ 
	$error = $this->session->flashdata('error_keperluan');
?>
<br>
<div class="alert alert-<?php echo $error['tipe'];?> ">
  	<?php echo $error['msg'];?>
</div>
<?php } ?>
<div class="row">
	<div class="table-responsive">
	 	<table class="table table-bordered table-sm table-hover" id="tbl_keperluan">
	    	<thead class='thead-light'>
	      		<tr>
	      			<th width="5%" class="text-center">No</th>
	        		<th width="70%" class="text-center">Keperluan</th>
	        		<th width="20%" class="text-center">Aktif</th>
	        		<th width="5%" class="text-center"><i class="far fa-sticky-note"></i></th>
	      		</tr>
	    	</thead>
	    	<tbody>
	      		<?php
	      		if(!empty($ls_keperluan)){
	      			$i=1;
	      			foreach ($ls_keperluan->result() as $row) {
	      				echo "<tr>";
	      				echo "	<td align='right'>".$i."</td>";
	      				echo "	<td>".$row->keperluan."</td>";
	      				if($row->aktif==1)$aktif = 'Aktif'; else $aktif = 'Tidak Aktif';
	      				echo "	<td>".$aktif."</td>";
	      				echo "	<td class='text-center'><a href='#' class='edit_form' data-toggle='modal' data-target='#frm_keperluan' enc='".encrypt_val($row->id)."'><i class='fas fa-edit'></i></a></td>";
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
<div class="modal" id="frm_keperluan">
  	<div class="modal-dialog">
    	<div class="modal-content">
    		<form method="POST" action="save_keperluan" enctype="multipart/form-data" target="_self">
      			<div class="modal-header">
        			<h4 class="modal-title">Tambah Data Ref Keperluan</h4>
        			<button type="button" class="close" data-dismiss="modal" onclick="clear_form()">&times;</button>
      			</div>
      			<div class="modal-body">
      				<div class="form-group">
						<label for="nama_keperluan">Nama keperluan:</label>
						<input type="text" class="form-control" id="nama_keperluan" name="nama_keperluan" value="" required>
						<input type="text" class="form-control" id="enc" name="enc" value="" hidden>
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
		$('#frm_keperluan input[type=text]').each(function(){
			$(this).val('');
		})
		$('#sel_aktif').val(1);
		$('.modal-title').text('Tambah Data Ref Keperluan');
	}
	
	$(document).ready( function () {
    	client_side('tbl_keperluan');
    	$('#sel_kecamatan').select2({ width: '100%' });
    	$('.edit_form').on('click', function(){
    		var enc = $(this).attr('enc');
    		clear_form();
    		$('.modal-title').text('Edit Data Ref Keperluan');
    		openLoadingDialog();
    		$.post( url+"referensi/ajax_get_keperluan", { enc: enc})
			.done(function( response ) {
		    	var obj = JSON.parse(response);
		    	if(obj.st==1){
			    	$('#enc').val(enc);
			    	$('#nama_keperluan').val(obj.data.keperluan);
			    	$('#sel_aktif').val(obj.data.aktif);
		    	}
		    	closeLoading();
			});
    	})
	} );
</script>