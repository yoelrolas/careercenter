<?php $this->load->view('frontend/header') ?>
<div class="container">
    <section class="content-header">
        <h1>Lupa Password</h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url()?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Lupa Password</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="box box-solid">
                <form class="form-horizontal" action="<?=current_url()?>" method="post">
                    <div class="box-body">
                        <?php
                        if($this->input->get("notfound") == 1){
                            ?>
                            <div class="alert alert-danger alert-dismissible">
                                <i class="fa fa-ban"></i>
                                <span class="">Email tidak terdaftar</span>
                            </div>
                            <?php
                        }
                        if($this->input->get("success") == 1){
                            ?>
                            <div class="alert alert-success alert-dismissible">
                                <i class="fa fa-check"></i>
                                Selesai. Silahkan periksa email anda untuk pemulihan password.
                            </div>
                            <?php
                        }
                        ?>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="label-control">Email</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                    <input type="text" class="form-control" name="<?=COL_EMAIL?>" placeholder="Masukkan email anda" />
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
