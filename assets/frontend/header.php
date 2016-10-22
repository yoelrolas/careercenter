<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=!empty($title) ? $title." | ".SITENAME : SITENAME?></title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Del, Career, Career Center, Job Board" />
    <!-- //for-mobile-apps -->
    <link href="<?=FRONTENDURL?>/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?=FRONTENDURL?>/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link class="include" rel="stylesheet" type="text/css" href="<?=FRONTENDURL?>/css/jquery.jqplot.css" />

    <!-- different-chart-bar -->
    <link rel="stylesheet" href="<?=FRONTENDURL?>/css/chart.min.css">
    <!-- //different-chart-bar -->
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="<?=FRONTENDURL?>/css/font-awesome.min.css" />
    <!-- //font-awesome icons -->
    <!-- js -->
    <script src="<?=FRONTENDURL?>/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?=FRONTENDURL?>/js/jquery.marquee.min.js"></script>
    <!-- js -->
    <!-- pop-up -->
    <link href="<?=FRONTENDURL?>/css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
    <!-- //pop-up -->
    <!-- left-chart -->
    <script src="<?=FRONTENDURL?>/js/jquery.flot.min.js" type="text/javascript"></script>
    <script src="<?=FRONTENDURL?>/js/jquery.flot.animator.min.js" type="text/javascript"></script>
    <!-- //left-chart -->
    <!--<link href="//fonts.googleapis.com/css?family=Muli:300,300i,400,400i" rel="stylesheet">-->
    <link href="<?=FRONTENDURL?>/css/fonts.css" rel="stylesheet" type="text/css" media="all" />
    <!-- start-smoth-scrolling -->
    <script type="text/javascript" src="<?=FRONTENDURL?>/js/move-top.js"></script>
    <script type="text/javascript" src="<?=FRONTENDURL?>/js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script>
    <!-- start-smoth-scrolling -->

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
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/dist/css/skins/_all-skins.min.css">
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

<body class="layout-top-nav">
<!-- preloader -->
<div class="se-pre-con"></div>
<!-- /.preloader -->

<!-- header -->
<div class="header">
    <div class="w3ls_header_top">
        <div class="container">
            <div class="w3l_header_left">
                <ul class="w3layouts_header">
                    <?php
                    if(!IsLogin()) {
                        ?>
                        <li class="w3layouts_header_list">
                            <a href="<?=site_url('user/login')?>">Login</a><i>|</i>
                        </li>
                    <?php
                    }
                    else {
                        $ruser = GetLoggedUser();
                        ?>
                        <li class="w3layouts_header_list">
                            <a href="<?=site_url('user/dashboard')?>">Dashboard</a><i>|</i>
                        </li>
                        <li class="w3layouts_header_list">
                            <a href="<?=site_url('user/logout')?>">Logout (<?=$ruser[COL_USERNAME]?>)</a><i>|</i>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="w3layouts_header_list">
                        <a href="<?=site_url("post/view/faq")?>">FAQ</a><i>|</i>
                    </li>
                    <li class="w3layouts_header_list">
                        <a href="<?=site_url("post/view/contact-us")?>">Contact Us</a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="w3ls_header_middle">
        <div class="container">
            <div class="agileits_logo">
                <h1><a href="<?=site_url()?>"><span>Del</span> Career Center<i> Excellence Starts Here!</i></a></h1>
            </div>
            <div class="agileits_search">
                <form action="<?=site_url('post/search')?>" method="post">
                    <input name="Keyword" type="text" placeholder="Keyword" value="<?=!empty($datapost["Keyword"])?$datapost["Keyword"]:""?>">
                    <select id="agileinfo_search" name="<?=COL_POSTCATEGORYID?>">
                        <option value="">All</option>
                        <option value="<?=POSTCATEGORY_NEWS?>" <?=!empty($datapost[COL_POSTCATEGORYID]) && $datapost[COL_POSTCATEGORYID] == POSTCATEGORY_NEWS ? "selected":""?>>News</option>
                        <option value="<?=POSTCATEGORY_EVENT?>" <?=!empty($datapost[COL_POSTCATEGORYID]) && $datapost[COL_POSTCATEGORYID] == POSTCATEGORY_EVENT ? "selected":""?>>Events</option>
                        <option value="<?=POSTCATEGORY_BLOG?>" <?=!empty($datapost[COL_POSTCATEGORYID]) && $datapost[COL_POSTCATEGORYID] == POSTCATEGORY_BLOG ? "selected":""?>>Blogs</option>
                    </select>
                    <input type="submit" value="Search">
                </form>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!-- //header -->
<!-- navigation -->
<div class="trade_navigation">
    <div class="container">
        <nav class="navbar nav_bottom">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header nav_2">
                <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                <nav class="wthree_nav">
                    <ul class="nav navbar-nav nav_1">
                        <li class="act"><a href="<?=site_url()?>">Home</a></li>
                        <li><a href="<?=site_url('vacancy/all')?>">Vacancies</a></li>
                        <li><a href="<?=site_url('company/all')?>">Companies</a></li>
                        <!--<li><a href="#">News</a></li>-->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Posts<span class="caret"></span></a>
                            <div class="dropdown-menu w3ls_vegetables_menu" style="display: none;">
                                <ul>
                                    <li><a href="<?=site_url('post/all/'.POSTCATEGORY_NEWS)?>">News</a></li>
                                    <li><a href="<?=site_url('post/all/'.POSTCATEGORY_BLOG)?>">Blog</a></li>
                                    <li><a href="<?=site_url('post/all/'.POSTCATEGORY_EVENT)?>">Events</a></li>
                                </ul>
                            </div>
                        </li>
                        <!--<li><a href="#">About</a></li>-->
                        <!--<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Short Codes<span class="caret"></span></a>
                            <div class="dropdown-menu w3ls_vegetables_menu">
                                <ul>
                                    <li><a href="icons.html">Icons</a></li>
                                    <li><a href="typography.html">Typography</a></li>
                                </ul>
                            </div>
                        </li>-->
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
</div>
<!-- //navigation -->
<!-- content-wrapper -->
<div class="content-wrap">
