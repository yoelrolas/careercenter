<?php $this->load->view('header') ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?= $title ?> <small> Form</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=site_url('post/index')?>"> Posts</a></li>
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
                            <div class="alert alert-danger alert-dismissible">
                                <i class="fa fa-ban"></i>
                                <?= validation_errors() ?>
                            </div>
                        <?php } ?>

                        <?php  if($this->input->get('success')){ ?>
                            <div class="form-group alert alert-success alert-dismissible">
                                <i class="fa fa-check"></i>
                                Update post berhasil.
                            </div>
                        <?php } ?>

                        <?php  if($this->input->get('error')){ ?>
                            <div class="form-group alert alert-danger alert-dismissible">
                                <i class="fa fa-ban"></i>
                                Gagal mengupdate post, silahkan coba kembali
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

                        <?=form_open_multipart(current_url(),array('role'=>'form','id'=>'post'))?>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-info"></i></div>
                                    <input type="text" class="form-control" name="<?=COL_POSTTITLE?>" value="<?=!empty($data[COL_POSTTITLE]) ? $data[COL_POSTTITLE] : ''?>" placeholder="Post Title" required>
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-sm-7">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><?=base_url('post')."/"?></div>
                                    <input type="text" class="form-control" name="<?=COL_POSTSLUG?>" value="<?=!empty($data[COL_POSTSLUG]) ? $data[COL_POSTSLUG] : ''?>" required readonly>
                                    <div class="input-group-addon"><?=URL_SUFFIX?></div>
                                </div>
                            </div>
                        </div>-->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-eyedropper"></i></div>
                                    <select name="<?=COL_POSTCATEGORYID?>" class="form-control" required>
                                        <option value="">Select Category</option>
                                        <?=GetCombobox("SELECT * FROM postcategories ORDER BY PostCategoryName", COL_POSTCATEGORYID, COL_POSTCATEGORYNAME, (!empty($data[COL_POSTCATEGORYID]) ? $data[COL_POSTCATEGORYID] : null))?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" class="form-control datepicker" name="<?=COL_POSTEXPIREDDATE?>" value="<?=!empty($data[COL_POSTEXPIREDDATE]) ? date('d M Y', strtotime($data[COL_POSTEXPIREDDATE])) : ''?>" placeholder="Expired Date" required>
                                    <div class="input-group-addon">
                                        <label><input type="checkbox" name="<?=COL_ISSUSPEND?>" <?=!empty($data[COL_ISSUSPEND]) && $data[COL_ISSUSPEND]?"checked":""?> value="1" /> Suspend</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <?php if(!empty($data[COL_FILENAME])) { ?>
                                    <img src="<?=MY_UPLOADURL.$data[COL_FILENAME]?>" alt="Logo" height="80" /><br />
                                <?php } ?>
                                <label class="label-control">Image (Optional - Max size: 50MB)</label>
                                <input type="file" name="userfile" accept="image/*" />
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Content</label>
                                <textarea id="content_editor" class="form-control" rows="4" placeholder="Post Content" name="<?=COL_POSTCONTENT?>"><?=!empty($data[COL_POSTCONTENT]) ? $data[COL_POSTCONTENT] : ''?></textarea>
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
            $("[name=PostTitle]").change(function() {
                var title = $(this).val().toLowerCase();
                var slug = title.replace(/\s/g, "-");
                $("[name=PostSlug]").val(slug);
            }).trigger("change");
            CKEDITOR.replace("content_editor");
        });
    </script>
<?php $this->load->view('footer') ?>