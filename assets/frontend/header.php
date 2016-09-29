<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=!empty($title) ? $title : SITENAME?></title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Del, Career, Career Center, Job Board" />
    <!-- //for-mobile-apps -->
    <link href="<?=FRONTENDPATH?>/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?=FRONTENDPATH?>/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link class="include" rel="stylesheet" type="text/css" href="<?=FRONTENDPATH?>/css/jquery.jqplot.css" />
    <!-- calender -->
    <link type="text/css" href="<?=FRONTENDPATH?>/css/jquery.simple-dtpicker.css" rel="stylesheet" />
    <!-- //calender -->
    <!-- different-chart-bar -->
    <link rel="stylesheet" href="<?=FRONTENDPATH?>/css/chart.min.css">
    <!-- //different-chart-bar -->
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="<?=FRONTENDPATH?>/css/font-awesome.min.css" />
    <!-- //font-awesome icons -->
    <!-- js -->
    <script src="<?=FRONTENDPATH?>/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?=FRONTENDPATH?>/js/jquery.marquee.min.js"></script>
    <!-- js -->
    <!-- pop-up -->
    <link href="<?=FRONTENDPATH?>/css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
    <!-- //pop-up -->
    <!-- left-chart -->
    <script src="<?=FRONTENDPATH?>/js/jquery.flot.min.js" type="text/javascript"></script>
    <script src="<?=FRONTENDPATH?>/js/jquery.flot.animator.min.js" type="text/javascript"></script>
    <!-- //left-chart -->
    <link href="//fonts.googleapis.com/css?family=Muli:300,300i,400,400i" rel="stylesheet">
    <!-- start-smoth-scrolling -->
    <script type="text/javascript" src="<?=FRONTENDPATH?>/js/move-top.js"></script>
    <script type="text/javascript" src="<?=FRONTENDPATH?>/js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script>
    <!-- start-smoth-scrolling -->
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

<body>
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
                            <a href="<?=site_url('user/dashboard')?>">Dashboard (<?=$ruser[COL_USERNAME]?>)</a><i>|</i>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="w3layouts_header_list">
                        <a href="faq.html">FAQ</a><i>|</i>
                    </li>
                    <li class="w3layouts_header_list">
                        <a href="contact.html">Contact Us</a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="w3ls_header_middle">
        <div class="container">
            <div class="agileits_logo">
                <h1><a href="<?=site_url()?>"><span>ITD</span> Career Center<i> Find your future job here</i></a></h1>
            </div>
            <div class="agileits_search">
                <form action="#" method="post">
                    <input name="Search" type="text" placeholder="Keyword" required="">
                    <select id="agileinfo_search" name="agileinfo_search">
                        <option value="commodities">Commodities</option>
                        <option value="navs">NAVs</option>
                        <option value="quotes">Quotes</option>
                        <option value="videos">Videos</option>
                        <option value="news">News</option>
                        <option value="notices">Notices</option>
                        <option value="all">All</option>
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
                        <li><a href="#">Vacancies</a></li>
                        <li><a href="#">News</a></li>
                        <li><a href="#">About</a></li>
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
<!-- banner -->
<div class="banner">
    <section class="slider">
        <div class="flexslider">
            <ul class="slides">
                <li>
                    <div class="w3_agile_banner_text banner1">
                        <h3>trade over world's leading stock exchanges</h3>
                        <div class="more">
                            <a href="single.html" class="button button--isi button--text-thick button--text-upper button--size-s"><span>Learn More</span></a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="w3_agile_banner_text banner2">
                        <h3>creating wealth with real estate investment</h3>
                        <div class="more">
                            <a href="single.html" class="button button--isi button--text-thick button--text-upper button--size-s"><span>Learn More</span></a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="w3_agile_banner_text banner3">
                        <p>national pension scheme</p>
                        <h3>start today for happy retirement</h3>
                        <div class="more">
                            <a href="single.html" class="button button--isi button--text-thick button--text-upper button--size-s"><span>Learn More</span></a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="w3_agile_banner_text banner4">
                        <h3>open a savings account & enjoy unique benefits</h3>
                        <div class="more">
                            <a href="single.html" class="button button--isi button--text-thick button--text-upper button--size-s"><span>Learn More</span></a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="w3_agile_banner_text banner5">
                        <h4>grow your money with trade market</h4>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <!-- flexSlider -->
    <link rel="stylesheet" href="<?=FRONTENDPATH?>/css/flexslider.css" type="text/css" media="screen" property="" />
    <script defer src="<?=FRONTENDPATH?>/js/jquery.flexslider.js"></script>
    <script type="text/javascript">
        $(window).load(function(){
            $('.flexslider').flexslider({
                animation: "slide",
                start: function(slider){
                    $('body').removeClass('loading');
                }
            });
        });
    </script>
    <!-- //flexSlider -->
</div>
<!-- //banner -->
