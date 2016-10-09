<?php $this->load->view('header') ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?= $title ?> <small> Form</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Change Password</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?=form_open(current_url(),array('role'=>'form','id'=>'changepassword'))?>
            <div class="col-sm-6">
                <?php if(validation_errors()){ ?>
                    <div class="form group alert alert-danger">
                        <i class="fa fa-ban"></i>
                        <?= validation_errors() ?>
                    </div>
                <?php } ?>

                <?php  if($this->input->get('success')){ ?>
                    <div class="form-group alert alert-success">
                        <i class="fa fa-check"></i>
                        Ganti password berhasil.
                    </div>
                <?php } ?>

                <?php  if($this->input->get('error')){ ?>
                    <div class="form-group alert alert-danger">
                        <i class="fa fa-ban"></i>
                        Gagal mengganti password, silahkan coba kembali
                    </div>
                <?php } ?>

                <?php  if($this->input->get('nomatch')){ ?>
                    <div class="form-group alert alert-danger">
                        <i class="fa fa-ban"></i>
                        Password lama tidak sesuai
                    </div>
                <?php } ?>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-key"></i></div>
                        <input type="password" class="form-control" name="OldPassword" placeholder="Old Password" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-key"></i></div>
                        <input type="password" class="form-control" name="<?=COL_PASSWORD?>" placeholder="New Password" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-key"></i></div>
                        <input type="password" class="form-control" name="RepeatPassword" placeholder="Repeat Password" required>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-flat pull-right">Simpan</button>
                </div>
            </div>
            <?=form_close()?>
        </div>
    </section>

<?php $this->load->view('loadjs') ?>
    <script type="text/javascript">
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
                    }
                });
                return false;
            }
        });
    </script>
<?php $this->load->view('footer') ?>