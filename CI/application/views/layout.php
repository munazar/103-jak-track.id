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
    <link href="<?php echo base_url('resources/css/'); ?>style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url('resources/bootstrap-4.0.0/css/bootstrap.min.css'); ?>">
    <title>Jak-Track.id</title>
	</head>
	<body>
    <div class='container'>
    	<br>
    	<div class="row">
	      <div class="col-md-3 col-sm-4 col-4">
	            <img src="<?php echo base_url('resources/img/'); ?>Logo.png" alt="" class="img-fluid">
	      </div>
	      <div class="col-md-1 col-sm-1 col-1 offset-md-6 offset-sm-5 offset-5">
	        <img src="<?php echo base_url('resources/img/'); ?>logo/jakarta.png" alt="" class='jak img-fluid'>
	      </div>
	      <div class="col-md-1 col-sm-1 col-1">
	        <img src="<?php echo base_url('resources/img/'); ?>logo/SmartCityDKI.png" alt="" class='sc img-fluid'>
	      </div>
	      <div class="col-md-1 col-sm-1 col-1">
	        <img src="<?php echo base_url('resources/img/'); ?>logo/dinkes.png" alt="" class='dinkes img-fluid'>
	      </div>
	    </div>
    	<div class="row">
      	<div class="col-md-4 col-sm-6 col-8">
	        <p class="text-responsive text-white">
	            <strong>Jak-Track</strong> Adalah Sistem Aplikasi Online berbasis web berisi data informasi dan laporan kegiatan inovatif untuk mendukung percepatan penanggulanan HIV/AIDS melalui jalur cepat(fast track) di Jakarta
	        </p>
	      </div>
      </div>
    	<div class="row">
    		<img src="<?php echo base_url('resources/img/'); ?>icon-Ambil-Obat.png" alt="" class="obat bg link" data-link='http://res.bantuanteknis.org' >
	      <img src="<?php echo base_url('resources/img/'); ?>icon-Ambil-Obat-tanpa-bg.png" alt="" class="obat link" data-link='http://res.bantuanteknis.org' 
	        data-toggle="popover" 
	        data-trigger="hover" 
	        data-placement="top" 
	        title="" 
	        data-content="Pemesanan/booking layanan pengobatan HIV di fasilitas layanan kesehatan.">

	      <img src="<?php echo base_url('resources/img/'); ?>Icon-Cek-risiko.png" alt="" class="risiko bg link" data-link='http://jak-cek.bantuanteknis.org/'>
	      <img src="<?php echo base_url('resources/img/'); ?>Icon-Cek-risiko-tanpa-bg.png" alt="" class="risiko link" data-link='http://jak-cek.bantuanteknis.org/'
	        data-toggle="popover" 
	        data-trigger="hover"
	        data-placement="top" 
	        title="" 
	        data-content="Penjajakan risiko diri terhadap kemungkinan tertular HIV.">

	      <img src="<?php echo base_url('resources/img/'); ?>icon_kinerja.png" alt="" class="kinerja bg link" data-link='https://simonacantik-dinkes.jakarta.go.id/'>
	      <img src="<?php echo base_url('resources/img/'); ?>icon_kinerja-tanpa-bg.png" alt="" class="kinerja link" data-link='https://simonacantik-dinkes.jakarta.go.id/'
	        data-toggle="popover" 
	        data-trigger="hover" 
	        data-placement="top" 
	        title="" 
	        data-content="Penilaian kinerja teknis layanan HIV di tingkat Puskesmas/Rumah Sakit.">

	      <img src="<?php echo base_url('resources/img/'); ?>icon-teman.png" alt="" class="teman bg link" data-link='http://jak-teman.bantuanteknis.org/'>
	      <img src="<?php echo base_url('resources/img/'); ?>icon-teman-tanpa-bg.png" alt="" class="teman link" data-link='http://jak-teman.bantuanteknis.org/' 
	        data-toggle="popover" 
	        data-trigger="hover" 
	        data-placement="top" 
	        title="" 
	        data-content="Merujuk teman atau pasangan untuk melakukan tes HIV.">
	        
	      <img src="<?php echo base_url('resources/img/'); ?>icon-reservasi.png" alt="" class="reservasi bg link" data-link='http://119.235.250.83/ayo-res.bantuanteknis-atria/'>
	      <img src="<?php echo base_url('resources/img/'); ?>icon-reservasi-tanpa-bg.png" alt="" class="reservasi link" data-link='http://119.235.250.83/ayo-res.bantuanteknis-atria/'
	        data-toggle="popover" 
	        data-trigger="hover" 
	        data-placement="top" 
	        title="" 
	        data-content="Pemesanan/booking layanan tes HIV di fasilitas layanan kesehatan."> 
    	</div>
    	<img src="<?php echo base_url('resources/img/'); ?>icon_masuk-jak.png" alt="" class='masuk' id="login">
      <footer class="footer">
      	<div class="row">
	      	<div class="identity col-md-4 col-sm-4 col-4 offset-md-8 offset-sm-8 offset-8">
		        <p class="">
		          Dinas Kesehatan Provinsi DKI Jakarta
		          <br>
		          <i class='fa fa-map-marker'></i> Jl. Kesehatan No.10
		          <i class='fa fa-phone'></i> 021-384 5825
		          <i class='fa fa-envelope'></i> dinkes@jakarta.go.id
		          
		        </p>
		      </div>
	      </div>
      </footer>
      <div id="myForm" class="d-none">
        <div class="dropdown">
				  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Pilih ...
				  </a>
				  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
				    <a class="dropdown-item" target="_blank" href="https://jaktrack-dinkes.jakarta.go.id/apps/">Login CSO</a>
				    <a class="dropdown-item" target="_blank" href="https://jaktrack-dinkes.jakarta.go.id/apps/">Login Puskesmas</a>
				    <a class="dropdown-item" target="_blank" href="<?php echo base_url('main');?>">Login CBSO</a>
				    <a class="dropdown-item" target="_blank" href="<?php echo base_url('main');?>">Login Monev</a>
				  </div>
				</div>
			</div>
    </div>
    <script src="<?php echo base_url('resources/'); ?>js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url('resources/'); ?>js/start.js"></script>
    <!--<script src="<?php echo base_url('resources/'); ?>js/metro.js"></script>-->
    <script src='<?php echo base_url('resources/'); ?>js/bootstrap.bundle.min.js'></script>
    <script src='<?php echo base_url('resources/'); ?>js/jquery.vide.js'></script>
    <script type="text/javascript">
			$(document).ready(function(){
				$('[data-toggle="popover"]').popover(); 
				$('#login').popover({
	        placement: 'top',
	        title: '',
	        html:true,
	        content:  $('#myForm').html()
		    })
			})
		</script>
	</body>
</html>