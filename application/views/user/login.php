<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login | <?= SITENAME ?></title>

    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?=base_url()?>assets/tbs/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">-->
    <link href="<?=base_url()?>assets/tbs/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?=base_url()?>assets/tbs/css/ionicons.min.css" rel="stylesheet" type="text/css" />
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

<div class="login-box">
    <div class="register-logo">
        <a href="<?=site_url()?>"><b>DEL</b> Career Center</a>
    </div>
    <div class="login-box-body" style="background: rgba(255, 255, 255, 0.90); ">
        <?php  if($this->input->get('msg') == 'notmatch'){ ?>
            <div class="form-group alert alert-danger">
                <i class="fa fa-ban"></i>
                Username atau password tidak tepat
            </div>
        <?php } ?>

        <?php  if($this->input->get('msg') == 'suspend'){ ?>
            <div class="form-group alert alert-danger">
                <i class="fa fa-ban"></i>
                Akun anda disuspend
            </div>
        <?php } ?>

        <?php  if($this->input->get('msg') == 'captcha'){ ?>
            <div class="form-group alert alert-danger">
                <i class="fa fa-ban"></i>
                Captcha tidak sesuai
            </div>
        <?php } ?>

        <?= form_open(current_url(),array('id'=>'validate')) ?>
        <p style="padding: 10px 0px; text-align: right"><a href="<?= site_url('user/forgotpassword') ?>">Lupa Password?</a></p>
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
            <img alt="captcha" style="width: 100%; height: auto" class="captchaimg" src="<?=site_url('captcha/show')?>" />
            <input class="form-control" style="margin-top: 10px;" type="text" name="Captcha" placeholder="Type The Code Shown Above" required />
        </div>

        <div class="footer" style="text-align: right;">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign me in</button>
            <p style="padding: 10px 0px">Register as <a href="<?= site_url('company/register') ?>" class="text-center">company</a> or <a href="<?= site_url('user/register') ?>" class="text-center">jobseeker</a></p>
        </div>

        <?= form_close(); ?>
    </div>
</div>
</body>
</html>
