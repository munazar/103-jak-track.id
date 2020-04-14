<!DOCTYPE html>
<html lang="en-US"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	    <meta name="author" content="Jak-Track">
	    <meta name="description" content="Jak-Track.id">
	    <meta name="keywords" content="Jak-Track.id">

        <link rel="stylesheet" href="<?php echo base_url('resources/bootstrap-4.0.0/css/bootstrap.min.css'); ?>">
        <link href="<?php echo base_url('resources/css/'); ?>style-admin.css" rel="stylesheet">
	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

	    <link href="<?php echo base_url('resources/css/'); ?>icon.css" rel="stylesheet" type="text/css"/>
	    <link href="<?php echo base_url('resources/css/'); ?>font.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="jak/img/logo.png" />
        <title>Login - Frontend JakTrack</title>

    </head>
    <body dir="ltr" class="body" style="">
	    <div id="noScript" style="position: static; width: 100%; height: 100%; z-index: 100; display: none;">
	        <h1>JavaScript required</h1>
	        <p>JavaScript is required. This web browser does not support JavaScript or JavaScript in this web browser is not enabled.</p>
	        <p>To find out if your web browser supports JavaScript or to enable JavaScript, see web browser help.</p>
	    </div>
	    <script type="text/javascript" language="JavaScript">
	         document.getElementById("noScript").style.display = "none";
	    </script>
	    <div id="fullPage">
	        <div id="brandingWrapper" class="float">
	            <div id="branding" class="illustrationClass"></div>
	        </div>
	        <div id="contentWrapper" class="float" style="overflow-y:hidden;">
	            <div id="content">
	                <div id="header">
	                    <div class="row">
	                        <div class="col-md-auto" style="text-align: center;">
	                          	<img class="logoImage" style="width: 350px;" id="companyLogo" src="<?php echo base_url('resources/img/'); ?>Logo.png" alt="Aplikasi Jak-Track">
	                        </div>
	                        <div class="col-lg">

	                        </div>
	                    </div>
	                </div>
	                <div id="workArea" style="margin-top: 10px;">
	                    <div id="authArea" class="groupMargin">

	                        <div id="loginArea">
	                            <!--<div id="loginMessage" class="groupMargin"><b style="font-size: 17px;"><i><center>SSA - Secure Sign In Authentication</center></i></b></div>-->
	                            <form method="POST" name="log_user" id="log_user" class="area_login" autocomplete="off" novalidate="novalidate" action="<?php echo base_url();?>login/validation_credential">
	                                <div id="formsAuthenticationArea">
	                                	<?php 
	                                	if($this->session->flashdata('error_login')){ 
	                                		$error = $this->session->flashdata('error_login');
	                                	?>
	                                    <div class="alert alert-<?php echo $error['tipe'];?> ">
										  	<?php echo $error['msg'];?>
										</div>
										<?php } ?>
	                                    <div id="userNameArea">
	                                        <label id="userNameInputLabel" for="userid"><b>Nama Pengguna:</b></label>
	                                        <input required name="username" id="username" type="text" maxlength="30" tabindex="1" class="form-control" spellcheck="false" placeholder="Nama Pengguna anda" autocomplete="off" value="">
	                                    </div>

	                                    <div id="passwordArea">
	                                        <label id="passwordInputLabel" for="passwordInput"><b>Password:</b></label>
	                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password anda" autocomplete="off" required maxlength="30" value="">
	                                    </div>
	                                    <div class="row margin" id="doProcess">
	                                      <div class="input-field col s12">
	                                        <img src="<?php echo base_url('resources/img/'); ?>loading.svg" style="width: 25px; margin-top: 0px; margin-right: 0px;" align="left" hspace="10" vspace="0" id="loading_img" /> <i><span id="msg_txt" style="margin-top: 30px !important;"></span></i>
	                                      </div>
	                                    </div>
	                                    <div id="submissionArea" class="submitMargin" style="margin-top: 14px;">
	                                        <button type="submit" class="btn btn-md btn-primary" id="btnLogin">MASUK <i class="i i-login"></i></button>
	                                        <!-- <button type="button" class="btn btn-md btn-secondary" id="lupa">LUPA PASSWORD <i class="i i-question"></i></button> -->
	                                    </div>
	                                </div>
	                                <input id="optionForms" type="hidden" name="AuthMethod" value="FormsAuthentication">
	                            </form>

	                            <form  method="POST" name="reset_pass" id="reset_pass" autocomplete="off" style="margin-top:15px;">
	                                <div id="userNameArea">
	                                    <label for="email"><b>E-Mail:</b></label>
	                                    <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan alamat E-Mail anda..." required maxlength="30">
	                                </div>
	                                <div id="userNameArea">
	                                    <label for="token"><b>Token:</b></label>
	                                    <input type="text" name="token" id="token" class="form-control" placeholder="Masukkan Token anda..." required maxlength="30">
	                                </div>
	                                <div class="row margin" id="doProcess_res">
	                                  <div class="input-field col s12">
	                                    <img src="<?php echo base_url('resources/img/'); ?>loading.svg" style="width: 30px; margin-top: -3px; margin-right: 5px;" align="left" hspace="5" vspace="5" id="loading_img_res" /> <i><span id="msg_txt_res"></span></i>
	                                  </div>
	                                </div>
	                                <div id="submissionArea" class="submitMargin" style="margin-top: 14px;">
	                                    <button type="button" id="kembali" class="btn btn-md btn-secondary"><i class="i i-arrow-left2"></i> KEMBALI</button>
	                                    <button type="submit" id="btnReset" class="btn btn-md btn-primary"><i class="i i-history"></i> RESET PASSWORD</button>
	                                </div>
	                            </form>
	                            <div id="introduction" class="groupMargin">
	                                <!-- <p style="text-align: justify;">Jika ada kendala untuk masuk ke Aplikasi Jak-Track silahkan hubungi Administrator atau Klik tombol <b><i>Lupa Password</i></b>.</p> -->
	                            </div>
	                        </div>


	                    </div>
	                </div>
	                <div id="footerPlaceholder"></div>
	            </div>
	            <div id="footer">
	                <div id="footerLinks" class="floatReverse" >
	                     <!-- <div style="margin-top: -15px; text-align: center;"><span id="copyright">&copy; 2019 <b style="color: #000;">JAK</b><b style="color: #bf360c;">TRACK</b></span></div> -->
	                </div>
	            </div>
	        </div>
	    </div>
	    <input id="ext-version" type="hidden" value="1.3.4">
	</body>
	<script src="<?php echo base_url('resources/'); ?>js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript">
	var base_url = "<?php echo base_url();?>"
	</script>
	<script src="<?php echo base_url();?>resources/js/login.js" type="text/javascript"></script>
</html>
