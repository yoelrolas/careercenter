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
$notifications = $this->db->get(TBL_NOTIFICATIONS)->result_array();
$count = !empty($notifications) ? count($notifications) : 0;
$divider = $count / 2;
?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary" style="border-top-color: transparent">
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="callout callout-info">
                                <h4><i class="fa fa-info"></i>&nbsp;&nbsp;Informasi</h4>
                                <p>Format yang dapat digunakan sebagai parameter pada <b>subject</b> dan <b>content</b> notifikasi:</p>
                                <ul style="width: 40%; display: inline-block">
                                    <li><b>@SITENAME@</b></li>
                                    <li><b>@USERNAME@</b></li>
                                    <li><b>@EMAIL@</b></li>
                                    <li><b>@COMPANYNAME@</b></li>
                                    <li><b>@COMPANYTELP@</b></li>
                                </ul>
                                <ul style="width: 40%; display: inline-block">
                                    <li><b>@URL@</b></li>
                                    <li><b>@STATUS@</b></li>
                                    <li><b>@VACANCYTITLE@</b></li>
                                    <li><b>@VACANCYTYPE@</b></li>
                                    <li><b>@VACANCYPOSITION@</b></li>
                                </ul>
                            </div>
                        </div>
                        <?=form_open(current_url(),array('role'=>'form','id'=>'settingForm'))?>
                        <?php
                        $counter = 0;
                        foreach($notifications as $notif) {
                            ?>
                            <h4 style="border-bottom: 1px solid #dedede;"><?=$notif[COL_NOTIFICATIONNAME]?></h4>
                            <div class="form-group col-sm-5">
                                <label class="form-label">Subject</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-edit"></i></div>
                                    <input type="text" class="form-control" name="<?=COL_NOTIFICATIONSUBJECT."-".$notif[COL_NOTIFICATIONID]?>" value="<?=$notif[COL_NOTIFICATIONSUBJECT]?>" placeholder="Notification Subject" />
                                    <div class="input-group-addon">
                                        <label><input type="checkbox" name="<?=COL_ISACTIVE."-".$notif[COL_NOTIFICATIONID]?>" <?=$notif[COL_ISACTIVE]?"checked":""?> value="1" /> Aktif</label>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="clearfix"></div>-->
                            <div class="form-group col-sm-4">
                                <label class="form-label">Sender Email</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-at"></i></div>
                                    <input type="text" class="form-control" name="<?=COL_NOTIFICATIONSENDEREMAIL."-".$notif[COL_NOTIFICATIONID]?>" value="<?=$notif[COL_NOTIFICATIONSENDEREMAIL]?>" placeholder="Sender Email" />
                                </div>
                            </div>
                            <div class="form-group col-sm-3"\>
                                <label class="form-label">Sender Name</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-info"></i></div>
                                    <input type="text" class="form-control" name="<?=COL_NOTIFICATIONSENDERNAME."-".$notif[COL_NOTIFICATIONID]?>" value="<?=$notif[COL_NOTIFICATIONSENDERNAME]?>" placeholder="Sender Name" />
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <div class="form-group col-sm-12">
                                <label class="form-label">Content</label>
                                <textarea id="content-<?=$counter?>" class="form-control" name="<?=COL_NOTIFICATIONCONTENT."-".$notif[COL_NOTIFICATIONID]?>" placeholder="Notification Content"><?=$notif[COL_NOTIFICATIONCONTENT]?></textarea>
                            </div>
                            <div class="clearfix" style="margin-bottom:40px;"></div>
                            <?php
                            $counter++;
                        }
                        ?>
                        <div class="clearfix"></div>
                        <div class="form-group col-sm-12">
                            <button type="submit" class="btn btn-primary btn-flat pull-right">Simpan</button>
                        </div>
                        <?=form_close()?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $this->load->view('loadjs') ?>
<script>
    $(document).ready(function(){
        for(var i=0; i<<?=$counter?>; i++) {
            CKEDITOR.replace("content-"+i);
        }
    });
</script>
<?php $this->load->view('footer') ?>