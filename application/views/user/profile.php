<?php $this->load->view('header') ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?= $title ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive" src="<?=!empty($data) && ($data[COL_FILENAME] || $data[COL_IMAGEFILENAME]) ? ($data[COL_ROLEID] == ROLECOMPANY ? MY_UPLOADURL.$data[COL_FILENAME] : MY_UPLOADURL.$data[COL_IMAGEFILENAME]) : ($data[COL_ROLEID] == ROLECOMPANY ? MY_IMAGEURL.'company-icon.jpg' : MY_IMAGEURL.'user.jpg') ?>" alt="Logo">

                        <h3 class="profile-username text-center"><?=!empty($data) ? $data[COL_COMPANYNAME] : "-"?></h3>
                        <p class="text-muted text-center"><?=!empty($data) ? $data[COL_INDUSTRYTYPENAME] : "-"?></p>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Username</b> <a class="pull-right"><?=!empty($data) ? $data[COL_USERNAME] : "-"?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Email</b> <a class="pull-right"><?=!empty($data) ? $data[COL_EMAIL] : "-"?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Registered On</b> <a class="pull-right"><?=!empty($data) ? date('d M Y', strtotime(($data[COL_ROLEID] == ROLECOMPANY ? $data[COL_REGISTERDATE] : $data[COL_REGISTEREDDATE]))) : "-"?></a>
                            </li>
                        </ul>

                        <a href="<?=site_url('user/changepassword')?>" class="btn btn-primary btn-block btn-flat"><b> Change Password</b></a>
                    </div>
                </div>
            </div>

            <?php if($data && $data[COL_ROLEID] == ROLECOMPANY) { ?>
            <div class="col-md-8">

                <?php if(validation_errors()){ ?>
                    <div class="alert alert-danger">
                        <i class="fa fa-ban"></i>
                        <?= validation_errors() ?>
                    </div>
                <?php }
                if(!empty($upload_errors)) {
                    ?>
                    <div class="alert alert-danger">
                        <i class="fa fa-ban"></i>
                        <?=$upload_errors?>
                    </div>
                    <?php
                }
                ?>

                <?php  if($this->input->get('success')){ ?>
                    <div class="form-group alert alert-success">
                        <i class="fa fa-check"></i>
                        Update profil berhasil.
                    </div>
                <?php } ?>

                <?php  if($this->input->get('error')){ ?>
                    <div class="form-group alert alert-danger">
                        <i class="fa fa-ban"></i>
                        Gagal mengupdate profil, silahkan coba kembali
                    </div>
                <?php } ?>


                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <h4>Profile Edit</h4>
                        <?= form_open_multipart(current_url(),array('id'=>'profile')) ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-building-o"></i></div>
                                    <input type="text" class="form-control" name="<?=COL_COMPANYNAME?>" value="<?=!empty($data[COL_COMPANYNAME]) ? $data[COL_COMPANYNAME] : ''?>" placeholder="Company Name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <select name="<?=COL_INDUSTRYTYPEID?>" class="form-control" required>
                                    <option value="">Select Industry Type</option>
                                    <?=GetCombobox("SELECT * FROM industrytypes", COL_INDUSTRYTYPEID, COL_INDUSTRYTYPENAME, (!empty($data[COL_INDUSTRYTYPEID]) ? $data[COL_INDUSTRYTYPEID] : null))?>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                    <input type="text" class="form-control" name="<?=COL_COMPANYEMAIL?>" value="<?=!empty($data[COL_COMPANYEMAIL]) ? $data[COL_COMPANYEMAIL] : ''?>" placeholder="Company Email Address">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-globe"></i></div>
                                    <input type="text" class="form-control" name="<?=COL_COMPANYWEBSITE?>" value="<?=!empty($data[COL_COMPANYWEBSITE]) ? $data[COL_COMPANYWEBSITE] : ''?>" placeholder="Company Website">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    <input type="text" class="form-control" name="<?=COL_COMPANYTELP?>" value="<?=!empty($data[COL_COMPANYTELP]) ? $data[COL_COMPANYTELP] : ''?>" placeholder="Company Telephone No." required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-print"></i></div>
                                    <input type="text" class="form-control" name="<?=COL_COMPANYFAX?>" value="<?=!empty($data[COL_COMPANYFAX]) ? $data[COL_COMPANYFAX] : ''?>" placeholder="Company Fax No.">
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" rows="4" placeholder="Company Address" name="<?=COL_COMPANYADDRESS?>" required><?=!empty($data[COL_COMPANYADDRESS]) ? $data[COL_COMPANYADDRESS] : ''?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea id="ckeditor" class="form-control" rows="4" placeholder="Company Description" name="<?=COL_COMPANYDESCRIPTION?>" required><?=!empty($data[COL_COMPANYDESCRIPTION]) ? $data[COL_COMPANYDESCRIPTION] : ''?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="label-control">Logo (Optional - Max size: 500KB)</label>
                                <input type="file" name="userfile" />
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-flat pull-right">Simpan</button>
                            </div>
                        </div>

                        <?= form_close() ?>
                    </div>
                </div>
            </div>
            <?php } else if($data && $data[COL_ROLEID] == ROLEUSER) {
                ?>
                <div class="col-md-8">

                    <?php if(validation_errors()){ ?>
                        <div class="alert alert-danger alert-dismissible">
                            <i class="fa fa-ban"></i>
                            <?= validation_errors() ?>
                        </div>
                    <?php }
                    if(!empty($upload_errors)) {
                        ?>
                        <div class="alert alert-danger alert-dismissible">
                            <i class="fa fa-ban"></i>
                            <?=$upload_errors?>
                        </div>
                        <?php
                    }
                    ?>

                    <?php  if($this->input->get('success')){ ?>
                        <div class="form-group alert alert-success alert-dismissible">
                            <i class="fa fa-check"></i>
                            Update profil berhasil.
                        </div>
                    <?php } ?>

                    <?php  if($this->input->get('error')){ ?>
                        <div class="form-group alert alert-danger alert-dismissible">
                            <i class="fa fa-ban"></i>
                            Gagal mengupdate profil, silahkan coba kembali
                        </div>
                    <?php } ?>


                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <h4>Profile Edit</h4>
                            <?= form_open_multipart(current_url(),array('id'=>'profile')) ?>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" class="form-control required" name="<?=COL_NAME?>" value="<?=!empty($data[COL_NAME]) ? $data[COL_NAME] : ''?>" placeholder="Full Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                                        <input type="text" class="form-control required" name="<?=COL_IDENTITYNO?>" value="<?=!empty($data[COL_IDENTITYNO]) ? $data[COL_IDENTITYNO] : ''?>" placeholder="Identity No">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input type="text" class="form-control datepicker" name="<?=COL_BIRTHDATE?>" value="<?=!empty($data[COL_BIRTHDATE]) ? date('d M Y', strtotime($data[COL_BIRTHDATE])) : ''?>" placeholder="Birth  Date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select name="<?=COL_RELIGIONID?>" class="form-control required">
                                        <option value="">Select Religion</option>
                                        <?=GetCombobox("SELECT * FROM religions", COL_RELIGIONID, COL_RELIGIONNAME, (!empty($data[COL_RELIGIONID]) ? $data[COL_RELIGIONID] : null))?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label class="control-label">Gender</label>
                                    </div>
                                    <div class="col-sm-7" style="margin-bottom: 10px;">
                                        <label><input type="radio" name="<?=COL_GENDER?>" value="1" <?=(!empty($data[COL_GENDER]) ? ($data[COL_GENDER]==1?"checked":"") : "checked")?> /> &nbsp; Male</label> &nbsp;&nbsp;
                                        <label><input type="radio" name="<?=COL_GENDER?>" value="2" <?=(!empty($data[COL_GENDER]) && $data[COL_GENDER]==2?"checked":"")?> /> &nbsp; Female</label> &nbsp;&nbsp;
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                        <input type="text" class="form-control required" name="<?=COL_PHONENUMBER?>" value="<?=!empty($data[COL_PHONENUMBER]) ? $data[COL_PHONENUMBER] : ''?>" placeholder="Phone Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control required" rows="4" placeholder="Address" name="<?=COL_ADDRESS?>"><?=!empty($data[COL_ADDRESS]) ? $data[COL_ADDRESS] : ''?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select name="<?=COL_EDUCATIONID?>" class="form-control">
                                        <option value="">Select Education</option>
                                        <?=GetCombobox("SELECT * FROM educationtypes ORDER BY EducationTypeName", COL_EDUCATIONTYPEID, COL_EDUCATIONTYPENAME, (!empty($data[COL_EDUCATIONID]) ? $data[COL_EDUCATIONID] : null))?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-institution"></i></div>
                                        <input type="text" class="form-control" name="<?=COL_UNIVERSITYNAME?>" value="<?=!empty($data[COL_UNIVERSITYNAME]) ? $data[COL_UNIVERSITYNAME] : ''?>" placeholder="University">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>
                                        <input type="text" class="form-control" name="<?=COL_FACULTYNAME?>" value="<?=!empty($data[COL_FACULTYNAME]) ? $data[COL_FACULTYNAME] : ''?>" placeholder="Faculty">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-book"></i></div>
                                        <input type="text" class="form-control" name="<?=COL_MAJORNAME?>" value="<?=!empty($data[COL_MAJORNAME]) ? $data[COL_MAJORNAME] : ''?>" placeholder="Major">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><input type="checkbox" value="1" name="<?=COL_ISGRADUATED?>" <?=!empty($data[COL_ISGRADUATED]) && $data[COL_ISGRADUATED] ? 'checked' : ''?> /> Graduated</div>
                                        <input type="text" class="form-control datepicker" name="<?=COL_GRADUATEDDATE?>" value="<?=!empty($data[COL_GRADUATEDDATE]) ? $data[COL_GRADUATEDDATE] : ''?>" placeholder="On">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-black-tie"></i></div>
                                        <input type="number" class="form-control" name="<?=COL_YEAROFEXPERIENCE?>" value="<?=!empty($data[COL_YEAROFEXPERIENCE]) ? $data[COL_YEAROFEXPERIENCE] : ''?>" placeholder="Experience (Year)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                        <input type="text" class="form-control" name="<?=COL_RECENTPOSITION?>" value="<?=!empty($data[COL_RECENTPOSITION]) ? $data[COL_RECENTPOSITION] : ''?>" placeholder="Recent Position">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                        <input type="number" class="form-control" name="<?=COL_RECENTSALARY?>" value="<?=!empty($data[COL_RECENTSALARY]) ? $data[COL_RECENTSALARY] : ''?>" placeholder="Recent Salary">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                        <input type="number" class="form-control" name="<?=COL_EXPECTEDSALARY?>" value="<?=!empty($data[COL_EXPECTEDSALARY]) ? $data[COL_EXPECTEDSALARY] : ''?>" placeholder="Expected Salary">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="label-control">Photo (Optional - Max size: 500KB)</label>
                                    <input type="file" name="userfile" accept="image/*" />
                                </div>
                                <div class="form-group">
                                    <label class="label-control">CV / Resume (Optional - Max size: 500KB)</label>
                                    <?php
                                    if($data[COL_CVFILENAME]) {
                                        ?>
                                        <a href="<?=MY_UPLOADURL.$data[COL_CVFILENAME]?>" ><?=$data[COL_CVFILENAME]?></a>
                                    <?php
                                    }
                                    ?>
                                    <input type="file" name="cvfile" accept="application/msword, text/plain, application/pdf" />
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-flat pull-right">Simpan</button>
                                </div>
                            </div>

                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </section>

<?php $this->load->view('loadjs') ?>
<script>
    CKEDITOR.replace("ckeditor");
</script>
<?php $this->load->view('footer') ?>