<?php $this->load->view('frontend/header') ?>
<?php $data = array();
$i = 0;
foreach ($res as $d) {
    $this->db->where(COL_COMPANYID, $d[COL_COMPANYID]);
    $this->db->where(COL_ISSUSPEND, false);
    $this->db->where(COL_ENDDATE." >= ", date("Y-m-d"));
    $activevacancies = $this->db->get(TBL_VACANCIES)->num_rows();

    $res[$i] = array(
        //'<img src="'.(!empty($d[COL_FILENAME]) ? MY_UPLOADURL.$d[COL_FILENAME] : MY_IMAGEURL.'company-icon.jpg').'" height="40">',
        anchor('company/detail/'.$d[COL_COMPANYID],$d[COL_COMPANYNAME]),
        $d[COL_INDUSTRYTYPENAME],
        $d[COL_COMPANYWEBSITE],
        $d[COL_COMPANYEMAIL],
        $activevacancies,
        //substr($d[COL_COMPANYADDRESS], 0, 25),
        date('d M Y', strtotime($d[COL_REGISTERDATE]))
    );
    $i++;
}
$data = json_encode($res);
?>

<div class="container">
    <section class="content-header">
        <h1>Perusahaan&nbsp;<small>Daftar perusahaan aktif</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url()?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Companies</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="box box-default box-default-ori">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-search"></i>&nbsp;&nbsp; Filter Pencarian</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </div>
                </div>
                <form class="form-horizontal" action="<?=site_url('company/all')?>" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <label class="label-control">Keyword</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                    <input type="text" class="form-control" name="Keyword" value="<?=!empty($keyword)?$keyword:''?>" placeholder="Keyword" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="label-control">Bidang Industri</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-industry"></i></div>
                                    <select name="IndustryTypeID[]" class="form-control select2" multiple>
                                        <?=GetCombobox("SELECT * FROM industrytypes", COL_INDUSTRYTYPEID, COL_INDUSTRYTYPENAME, (!empty($industry)?$industry:null))?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="label-control"></label>
                                <div class="input-group">
                                    <button type="submit" class="btn btn-primary btn-flat pull-right">Cari Perusahaan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="box box-default box-default-ori">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-list-ol"></i>&nbsp;&nbsp; Data Perusahaan</h3>
                </div>
                <div class="box-body">
                    <form id="dataform" method="post" action="#">
                        <table id="datalist" class="table table-bordered table-hover">

                        </table>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var dataTable = $('#datalist').dataTable({
            //"sDom": "Rlfrtip",
            "aaData": <?=$data?>,
            //"bJQueryUI": true,
            //"aaSorting" : [[5,'desc']],
            "scrollY" : 400,
            "scrollX": "300%",
            "iDisplayLength": 100,
            "aLengthMenu": [[100, 1000, 5000, -1], [100, 1000, 5000, "Semua"]],
            "dom":"R<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": ['copyHtml5','excelHtml5','csvHtml5','pdfHtml5'],
            "aoColumns": [
                //{"sTitle": ""},
                {"sTitle": "Nama Perusahaan", "width": "20%"},
                {"sTitle": "Industri", "width": "20%"},
                {"sTitle": "Website", "width": "15%"},
                {"sTitle": "Email", "width": "15%"},
                {"sTitle": "Lowongan Aktif", "width": "15%"},
                {"sTitle": "Terdaftar Sejak", "width": "15%"}
            ]
        });
    });
</script>
<?php $this->load->view('frontend/footer') ?>
