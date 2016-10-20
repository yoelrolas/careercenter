</div>
<!-- /.content-wrapper -->
<!-- follow-us -->
<div class="follow-us">
    <div class="container">
        <div class="agileinfo_follow_us_grid">
            <div class="agileits_follow_us_left">
                <h4>Contact Us :</h4>
            </div>
            <div class="agileits_follow_us_right">
                <p><strong>Institut Teknologi Del</strong></p>
                <p>Jl. Sisingamangaraja, Sitoluama</p>
                <p>Laguboti, Toba Samosir</p>
                <p>Sumatera Utara, Indonesia</p>
                <p>Kode Pos: 22381</p>
                <p>Telp: +62 632 331234</p>
                <p>Fax: +62 632 331116</p>
                <br>
                <p>Website: http://www.del.ac.id</p>
                <p>Email: info@del.ac.id</p>
            </div>

            <div class="clearfix visible-xs-block" style="margin-top: 20px"></div>

            <div class="agileits_follow_us_right">
                <h4>Follow Us On :</h4>
            </div>
            <div class="agileits_follow_us_right">
                <ul class="w3_agileits_social_icons">
                    <li><a href="#" class="wthree_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="#" class="wthree_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="#" class="wthree_instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
            </div>

            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!-- //follow-us -->

<!-- footer -->
<div class="footer">
    <div class="container">
        <!--<ul class="agileits_w3layouts_footer_info">
            <li><a href="index.html">Home</a><i>|</i></li>
            <li><a href="news.html">Markets</a><i>|</i></li>
            <li><a href="funds.html">mutual funds</a><i>|</i></li>
            <li><a href="commodities.html">commodities</a><i>|</i></li>
            <li><a href="portfolio.html">portfolio</a><i>|</i></li>
            <li><a href="about.html">About Us</a><i>|</i></li>
            <li><a href="ipo.html">IPO</a><i>|</i></li>
            <li><a href="sitemap.html">sitemap</a></li>
        </ul>-->
        <p>&copy; 2016 <a href="http://del.ac.id">Del Institute Of Technology</a>. All rights reserved</p>
    </div>
</div>
<!-- //footer -->

<script class="include" type="text/javascript" src="<?=FRONTENDURL?>/js/jquery.jqplot.js"></script>
<script class="include" type="text/javascript" src="<?=FRONTENDURL?>/js/jqplot.dateAxisRenderer.js"></script>
<script class="include" type="text/javascript" src="<?=FRONTENDURL?>/js/jqplot.logAxisRenderer.js"></script>
<script class="include" type="text/javascript" src="<?=FRONTENDURL?>/js/jqplot.canvasTextRenderer.js"></script>
<script class="include" type="text/javascript" src="<?=FRONTENDURL?>/js/jqplot.canvasAxisTickRenderer.js"></script>
<script class="include" type="text/javascript" src="<?=FRONTENDURL?>/js/jqplot.highlighter.js"></script>
<!-- //revenue-chart -->

<!-- Select 2 -->
<script src="<?=base_url()?>assets/adminlte/plugins/select2/select2.full.min.js"></script>

<!-- Bootstrap WYSIHTML5 -->
<!--<script src="<?=base_url()?>assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>-->

<!-- CK Editor -->
<script src="<?=base_url()?>assets/js/ckeditor/ckeditor.js"></script>

<!-- date-range-picker -->
<script src="<?=base_url()?>assets/js/moment.js"></script>
<script src="<?=base_url()?>assets/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?=base_url()?>assets/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>


<!-- Bootstrap Core JavaScript -->
<script src="<?=FRONTENDURL?>/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets/adminlte/dist/js/app.min.js"></script>
<script>
    $(document).ready(function(){
        $(".dropdown").hover(
            function() {
                $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
                $(this).toggleClass('open');
            },
            function() {
                $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
                $(this).toggleClass('open');
            }
        );

        //$(".editor").wysihtml5();
        $(".select2").select2();
        $('.input-datepicker').datepicker({
            autoclose: true,
            format: 'dd M yyyy'
        });
        $('li.act').removeClass("act");
        $('a[href="<?=current_url()?>"]').addClass('act').parents('li').addClass('act');
    });
</script>
<!-- //Bootstrap Core JavaScript -->
<!-- here stars scrolling icon -->
<script type="text/javascript">
    $(document).ready(function() {
        /*
         var defaults = {
         containerID: 'toTop', // fading element id
         containerHoverID: 'toTopHover', // fading element hover id
         scrollSpeed: 1200,
         easingType: 'linear'
         };
         */

        $().UItoTop({ easingType: 'easeOutQuart' });

    });
</script>
<!-- //here ends scrolling icon -->
</body>
</html>