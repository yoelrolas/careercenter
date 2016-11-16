<?php $this->load->view('frontend/header') ?>
<div class="news-original">
    <div class="container">
        <div class="agileinfo_news_original_grids">
            <div class="col-sm-8 agileinfo_news_original_grids_left">
                <div class="box box-solid">
                    <div class="box-body">
                        <?php
                        if(!empty($datapost)) {
                            $searchstr = "";
                            if(!empty($datapost["Keyword"])) $searchstr .= " keyword <b>".$datapost["Keyword"]."</b>";
                            if(!empty($datapost[COL_POSTCATEGORYID])) {
                                $rcat = $this->db->where(COL_POSTCATEGORYID, $datapost[COL_POSTCATEGORYID])->get(TBL_POSTCATEGORIES)->row_array();
                                if($rcat) {
                                    $searchstr .= $searchstr == "" ? " dan " : "";
                                    $searchstr .= " kategori <b>".$rcat[COL_POSTCATEGORYNAME]."</b>";
                                }
                            }
                            $searchstr .= "Menampilkan hasil pencarian untuk".$searchstr;
                            ?>
                            <?php
                        }
                        ?>

                        <div class="posts">
                            <?php
                            if(!empty($data) && count($data) > 0) {
                                foreach($data as $n) {
                                    ?>
                                    <!--<div class="col-md-6 w3_agileits_news_blog1" style="padding: 10px">
                                        <img style="max-height: 200px; min-height: 200px;" src="<?=!empty($n[COL_FILENAME])?MY_UPLOADURL.$n[COL_FILENAME]:MY_NOIMAGEURL?>" alt="<?=$n[COL_POSTTITLE]?>" class="img-responsive">
                                        <a href="<?=site_url('post/view/'.$n[COL_POSTSLUG])?>">
                                            <?=$n[COL_POSTTITLE]?>
                                        </a>
                                        <p>
                                            <i class="fa fa-user"></i> &nbsp; <?=$n[COL_NAME]?> &nbsp;&nbsp;
                                            <i class="fa fa-calendar"></i> &nbsp; <?=date('d M Y', strtotime($n[COL_POSTDATE]))?> &nbsp;&nbsp;
                                            <i class="fa fa-eye"></i> &nbsp; <?=$n[COL_TOTALVIEW]?> &nbsp;&nbsp;
                                        </p>
                                    </div>-->
                                    <div class="post-outer">
                                        <div class="post hentry">
                                    <span class="post-labels">
                                        <a href="<?=site_url('post/all/'.$n[COL_POSTCATEGORYID])?>" rel="tag" target="_blank"><?=$n[COL_POSTCATEGORYNAME]?></a>
                                    </span>
                                            <div class="block-image">
                                                <div class="thumb">
                                                    <a href="<?=!empty($n[COL_FILENAME])?MY_UPLOADURL.$n[COL_FILENAME]:MY_NOIMAGEURL?>?>" style="background:url(<?=!empty($n[COL_FILENAME])?MY_UPLOADURL.$n[COL_FILENAME]:MY_NOIMAGEURL?>) no-repeat center center;background-size:cover" target="_blank"></a>
                                                </div>
                                            </div>
                                            <article>
                                                <font class="retitle">
                                                    <h2 class="post-title entry-title">
                                                        <a href="<?=site_url('post/view/'.$n[COL_POSTSLUG])?>">
                                                            <?=$n[COL_POSTTITLE]?>
                                                        </a>
                                                    </h2>
                                                </font>
                                                <div class="date-header">
                                                    <div>
                                                <span class="post-timestamp">
                                                    <meta content="<?=current_url()?>" itemprop="url mainEntityOfPage">
                                                    <p>
                                                        <i class="fa fa-user"></i> &nbsp; <?=$n[COL_NAME]?> &nbsp;&nbsp;
                                                        <i class="fa fa-calendar"></i> &nbsp; <?=date('d M Y', strtotime($n[COL_POSTDATE]))?> &nbsp;&nbsp;
                                                        <i class="fa fa-eye"></i> &nbsp; <?=$n[COL_TOTALVIEW]?> &nbsp;&nbsp;
                                                    </p>
                                                </span>
                                                        <!--<span class="post-cmm">
                                                            <a href="http://harmonia-soratemplates.blogspot.co.id/2015/12/celebrated-am-announcing-delightful_5.html#comment-form" onclick="" target="_top">4</a>
                                                        </span>-->
                                                    </div>
                                                    <div class="resumo">
                                                    <span>
                                                        <?php
                                                        $strippedcontent = strip_tags($n[COL_POSTCONTENT]);
                                                        ?>
                                                        <?=strlen($strippedcontent) > 200 ? substr($strippedcontent, 0, 200) . "..." : $strippedcontent ?>
                                                    </span>
                                                    </div>
                                                    <div style="clear: both;"></div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="col-md-12 w3_agileits_news_blog1" style="padding: 10px">
                                    <blockquote>
                                        <p style="font-weight: bold; font-size: 2.5em">
                                            Maaf, tidak ada data tersedia untuk saat ini.
                                        </p>
                                    </blockquote>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view('frontend/sidebar') ?>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<?php $this->load->view('frontend/footer') ?>
