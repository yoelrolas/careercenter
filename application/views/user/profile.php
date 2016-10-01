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
                        <img class="profile-user-img img-responsive img-circle" src="<?=MY_IMAGEURL.'company-icon.jpg'?>" alt="User profile picture">

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
                                <b>Registered On</b> <a class="pull-right"><?=!empty($data) ? date('d M Y', strtotime($data[COL_REGISTERDATE])) : "-"?></a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block btn-flat"><b> Change Password</b></a>
                    </div>
                </div>
            </div>

            <?php if($data && !empty($data[COL_COMPANYID])) { ?>
            <div class="col-md-8">

                <?php if(validation_errors()){ ?>
                    <div class="alert alert-danger">
                        <?= validation_errors() ?>
                    </div>
                <?php } ?>

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
                        <?= form_open(current_url(),array('id'=>'profile')) ?>
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
            <?php } ?>
        </div>
    </section>

<?php $this->load->view('loadjs') ?>
<script>
    CKEDITOR.replace("ckeditor");
</script>
<?php $this->load->view('footer') ?>