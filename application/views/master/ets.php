<?php $data = array();
$i = 0;
foreach ($res as $d) {
    $res[$i] = array(
        '<input type="checkbox" class="cekbox" name="cekbox[]" value="' . $d[COL_EDUCATIONTYPEID] . '" />',
        anchor('master/etedit/'.$d[COL_EDUCATIONTYPEID],$d[COL_EDUCATIONTYPENAME])
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
                <a href="#"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">
                Education Types
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <p>
            <?=anchor('master/etdelete','<i class="fa fa-trash-o"></i> Hapus',array('class'=>'cekboxaction btn btn-danger','confirm'=>'Apa anda yakin?'))
            ?>
            <?=anchor('master/etadd','<i class="fa fa-plus"></i> Data Baru',array('class'=>'btn btn-primary'))
            ?>
        </p>
        <div class="box-body table-responsive">
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
                "sDom": "Rlfrtip",
                "aaData": <?=$data?>,
                //"bJQueryUI": true,
                "aaSorting" : [[2,'asc']],
                "iDisplayLength": 100,
                "aLengthMenu": [[100, 1000, 5000, -1], [100, 1000, 5000, "Semua"]],
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