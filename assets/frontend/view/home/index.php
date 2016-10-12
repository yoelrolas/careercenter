<?php $this->load->view('frontend/header') ?>
<!-- banner -->
<div class="banner">
    <section class="slider">
        <div class="flexslider">
            <ul class="slides">
                <li>
                    <div class="w3_agile_banner_text banner1">
                        <!--<h3>trade over world's leading stock exchanges</h3>
                        <div class="more">
                            <a href="single.html" class="button button--isi button--text-thick button--text-upper button--size-s"><span>Learn More</span></a>
                        </div>-->
                    </div>
                </li>
                <li>
                    <div class="w3_agile_banner_text banner2">
                        <!--<h3>creating wealth with real estate investment</h3>
                        <div class="more">
                            <a href="single.html" class="button button--isi button--text-thick button--text-upper button--size-s"><span>Learn More</span></a>
                        </div>-->
                    </div>
                </li>
                <li>
                    <div class="w3_agile_banner_text banner3">
                        <!--<p>national pension scheme</p>
                        <h3>start today for happy retirement</h3>
                        <div class="more">
                            <a href="single.html" class="button button--isi button--text-thick button--text-upper button--size-s"><span>Learn More</span></a>
                        </div>-->
                    </div>
                </li>
                <li>
                    <div class="w3_agile_banner_text banner4">
                        <!--<h3>open a savings account & enjoy unique benefits</h3>
                        <div class="more">
                            <a href="single.html" class="button button--isi button--text-thick button--text-upper button--size-s"><span>Learn More</span></a>
                        </div>-->
                    </div>
                </li>
                <li>
                    <div class="w3_agile_banner_text banner5">
                        <!--<h4>grow your money with trade market</h4>-->
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

<!-- news-original -->
<div class="news-original">
    <div class="container">
        <div class="agileinfo_news_original_grids">
            <div class="col-sm-12 agileinfo_news_original_grids_left">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i>&nbsp;&nbsp; Cari Lowongan</h3>
                    </div>
                    <form class="form-horizontal" action="<?=site_url('vacancy/all')?>" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <label class="label-control">Keyword</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                        <input type="text" class="form-control" name="Keyword" placeholder="Keyword" />
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label class="label-control">Fungsi Pekerjaan</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-briefcase"></i></div>
                                        <select name="PositionID[]" class="form-control select2" multiple>
                                            <?=GetCombobox("SELECT * FROM positions ORDER  BY PositionName", COL_POSITIONID, COL_POSITIONNAME)?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label class="label-control">Bidang Industri</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-industry"></i></div>
                                        <select name="IndustryTypeID[]" class="form-control select2" multiple>
                                            <?=GetCombobox("SELECT * FROM industrytypes", COL_INDUSTRYTYPEID, COL_INDUSTRYTYPENAME, (!empty($data[COL_INDUSTRYTYPEID]) ? $data[COL_INDUSTRYTYPEID] : null))?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label class="label-control">Penempatan</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                        <select name="LocationID[]" class="form-control select2" multiple>
                                            <?=GetCombobox("SELECT * FROM locations ORDER BY LocationName", COL_LOCATIONID, COL_LOCATIONNAME, (!empty($locs) ? $locs : null))?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-flat pull-right">Cari Lowongan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-8 agileinfo_news_original_grids_left">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#vacancies" data-toggle="tab">Lowongan</a></li>
                        <li><a href="#companies" data-toggle="tab">Perusahaan</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="vacancies">
                            <?php if(!empty($vacancies) && count($vacancies) > 0 ) { ?>
                                <div class="row row-no-margin">
                                    <small class="pull-right">Menampilkan <strong><?=count($vacancies)?></strong> lowongan terbaru</small>
                                </div>
                            <?php } ?>

                            <?php if(!empty($vacancies) && count($vacancies) > 0 ) { ?>
                                <?php foreach($vacancies as $vac) { ?>
                                    <div class="row row-no-margin r-vacancy">
                                        <div class="col-sm-12 vacancy-container">
                                            <div class="col-sm-2 avatar-container">
                                            <span class="span-img">
                                                <img src="<?=!empty($vac[COL_FILENAME]) ? MY_UPLOADURL.$vac[COL_FILENAME] : MY_IMAGEURL.'company-icon.jpg'?>" class="v-img">
                                            </span>
                                            </div>
                                            <div class="clearfix visible-xs-block"></div>
                                            <div class="col-sm-10">
                                                <p class="vacancytitle"><?=$vac[COL_VACANCYTITLE]?></p>
                                                <div class="companytitle">
                                                    <a href="<?=site_url('company/detail/'.$vac[COL_COMPANYID])?>"><?=$vac[COL_COMPANYNAME]?></a>
                                                </div>
                                                <div class="companyinfo">
                                                    <div class="col-sm-6">
                                                        <p class="info-head">Penempatan:</p>
                                                        <p class="info-body"><?=$vac[COL_ISALLLOCATION]?"Seluruh Indonesia":$vac["Locations"]?></p>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <p class="info-head">Pendidikan:</p>
                                                        <p class="info-body"><?=$vac["Educations"]?></p>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <p class="info-head">Deadline:</p>
                                                        <p class="info-body"><?=date("d M Y", strtotime($vac[COL_ENDDATE]))?></p>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <a href="<?=site_url('vacancy/detail/'.$vac[COL_VACANCYID])?>" class="btn btn-default btn-block btn-flat btn-detail">Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="row row-no-margin ">
                                    <div class="col-sm-12" style="margin-top: 20px;">
                                        <a href="<?=site_url('vacancy/all')?>" class="btn btn-primary btn-flat pull-right">Lihat semua</a>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="row row-no-margin r-vacancy">
                                    <div class="col-sm-12 vacancy-container">
                                        <span class="nodata">Tidak ada data ditemukan</span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="tab-pane" id="companies">
                            <?php if(!empty($companies) && count($companies) > 0 ) { ?>
                                <div class="row row-no-margin">
                                    <small class="pull-right">Menampilkan <strong><?=count($companies)?></strong> data perusahaan</small>
                                </div>
                            <?php } ?>

                            <?php if(!empty($companies) && count($companies) > 0 ) { ?>
                                <?php foreach($companies as $com) {
                                    $this->db->where(COL_COMPANYID, $com[COL_COMPANYID]);
                                    $this->db->where(COL_ISSUSPEND, false);
                                    $this->db->where(COL_ENDDATE." >= ", date("Y-m-d"));
                                    $activevacancies = $this->db->get(TBL_VACANCIES)->num_rows();
                                    ?>
                                    <div class="row row-no-margin r-vacancy">
                                        <div class="col-sm-12 vacancy-container">
                                            <div class="col-sm-2 avatar-container">
                                            <span class="span-img">
                                                <img src="<?=!empty($com[COL_FILENAME]) ? MY_UPLOADURL.$com[COL_FILENAME] : MY_IMAGEURL.'company-icon.jpg'?>" class="v-img">
                                            </span>
                                            </div>
                                            <div class="clearfix visible-xs-block"></div>
                                            <div class="col-sm-10">
                                                <p class="vacancytitle">
                                                    <a href="<?=site_url('company/detail/'.$com[COL_COMPANYID])?>"><?=$com[COL_COMPANYNAME]?></a>
                                                </p>
                                                <div class="companyinfo">
                                                    <div class="col-sm-4">
                                                        <p class="info-head">Industri:</p>
                                                        <p class="info-body"><?=$com[COL_INDUSTRYTYPENAME]?></p>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <p class="info-head">Website:</p>
                                                        <p class="info-body"><?=$com[COL_COMPANYWEBSITE] ? anchor($com[COL_COMPANYWEBSITE], $com[COL_COMPANYWEBSITE]) : "-"?></p>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <p class="info-head">Lowongan Aktif:</p>
                                                        <?php if($activevacancies > 0) { ?>
                                                            <p><?=$activevacancies?> - <a href="<?=site_url('company/detail/'.$com[COL_COMPANYID])?>">Lihat</a></p>
                                                        <?php } else { ?>
                                                            <p style="font-style: italic">Tidak ada lowongan aktif</p>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="row row-no-margin">
                                    <div class="col-sm-12" style="margin-top: 20px;">
                                        <a href="<?=site_url('company/all')?>" class="btn btn-primary btn-flat pull-right">Lihat semua</a>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="row row-no-margin r-vacancy">
                                    <div class="col-sm-12 vacancy-container">
                                        <span class="nodata">Tidak ada data ditemukan</span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <!--<div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-history"></i>&nbsp;&nbsp; Lowongan Terbaru</h3>

                    </div>
                    <div class="box-body">

                    </div>
                </div>-->
            </div>
            <div class="col-md-4 agileinfo_news_original_grids_left">
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
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!-- //news-original -->
<?php $this->load->view('frontend/footer') ?>
