<?php $this->load->view('header') ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?= $title ?> <small> Form</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=site_url('company/index')?>"> Companies</a></li>
            <li class="active"><?=$edit?'Edit':'Add'?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div style="display: none" class="alert alert-danger errorBox">
                    <i class="fa fa-ban"></i> Error :
                    <span class="errorMsg"></span>
                </div>
                <?php
                if($this->input->get('error') == 1){
                    ?>
                    <div class="alert alert-danger">
                        <i class="fa fa-ban"></i>
                        <span class="">Data gagal disimpan, silahkan coba kembali</span>
                    </div>
                    <?php
                }
                if(validation_errors()){
                    ?>
                    <div class="alert alert-danger">
                        <i class="fa fa-ban"></i>
                        <?=validation_errors()?>
                    </div>
                    <?php
                }
                if(!empty($upload_errors)) {
                    ?>
                    <div class="alert alert-danger">
                        <i class="fa fa-ban"></i>
                        <?=$upload_errors?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?=form_open_multipart(current_url(),array('role'=>'form','id'=>'deviceForm'))?>
            <?php if(!$edit) {
                ?>
                <div class="col-sm-4">
                    <h4>Credentials</h4>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <input type="text" class="form-control" name="<?=COL_USERNAME?>" placeholder="Username" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-key"></i></div>
                            <input type="password" class="form-control" name="<?=COL_PASSWORD?>" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-key"></i></div>
                            <input type="password" class="form-control" name="RepeatPassword" placeholder="Repeat Password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">@</div>
                            <input type="text" class="form-control" name="<?=COL_EMAIL?>" placeholder="Email" required>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

            <div class="col-sm-8" style="padding: 0px;">
                <div class="col-sm-6">
                    <h4>Company Info</h4>
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
                <div class="col-sm-6">
                    <h4>&nbsp;</h4>
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
                        <textarea class="form-control" rows="3" placeholder="Company Address" name="<?=COL_COMPANYADDRESS?>" required><?=!empty($data[COL_COMPANYADDRESS]) ? $data[COL_COMPANYADDRESS] : ''?></textarea>
                    </div>
                    <div class="form-group">
                        <?php if(!empty($data[COL_FILENAME])) { ?>
                            <img src="<?=MY_UPLOADURL.$data[COL_FILENAME]?>" alt="Logo" height="80" /><br />
                        <?php } ?>
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
            </div>
            <?=form_close()?>
        </div>
    </section>

<?php $this->load->view('loadjs') ?>
    <!--<script type="text/javascript">
        $("#deviceForm").validate({
            submitHandler : function(form){
                $(form).find('btn').attr('disabled',true);
                $(form).ajaxSubmit({
                    dataType: 'json',
                    type : 'post',
                    success : function(data){
                        $(form).find('btn').attr('disabled',false);
                        if(data.error != 0){
                            $('.errorBox').show().find('.errorMsg').html(data.error);
                        }else{
                            window.location.href = data.redirect;
                        }
                    },
                    error : function(a,b,c){
                        alert('Response Error');
                        console.log(a);
                        console.log(b);
                        console.log(c);
                    }
                });
                return false;
            }
        });
    </script>-->
<?php $this->load->view('footer') ?>