<?php $this->load->view('frontend/header') ?><div class="news-original">    <div class="container">        <div class="agileinfo_news_original_grids">            <div class="col-sm-8 agileinfo_news_original_grids_left">                <div class="box box-solid">                    <div class="box-header">                        <h3><?=$data[COL_POSTTITLE]?></h3>                    </div>                    <div class="box-body w3_agileits_news_blog1">                        <?php                        if(!empty($data[COL_FILENAME])) {                            ?>                            <img class="img-responsive pad" style="margin: auto;" src="<?=!empty($data[COL_FILENAME])?MY_UPLOADURL.$data[COL_FILENAME]:MY_NOIMAGEURL?>" alt="<?=$data[COL_POSTTITLE]?>">                        <?php                        }                        ?>                        <blockquote>                            <p style="font-weight: bold;">                                <i class="fa fa-user"></i> &nbsp; <?=$data[COL_NAME]?> &nbsp;&nbsp;                                <i class="fa fa-calendar"></i> &nbsp; <?=date('d M Y', strtotime($data[COL_POSTDATE]))?> &nbsp;&nbsp;                                <i class="fa fa-tag"></i> &nbsp; <?=$data[COL_POSTCATEGORYNAME]?> &nbsp;&nbsp;                                <i class="fa fa-eye"></i> &nbsp; <?=$data[COL_TOTALVIEW]?> &nbsp;&nbsp;                            </p>                        </blockquote>                        <div class="well">                            <?=$data[COL_POSTCONTENT]?>                        </div>                        <div class="clearfix"> </div>                    </div>                </div>            </div>            <?php $this->load->view('frontend/sidebar') ?>            <div class="clearfix"> </div>        </div>    </div></div><?php $this->load->view('frontend/footer') ?>