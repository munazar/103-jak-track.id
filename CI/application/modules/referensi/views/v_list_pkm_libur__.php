<script src="<?php echo base_url();?>resources/vendor/bootstrap-year-calendar/bootstrap-year-calendar.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>resources/vendor/bootstrap-year-calendar/bootstrap-year-calendar.css"/>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" /> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
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
</div>
<br>
<input type="text" id='test'>
<div class="row">
	<div class="panel panel-default" style="margin:10px;">
		<div class="panel-heading">Calendar</div>
		<div class="panel-body">
			<div id="calendar" class="calendar"></div>
		</div>
	</div>
</div>

<!-- The Modal -->
  <div class="modal fade" id="event-modal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Hari Libur</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          
          
          <input name="event-location" type="text">
          <div class="form-group">
			<label for="deskripsi">Deskripsi:</label>
			<input name="event-name" type="text">
			<input name="event-index" type="hidden">
		</div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  <!-- modal -->

<script type="text/javascript">
	function editEvent(event) {
		
	    $('#event-modal input[name="event-index"]').val(event ? event.id : '');
	    $('#event-modal input[name="event-name"]').val(event ? event.name : '');
	    $('#event-modal input[name="event-location"]').val(event ? event.location : '');
	    // $('#event-modal input[name="event-start-date"]').datepicker('update', event ? event.startDate : '');
	    // $('#event-modal input[name="event-end-date"]').datepicker('update', event ? event.endDate : '');
	    $('#event-modal').modal();
	}

	function deleteEvent(event) {
	    var dataSource = $('#calendar').data('calendar').getDataSource();

	    for(var i in dataSource) {
	        if(dataSource[i].id == event.id) {
	            dataSource.splice(i, 1);
	            break;
	        }
	    }
	    
	    $('#calendar').data('calendar').setDataSource(dataSource);
	}

	function saveEvent() {
	    var event = {
	        id: $('#event-modal input[name="event-index"]').val(),
	        name: $('#event-modal input[name="event-name"]').val(),
	        location: $('#event-modal input[name="event-location"]').val(),
	        // startDate: $('#event-modal input[name="event-start-date"]').datepicker('getDate'),
	        // endDate: $('#event-modal input[name="event-end-date"]').datepicker('getDate')
	    }
	    
	    var dataSource = $('#calendar').data('calendar').getDataSource();

	    if(event.id) {
	        for(var i in dataSource) {
	            if(dataSource[i].id == event.id) {
	                dataSource[i].name = event.name;
	                dataSource[i].location = event.location;
	                dataSource[i].startDate = event.startDate;
	                dataSource[i].endDate = event.endDate;
	            }
	        }
	    }
	    else
	    {
	        var newId = 0;
	        for(var i in dataSource) {
	            if(dataSource[i].id > newId) {
	                newId = dataSource[i].id;
	            }
	        }
	        
	        newId++;
	        event.id = newId;
	    
	        dataSource.push(event);
	    }
	    
	    $('#calendar').data('calendar').setDataSource(dataSource);
	    $('#event-modal').modal('hide');
	}

	function reload_data_source(data){
		var dataSource = {};
		
		for(var i in data) {
			dataSource[i] = data[i];
		}
	    
	    $('#calendar').data('calendar').setDataSource(dataSource);
	    $('#event-modal').modal('hide');
	}


	var currentYear = new Date().getFullYear();
	var events = '';

	$('#calendar').calendar({
	    enableContextMenu: true,
	    enableRangeSelection: true,
	    contextMenuItems:[
	        {
	            text: 'Update',
	            click: editEvent
	        },
	        {
	            text: 'Delete',
	            click: deleteEvent
	        }
	    ],
	    selectRange: function(e) {
	    	// console.log(events);
	        editEvent(events);
	    },
	    mouseOnDay: function(e) {
	        if(e.events.length > 0) {
	            var content = '';
	            
	            for(var i in e.events) {
	                content += '<div class="event-tooltip-content">'
	                                + '<div class="event-name" style="color:' + e.events[i].color + '">' + e.events[i].name + '</div>'
	                                + '<div class="event-location">' + e.events[i].location + '</div>'
	                            + '</div>';
	            }
	            events = e.events[i];
	        	
	            // $(e.element).popover({
	            //     trigger: 'manual',
	            //     container: 'body',
	            //     html:true,
	            //     content: content
	            // });
	            
	            // $(e.element).popover('show');
	        }
	    },
	    mouseOutDay: function(e) {
	        if(e.events.length > 0) {
	            // $(e.element).popover('hide');
	        }
	    },
	    dayContextMenu: function(e) {
	        // $(e.element).popover('hide');
	    },
	    dataSource: [{}]
	});

	$('#save-event').click(function() {
	    saveEvent();
	});

	// $(function(){
		$('#sel_puskesmas').change(function(){
			$('#page_title').text( "Setting Hari Libur - "+$("#sel_puskesmas option:selected").text());
			openLoadingDialog();
			// table.destroy();
			// $('#tbl_body').empty();
    		$.post( url+"referensi/ajax_get_libur_puskesmas", { enc: $(this).val()})
			.done(function( response ) {
		    	var obj = JSON.parse(response);
		    	console.log(obj.dataCalendar);
		    	reload_data_source(obj.dataCalendar);
		    	// var isi = obj.lsData;
		    	// $('#tbl_body').append(isi);
		    	// client_side('tbl_puskesmas');
		    	closeLoading();
			});
		})
	// })

</script>
