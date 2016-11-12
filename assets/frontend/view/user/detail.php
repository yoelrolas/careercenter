<?php $this->load->view('frontend/header') ?>
<div class="container">
    <section class="content">
        <div class="row">
            <div class="col-sm-4">
                <div class="box box-default" style="border-top-color: transparent !important;">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive" src="<?=!empty($data[COL_IMAGEFILENAME]) ? MY_UPLOADURL.$data[COL_IMAGEFILENAME] : MY_IMAGEURL.'user.jpg' ?>" alt="Profile">
                        <p style="margin-top: 10px; font-size: 16px;" class="text-muted text-center"><b><?=$data[COL_NAME]?></b></p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Email</b> <a class="pull-right"><?=$data[COL_EMAIL]?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Tanggal Lahir</b> <a class="pull-right"><?=!empty($data[COL_BIRTHDATE])? date("d M Y", strtotime($data[COL_BIRTHDATE])) : "-"?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Jenis Kelamin</b> <a class="pull-right"><?=$data[COL_GENDER] == 1 ? "Pria" : "Wanita"?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Pendidikan</b> <a class="pull-right"><?=$data[COL_EDUCATIONTYPENAME] ? $data[COL_EDUCATIONTYPENAME] : "-"?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Agama</b> <a class="pull-right"><?=$data[COL_RELIGIONNAME] ? $data[COL_RELIGIONNAME] : "-"?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="box box-solid">
                    <div class="box-body">
                        <ul class="list-group list-group-bordered">
                            <li class="list-group-item">
                                <i class="fa fa-map-marker"></i> &nbsp; Alamat
                                <span class="pull-right" style="font-size: 14px"><?=$data[COL_ADDRESS] ? $data[COL_ADDRESS] : "-"?></span>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-phone"></i> &nbsp; No Telp.
                                <span class="pull-right" style="font-size: 14px"><?=$data[COL_PHONENUMBER] ? $data[COL_PHONENUMBER] : "-"?></span>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-credit-card"></i> &nbsp; No Identitas
                                <span class="pull-right" style="font-size: 14px"><?=$data[COL_IDENTITYNO] ? $data[COL_IDENTITYNO] : "-"?></span>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-institution"></i> &nbsp; Institusi
                                <span class="pull-right" style="font-size: 14px"><?=$data[COL_UNIVERSITYNAME] ? $data[COL_UNIVERSITYNAME] : "-"?></span>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-graduation-cap"></i> &nbsp; Fakultas
                                <span class="pull-right" style="font-size: 14px"><?=$data[COL_FACULTYNAME] ? $data[COL_FACULTYNAME] : "-"?></span>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-book"></i> &nbsp; Jurusan / Program Studi
                                <span class="pull-right" style="font-size: 14px"><?=$data[COL_MAJORNAME] ? $data[COL_MAJORNAME] : "-"?></span>
                            </li>
                            <?php
                            if($data[COL_ISGRADUATED] && $data[COL_GRADUATEDDATE]) {
                                ?>
                                <li class="list-group-item">
                                    <i class="fa fa-calendar"></i> &nbsp; Lulus Pada
                                    <span class="pull-right" style="font-size: 14px"><?=date("d M Y", strtotime($data[COL_GRADUATEDDATE]))?></span>
                                </li>
                            <?php
                            }
                            ?>
                            <li class="list-group-item">
                                <i class="fa fa-black-tie"></i> &nbsp; Pengalaman Kerja
                                <span class="pull-right" style="font-size: 14px"><?=$data[COL_YEAROFEXPERIENCE] ? $data[COL_YEAROFEXPERIENCE] : "-"?> Tahun</span>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-briefcase"></i> &nbsp; Jabatan Terakhir
                                <span class="pull-right" style="font-size: 14px"><?=$data[COL_RECENTPOSITION] ? $data[COL_RECENTPOSITION] : "-"?></span>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-money"></i> &nbsp; Gaji Terakhir
                                <span class="pull-right" style="font-size: 14px"><?=$data[COL_RECENTSALARY] ? $data[COL_RECENTSALARY] : "-"?></span>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-money"></i> &nbsp; Gaji Yang Diharapkan
                                <span class="pull-right" style="font-size: 14px"><?=$data[COL_EXPECTEDSALARY] ? $data[COL_EXPECTEDSALARY] : "-"?></span>
                            </li>
                            <?php
                            if($data[COL_CVFILENAME]) {
                                ?>
                                <li class="list-group-item">
                                    <i class="fa fa-file"></i> &nbsp; CV / Resume
                                    <a class="pull-right" style="font-size: 14px" href="<?=MY_UPLOADURL.$data[COL_CVFILENAME]?>"><?=$data[COL_CVFILENAME]?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('frontend/footer') ?>
