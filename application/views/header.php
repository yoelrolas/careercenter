
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=!empty($title) ? 'DCC | '.$title : SITENAME?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- JQUERY -->
    <script src="<?=base_url()?>assets/adminlte/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="<?=base_url()?>assets/adminlte/plugins/modernizr/modernizr.js"></script>

    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/bootstrap/css/bootstrap.min.css">
    <!-- font Awesome -->
    <link rel="stylesheet" href="<?=base_url()?>assets/tbs/css/font-awesome.min.css" />
    <!-- Ionicons -->
    <link href="<?=base_url()?>assets/tbs/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css">

    <link href="<?=base_url()?>assets/css/my.css" rel="stylesheet" type="text/css" />
    <!--<link href="--><?//=base_url()?><!--assets/tbs/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />-->

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/iCheck/all.css">

    <!-- Select 2 -->
    <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/select2/select2.min.css">

    <!-- datatable css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/datatable/media/css/dataTables.bootstrap.min.css">

    <script type="text/javascript" src="<?=base_url()?>assets/datatable/media/js/jquery.dataTables.min.js?ver=1"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/datatable/media/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/datatable/media/js/ColReorderWithResize.js"></script>

    <!-- datatable buttons ext + resp + print -->
    <script type="text/javascript" src="<?=base_url()?>assets/datatable/ext/buttons/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/datatable/ext/buttons/buttons.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/datatable/ext/buttons/buttons.print.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/datatable/ext/buttons/buttons.print.min.js"></script>
    <link href="<?=base_url()?>assets/datatable/ext/buttons/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/datatable/ext/responsive/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?=base_url()?>assets/datatable/ext/jszip/jszip.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/datatable/ext/pdfmake/build/pdfmake.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/datatable/ext/pdfmake/build/vfs_fonts.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/datatable/ext/responsive/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/datatable/ext/buttons/buttons.html5.min.js"></script>

    <!-- WYSIHTML5 -->
    <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- daterange picker -->
    <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/datepicker/datepicker3.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- Preloader Style -->
<style>
    .no-js #loader { display: none;  }
    .js #loader { display: block; position: absolute; left: 100px; top: 0; }
    .se-pre-con {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url(<?=base_url()?>assets/preloader/images/loader-128x/Preloader_3.gif) center no-repeat #fff;
    }
</style>
<!-- /.preloader style -->

<!-- Preloader Script -->
<script>
    // Wait for window load
    $(window).load(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");;
    });
</script>
<!-- /.preloader script -->

<body class="hold-transition skin-blue sidebar-mini">
<!-- preloader -->
<div class="se-pre-con"></div>
<!-- /.preloader -->

<div class="wrapper">
    <?php
    $ruser = GetLoggedUser();
    $displayname = $ruser ? $ruser[COL_USERNAME] : "Guest";
    $displaypicture = MY_IMAGEURL.'user.jpg';
    if($ruser) {
        if($ruser[COL_ROLEID] == ROLECOMPANY) {
            $displaypicture = $ruser[COL_FILENAME] ? MY_UPLOADURL.$ruser[COL_FILENAME] : MY_IMAGEURL.'company-icon.jpg';
        } else {
            $displaypicture = $ruser[COL_IMAGEFILENAME] ? MY_UPLOADURL.$ruser[COL_IMAGEFILENAME] : MY_IMAGEURL.'user.jpg';
        }
    }
    ?>
    <header class="main-header">

        <!-- Logo -->
        <a href="<?=site_url()?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>D</b>CC</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>DEL</b> Career Center</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?=$displaypicture?>" class="user-image" alt="Your Profile Image">
                            <span class="hidden-xs"><?=$displayname?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?=base_url()?>assets/tbs/img/user.jpg" class="img-circle" alt="User Image">

                                <p>
                                    <?=$displayname?>
                                    <small>Member since <?=date('M Y', strtotime(($ruser[COL_REGISTEREDDATE])))?></small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?= site_url("user/profile") ?>" class="btn btn-info"><i class="fa fa-gear"></i> Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?= site_url("user/logout") ?>" class="btn btn-danger"><i class="fa fa-sign-out"></i> Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?=base_url()?>assets/tbs/img/user.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Howdy, <?=$displayname?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?=site_url('user/dashboard')?>"><i class="fa fa-circle-o"></i> Dashboard</a></li>
                        <li><a href="<?=site_url()?>"><i class="fa fa-circle-o"></i> Homepage</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user"></i> <span>Account</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?=site_url('user/profile')?>"><i class="fa fa-circle-o"></i> Profile</a></li>
                        <li><a href="<?=site_url('user/changepassword')?>"><i class="fa fa-circle-o"></i> Change Password</a></li>
                    </ul>
                </li>

                <?php if($ruser[COL_ROLEID] == ROLEADMIN) { ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-anchor"></i> <span>Master Data</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?=site_url('master/ets')?>"><i class="fa fa-circle-o"></i> Education Types</a></li>
                            <li><a href="<?=site_url('master/its')?>"><i class="fa fa-circle-o"></i> Industry Types</a></li>
                            <li><a href="<?=site_url('master/vts')?>"><i class="fa fa-circle-o"></i> Vacancy Types</a></li>
                            <li><a href="<?=site_url('master/locations')?>"><i class="fa fa-circle-o"></i> Locations</a></li>
                            <li><a href="<?=site_url('master/positions')?>"><i class="fa fa-circle-o"></i> Positions</a></li>
                            <li><a href="<?=site_url('master/categories')?>"><i class="fa fa-circle-o"></i> Post Categories</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-building-o"></i> <span>Companies</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?=site_url('company/index')?>"><i class="fa fa-circle-o"></i> Data</a></li>
                            <li><a href="<?=site_url('company/add')?>"><i class="fa fa-circle-o"></i> Add Company</a></li>
                        </ul>
                    </li>
                <?php } ?>

                <?php if($ruser[COL_ROLEID] == ROLEADMIN || $ruser[COL_ROLEID] == ROLECOMPANY) { ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-bookmark-o"></i> <span>Vacancies</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?=site_url('vacancy/index')?>"><i class="fa fa-circle-o"></i> Data</a></li>
                        <li><a href="<?=site_url('vacancy/add')?>"><i class="fa fa-circle-o"></i> Add Vacancy</a></li>
                    </ul>
                </li>
                <?php } ?>

                <?php if($ruser[COL_ROLEID] == ROLEADMIN) { ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-tags"></i> <span>Posts</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?=site_url('post/index')?>"><i class="fa fa-circle-o"></i> Data</a></li>
                            <li><a href="<?=site_url('post/add')?>"><i class="fa fa-circle-o"></i> Add Post</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-users"></i> <span>Users</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?=site_url('user/index')?>"><i class="fa fa-circle-o"></i> Data</a></li>
                            <li><a href="<?=site_url('user/add')?>"><i class="fa fa-circle-o"></i> Add User</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-cogs"></i> <span>Settings</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?=site_url('setting/main')?>"><i class="fa fa-circle-o"></i> Main</a></li>
                            <li><a href="<?=site_url('setting/notification')?>"><i class="fa fa-circle-o"></i> Notification</a></li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">