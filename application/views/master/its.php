<?php $data = array();
$i = 0;
foreach ($res as $d) {
    $res[$i] = array(
        '<input type="checkbox" class="cekbox" name="cekbox[]" value="' . $d[COL_INDUSTRYTYPEID] . '" />',
        anchor('master/itedit/'.$d[COL_INDUSTRYTYPEID],$d[COL_INDUSTRYTYPENAME])
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
                Industry Types
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <p>
            <?=anchor('master/itdelete','<i class="fa fa-trash-o"></i> Hapus',array('class'=>'cekboxaction btn btn-danger','confirm'=>'Apa anda yakin?'))
            ?>
            <?=anchor('master/itadd','<i class="fa fa-plus"></i> Data Baru',array('class'=>'btn btn-primary'))
            ?>
        </p>
        <div class="box-body">
            <form id="dataform" method="post" action="#">
                <table id="datalist" class="table table-bordered table-striped">

                </table>
            </form>
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
                    {"sTitle": "Name"}
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