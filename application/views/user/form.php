<?php $this->load->view('header') ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?= $title ?> <small> Form</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=site_url('user/index')?>"> Users</a></li>
            <li class="active"><?=$edit?'Edit':'Add'?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary" style="border-top-color: transparent">
                    <div class="box-body">
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

                        <?=form_open_multipart(current_url(),array('role'=>'form','id'=>'userForm'))?>
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
                                <div class="form-group">
                                    <select name="<?=COL_ROLEID?>" class="form-control" required>
                                        <option value="">Select Role</option>
                                        <?=GetCombobox("SELECT * FROM roles", COL_ROLEID, COL_ROLENAME, (!empty($data[COL_ROLEID]) ? $data[COL_ROLEID] : null))?>
                                    </select>
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <input type="hidden" name="<?=COL_ROLEID?>" value="<?=$data[COL_ROLEID]?>" disabled />
                        <?php
                        }
                        ?>

                        <div class="col-sm-8 company" style="padding: 0px; display: none">
                            <div class="col-sm-6">
                                <h4>Company Info</h4>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-building-o"></i></div>
                                        <input type="text" class="form-control required" name="<?=COL_COMPANYNAME?>" value="<?=!empty($data[COL_COMPANYNAME]) ? $data[COL_COMPANYNAME] : ''?>" placeholder="Company Name" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select name="<?=COL_INDUSTRYTYPEID?>" class="form-control required">
                                        <option value="">Select Industry Type</option>
                                        <?=GetCombobox("SELECT * FROM industrytypes", COL_INDUSTRYTYPEID, COL_INDUSTRYTYPENAME, (!empty($data[COL_INDUSTRYTYPEID]) ? $data[COL_INDUSTRYTYPEID] : null))?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                        <input type="text" class="form-control required" name="<?=COL_COMPANYEMAIL?>" value="<?=!empty($data[COL_COMPANYEMAIL]) ? $data[COL_COMPANYEMAIL] : ''?>" placeholder="Company Email Address">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h4>&nbsp;</h4>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-globe"></i></div>
                                        <input type="text" class="form-control required" name="<?=COL_COMPANYWEBSITE?>" value="<?=!empty($data[COL_COMPANYWEBSITE]) ? $data[COL_COMPANYWEBSITE] : ''?>" placeholder="Company Website">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                        <input type="text" class="form-control required" name="<?=COL_COMPANYTELP?>" value="<?=!empty($data[COL_COMPANYTELP]) ? $data[COL_COMPANYTELP] : ''?>" placeholder="Company Telephone No.">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-print"></i></div>
                                        <input type="text" class="form-control required" name="<?=COL_COMPANYFAX?>" value="<?=!empty($data[COL_COMPANYFAX]) ? $data[COL_COMPANYFAX] : ''?>" placeholder="Company Fax No.">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea class="form-control required" rows="3" placeholder="Company Address" name="<?=COL_COMPANYADDRESS?>" required><?=!empty($data[COL_COMPANYADDRESS]) ? $data[COL_COMPANYADDRESS] : ''?></textarea>
                                </div>
                                <div class="form-group">
                                    <?php if(!empty($data[COL_FILENAME])) { ?>
                                        <img src="<?=MY_UPLOADURL.$data[COL_FILENAME]?>" alt="Logo" height="80" /><br />
                                    <?php } ?>
                                    <label class="label-control">Logo (Optional - Max size: 500KB)</label>
                                    <input type="file" name="companyfile" />
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-8 user" style="padding: 0px; display: none">
                            <div class="col-sm-6">
                                <h4>User Information</h4>
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
                                <h4>&nbsp;</h4>
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
                                        <input type="text" class="form-control datepicker" name="<?=COL_MAJORNAME?>" value="<?=!empty($data[COL_MAJORNAME]) ? $data[COL_MAJORNAME] : ''?>" placeholder="On">
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
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-flat pull-right">Simpan</button>
                            </div>
                        </div>
                        <?=form_close()?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $this->load->view('loadjs') ?>
    <script type="text/javascript">
        $("[name=RoleID]").change(function() {
            var role = $(this).val();
            if(role == <?=ROLECOMPANY?>) {
                $(".user").fadeOut("slow", function() {
                    $(".company").fadeIn("slow", function(){
                        $("select", $(".company")).select2();
                        $(".required", $(".user")).attr("required", false);
                        $(".required", $(".company")).attr("required", true);
                    });
                });
            }
            else {
                $(".company").fadeOut("slow", function() {
                    $(".user").fadeIn("slow", function(){
                        $("select", $(".user")).select2();
                        $(".required", $(".user")).attr("required", true);
                        $(".required", $(".company")).attr("required", false);
                    });
                });
            }
            /*else {
                $(".company").fadeOut("slow", function() {});
                $(".user").fadeOut("slow", function(){});

                $(".required", $(".user")).attr("required", false);
                $(".required", $(".company")).attr("required", false);
            }*/
        }).trigger("change");
    </script>
<?php $this->load->view('footer') ?>