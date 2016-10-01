<!DOCTYPE html>
<html class="bg-black">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
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
    <div class="header">Register</div>
    <form action="<?=current_url()?>" method="post">
        <div class="body bg-gray">

            <?php  if(validation_errors()){ ?>
                <div class="form-group alert alert-danger">
                    <i class="fa fa-ban"></i>
                    <?=validation_errors()?>
                </div>
            <?php } ?>

            <?php  if($this->input->get('success')){ ?>
                <div class="form-group alert alert-success">
                    <i class="fa fa-ban"></i>
                    Registrasi berhasil. Silahkan menunggu aktifasi akun yang akan dikirim melalui email anda.
                </div>
            <?php } ?>

            <?php if($this->input->get('error')) {
                ?>
                <div class="form-group alert alert-danger">
                    <i class="fa fa-ban"></i>
                    Registrasi gagal. Silahkan coba kembali.
                </div>
            <?php } ?>

            <h4>Credentials</h4>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                    <input type="text" class="form-control" name="<?=COL_USERNAME?>" value="<?=!empty($data[COL_USERNAME]) ? $data[COL_USERNAME] : ''?>" placeholder="Username">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-key"></i></div>
                    <input type="password" class="form-control" name="<?=COL_PASSWORD?>" value="<?=!empty($data[COL_PASSWORD]) ? $data[COL_PASSWORD] : ''?>" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-key"></i></div>
                    <input type="password" class="form-control" name="RepeatPassword" value="<?=!empty($data['RepeatPassword']) ? $data['RepeatPassword'] : ''?>" placeholder="Repeat Password">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">@</div>
                    <input type="text" class="form-control" name="<?=COL_EMAIL?>" value="<?=!empty($data[COL_EMAIL]) ? $data[COL_EMAIL] : ''?>" placeholder="Email">
                </div>
            </div>

            <h4>Company Info</h4>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-building-o"></i></div>
                    <input type="text" class="form-control" name="<?=COL_COMPANYNAME?>" value="<?=!empty($data[COL_COMPANYNAME]) ? $data[COL_COMPANYNAME] : ''?>" placeholder="Company Name">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                    <input type="text" class="form-control" name="<?=COL_COMPANYTELP?>" value="<?=!empty($data[COL_COMPANYTELP]) ? $data[COL_COMPANYTELP] : ''?>" placeholder="Company Telephone No.">
                </div>
            </div>
            <div class="form-group">
                <select name="<?=COL_INDUSTRYTYPEID?>" class="form-control">
                    <?=GetCombobox("SELECT * FROM industrytypes", COL_INDUSTRYTYPEID, COL_INDUSTRYTYPENAME, (!empty($data[COL_INDUSTRYTYPEID]) ? $data[COL_INDUSTRYTYPEID] : null))?>
                </select>
            </div>
            <div class="form-group">
                <textarea class="form-control" rows="3" placeholder="Company Address" name="<?=COL_COMPANYADDRESS?>"><?=!empty($data[COL_COMPANYADDRESS]) ? $data[COL_COMPANYADDRESS] : ''?></textarea>
            </div>

        </div>
        <div class="footer">
            <button type="submit" class="btn bg-olive btn-block">Submit</button>

            <p>Already have account? Please <a href="<?=site_url('user/login')?>">login</a>. </p>
        </div>
    </form>
</div>

<!-- jQuery 2.0.2 -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?=base_url()?>assets/tbs/js/bootstrap.min.js" type="text/javascript"></script>

</body>
</html>