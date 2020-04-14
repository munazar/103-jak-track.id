<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <meta name="author" content="Jak-Track">
        <meta name="description" content="Jak-Track.id">
        <meta name="keywords" content="Jak-Track.id">
        <title>Frontend JakTrack</title>
        
        <link rel="stylesheet" href="<?php echo base_url('resources/bootstrap-4.0.0/css/bootstrap.min.css'); ?>">
        <script src="<?php echo base_url('resources/'); ?>js/jquery-3.3.1.min.js"></script>
        <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
        <script src="<?php echo base_url('resources/bootstrap-4.0.0/'); ?>js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link href="<?php echo base_url('resources/css/'); ?>style-main.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url();?>resources/vendor/datatables/datatables.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url();?>resources/vendor/select2/css/select2.css" rel="stylesheet" type="text/css">

        
        <script type="text/javascript">
            var url="<?php echo base_url();?>";
        </script>
    </head>

    <body>
        <div id="loading" class="popup_loading">
            <div style="margin: 0px auto;margin-left: 40%;margin-top: 15%;width:0;text-align:center;">
                <div style="width:300px;">
                    <i class="fa fa-cog fa-spin" style="font-size:100px;color:#ED6454;"></i>
                    <br/><br/>
                    <font style="font-size:45px;color:#ED6454;">Please Wait ...</font>
                </div>        
            </div>
        </div>
        <div class="page-wrapper chiller-theme toggled">
            <a id="show-sidebar" class="btn" href="#" style="z-index:1;background-color:rgb(41, 43, 44);">
                <i class="fas fa-bars"></i>
            </a>
            <nav id="sidebar" class="sidebar-wrapper">
                <div class="sidebar-content">
                    <div class="sidebar-brand">
                        <div class="logo-pic">
                            <a href="#"><img class="img-responsive img-rounded" src="<?php echo base_url('resources/img/Logo.png');?>" alt="Logo"></a>
                        </div>
                        <div id="close-sidebar">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <div class="sidebar-header">
                        <div class="user-pic">
                            <img class="img-responsive img-rounded" src="<?php echo base_url('resources/img/profile/').$this->session->userdata('profile_img');?>" alt="User picture">
                        </div>
                        <div class="user-info">
                            <span class="user-name"><strong><?php echo $this->session->userdata('fullname');?></strong></span>
                            <span class="user-role"><?php echo $this->session->userdata('status');?></span>
                            <span class="user-status">
                                <i class="fa fa-circle"></i>
                                <span>Online</span>
                            </span>
                        </div>
                    </div>
                    <!-- sidebar-header  -->
                    <div class="sidebar-menu">
                        <ul>
                            <li class="header-menu">
                                <span></span>
                            </li>
                            <li>
                                <a href="<?php echo base_url('main');?>">
                                    <i class="fas fa-home"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="sidebar-dropdown">
                                <a href="#">
                                    <i class="fas fa-upload"></i>
                                    <span>Update Status</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url('update_status/show_list');?>">List</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('update_status/show_list2');?>">List2</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="sidebar-dropdown">
                                <a href="#">
                                    <i class="fas fa-tools"></i>
                                    <span>Setting</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url('referensi/provinsi');?>">Provinsi</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('referensi/kota');?>">Kota</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('referensi/kecamatan');?>">Kecamatan</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('referensi/puskesmas');?>">Puskesmas</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('referensi/pkm_libur');?>">Hari Libur</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('referensi/keperluan');?>">Keperluan</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('referensi/stream');?>">Stream</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('referensi/pendamping');?>">Pendamping</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="sidebar-dropdown">
                                <a href="#">
                                    <i class="fas fa-cogs"></i>
                                    <span>System</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url('sistem/group');?>">Group User</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('sistem/user');?>">User Management</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- sidebar-menu  -->
                </div>
                <!-- sidebar-content  -->
                <div class="sidebar-footer">
                    <a href="<?php echo base_url('profile');?>" title="Profile Setting">
                        <i class="fa fa-cog"></i>
                        <!-- <span class="badge-sonar"></span> -->
                    </a>
                    <a href="<?php echo base_url('login/logout');?>" title="Logout">
                        <i class="fa fa-power-off" ></i>
                    </a>
                </div>
            </nav>
            <!-- sidebar-wrapper  -->


                    