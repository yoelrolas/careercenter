<?php $this->load->view('frontend/header') ?>
<div class="container">
    <section class="content-header">
        <h1><?=$vacancy[COL_VACANCYTITLE]?></h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url()?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?=site_url('vacancy/all')?>"> Vacancies</a></li>
            <li class="active"><?=$vacancy[COL_VACANCYTITLE]?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-4">
                <div class="box box-default" style="border-top-color: transparent !important;">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive" src="<?=!empty($vacancy) ? MY_UPLOADURL.$vacancy[COL_FILENAME] : MY_IMAGEURL.'company-icon.jpg' ?>" alt="Logo">
                        <div class="profile-caption" style="padding: 10px 0px;">
                            <h4 class="text-center"><?=$vacancy[COL_COMPANYNAME]?></h4>
                            <p style="margin-top: 10px" class="text-muted text-center">Terdaftar sejak <?=date('d M Y', strtotime($vacancy[COL_REGISTERDATE]))?></p>
                        </div>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <p class="list-item-label">Tipe Lowogan</p>
                                <p class="list-item-value"><a class="pull-right"><?=$vacancy[COL_VACANCYTYPENAME]?></a></p>
                            </li>
                            <li class="list-group-item">
                                <p class="list-item-label">Posisi</p>
                                <p class="list-item-value"><a class="pull-right"><?=$vacancy[COL_POSITIONNAME]?></a></p>
                            </li>
                            <li class="list-group-item">
                                <p class="list-item-label">Pendidikan Min.</p>
                                <p class="list-item-value"><a class="pull-right"><?=$vacancy["Educations"]?></a></p>
                            </li>
                            <li class="list-group-item">
                                <p class="list-item-label">Penempatan</p>
                                <p class="list-item-value"><a class="pull-right"><?=$vacancy[COL_ISALLLOCATION]?"Seluruh Indonesia":$vacancy["Locations"]?></a></p>
                            </li>
                            <li class="list-group-item">
                                <p class="list-item-label">Deadline</p>
                                <p class="list-item-value"><a class="pull-right"><?=date("d M Y", strtotime($vacancy[COL_ENDDATE]))?></a></p>
                            </li>
                            <li class="list-group-item">
                                <p class="list-item-label">Contact Email</p>
                                <p class="list-item-value"><a class="pull-right"><?=$vacancy[COL_VACANCYEMAIL]?></a></p>
                            </li>
                        </ul>
                        <a href="<?=site_url('company/detail/'.$vacancy[COL_COMPANYID])?>" class="btn btn-primary btn-block btn-flat"><b> Detail Perusahaan</b></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-info"></i>&nbsp;&nbsp; Detail Lowongan</h3><small class="pull-right">Dilihat : <b><?=$vacancy[COL_TOTALVIEW]?></b> kali</small>
                    </div>
                    <div class="box-body">
                        <h4 style="margin-bottom: 10px;">Deskripsi</h4>
                        <div class="well">
                            <?=$vacancy[COL_VACANCYDESC]?>
                        </div>
                        <br />

                        <h4 style="margin-bottom: 10px;">Syarat</h4>
                        <div class="well">
                            <?=$vacancy[COL_VACANCYREQUIREMENT]?>
                        </div>
                        <br />

                        <h4 style="margin-bottom: 10px;">Tanggung Jawab</h4>
                        <div class="well">
                            <?=$vacancy[COL_VACANCYRESPONSIBILITY]?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('frontend/footer') ?>