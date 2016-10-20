<?php $this->load->view('header') ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?= $title ?> <small> Form</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Settings</li>
        </ol>
    </section>

<?php
$allsetting = $this->db->get(TBL_SETTINGS)->result_array();
?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-8">
                <div class="box box-solid">
                    <div class="box-body">
                        <div class="col-sm-12">
                            <?=form_open(current_url(),array('role'=>'form','id'=>'settingForm'))?>
                            <?php
                            foreach($allsetting as $setting) {
                                ?>
                                <div class="form-group">
                                    <label class="form-label"><?=$setting[COL_SETTINGLABEL]?></label>
                                    <input type="<?=$setting[COL_SETTINGNAME]==SETTING_SMTPPASSWORD?'password':'text'?>" class="form-control" name="<?=$setting[COL_SETTINGNAME]?>" value="<?=GetSetting($setting[COL_SETTINGNAME])?>" required>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-flat pull-right">Simpan</button>
                            </div>
                            <?=form_close()?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $this->load->view('loadjs') ?>
<?php $this->load->view('footer') ?>