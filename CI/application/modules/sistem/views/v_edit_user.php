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
<form action="<?php echo base_url('sistem/save_user'); ?>" method="POST"  enctype="multipart/form-data" target="_self">
	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-4 imgUp">
					<div class="imagePreview">
						<img id='profile_img' class="img-responsive img-rounded img-thumbnail btn-file" src="<?php echo base_url('resources/img/profile/').$this->session->userdata('profile_img');?>" alt="User picture">
					</div>
					<label class="btn btn-outline-secondary btn_upload_img">
						Upload
					</label>
					<input type="file" name="file_profile" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
					<input type="hidden" name="enc" value="<?php echo $enc;?>">
					<h5><?php echo $ls_user->username;?></h5>
					<input type="hidden" class="form-control" id="username" name="username" value="<?php echo $ls_user->username;?>" readonly>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<label for="sel_group">User Group:</label>
						<select id="sel_group" name="sel_group" class="form-control">
							<?php
							foreach ($ls_group->result() as $key => $value) {
								$selected = '';
								if($value->groupid == $this->session->userdata('idgroup')){
									$selected = 'selected';
								}
								echo "<option value='".encrypt_val($value->groupid)."' ".$selected.">".$value->name."</option>";
							}
							?>
						</select>
					</div>
				</div>
            </div>
			<div class="form-group">
				<label for="fullname">Fullname:</label>
				<input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $ls_user->fullname?>" required>
			</div>
			<div class="form-group">
				<label for="email">Email:</label>
				<input type="email" class="form-control" id="email" name="email" value="<?php echo $ls_user->email?>" required>
			</div>
			<div class="form-group">
				<label for="telp">Telp:</label>
				<input type="text" class="form-control" id="telp" name="telp" value="<?php echo $ls_user->telp?>" required>
			</div>
			<input type="text" class="form-control" id="e" name="e" value="" hidden>
			<?php 
        	if($this->session->flashdata('error_paswd')){ 
        		$error = $this->session->flashdata('error_paswd');
        	?>
            <div class="alert alert-<?php echo $error['tipe'];?> ">
			  	<?php echo $error['msg'];?>
			</div>
			<?php } ?>
			<div class="form-group">
				<label for="pwd">Password:</label>
				<input type="password" class="form-control" id="passwd" name="passwd" placeholder="password">
			</div>
			<div class="form-group">
				<label for="pwd">Confirm Password:</label>
				<input type="password" class="form-control" id="confirm_passwd" name="confirm_passwd" placeholder="confirm password">
			</div>
		</div>
		<div class="col-md-6">
			
		</div>
	</div>
	<div class="row">
		<button type="submit" class="btn btn-primary">Submit</button>
		<a href="<?php echo base_url('sistem/user');?>" class="btn btn-danger">Cancel</a>
	</div>
</form> 



<script type="text/javascript">
	function goBack(url) {
  		window.open(url, "_self");
	}
$(function() {
	$('#sel_group').select2();
	$('.btn_upload_img').click(function(){
		if($.trim($(this).text())=='Upload')
			$('.uploadFile').trigger('click');
		else{
			$('.uploadFile').replaceWith( $('.uploadFile').val('').clone( true ) );
			$('#profile_img').attr('src', "<?php echo base_url('resources/img/profile/').$this->session->userdata('profile_img');?>");
			$(this).text('Upload');
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
                //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
				// uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
				$('#profile_img').attr('src', this.result);
				$('.btn_upload_img').text('Cancel');
            }
        }
      
    });
});
</script>