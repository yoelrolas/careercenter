<?php $this->load->view('frontend/header') ?>
<div class="container">
    <section class="content-header">
        <h1>Reset Password</h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url()?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Reset Password</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="box box-solid">
                <form class="form-horizontal" action="<?=current_url()."?token=".$token?>" method="post">
                    <div class="box-body">
                        <?php
                        if(validation_errors()){
                            ?>
                            <div class="alert alert-danger alert-dismissible">
                                <i class="fa fa-ban"></i>
                                <span class="">
                                    <?=validation_errors()?>
                                </span>
                            </div>
                            <?php
                        }
                        if($this->input->get("error") == 1){
                            ?>
                            <div class="alert alert-danger alert-dismissible">
                                <i class="fa fa-ban"></i>
                                Reset password gagal
                            </div>
                            <?php
                        }
                        ?>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="label-control">Password Baru</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                    <input type="password" class="form-control" name="<?=COL_PASSWORD?>" placeholder="Masukkan password baru anda" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="label-control">Ulangi Password Baru</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                    <input type="password" class="form-control" name="RepeatPassword" placeholder="Ulangi password baru anda" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary btn-flat pull-right">Kirim</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('frontend/footer') ?>
