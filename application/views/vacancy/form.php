<?php $this->load->view('header') ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?= $title ?> <small> Form</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=site_url('vacancy/index')?>"> Vacancies</a></li>
            <li class="active"><?=$edit?'Edit':'Add'?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary" style="border-top-color: transparent">
                    <div class="box-body">
                        <?php if(validation_errors()){ ?>
                            <div class="alert alert-danger">
                                <i class="fa fa-ban"></i>
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

                        <?=form_open_multipart(current_url(),array('role'=>'form','id'=>'vacancy'))?>
                        <div class="col-sm-6">
                            <div class="form-group col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-info"></i></div>
                                    <input type="text" class="form-control" name="<?=COL_VACANCYTITLE?>" value="<?=!empty($data[COL_VACANCYTITLE]) ? $data[COL_VACANCYTITLE] : ''?>" placeholder="Vacancy Title" required>
                                </div>
                            </div>

                            <?php if(GetLoggedUser()[COL_ROLEID] == ROLEADMIN) { ?>
                                <div class="form-group col-sm-8">
                                    <select name="<?=COL_COMPANYID?>" class="form-control" required>
                                        <option value="">Select Company</option>
                                        <?=GetCombobox("SELECT * FROM companies ORDER BY CompanyName", COL_COMPANYID, COL_COMPANYNAME, (!empty($data[COL_COMPANYID]) ? $data[COL_COMPANYID] : null))?>
                                    </select>
                                </div>
                            <?php } else { ?>
                                <input type="hidden" name="<?=COL_COMPANYID?>" value="<?=GetLoggedUser()[COL_COMPANYID]?>" required>
                            <?php } ?>

                            <div class="form-group col-sm-8">
                                <select name="<?=COL_VACANCYTYPEID?>" class="form-control" required>
                                    <option value="">Select Type</option>
                                    <?=GetCombobox("SELECT * FROM vacancytypes ORDER BY VacancyTypeName", COL_VACANCYTYPEID, COL_VACANCYTYPENAME, (!empty($data[COL_VACANCYTYPEID]) ? $data[COL_VACANCYTYPEID] : null))?>
                                </select>
                            </div>
                            <div class="form-group col-sm-8">
                                <select name="<?=COL_POSITIONID?>" class="form-control" required>
                                    <option value="">Select Position</option>
                                    <?=GetCombobox("SELECT * FROM positions ORDER  BY PositionName", COL_POSITIONID, COL_POSITIONNAME, (!empty($data[COL_POSITIONID]) ? $data[COL_POSITIONID] : null))?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" class="form-control datepicker" name="<?=COL_ENDDATE?>" value="<?=!empty($data[COL_ENDDATE]) ? date('d M Y', strtotime($data[COL_ENDDATE])) : ''?>" placeholder="Deadline" required>
                                </div>
                            </div>

                            <div class="form-group col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                    <input type="text" class="form-control" name="<?=COL_VACANCYEMAIL?>" value="<?=!empty($data[COL_VACANCYEMAIL]) ? $data[COL_VACANCYEMAIL] : ''?>" placeholder="Email Contact" required>
                                </div>
                            </div>

                            <?php if(GetLoggedUser()[COL_ROLEID] == ROLEADMIN) { ?>
                                <div class="form-group col-sm-8 checkbox">
                                    <label>
                                        <input type="checkbox" value="1" name="<?=COL_ISSUSPEND?>" <?=!empty($data[COL_ISSUSPEND]) && $data[COL_ISSUSPEND] ? 'checked' : ''?> />
                                        Suspend
                                    </label>
                                </div>
                            <?php } ?>

                            <div class="form-group col-sm-8 checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="<?=COL_ISALLLOCATION?>" <?=!empty($data[COL_ISALLLOCATION]) && $data[COL_ISALLLOCATION] ? 'checked' : ''?> />
                                    Semua lokasi
                                </label>
                            </div>

                            <div class="form-group col-sm-12 location">
                                <label class="control-label col-sm-4">Lokasi</label>
                                <div class="col-sm-8">
                                    <select name="LocationID[]" class="form-control" multiple>
                                        <?=GetCombobox("SELECT * FROM locations ORDER BY LocationName", COL_LOCATIONID, COL_LOCATIONNAME, (!empty($locs) ? $locs : null))?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <label class="control-label col-sm-4">Pendidikan</label>
                                <div class="col-sm-8">
                                    <select name="EducationTypeID[]" class="form-control" multiple required>
                                        <?=GetCombobox("SELECT * FROM educationtypes ORDER BY EducationTypeName", COL_EDUCATIONTYPEID, COL_EDUCATIONTYPENAME, (!empty($edus) ? $edus : null))?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea id="desc_editor" class="form-control" rows="4" placeholder="Vacancy Description" name="<?=COL_VACANCYDESC?>"><?=!empty($data[COL_VACANCYDESC]) ? $data[COL_VACANCYDESC] : ''?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Responsibility</label>
                                <textarea id="resp_editor" class="form-control" rows="4" placeholder="Vacancy Responsibilities" name="<?=COL_VACANCYRESPONSIBILITY?>"><?=!empty($data[COL_VACANCYRESPONSIBILITY]) ? $data[COL_VACANCYRESPONSIBILITY] : ''?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Requirements</label>
                                <textarea id="req_editor" class="form-control" rows="4" placeholder="Vacancy Requirements" name="<?=COL_VACANCYREQUIREMENT?>"><?=!empty($data[COL_VACANCYREQUIREMENT]) ? $data[COL_VACANCYREQUIREMENT] : ''?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="label-control">Lampiran (Optional - Max size: 10MB)</label>
                                <?php
                                if(!empty($data[COL_ATTACHMENTFILENAME])) {
                                    ?>
                                    <a href="<?=MY_UPLOADURL.$data[COL_ATTACHMENTFILENAME]?>" ><?=$data[COL_ATTACHMENTFILENAME]?></a>
                                    <?php
                                }
                                ?>
                                <input type="file" name="userfile" accept="application/msword, text/plain, application/pdf" />
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
<script>
    $(document).ready(function() {
        $("[name=IsAllLocation]").change(function() {
            if($(this).is(":checked")) $(".location").hide();
            else $(".location").show();
        }).trigger("change");

        CKEDITOR.replace("desc_editor");
        CKEDITOR.replace("resp_editor");
        CKEDITOR.replace("req_editor");
    });
</script>
<?php $this->load->view('footer') ?>