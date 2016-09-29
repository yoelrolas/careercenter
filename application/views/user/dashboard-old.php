<?php $this->load->view('header') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Dashboard </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#"><i class="fa fa-dashboard"></i> Home</a>
        </li>
        <li class="active">
            Dashboard
        </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- Left col -->

        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-6">
            <!-- Box (with bar chart) -->
            <div class="box box-danger" id="loading-example">
                <div class="box-header">
                    <i class="fa fa-tasks"></i>
                    <h3 class="box-title">Panel Danger</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    Body here...
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </section><!-- right col -->
        <section class="col-lg-6">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-mobile"></i>
                    <h3 class="box-title"> Panel Primary </h3>
                </div>
                <div class="box-body no-padding">
                    Body Here...
                </div>
            </div>
            <!-- /.box -->
        </section><!-- /.Left col -->
    </div><!-- /.row (main row) -->
</section><!-- /.content -->

<?php $this->load->view('footer') ?>
