

<!-- jQuery 2.2.3 -->
<!-- Already in header -->
<!-- Bootstrap 3.3.6 -->
<script src="<?=base_url()?>assets/adminlte/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url()?>assets/adminlte/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets/adminlte/dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="<?=base_url()?>assets/adminlte/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?=base_url()?>assets/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?=base_url()?>assets/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?=base_url()?>assets/adminlte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?=base_url()?>assets/adminlte/plugins/chartjs/Chart.min.js"></script>
<!-- Select 2 -->
<script src="<?=base_url()?>assets/adminlte/plugins/select2/select2.full.min.js"></script>

<!-- Block UI -->
<script type="text/javascript" src="<?=base_url() ?>assets/js/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/template/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/template/js/function.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/template/js/jquery.form.js"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="<?=base_url()?>assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<!-- CK Editor -->
<script src="<?=base_url()?>assets/js/ckeditor/ckeditor.js"></script>

<!-- date-range-picker -->
<script src="<?=base_url()?>assets/js/moment.js"></script>
<script src="<?=base_url()?>assets/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?=base_url()?>assets/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>

<!--<script type="text/javascript" src="--><?//=base_url()?><!--assets/tbs/js/plugins/datatables/jquery.dataTables.js"></script>-->
<!--<script type="text/javascript" src="--><?//=base_url()?><!--assets/tbs/js/plugins/datatables/dataTables.bootstrap.js"></script>-->
<!--<script type="text/javascript" src="--><?//=base_url()?><!--assets/tbs/js/plugins/datatables/ColReorderWithResize.js"></script>-->
<!--<script type="text/javascript" src="--><?//=base_url()?><!--assets/js/bootstrap-multiselect.js"></script>-->

<script>
    Date.prototype.setISO8601 = function (string) {
        var regexp = "([0-9]{4})(-([0-9]{2})(-([0-9]{2})" +
            "(T([0-9]{2}):([0-9]{2})(:([0-9]{2})(\.([0-9]+))?)?" +
            "(Z|(([-+])([0-9]{2}):([0-9]{2})))?)?)?)?";
        var d = string.match(new RegExp(regexp));

        var offset = 0;
        var date = new Date(d[1], 0, 1);

        if (d[3]) { date.setMonth(d[3] - 1); }
        if (d[5]) { date.setDate(d[5]); }
        if (d[7]) { date.setHours(d[7]); }
        if (d[8]) { date.setMinutes(d[8]); }
        if (d[10]) { date.setSeconds(d[10]); }
        if (d[12]) { date.setMilliseconds(Number("0." + d[12]) * 1000); }
        if (d[14]) {
            offset = (Number(d[16]) * 60) + Number(d[17]);
            offset *= ((d[15] == '-') ? 1 : -1);
        }

        offset -= date.getTimezoneOffset();
        time = (Number(date) + (offset * 60 * 1000));
        this.setTime(Number(time));
    }

    function DuaDigit(x){
        x = x.toString();
        var len = x.length;
        if(len < 2){
            return "0"+x;
        }else{
            return x;
        }
    }

    var mymodal;
    function UseModal(){
        var modalcontent = '<div class="modal fade" id="generalModal" tabindex="-1" role="dialog" aria-hidden="true">'+
            '<div class="modal-dialog modal-lg">'+
            '<div class="modal-content">'+
            '<div class="modal-header">'+
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
            '<h4 class="modal-title" id="myModalLabel">Modal title</h4>'+
            '</div>'+
            '<div class="modal-body">'+
            '</div>'+
            '<div class="modal-footer">'+
            '<button type="button" class="btn btn-default modalCancel" data-dismiss="modal">Cancel</button>'+
            '<button type="button" class="btn btn-primary modalOK">OK</button>'+
            '</div>'+
            '</div>'+
            '</div>';
        if(!$('#generalModal').length){
            $(modalcontent).appendTo('body');
            mymodal = $('#generalModal');
        }
    }

    function LoadModal(url,data,cb){
        mymodal.find('.modal-body').empty().load(url,data,cb);
    }

    function ModalTitle(title){
        mymodal.find('#myModalLabel').empty().text(title);
    }

    function CloseModal(){
        mymodal.modal('hide');
    }

    function timeConverter(UNIX_timestamp){
        var a = new Date(UNIX_timestamp*1000);
        var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        var year = a.getFullYear();
        var month = months[a.getMonth()];
        var date = a.getDate();
        var hour = a.getHours();
        var min = a.getMinutes();
        var sec = a.getSeconds();
        var time = DuaDigit(date)+' '+month+' '+year+' '+DuaDigit(hour)+':'+DuaDigit(min)+':'+DuaDigit(sec);
        return time;
    }

    $(document).ready(function(){
        $('.ui').button();
        $('a[href="<?=current_url()?>"]').addClass('active');
        $('.dropdown-menu textarea,.dropdown-menu input, .dropdown-menu label').click(function(e) {
            e.stopPropagation();
        });
        $(document).on('keypress','.angka',function(e){
            if((e.which <= 57 && e.which >= 48) || (e.keyCode >= 37 && e.keyCode <= 40) || e.keyCode==9 || e.which==43 || e.which==44 || e.which==45 || e.which==46 || e.keyCode==8){
                return true;
            }else{
                return false;
            }
        });

        $(document).on('blur','.uang',function(){
            $(this).val(desimal($(this).val(),2));
        }).on('focus','.uang',function(){
            $(this).val(toNum($(this).val()));
        });

        if($('.cekboxaction').length){
            $('.cekboxaction').click(function(){
                var a = $(this);
                if($('.cekbox:checked').length < 1){
                    alert('Tidak ada data dipilih');
                    return false;
                }
                var yakin = confirm("Apa anda yakin?");
                if(yakin){
                    $('#dataform').ajaxSubmit({
                        dataType: 'json',
                        url : a.attr('href'),
                        success : function(data){
                            if(data.error==0){
                                //alert(data.success);
                                window.location.reload();
                            }else{
                                alert(data.error);
                            }
                        }
                    });
                }
                return false;
            });
        }
        $('a[href="<?=current_url()?>"]').addClass('active').parents('li').addClass('active');
        $('li.treeview.active').find('ul').eq(0).show();
        $('li.treeview.active').find('.fa-angle-left').removeClass('fa-angle-left').addClass('fa-angle-down');

        $(".editor").wysihtml5();
        $("select").select2();
        $('.datepicker').datepicker({
            autoclose: true,
            format: 'dd M yyyy',
        });
    });
</script>