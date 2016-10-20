<?php $data = array();
$i = 0;
foreach ($res as $d) {
    $res[$i] = array(
        '<input type="checkbox" class="cekbox" name="cekbox[]" value="' . $d[COL_USERNAME] . '" />',
        $d[COL_ISSUSPEND] ? '<small class="label pull-left bg-red">Suspend</small>' : '<small class="label pull-left bg-green">Active</small>',
        anchor('user/edit/'.$d[COL_USERNAME],$d[COL_USERNAME]),
        $d[COL_ROLENAME],
        $d[COL_EMAIL],
        ($d[COL_ROLEID]==ROLECOMPANY?$d[COL_COMPANYNAME]:$d[COL_NAME]),
        //substr($d[COL_COMPANYADDRESS], 0, 25),
        (!empty($d[COL_LASTLOGIN])?date('d M Y H:i:s', strtotime($d[COL_LASTLOGIN])):"-")
    );
    $i++;
}
$data = json_encode($res);
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
                Users
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <p>
            <?=anchor('user/delete','<i class="fa fa-trash-o"></i> Hapus',array('class'=>'cekboxaction btn btn-danger','confirm'=>'Apa anda yakin?'))?>
            <?=anchor('user/activate','<i class="fa fa-check"></i> Aktifkan',array('class'=>'cekboxaction btn btn-success','confirm'=>'Apa anda yakin?'))?>
            <?=anchor('user/activate/1','<i class="fa fa-warning"></i> Suspend',array('class'=>'cekboxaction btn btn-warning','confirm'=>'Apa anda yakin?'))?>
            <?=anchor('user/add','<i class="fa fa-plus"></i> Data Baru',array('class'=>'btn btn-primary'))?>
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
                    {"sTitle": "Username", "width": "20%"},
                    {"sTitle": "Role", "width": "15%"},
                    {"sTitle": "Email"},
                    {"sTitle": "Name", "width": "20%"},
                    //{"sTitle": "Address"},
                    {"sTitle": "Last Login", "width": "15%"}
                ]
            });
            $('#cekbox').click(function(){
                if($(this).is(':checked')){
                    $('.cekbox').prop('checked',true);
                }else{
                    $('.cekbox').prop('checked',false);
                }
            });
        });
    </script>

<?php $this->load->view('footer')
?>