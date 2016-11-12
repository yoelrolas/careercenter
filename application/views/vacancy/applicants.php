<?php
$user = GetLoggedUser();
$data = array();
$i = 0;
foreach ($res as $d) {
    $encrypt = GetEncryption($d[COL_USERNAME]);
    $status = "";
    if($d[COL_STATUSID] == STATUS_DIPROSES) $status = '<smal class="label label-primary pull-left">'.$d[COL_STATUSNAME].'</smal>';
    if($d[COL_STATUSID] == STATUS_DITERIMA) $status = '<smal class="label label-success pull-left">'.$d[COL_STATUSNAME].'</smal>';
    if($d[COL_STATUSID] == STATUS_DITOLAK) $status = '<smal class="label label-warning pull-left">'.$d[COL_STATUSNAME].'</smal>';

    $res[$i] = array(
        '<input type="checkbox" class="cekbox" name="cekbox" value="' . $d[COL_VACANCYAPPLYID] . '" />',
        $status,
        '<a href="'.site_url('vacancy/detail/'.$d[COL_VACANCYID]).'" target="_blank">'.$d[COL_VACANCYTITLE].'</a>',
        '<a href="'.site_url('user/detail/'.$encrypt).'" target="_blank">'.$d[COL_NAME].'</a>',
        $d[COL_EMAIL],
        date("d M Y H:i:s", strtotime($d[COL_APPLYDATE])),
        !empty($d[COL_EDUCATIONTYPENAME])?$d[COL_EDUCATIONTYPENAME]:"-",
        $d[COL_GENDER] == 1 ? "Pria" : "Wanita"
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
                Applicants
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <p>
            <?php if($user[COL_ROLEID] == ROLECOMPANY) { ?>
                <a data-href="<?=site_url('applicant/response')?>" data-accept="1" class="btn btn-success btn-response"> <i class="fa fa-check"></i> Accept</a>
                <a data-href="<?=site_url('applicant/response')?>" data-accept="0" class="btn btn-warning btn-response"> <i class="fa fa-close"></i> Reject</a>
            <?php } ?>
        </p>
        <div class="box box-default">
            <div class="box-body">
                <?php if($user[COL_ROLEID] == ROLECOMPANY) {
                    ?>
                    <form id="filter" method="post" action="<?=current_url()?>" style="margin: 10px 0px;;">
                        <div class="form-group">
                            <label class="control-label col-sm-2" style="padding-left: 0px;">Filter</label>
                            <div class="col-sm-4 input-group">
                                <select name="<?=COL_VACANCYID?>" class="form-control">
                                    <option value="">Filter Vacancy</option>
                                    <?=GetCombobox("SELECT * FROM vacancies ORDER BY VacancyTitle", COL_VACANCYID, COL_VACANCYTITLE, (!empty($filter) ? $filter : null))?>
                                </select>
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">Show</button>
                            </span>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                <?php
                }
                ?>

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
            var table = $('#datalist');
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
                    {"sTitle": "Status", "width": "10%"},
                    {"sTitle": "Vacancy", "width": "25%"},
                    {"sTitle": "Name", "width": "25%"},
                    {"sTitle": "Email", "width": "20%"},
                    {"sTitle": "Date", "width": "15%"},
                    {"sTitle": "Education", "width": "10%"},
                    {"sTitle": "Gender", "width": "10%"}
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
            $(".btn-response").click(function() {
                var checked = $("[name=cekbox]:checked", table).map(function(i,n) { return $(n).val(); }).get();
                var url = $(this).data("href");
                var accept = $(this).data("accept");
                if(checked && checked.length > 0) {
                    var promptDialog = $("#promptDialog");
                    var alertDialog = $("#alertDialog");
                    promptDialog.on("hidden.bs.modal", function(){
                        $(".modal-body", promptDialog).html("");
                        $(".btn-ok", promptDialog).html("OK").attr("disabled", false);
                    });
                    alertDialog.on("hidden.bs.modal", function(){
                        $(".modal-body", alertDialog).html("");
                    });

                    $(".modal-body", promptDialog).html('<textarea name="MessageContent" rows="3" cols="5" class="form-control"></textarea>');
                    promptDialog.modal("show");

                    $(".btn-ok", promptDialog).unbind("click").click(function(){
                        $(this).html("Loading...").attr("disabled", true);
                        // Ajax here...
                        var message = $("[name=MessageContent]", promptDialog).val();
                        var datapost = {cekbox: checked, message: message, accept: accept};
                        $.post(url, datapost, function(res) {
                            promptDialog.modal("hide");
                            if(res.error!=0){
                                $(".modal-body", alertDialog).html(res.error);
                                alertDialog.modal("show");
                                return false;
                            }else{
                                window.location.reload();
                            }
                        },"json");
                    });
                }
            });
        });
    </script>

<?php $this->load->view('footer')
?>