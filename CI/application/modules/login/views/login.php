<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	    <meta name="author" content="Jak-Track">
	    <meta name="description" content="Jak-Track.id">
	    <meta name="keywords" content="Jak-Track.id">

	    <link rel="shortcut icon" href="logo/JakTrack.png" type="image/x-icon">
	    <link rel="icon" href="logo/JakTrack.png" type="image/x-icon">

	    <!-- <link href="<?php echo base_url('resources/css/metro.css'); ?>" rel="stylesheet"> -->
	    <link href="<?php echo base_url('resources/css/'); ?>style-admin.css" rel="stylesheet">
	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	    <link rel="stylesheet" href="<?php echo base_url('resources/bootstrap-4.0.0/css/bootstrap.min.css'); ?>">
	    <title>Jak-Track.id Admin</title>
	</head>
	<body>
	    <div class='container'>
	    	<button type="button" id="btn_login" class="btn btn-primary d-none" data-toggle="modal" data-backdrop="static" data-target="#loginModal">
			    Open modal
			</button>
	    	<!-- The Modal -->
			<div class="modal show fade" id="loginModal">
			  	<div class="modal-dialog">
			    	<div class="modal-content">
			    		<form action="/action_page.php">
				      		<!-- Modal Header -->
				      		<div class="modal-header">
				        		<h4 class="modal-title">Login</h4>
				      		</div>
				      		<!-- Modal body -->
				      		<div class="modal-body">
								<div class="form-group">
									<label for="email">Username:</label>
									<input type="text" class="form-control" id="email">
								</div>
								<div class="form-group">
									<label for="pwd">Password:</label>
									<input type="password" class="form-control" id="pwd">
								</div>
				      		</div>
				      		<!-- Modal footer -->
				      		<div class="modal-footer">
				        		<button type="submit" class="btn btn-primary">Submit</button>
				      		</div>
			      		</form> 
			    	</div>
			  	</div>
			</div>
			<!-- END Modal -->
	    </div>
	</body>
	<script src="<?php echo base_url('resources/'); ?>js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url('resources/'); ?>js/start.js"></script>
    <!--<script src="<?php echo base_url('resources/'); ?>js/metro.js"></script>-->
    <script src='<?php echo base_url('resources/'); ?>js/bootstrap.bundle.min.js'></script>
    <script src='<?php echo base_url('resources/'); ?>js/jquery.vide.js'></script>
    <script type="text/javascript">
		$(document).ready(function(){
			$('#btn_login').trigger('click');
		})
	</script>
</html>