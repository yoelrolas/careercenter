<?php $data = array();
$i = 0;
foreach ($res as $d) {
    $res[$i] = array(
        '<input type="checkbox" class="cekbox" name="cekbox[]" value="' . $d[COL_VACANCYID] . '" />',
        //$d[COL_ISSUSPEND] ? '<small class="label pull-left bg-red">Suspend</small>' : '<small class="label pull-left bg-green">Active</small>',
        $d[COL_ISSUSPEND] ? '<smal class="label label-danger pull-left">Suspend</smal>' : (strtotime($d[COL_ENDDATE]) > strtotime(date('Y-m-d')) ? '<small class="label label-success pull-left">Active</small>' : '<small class="label label-warning pull-left">Expired</small>'),
        anchor('vacancy/edit/'.$d[COL_VACANCYID],$d[COL_VACANCYTITLE]),
        $d[COL_COMPANYNAME],
        $d[COL_POSITIONNAME],
        $d[COL_VACANCYTYPENAME],
        //substr($d[COL_COMPANYADDRESS], 0, 25),
        date('d M Y', strtotime($d[COL_ENDDATE]))
    );
    $i++;
}
$data = json_encode($res);
$user = GetLoggedUser();
?>

<?php $this->load->view('header')
?>
    <section class="content-header">
        <h1><?= $title ?>  <small>Data</small></h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?=site_url()?>"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">
                Vacancies
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <p>
            <?=anchor('vacancy/delete','<i class="fa fa-trash-o"></i> Hapus',array('class'=>'cekboxaction btn btn-danger','confirm'=>'Apa anda yakin?'))?>
            <?php if($user[COL_ROLEID] == ROLEADMIN) { ?>
            <?=anchor('vacancy/activate','<i class="fa fa-check"></i> Aktifkan',array('class'=>'cekboxaction btn btn-success','confirm'=>'Apa anda yakin?'))?>
            <?=anchor('vacancy/activate/1','<i class="fa fa-warning"></i> Suspend',array('class'=>'cekboxaction btn btn-warning','confirm'=>'Apa anda yakin?'))?>
            <?php } ?>
            <?=anchor('vacancy/add','<i class="fa fa-plus"></i> Data Baru',array('class'=>'btn btn-primary'))?>
        </p>
        <div class="box box-default">
            <div class="box-body">
                <form id="dataform" method="post" action="#">
                    <table id="datalist" class="table table-bordered table-hover">

                    </table>
                </form>
            </div>
        </div>
    </section>

<?php $this->load->view('loadjs')?>
    <script type="text/javascript">
        $(document).ready(function() {
            var dataTable = $('#datalist').dataTable({
                //"sDom": "Rlfrtip",
                "aaData": <?=$data?>,
                //"bJQueryUI": true,
                //"aaSorting" : [[5,'desc']],
                "scrollY" : 400,
                "scrollX": "200%",
                "iDisplayLength": 100,
                "aLengthMenu": [[100, 1000, 5000, -1], [100, 1000, 5000, "Semua"]],
                "dom":"R<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
                "buttons": ['copyHtml5','excelHtml5','csvHtml5','pdfHtml5'],
                "aoColumns": [
                    {"sTitle": "<input type=\"checkbox\" id=\"cekbox\" class=\"\" />","sWidth":15,bSortable:false},
                    {"sTitle": "Status"},
                    {"sTitle": "Name", "width": "20%"},
                    {"sTitle": "Company", "width": "20%"},
                    {"sTitle": "Position"},
                    {"sTitle": "Type", "width": "15%"},
                    //{"sTitle": "Address"},
                    {"sTitle": "Deadline", "width": "15%"}
                ]
            });
            $('#cekbox').click(function(){
                if($(this).is(':checked')){
                    $('.cekbox').prop('checked',true);
                    console.log('clicked');
                }else{
                    $('.cekbox').prop('checked',false);
                }
            });
        });
    </script>

<?php $this->load->view('footer')
?>