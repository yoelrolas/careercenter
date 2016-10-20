<?php
$CI =& get_instance();
$CI->load->model('mpost');
$news = $CI->mpost->search(10,"",POSTCATEGORY_NEWS);
$blogs = $CI->mpost->search(10,"",POSTCATEGORY_BLOG);
$events = $CI->mpost->search(10,"",POSTCATEGORY_EVENT);
?>
<div class="col-md-4 agileinfo_news_original_grids_left">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-newspaper-o"></i>&nbsp;&nbsp; News</h3>
        </div>
        <div class="box-body">
            <ul class="products-list product-list-in-box">
                <?php
                if(!empty($news) && count($news) > 0) {
                    foreach($news as $n) {
                        ?>
                        <li class="item">
                            <div class="product-img">
                                <img src="<?=!empty($n[COL_FILENAME])?MY_UPLOADURL.$n[COL_FILENAME]:MY_NOIMAGEURL?>" alt="<?=$n[COL_POSTTITLE]?>">
                            </div>
                            <div class="product-info">
                                            <span class="product-description">
                                                <?=date('d M Y', strtotime($n[COL_POSTDATE]))?>
                                            </span>
                                <a href="<?=site_url('post/view/'.$n[COL_POSTSLUG])?>" class="product-title">
                                    <?=$n[COL_POSTTITLE]?>
                                    <!--<span class="label label-warning pull-right">$1800</span>-->
                                </a>
                            </div>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <div class="box-footer text-center">
            <?php if(!empty($news) && count($news) > 0) { ?>
                <a href="<?=site_url('post/all/'.POSTCATEGORY_NEWS)?>" class="uppercase">Lihat Semua</a>
            <?php } else { ?>
                <span style="font-style: italic">Tidak ada data tersedia</span>
            <?php } ?>
        </div>
    </div>
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;&nbsp; Events</h3>
        </div>
        <div class="box-body">
            <ul class="products-list product-list-in-box">
                <?php
                if(!empty($events) && count($events) > 0) {
                    foreach($events as $n) {
                        ?>
                        <li class="item">
                            <div class="product-img">
                                <img src="<?=!empty($n[COL_FILENAME])?MY_UPLOADURL.$n[COL_FILENAME]:MY_NOIMAGEURL?>" alt="<?=$n[COL_POSTTITLE]?>">
                            </div>
                            <div class="product-info">
                                            <span class="product-description">
                                                <?=date('d M Y', strtotime($n[COL_POSTDATE]))?>
                                            </span>
                                <a href="<?=site_url('post/view/'.$n[COL_POSTSLUG])?>" class="product-title">
                                    <?=$n[COL_POSTTITLE]?>
                                    <!--<span class="label label-warning pull-right">$1800</span>-->
                                </a>
                            </div>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <div class="box-footer text-center">
            <?php if(!empty($events) && count($events) > 0) { ?>
                <a href="<?=site_url('post/all/'.POSTCATEGORY_EVENT)?>" class="uppercase">Lihat Semua</a>
            <?php } else { ?>
                <span style="font-style: italic">Tidak ada data tersedia</span>
            <?php } ?>
        </div>
    </div>
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-book"></i>&nbsp;&nbsp; Blogs</h3>
        </div>
        <div class="box-body">
            <ul class="products-list product-list-in-box">
                <?php
                if(!empty($blogs) && count($blogs) > 0) {
                    foreach($blogs as $n) {
                        ?>
                        <li class="item">
                            <div class="product-img">
                                <img src="<?=!empty($n[COL_FILENAME])?MY_UPLOADURL.$n[COL_FILENAME]:MY_NOIMAGEURL?>" alt="<?=$n[COL_POSTTITLE]?>">
                            </div>
                            <div class="product-info">
                                            <span class="product-description">
                                                <?=date('d M Y', strtotime($n[COL_POSTDATE]))?>
                                            </span>
                                <a href="<?=site_url('post/view/'.$n[COL_POSTSLUG])?>" class="product-title">
                                    <?=$n[COL_POSTTITLE]?>
                                    <!--<span class="label label-warning pull-right">$1800</span>-->
                                </a>
                            </div>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <div class="box-footer text-center">
            <?php if(!empty($blogs) && count($blogs) > 0) { ?>
                <a href="<?=site_url('post/all/'.POSTCATEGORY_BLOG)?>" class="uppercase">Lihat Semua</a>
            <?php } else { ?>
                <span style="font-style: italic">Tidak ada data tersedia</span>
            <?php } ?>
        </div>
    </div>
</div>
<!--<div class="col-md-4 agileinfo_news_original_grids_left">
                <div class="agileinfo_calender">
                    <h3><i class="fa fa-calendar" aria-hidden="true"></i>Event Calendar</h3>
                    <div id="date_picker"> </div>
                    <script type="text/javascript">
                        $(function(){
                            $('#date_picker').datepicker();
                        });
                    </script>
                    <script type="text/javascript" src="<?=FRONTENDPATH?>/js/jquery.simple-dtpicker.js"></script>
                </div>
                <div class="w3layouts_sponsored_links">
                    <p>Sponsored Links</p>
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title asd">
                                    <a class="pa_italic" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span><i class="glyphicon glyphicon-menu-up" aria-hidden="true"></i>stocks to buy today
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body panel_text">
                                    Ut quis venenatis neque, sit amet sagittis lorem. Quisque dapibus dui
                                    non urna suscipit ultricies.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title asd">
                                    <a class="pa_italic collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span><i class="glyphicon glyphicon-menu-up" aria-hidden="true"></i>best retirement funds
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body panel_text">
                                    Ut quis venenatis neque, sit amet sagittis lorem. Quisque dapibus dui
                                    non urna suscipit ultricies.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title asd">
                                    <a class="pa_italic collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span><i class="glyphicon glyphicon-menu-up" aria-hidden="true"></i>how to invest in gold
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body panel_text">
                                    Ut quis venenatis neque, sit amet sagittis lorem. Quisque dapibus dui
                                    non urna suscipit ultricies.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->