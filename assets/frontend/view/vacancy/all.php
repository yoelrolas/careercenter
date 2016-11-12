<?php $this->load->view('frontend/header') ?>
<?php $data = array();
$i = 0;
foreach ($res as $d) {
    $res[$i] = array(
        //'<img src="'.(!empty($d[COL_FILENAME]) ? MY_UPLOADURL.$d[COL_FILENAME] : MY_IMAGEURL.'company-icon.jpg').'" height="40">',
        anchor('vacancy/detail/'.$d[COL_VACANCYID],$d[COL_VACANCYTITLE], array('target'=>'_blank')),
        anchor('company/detail/'.$d[COL_COMPANYID],$d[COL_COMPANYNAME]),
        $d[COL_VACANCYTYPENAME],
        $d[COL_POSITIONNAME],
        $d["Educations"],
        $d[COL_ISALLLOCATION]?"Seluruh Indonesia":$d["Locations"],
        //substr($d[COL_COMPANYADDRESS], 0, 25),
        date('d M Y', strtotime($d[COL_ENDDATE]))
    );
    $i++;
}
$data = json_encode($res);
?>

<div class="container">
    <section class="content-header">
        <h1>Lowongan&nbsp;<small>Daftar lowongan aktif</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url()?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Vacancies</a></li>
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
                <form class="form-horizontal" action="<?=site_url('vacancy/all')?>" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-sm-3">
                                <label class="label-control">Keyword</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                    <input type="text" class="form-control" name="Keyword" value="<?=!empty($keyword)?$keyword:''?>" placeholder="Keyword" />
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label class="label-control">Fungsi Pekerjaan</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-briefcase"></i></div>
                                    <select name="PositionID[]" class="form-control select2" multiple>
                                        <?=GetCombobox("SELECT * FROM positions ORDER  BY PositionName", COL_POSITIONID, COL_POSITIONNAME, (!empty($pos)?$pos:null))?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label class="label-control">Bidang Industri</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-industry"></i></div>
                                    <select name="IndustryTypeID[]" class="form-control select2" multiple>
                                        <?=GetCombobox("SELECT * FROM industrytypes", COL_INDUSTRYTYPEID, COL_INDUSTRYTYPENAME, (!empty($industry)?$industry:null))?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label class="label-control">Penempatan</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                    <select name="LocationID[]" class="form-control select2" multiple>
                                        <?=GetCombobox("SELECT * FROM locations ORDER BY LocationName", COL_LOCATIONID, COL_LOCATIONNAME, (!empty($loc)?$loc:null))?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary btn-flat pull-right">Cari Lowongan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="box box-default box-default-ori">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-list-ol"></i>&nbsp;&nbsp; Data Lowongan</h3>
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
                {"sTitle": "Nama Lowongan", "width": "20%"},
                {"sTitle": "Perusahaan", "width": "20%"},
                {"sTitle": "Tipe Lowongan", "width": "12%"},
                {"sTitle": "Posisi", "width": "15%"},
                {"sTitle": "Pendidikan Min.", "width": "15%"},
                {"sTitle": "Penempatan", "width": "25%"},
                {"sTitle": "Deadline", "width": "20%"}
            ]
        });
    });
</script>
<?php $this->load->view('frontend/footer') ?>
