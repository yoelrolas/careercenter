<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register | <?= SITENAME ?></title>

    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?=base_url()?>assets/tbs/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">-->
    <link href="<?=base_url()?>assets/tbs/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?=base_url()?>assets/tbs/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Select 2 -->
    <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/select2/select2.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/datepicker/datepicker3.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/styles.css">

    <script src="<?=base_url()?>assets/adminlte/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="<?=base_url()?>assets/adminlte/plugins/modernizr/modernizr.js"></script>
    <!--<script type="text/javascript" src="<?= base_url() ?>assets/js/helper.js"></script>-->
    <!-- Custom styles for this template -->

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .adsbox{
            background: none repeat scroll 0 0 #f5f5f5;
            border-radius: 10px;
            box-shadow: 0 0 5px 1px rgba(50, 50, 50, 0.2);
            margin: 20px auto 0;
            padding: 15px;
            border: 1px solid #caced3;
            height: 145px;
        }
    </style>
</head>
<!-- Preloader Style -->
<style>
    .no-js #loader { display: none;  }
    .js #loader { display: block; position: absolute; left: 100px; top: 0; }
    .se-pre-con {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url(<?=base_url()?>assets/preloader/images/loader-128x/Preloader_3.gif) center no-repeat #fff;
    }
</style>
<!-- /.preloader style -->

<!-- Preloader Script -->
<script>
    // Wait for window load
    $(window).load(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");
    });
</script>
<!-- /.preloader script -->
<body class="hold-transition login-page" style="background: url('<?=MY_IMAGEURL.'companies.jpg'?>'); background-size: cover">

<!-- preloader -->
<div class="se-pre-con"></div>
<!-- /.preloader -->

<div class="register-box">
    <div class="register-logo">
        <a href="<?=site_url()?>"><b>DEL</b> Career Center</a>
    </div>
    <div class="register-box-body" style="background: rgba(255, 255, 255, 0.90); ">
        <?php if(validation_errors()){ ?>
            <div class="alert alert-danger">
                <?= validation_errors() ?>
            </div>
        <?php } ?>

        <?php  if($this->input->get('error')){ ?>
            <div class="form-group alert alert-danger">
                <i class="fa fa-ban"></i>
                Maaf, registrasi anda tidak berhasil. Silahkan coba lagi atau hubungi administrator
            </div>
        <?php } ?>

        <?= form_open_multipart(current_url(),array('id'=>'validate')) ?>

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
            <h4>Credentials</h4>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                    <input type="text" class="form-control" name="<?=COL_USERNAME?>" value="<?=!empty($data[COL_USERNAME]) ? $data[COL_USERNAME] : ''?>" placeholder="Username" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">@</div>
                    <input type="text" class="form-control" name="<?=COL_EMAIL?>" value="<?=!empty($data[COL_EMAIL]) ? $data[COL_EMAIL] : ''?>" placeholder="Email" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-key"></i></div>
                    <input type="password" class="form-control" name="<?=COL_PASSWORD?>" value="<?=!empty($data[COL_PASSWORD]) ? $data[COL_PASSWORD] : ''?>" placeholder="Password" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-key"></i></div>
                    <input type="password" class="form-control" name="RepeatPassword" value="<?=!empty($data['RepeatPassword']) ? $data['RepeatPassword'] : ''?>" placeholder="Repeat Password" required>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block btn-flat btn-register">Submit</button>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="footer" style="text-align: right;">
            <p>Already have account? Please <a href="<?=site_url('user/login')?>">login</a>. </p>
        </div>

        <?= form_close(); ?>
    </div>
</div>
<!-- Select 2 -->
<script src="<?=base_url()?>assets/adminlte/plugins/select2/select2.full.min.js"></script>
<!-- date-range-picker -->
<script src="<?=base_url()?>assets/js/moment.js"></script>
<script src="<?=base_url()?>assets/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?=base_url()?>assets/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
    $("select").select2();
    $('.datepicker').datepicker({
        autoclose: true,
        format: 'dd M yyyy'
    });
</script>
</body>
</html>
