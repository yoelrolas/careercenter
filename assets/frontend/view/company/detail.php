<?php $this->load->view('frontend/header') ?>
<div class="container">
    <section class="content-header">
        <h1><?=$company[COL_COMPANYNAME]?></h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url()?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?=site_url('company/all')?>"> Companies</a></li>
            <li class="active"><?=$company[COL_COMPANYNAME]?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-4">
                <div class="box box-default" style="border-top-color: transparent !important;">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive" src="<?=!empty($company) ? MY_UPLOADURL.$company[COL_FILENAME] : MY_IMAGEURL.'company-icon.jpg' ?>" alt="Logo">
                        <p style="margin-top: 10px" class="text-muted text-center">Terdaftar sejak <?=date('d M Y', strtotime($company[COL_REGISTERDATE]))?></p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Industri</b> <a class="pull-right"><?=$company[COL_INDUSTRYTYPENAME]?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Website</b> <a class="pull-right" href="<?=$company[COL_COMPANYWEBSITE]?>"><?=$company[COL_COMPANYWEBSITE]?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Email</b> <a class="pull-right"><?=$company[COL_COMPANYEMAIL]?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Telp</b> <a class="pull-right"><?=$company[COL_COMPANYTELP]?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Fax</b> <a class="pull-right"><?=$company[COL_COMPANYFAX]?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#detail" data-toggle="tab">Detail</a></li>
                        <li><a href="#vacancy" data-toggle="tab">Lowongan Aktif <?='('.count($vacancies).')'?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="detail">
                            <h4><i class="fa fa-map-marker"></i>&nbsp;&nbsp;&nbsp; Alamat</h4>
                            <p style="margin: 10px 0px;"><?=$company[COL_COMPANYADDRESS]?></p>

                            <h4 style="padding-top: 10px; border-top: 1px solid #dedede"><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp; Tentang Perusahaan</h4>
                            <p style="margin: 10px 0px;"><?=$company[COL_COMPANYDESCRIPTION]?></p>
                        </div>
                        <div class="tab-pane" id="vacancy">
                            <?php if(!empty($vacancies) && count($vacancies) > 0 ) { ?>
                                <div class="row row-no-margin">
                                    <small class="pull-right">Menampilkan <strong><?=count($vacancies)?></strong> lowongan</small>
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
                                <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('frontend/footer') ?>
