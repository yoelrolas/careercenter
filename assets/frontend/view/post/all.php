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
                            <!--<div class="w3_agileits_news_blog1" style="padding: 10px">
                                <blockquote>
                                    <p style="font-size: 1.5em">
                                        <?=$searchstr?>
                                    </p>
                                </blockquote>
                            </div>-->
                        <?php
                        }
                        ?>

                        <?php
                        if(!empty($data) && count($data) > 0) {
                            foreach($data as $n) {
                                ?>
                                <div class="col-md-6 w3_agileits_news_blog1" style="padding: 10px">
                                    <img style="height: 200px;" src="<?=!empty($n[COL_FILENAME])?MY_UPLOADURL.$n[COL_FILENAME]:MY_NOIMAGEURL?>" alt="<?=$n[COL_POSTTITLE]?>" class="img-responsive">
                                    <a href="<?=site_url('post/view/'.$n[COL_POSTSLUG])?>">
                                        <?=$n[COL_POSTTITLE]?>
                                    </a>
                                    <p>
                                        <i class="fa fa-user"></i> &nbsp; <?=$n[COL_NAME]?> &nbsp;&nbsp;
                                        <i class="fa fa-calendar"></i> &nbsp; <?=date('d M Y', strtotime($n[COL_POSTDATE]))?> &nbsp;&nbsp;
                                        <i class="fa fa-eye"></i> &nbsp; <?=$n[COL_TOTALVIEW]?> &nbsp;&nbsp;
                                    </p>
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
