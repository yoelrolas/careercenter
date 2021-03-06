<!DOCTYPE html>
<html class="bg-black">
<head>
    <meta charset="UTF-8">
    <title>Sign In</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="<?=base_url()?>assets/tbs/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="<?=base_url()?>assets/tbs/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?=base_url()?>assets/tbs/css/AdminLTE.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="<?=base_url()?>assets/adminlte/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="<?=base_url()?>assets/adminlte/plugins/modernizr/modernizr.js"></script>
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
        $(".se-pre-con").fadeOut("slow");;
    });
</script>
<!-- /.preloader script -->

<body class="bg-black">

<!-- preloader -->
<div class="se-pre-con"></div>
<!-- /.preloader -->

<div class="form-box" id="login-box">
    <div class="header">Sign In</div>
    <form action="<?=current_url()?>" method="post">
        <div class="body bg-gray">

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

            <div class="form-group">
                <input type="text" name="<?=COL_USERNAME?>" class="form-control" value="<?= set_value(COL_USERNAME) ?>" placeholder="Username / Email"/>
            </div>
            <div class="form-group">
                <input type="password" name="<?=COL_PASSWORD?>" class="form-control" placeholder="Password"/>
            </div>
        </div>
        <div class="footer">
            <button type="submit" class="btn bg-olive btn-block">Sign me in</button>

            <a href="<?= site_url('company/register') ?>" class="text-center">Register as Employer</a>
        </div>
    </form>
</div>

<!-- Bootstrap -->
<script src="<?=base_url()?>assets/tbs/js/bootstrap.min.js" type="text/javascript"></script>

</body>
</html>