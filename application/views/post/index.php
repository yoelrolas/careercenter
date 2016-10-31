<?php $data = array();
$i = 0;
foreach ($res as $d) {
    $res[$i] = array(
        '<input type="checkbox" class="cekbox" name="cekbox[]" value="' . $d[COL_POSTID] . '" />',
        $d[COL_ISSUSPEND] ? '<small class="label pull-left bg-red">Suspend</small>' : (strtotime($d[COL_POSTEXPIREDDATE]) >= strtotime(date('Y-m-d')) ? '<small class="label pull-left bg-green">Active</small>' : '<small class="label pull-left bg-orange">Expired</small>'),
        anchor('post/edit/'.$d[COL_POSTID],$d[COL_POSTTITLE]),
        $d[COL_POSTCATEGORYNAME],
        '<a href="'.site_url('post/view/'.$d[COL_POSTSLUG]).'">'.site_url('post/view/'.$d[COL_POSTSLUG]).'</a>',
        date('d M Y', strtotime($d[COL_POSTDATE])),
        $d[COL_TOTALVIEW]
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
                Posts
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <p>
            <?=anchor('post/delete','<i class="fa fa-trash-o"></i> Hapus',array('class'=>'cekboxaction btn btn-danger','confirm'=>'Apa anda yakin?'))?>
            <?php if($user[COL_ROLEID] == ROLEADMIN) { ?>
                <?=anchor('post/activate','<i class="fa fa-check"></i> Aktifkan',array('class'=>'cekboxaction btn btn-success','confirm'=>'Apa anda yakin?'))?>
                <?=anchor('post/activate/1','<i class="fa fa-warning"></i> Suspend',array('class'=>'cekboxaction btn btn-warning','confirm'=>'Apa anda yakin?'))?>
            <?php } ?>
            <?=anchor('post/add','<i class="fa fa-plus"></i> Data Baru',array('class'=>'btn btn-primary'))?>
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
                "scrollX": "120%",
                "iDisplayLength": 100,
                "aLengthMenu": [[100, 1000, 5000, -1], [100, 1000, 5000, "Semua"]],
                "dom":"R<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
                "buttons": ['copyHtml5','excelHtml5','csvHtml5','pdfHtml5'],
                "aoColumns": [
                    {"sTitle": "<input type=\"checkbox\" id=\"cekbox\" class=\"\" />",bSortable:false},
                    {"sTitle": "Status", "width": "10%"},
                    {"sTitle": "Title", "width": "25%"},
                    {"sTitle": "Category"},
                    {"sTitle": "URL", "width": "35%"},
                    {"sTitle": "Date", "width": "15%"},
                    {"sTitle": "Total View", "width": "10%"}
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