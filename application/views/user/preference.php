<?php $this->load->view('header') ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?= $title ?> <small> Form</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Preference</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary" style="border-top-color: transparent">
                    <div class="box-body">
                        <?=form_open(current_url(),array('role'=>'form','id'=>'preferenceForm'))?>
                        <input type="hidden" name="<?=COL_USERNAME?>" value="<?=GetLoggedUser()[COL_USERNAME]?>" />
                        <div class="form-group col-sm-8">
                            <label class="form-label">Industry</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                <select name="<?=COL_PREFERENCEVALUE."-".PREFERENCETYPE_INDUSTRYTYPE?>[]" class="form-control" multiple>
                                    <?=GetCombobox("SELECT * FROM industrytypes ORDER BY IndustryTypeName", COL_INDUSTRYTYPEID, COL_INDUSTRYTYPENAME, (!empty($industry) ? $industry : null))?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-8">
                            <label class="form-label">Education</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>
                                <select name="<?=COL_PREFERENCEVALUE."-".PREFERENCETYPE_EDUCATIONTYPE?>[]" class="form-control" multiple>
                                    <?=GetCombobox("SELECT * FROM educationtypes ORDER BY EducationTypeName", COL_EDUCATIONTYPEID, COL_EDUCATIONTYPENAME, (!empty($education) ? $education : null))?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-8">
                            <label class="form-label">Position</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                <select name="<?=COL_PREFERENCEVALUE."-".PREFERENCETYPE_POSITION?>[]" class="form-control" multiple>
                                    <?=GetCombobox("SELECT * FROM positions ORDER BY PositionID", COL_POSITIONID, COL_POSITIONNAME, (!empty($position) ? $position : null))?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-8">
                            <label class="form-label">Location</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                <select name="<?=COL_PREFERENCEVALUE."-".PREFERENCETYPE_LOCATION?>[]" class="form-control" multiple>
                                    <?=GetCombobox("SELECT * FROM locations ORDER BY LocationID", COL_LOCATIONID, COL_LOCATIONNAME, (!empty($location) ? $location : null))?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-8">
                            <label class="form-label">Vacancy Type</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-bookmark"></i></div>
                                <select name="<?=COL_PREFERENCEVALUE."-".PREFERENCETYPE_VACANCYTYPE?>[]" class="form-control" multiple>
                                    <?=GetCombobox("SELECT * FROM vacancytypes ORDER BY VacancyTypeID", COL_VACANCYTYPEID, COL_VACANCYTYPENAME, (!empty($type) ? $type : null))?>
                                </select>
                            </div>
                        </div>
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
<?php $this->load->view('footer') ?>