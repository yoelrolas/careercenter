<!-- follow-us -->
<div class="follow-us">
    <div class="container">
        <div class="agileinfo_follow_us_grid">
            <div class="agileits_follow_us_left">
                <h3>Follow Us On :</h3>
            </div>
            <div class="agileits_follow_us_right">
                <ul class="w3_agileits_social_icons">
                    <li><a href="#" class="wthree_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="#" class="wthree_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="#" class="wthree_google"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                    <li><a href="#" class="wthree_rss"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                    <li><a href="#" class="wthree_linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                    <li><a href="#" class="wthree_dribble"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
                    <li><a href="#" class="wthree_instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    <li><a href="#" class="wthree_utube"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                    <li><a href="#" class="wthree_tumblr"><i class="fa fa-tumblr" aria-hidden="true"></i></a></li>
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

<script class="include" type="text/javascript" src="<?=FRONTENDPATH?>/js/jquery.jqplot.js"></script>
<script class="include" type="text/javascript" src="<?=FRONTENDPATH?>/js/jqplot.dateAxisRenderer.js"></script>
<script class="include" type="text/javascript" src="<?=FRONTENDPATH?>/js/jqplot.logAxisRenderer.js"></script>
<script class="include" type="text/javascript" src="<?=FRONTENDPATH?>/js/jqplot.canvasTextRenderer.js"></script>
<script class="include" type="text/javascript" src="<?=FRONTENDPATH?>/js/jqplot.canvasAxisTickRenderer.js"></script>
<script class="include" type="text/javascript" src="<?=FRONTENDPATH?>/js/jqplot.highlighter.js"></script>
<!-- //revenue-chart -->
<!-- Bootstrap Core JavaScript -->
<script src="<?=FRONTENDPATH?>/js/bootstrap.min.js"></script>
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