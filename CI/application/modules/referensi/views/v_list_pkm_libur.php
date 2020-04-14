<script src="<?php echo base_url();?>resources/vendor/bootstrap-year-calendar-bs4-master/js/bootstrap-year-calendar.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>resources/vendor/bootstrap-year-calendar-bs4-master/css/bootstrap-year-calendar.css"/>

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
				$selected = '';
				if($id_puskesmas==$value->id) $selected = 'selected';
				echo "<option value='".encrypt_val($value->id)."' ".$selected.">".$value->nama."</option>";
			}
			?>
		</select>
	</div>
</div>
<br>

<div class="row">
	<div class="panel panel-default" style="margin:10px;">
		<div class="panel-heading" id="nama_pkm"></div>
		<div class="panel-body">
			<div id="calendar" class="calendar"></div>
		</div>
	</div>
</div>
<!-- The Modal -->
<div class="modal fade" id="event-modal" data-backdrop="static">
	<form method="POST" action="<?php echo base_url('referensi/save_hari_libur');?>" enctype="multipart/form-data" target="_self">
	    <div class="modal-dialog">
	      	<div class="modal-content">
	      
		        <!-- Modal Header -->
		        <div class="modal-header">
		          <h4 class="modal-title">Hari Libur - <label id="event-display-date"></label></h4>
		          <button type="button" class="close" data-dismiss="modal">×</button>
		        </div>
		        
		        <!-- Modal body -->
		        <div class="modal-body">
					<input name="event-start-date" type="text" hidden>
					<input name="event-index" type="hidden">
					<input name="enc" type="hidden" value="<?php echo $enc; ?>">
					
		          	<div class="form-group">
						<label for="event-deskripsi">Deskripsi:</label>
						<textarea class="form-control" id="event-deskripsi" name="event-deskripsi" required></textarea>
					</div>
		        </div>
		        
		        <!-- Modal footer -->
		        <div class="modal-footer">
					<button type="button" class="btn btn-danger" hidden>Hapus</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
		  			<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
		        </div>
	        
	      	</div>
	    </div>
	</form>
</div>
<!-- modal -->
<script type="text/javascript">
	$('#calendar').calendar();
	function clear_form(){
		$('#event-modal input[type=text] , #event-modal textarea').each(function(){
			$(this).val('');
		})
	}
	function editEvent(event) {
	    $('#event-modal input[name="event-index"]').val(event ? event.id : '');
	    $('#event-modal textarea[name="event-deskripsi"]').val(event ? event.deskripsi : '');
	    $('#event-modal input[name="event-start-date"]').val(selected_tanggal ? selected_tanggal : '');
	    $('#event-display-date').text(dis_tanggal ? dis_tanggal : '');
	    $('#event-modal').modal();
	}
	
	var events = '';var selected_tanggal, dis_tanggal = '';

	$('#calendar').calendar({
	    enableContextMenu: true,
	    enableRangeSelection: true,
	    selectRange: function(e) {
	    	var tanggal = new Date(e.endDate);
	    	selected_tanggal = tanggal.getFullYear()+'-'+(tanggal.getMonth()+1)+'-'+tanggal.getDate();
	    	dis_tanggal = formatDate(tanggal);
	        editEvent(events);
	    },
	    mouseOnDay: function(e) {
	        if(e.events.length > 0) {
	            var content = '';
	            
	            for(var i in e.events) {
	                content += '<div class="event-tooltip-content">'
	                                + '<div class="event-name" style="color:' + e.events[i].color + '">' + e.events[i].nm_pkm + '</div>'
	                                + '<div class="event-location">' + e.events[i].deskripsi + '</div>'
	                            + '</div>';
	            }
	            events = e.events[i];
	        	
	            $(e.element).popover({
	                trigger: 'manual',
	                container: 'body',
	                html:true,
	                content: content
	            });
	            
	            $(e.element).popover('show');
	        }else{
	        	events = {};
	        }
	    },
	    mouseOutDay: function(e) {
	        if(e.events.length > 0) {
	            $(e.element).popover('hide');
	        }
	    },
	    dayContextMenu: function(e) {
	        $(e.element).popover('hide');
	    },
	    dataSource: [<?php echo $data_source;?>]
	});
	$(function(){
		$('#sel_puskesmas').change(function(){
			$('#page_title').text( "Setting Hari Libur - "+$("#sel_puskesmas option:selected").text());
			window.open('<?php echo base_url()."referensi/pkm_libur/";?>'+$(this).val(), "_self");
		})
		$('#event-modal').on('hidden.bs.modal', function () {
		    clear_form();
		})
	});
</script>