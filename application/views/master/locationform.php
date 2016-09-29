<?php $this->load->view('header') ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?= $title ?> <small> Form</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=site_url('master/locations')?>"> Locations</a></li>
            <li class="active"><?=$edit?'Edit':'Add'?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-6">
                <?=form_open(current_url(),array('role'=>'form','id'=>'deviceForm'))?>
                <div style="display: none" class="alert alert-danger errorBox">
                    <i class="fa fa-ban"></i>
                    <span class="errorMsg"></span>
                </div>
                <?php
                if($this->input->get('success') == 1){
                    ?>
                    <div class="alert alert-success">
                        <i class="fa fa-check"></i>
                        <span class="">Data disimpan</span>
                    </div>
                    <?php
                }
                ?>
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="<?=COL_LOCATIONNAME?>" value="<?= $edit ? $data[COL_LOCATIONNAME] : ""?>" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <?=form_close()?>
            </div>
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
                            $('.errorBox').show().find('.errorMsg').text(data.error);
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