<?php $this->load->view('header') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard <small>Your Summary</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=site_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<?php
$ruser = GetLoggedUser();
?>

<!-- Main content -->
<section class="content">
    <!-- Main row -->
    <div class="row">
        <?php
        if($ruser[COL_ROLEID] == ROLEADMIN) {
            // user-related query
            $this->db->join(TBL_USERINFORMATION,TBL_USERINFORMATION.'.'.COL_USERNAME." = ".TBL_USERS.".".COL_USERNAME,"inner");
            $this->db->join(TBL_ROLES,TBL_ROLES.'.'.COL_ROLEID." = ".TBL_USERS.".".COL_ROLEID,"inner");
            $this->db->join(TBL_COMPANIES,TBL_COMPANIES.'.'.COL_COMPANYID." = ".TBL_USERINFORMATION.".".COL_COMPANYID,"left");
            $this->db->join(TBL_INDUSTRYTYPES,TBL_INDUSTRYTYPES.'.'.COL_INDUSTRYTYPEID." = ".TBL_COMPANIES.".".COL_INDUSTRYTYPEID,"left");
            //$this->db->order_by(TBL_USERS.".".COL_USERNAME, 'asc');
            $this->db->order_by(TBL_COMPANIES.".".COL_REGISTERDATE, 'desc');
            $users = $this->db->get(TBL_USERS)->result_array();

            $activeusers = array();
            $activecompanies = array();
            $companies = array();
            $CompanyIndustries = array();
            $CompanyIndustryColors = array();
            //$TempCompanyIndustries = array();
            foreach($users as $u) {
                if(!$u[COL_ISSUSPEND]) $activeusers[] = $u;
                if($u[COL_ROLEID] == ROLECOMPANY) {
                    $companies[] = $u;
                    if(!$u[COL_ISSUSPEND]) $activecompanies[] = $u;
                    if(!array_key_exists($u[COL_INDUSTRYTYPENAME], $CompanyIndustries)) {
                        $color = "#".random_color();
                        while(in_array($color, $CompanyIndustryColors)) {
                            $color = "#".random_color();
                        }
                        $CompanyIndustryColors[] = $color;
                        $CompanyIndustries[$u[COL_INDUSTRYTYPENAME]] = array(
                            "value" => 1,
                            //"color" => "#d2d6de",
                            "color" => $color,
                            //"highlight" => "#d2d6de",
                            "highlight" => $color,
                            "label" => $u[COL_INDUSTRYTYPENAME]
                        );
                    } else {
                        $CompanyIndustries[$u[COL_INDUSTRYTYPENAME]]["value"] += 1;
                    }
                    //$TempCompanyIndustries[] = $CompanyIndustries[$u[COL_INDUSTRYTYPENAME]];
                }
            }
            $ArrCompanyIndustries = json_encode($CompanyIndustries);

            // vacancy-related query
            $vacancies = $this->mvacancy->getall($ruser[COL_COMPANYID], $ruser[COL_ROLEID]);
            //print_r($vacancies);
            //echo $this->db->last_query();
            //return;
            $activevacancies = array();
            $VacancyWithAllLocation = array();
            $VacancyPositions = array();
            $VacancyPositionsByMonth = array();
            $VacancyPositionColors = array();
            $VacancyMonths = array();
            foreach($vacancies as $vac) {
                if(!$vac[COL_ISSUSPEND] && strtotime(date("Y-m-d")) < strtotime($vac[COL_ENDDATE])) $activevacancies[] = $vac;
                if($vac[COL_ISALLLOCATION]) $VacancyWithAllLocation[] = $vac;
                if(!array_key_exists($vac[COL_POSITIONNAME], $VacancyPositions)) {
                    $color = "#".random_color();
                    while(in_array($color, $VacancyPositionColors)) {
                        $color = "#".random_color();
                    }
                    $VacancyPositionColors[] = $color;
                    $VacancyPositions[$vac[COL_POSITIONNAME]] = array(
                        "value" => 1,
                        //"color" => "#d2d6de",
                        "color" => $color,
                        //"highlight" => "#d2d6de",
                        "highlight" => $color,
                        "label" => $vac[COL_POSITIONNAME],
                    );
                } else {
                    $VacancyPositions[$vac[COL_POSITIONNAME]]["value"] += 1;
                }

                $month = date("M Y", strtotime($vac[COL_CREATEDON]));
                if(!in_array($month, $VacancyMonths)) {
                    $VacancyMonths[] = $month;
                }
                if(!array_key_exists($vac[COL_POSITIONNAME], $VacancyPositionsByMonth)) {
                    $VacancyPositionsByMonth[$vac[COL_POSITIONNAME]] = array(
                        $month => 1,
                        "name" => $vac[COL_POSITIONNAME]
                    );
                }
                else {
                    if(!array_key_exists($month, $VacancyPositionsByMonth[$vac[COL_POSITIONNAME]])) {
                        $VacancyPositionsByMonth[$vac[COL_POSITIONNAME]] = array_merge(array($month=>1), $VacancyPositionsByMonth[$vac[COL_POSITIONNAME]]);
                    } else {
                        $VacancyPositionsByMonth[$vac[COL_POSITIONNAME]][$month] += 1;
                    }
                }
            }
            $ArrVacancyPositions = json_encode($VacancyPositions);
            //echo json_encode($VacancyPositionsByMonth);
            //return;

            // re-arrange months ascending
            $VacancyMonthsAsc = array();
            for($i=count($VacancyMonths)-1; $i>=0; $i--) {
                if(!empty($VacancyMonths[$i])) $VacancyMonthsAsc[] = $VacancyMonths[$i];
            }

            $VacancyPositions2 = array();
            $VacancyPositionColors2 = array();
            foreach($VacancyPositionsByMonth as $vpm) {
                // Prepare data
                $data = array();
                //foreach($VacancyMonths as $vm) {
                foreach($VacancyMonthsAsc as $vm) {
                    if(!empty($vpm[$vm])) $data[] =  $vpm[$vm];
                    else $data[] = 0;
                }

                // Prepare color
                $color = "#".random_color();
                while(in_array($color, $VacancyPositionColors2)) {
                    $color = "#".random_color();
                }
                $VacancyPositionColors2[] = $color;

                // Prepare object
                $VacancyPositions2[] = array(
                    "label" => $vpm["name"],
                    "fillColor" => $color,
                    "strokeColor" => $color,
                    "pointColor" => $color,
                    "pointStrokeColor" => $color,
                    "pointHighlightFill" => $color,
                    "pointHighlightStroke" => $color,
                    "data" => $data
                );
            }
            $ArrVacancyPositions2 = json_encode($VacancyPositions2);

            $this->db->join(TBL_EDUCATIONTYPES,TBL_EDUCATIONTYPES.'.'.COL_EDUCATIONTYPEID." = ".TBL_VACANCYEDUCATIONS.".".COL_EDUCATIONTYPEID,"inner");
            $vacancyeducation = $this->db->get(TBL_VACANCYEDUCATIONS)->result_array();
            $Educations = array();
            $EducationColors = array();
            foreach($vacancyeducation as $edu) {
                if(!array_key_exists($edu[COL_EDUCATIONTYPENAME], $Educations)) {
                    $color = "#".random_color();
                    while(in_array($color, $EducationColors)) {
                        $color = "#".random_color();
                    }
                    $EducationColors[] = $color;
                    $Educations[$edu[COL_EDUCATIONTYPENAME]] = array(
                        "value" => 1,
                        //"color" => "#d2d6de",
                        "color" => $color,
                        //"highlight" => "#d2d6de",
                        "highlight" => $color,
                        "label" => $edu[COL_EDUCATIONTYPENAME],
                    );
                } else {
                    $Educations[$edu[COL_EDUCATIONTYPENAME]]["value"] += 1;
                }
            }
            $ArrEducations = json_encode($Educations);

            $this->db->join(TBL_LOCATIONS,TBL_LOCATIONS.'.'.COL_LOCATIONID." = ".TBL_VACANCYLOCATIONS.".".COL_LOCATIONID,"inner");
            $vacancylocations = $this->db->get(TBL_VACANCYLOCATIONS)->result_array();
            $Locations = array();
            $LocationColors = array();
            foreach($vacancylocations as $loc) {
                if(!array_key_exists($loc[COL_LOCATIONNAME], $Locations)) {
                    $color = "#".random_color();
                    while(in_array($color, $LocationColors)) {
                        $color = "#".random_color();
                    }
                    $LocationColors[] = $color;
                    $Locations[$loc[COL_LOCATIONNAME]] = array(
                        "value" => 1,
                        //"color" => "#d2d6de",
                        "color" => $color,
                        //"highlight" => "#d2d6de",
                        "highlight" => $color,
                        "label" => $loc[COL_LOCATIONNAME],
                    );
                } else {
                    $Locations[$loc[COL_LOCATIONNAME]]["value"] += 1;
                }
            }
            if($VacancyWithAllLocation && count($VacancyWithAllLocation) > 0) {
                $color = "#".random_color();
                while(in_array($color, $LocationColors)) {
                    $color = "#".random_color();
                }
                $LocationColors[] = $color;
                $Locations["Semua Lokasi"] = array(
                    "value" => count($VacancyWithAllLocation),
                    //"color" => "#d2d6de",
                    "color" => $color,
                    //"highlight" => "#d2d6de",
                    "highlight" => $color,
                    "label" => "Semua Lokasi",
                );
            }
            $ArrLocations = json_encode($Locations);



            // post-related query
            $posts = $this->mpost->getall();
            $activeposts = array();
            foreach($posts as $p) {
                if(!$p[COL_ISSUSPEND] && strtotime(date("Y-m-d")) < strtotime($p[COL_POSTEXPIREDDATE])) $activeposts[] = $p;
            }
            ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="<?=site_url('user/index')?>" class="info-box-icon bg-aqua"><i class="fa fa-users"></i></a>
                    <div class="info-box-content">
                        <span class="info-box-text">Total User</span>
                        <span class="info-box-number"><?=count($users)?></span>
                        <div class="progress">
                            <div class="progress-bar bg-aqua" style="width: <?=count($users) > 0 ?  (count($activeusers)/count($users))*100 : 0?>%"></div>
                        </div>
                        <span class="progress-description" style="font-size: 12px"><?=count($activeusers)?> of <?=count($users)?> active</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="<?=site_url('company/index')?>" class="info-box-icon bg-green"><i class="fa fa-building"></i></a>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Company</span>
                        <span class="info-box-number"><?=count($companies)?></span>
                        <div class="progress">
                            <div class="progress-bar bg-green" style="width: <?=count($companies) > 0 ? (count($activecompanies)/count($companies))*100 : 0?>%">></div>
                        </div>
                        <span class="progress-description" style="font-size: 12px"><?=count($activecompanies)?> of <?=count($companies)?> active</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="<?=site_url('vacancy/index')?>" class="info-box-icon bg-orange"><i class="fa fa-bookmark-o"></i></a>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Vacancy</span>
                        <span class="info-box-number"><?=count($vacancies)?></span>
                        <div class="progress">
                            <div class="progress-bar bg-orange" style="width: <?=count($vacancies) > 0 ?  (count($activevacancies)/count($vacancies))*100 : 0?>%">></div>
                        </div>
                        <span class="progress-description" style="font-size: 12px"><?=count($activevacancies)?> of <?=count($vacancies)?> active</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="<?=site_url('post/index')?>" class="info-box-icon bg-red"><i class="fa fa-tags"></i></a>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Post</span>
                        <span class="info-box-number"><?=count($posts)?></span>
                        <div class="progress">
                            <div class="progress-bar bg-red" style="width: <?=count($posts) > 0 ?  (count($activeposts)/count($posts))*100 : 0?>%">></div>
                        </div>
                        <span class="progress-description" style="font-size: 12px"><?=count($activeposts)?> of <?=count($posts)?> active</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="clearfix"></div>

            <!-- COMPANIES -->
            <div class="col-sm-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Company Summaries</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <?php if(count($companies) > 0 && $CompanyIndustries && count($CompanyIndustries) > 0) {
                            ?>
                            <div class="col-sm-4">
                                <ul class="products-list product-list-in-box">
                                    <?php
                                    if($companies && count($companies) > 0) {
                                        for($i=0; $i<5; $i++) {
                                            if(empty($companies[$i])) break;
                                            $com = $companies[$i];
                                            ?>
                                            <li class="item" style="border-bottom: 1px solid #dedede;">
                                                <div class="product-img">
                                                    <img src="<?= !empty($com[COL_FILENAME]) ? MY_UPLOADURL . $com[COL_FILENAME] : MY_IMAGEURL . 'company-icon.jpg' ?>" alt="<?=$com[COL_COMPANYNAME]?>">
                                                </div>
                                                <div class="product-info">
                                                    <a href="<?=site_url('company/edit/'.$com[COL_COMPANYID])?>" class="product-title">
                                                        <?=$com[COL_COMPANYNAME]?>
                                                        <?=$com[COL_ISSUSPEND]?'<span class="label label-danger pull-right">Suspend</span>':'<span class="label label-success pull-right">Active</span>'?>
                                                    </a>
                                                <span class="product-description">
                                                  <?=$com[COL_INDUSTRYTYPENAME]?>
                                                </span>
                                                </div>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                                <a href="<?=site_url('company/index')?>" style="margin-top: 10px" class="btn btn-sm btn-default btn-flat pull-right">View All</a>
                            </div>
                            <div class="col-sm-5">
                                <canvas id="IndustryTypeChart" style="height:250px"></canvas>
                            </div>
                            <div class="col-sm-3">
                                <ul class="chart-legend clearfix">
                                    <?php
                                    foreach($CompanyIndustries as $ind) {
                                        ?>
                                        <li>
                                            <i class="fa fa-circle-o" style="color: <?=$ind["color"]?>"></i>
                                            <b><?=desimal(($ind["value"]/count($companies))*100)?>%</b>
                                            <?=$ind["label"]?>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        <?php
                        } else {
                            ?>
                            <div class="col-sm-12">
                                <span class="no-data">No data available</span>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /. COMPANIES -->

            <!-- VACANCIES -->
            <div class="col-sm-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Vacancy Summaries</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <?php if(count($vacancies) > 0 && $VacancyPositions && count($VacancyPositions) > 0) {
                            ?>
                            <div class="col-sm-12" style="border: 1px solid #dedede; padding: 10px">
                                <div class="col-sm-4">
                                    <ul class="products-list product-list-in-box">
                                        <?php
                                        if($vacancies && count($vacancies) > 0) {
                                            for($i=0; $i<5; $i++) {
                                                if(empty($vacancies[$i])) break;
                                                $vac = $vacancies[$i];
                                                ?>
                                                <li class="item" style="border-bottom: 1px solid #dedede;">
                                                    <div class="product-img">
                                                        <img src="<?= !empty($vac[COL_FILENAME]) ? MY_UPLOADURL . $vac[COL_FILENAME] : MY_IMAGEURL . 'company-icon.jpg' ?>" alt="<?=$vac[COL_COMPANYNAME]?>">
                                                    </div>
                                                    <div class="product-info">
                                                        <a href="<?=site_url('vacancy/edit/'.$vac[COL_VACANCYID])?>" class="product-title">
                                                            <?=$vac[COL_VACANCYTITLE]?>
                                                            <?=$vac[COL_ISSUSPEND] ? '<span class="label label-danger pull-right">Suspend</span>' : (strtotime($vac[COL_ENDDATE]) > strtotime(date('Y-m-d')) ? '<span class="label label-success pull-right">Active</span>' : '<span class="label label-warning pull-right">Expired</span>')?>
                                                        </a>
                                                <span class="product-description">
                                                  <?=$vac[COL_POSITIONNAME]?>
                                                </span>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                    <a href="<?=site_url('vacancy/index')?>" style="margin-top: 10px" class="btn btn-sm btn-default btn-flat pull-right">View All</a>
                                </div>
                                <div class="col-sm-8">
                                    <div class="col-sm-6">
                                        <p>Positions</p>
                                        <canvas id="PositionChart" style="height:250px"></canvas>
                                    </div>
                                    <div class="col-sm-6" style="padding: 10px">
                                        <ul class="chart-legend clearfix">
                                            <?php
                                        foreach($VacancyPositions as $pos) {
                                            ?>
                                                <li>
                                                    <i class="fa fa-circle-o" style="color: <?=$pos["color"]?>"></i>
                                                    <!--<b><?=desimal(($pos["value"]/count($vacancies))*100)?>%</b>-->
                                                    <?=$pos["label"]?>
                                                </li>
                                                <?php
                                        }
                                        ?>
                                        </ul>
                                    </div>

                                    <div class="clearfix" style="margin-bottom: 10px"></div>

                                    <div class="col-sm-6">
                                        <p>Educations</p>
                                        <canvas id="EducationChart" style="height:250px"></canvas>
                                    </div>
                                    <div class="col-sm-6">
                                        <ul class="chart-legend clearfix">
                                            <?php
                                            foreach($Educations as $edu) {
                                                ?>
                                                <li>
                                                    <i class="fa fa-circle-o" style="color: <?=$edu["color"]?>"></i>
                                                    <!--<b><?=desimal(($edu["value"]/count($vacancies))*100)?>%</b>-->
                                                    <?=$edu["label"]?>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>

                                    <div class="clearfix" style="margin-bottom: 10px"></div>

                                    <div class="col-sm-6">
                                        <p>Locations</p>
                                        <canvas id="LocationChart" style="height:250px"></canvas>
                                    </div>
                                    <div class="col-sm-6">
                                        <ul class="chart-legend clearfix">
                                            <?php
                                            foreach($Locations as $loc) {
                                                ?>
                                                <li>
                                                    <i class="fa fa-circle-o" style="color: <?=$loc["color"]?>"></i>
                                                    <!--<b><?=desimal(($loc["value"]/count($vacancies))*100)?>%</b>-->
                                                    <?=$loc["label"]?>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix" style="margin-bottom: 20px"></div>

                            <div class="col-sm-12" style="border: 1px solid #dedede; padding: 10px">
                                <p><h4 class="text-center">Monthly Statistic</h4></p>
                                <canvas id="PositionAreaChart" style="height: 250px; width: 467px;" height="250" width="467"></canvas>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="col-sm-12">
                                <span class="no-data">No data available</span>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /. VACANCIES -->
        <?php
        } else if($ruser[COL_ROLEID] == ROLECOMPANY) {
            // vacancy-related query
            $vacancies = $this->mvacancy->getall($ruser[COL_COMPANYID], $ruser[COL_ROLEID]);
            $activevacancies = array();
            $suspendvacancies = array();
            $expiredvacancies = array();

            $VacancyWithAllLocation = array();
            $VacancyPositions = array();
            $VacancyPositionColors = array();

            $Educations = array();
            $EducationColors = array();

            $Locations = array();
            $LocationColors = array();

            $VacancyPositionsByMonth = array();
            $VacancyMonths = array();

            foreach($vacancies as $vac) {
                if($vac[COL_ISSUSPEND]) $suspendvacancies[] = $vac;
                else if(strtotime(date("Y-m-d")) > strtotime($vac[COL_ENDDATE])) $expiredvacancies[] = $vac;
                else $activevacancies[] = $vac;

                //if(!$vac[COL_ISSUSPEND] && strtotime(date("Y-m-d")) < strtotime($vac[COL_ENDDATE])) $activevacancies[] = $vac;
                if($vac[COL_ISALLLOCATION]) $VacancyWithAllLocation[] = $vac;

                if(!array_key_exists($vac[COL_POSITIONNAME], $VacancyPositions)) {
                    $color = "#".random_color();
                    while(in_array($color, $VacancyPositionColors)) {
                        $color = "#".random_color();
                    }
                    $VacancyPositionColors[] = $color;
                    $VacancyPositions[$vac[COL_POSITIONNAME]] = array(
                        "value" => 1,
                        //"color" => "#d2d6de",
                        "color" => $color,
                        //"highlight" => "#d2d6de",
                        "highlight" => $color,
                        "label" => $vac[COL_POSITIONNAME],
                    );
                } else {
                    $VacancyPositions[$vac[COL_POSITIONNAME]]["value"] += 1;
                }

                $month = date("M Y", strtotime($vac[COL_CREATEDON]));
                if(!in_array($month, $VacancyMonths)) {
                    $VacancyMonths[] = $month;
                }
                if(!array_key_exists($vac[COL_POSITIONNAME], $VacancyPositionsByMonth)) {
                    $VacancyPositionsByMonth[$vac[COL_POSITIONNAME]] = array(
                        $month => 1,
                        "name" => $vac[COL_POSITIONNAME]
                    );
                }
                else {
                    $VacancyPositionsByMonth[$vac[COL_POSITIONNAME]][$month] += 1;
                }

                $this->db->join(TBL_EDUCATIONTYPES,TBL_EDUCATIONTYPES.'.'.COL_EDUCATIONTYPEID." = ".TBL_VACANCYEDUCATIONS.".".COL_EDUCATIONTYPEID,"inner");
                $this->db->where(COL_VACANCYID, $vac[COL_VACANCYID]);
                $vacancyeducation = $this->db->get(TBL_VACANCYEDUCATIONS)->result_array();
                foreach($vacancyeducation as $edu) {
                    if(!array_key_exists($edu[COL_EDUCATIONTYPENAME], $Educations)) {
                        $color = "#".random_color();
                        while(in_array($color, $EducationColors)) {
                            $color = "#".random_color();
                        }
                        $EducationColors[] = $color;
                        $Educations[$edu[COL_EDUCATIONTYPENAME]] = array(
                            "value" => 1,
                            //"color" => "#d2d6de",
                            "color" => $color,
                            //"highlight" => "#d2d6de",
                            "highlight" => $color,
                            "label" => $edu[COL_EDUCATIONTYPENAME],
                        );
                    } else {
                        $Educations[$edu[COL_EDUCATIONTYPENAME]]["value"] += 1;
                    }
                }

                $this->db->join(TBL_LOCATIONS,TBL_LOCATIONS.'.'.COL_LOCATIONID." = ".TBL_VACANCYLOCATIONS.".".COL_LOCATIONID,"inner");
                $this->db->where(COL_VACANCYID, $vac[COL_VACANCYID]);
                $vacancylocations = $this->db->get(TBL_VACANCYLOCATIONS)->result_array();
                foreach($vacancylocations as $loc) {
                    if(!array_key_exists($loc[COL_LOCATIONNAME], $Locations)) {
                        $color = "#".random_color();
                        while(in_array($color, $LocationColors)) {
                            $color = "#".random_color();
                        }
                        $LocationColors[] = $color;
                        $Locations[$loc[COL_LOCATIONNAME]] = array(
                            "value" => 1,
                            //"color" => "#d2d6de",
                            "color" => $color,
                            //"highlight" => "#d2d6de",
                            "highlight" => $color,
                            "label" => $loc[COL_LOCATIONNAME],
                        );
                    } else {
                        $Locations[$loc[COL_LOCATIONNAME]]["value"] += 1;
                    }
                }
            }
            $ArrVacancyPositions = json_encode($VacancyPositions);
            $ArrEducations = json_encode($Educations);

            if($VacancyWithAllLocation && count($VacancyWithAllLocation) > 0) {
                $color = "#".random_color();
                while(in_array($color, $LocationColors)) {
                    $color = "#".random_color();
                }
                $LocationColors[] = $color;
                $Locations["Semua Lokasi"] = array(
                    "value" => count($VacancyWithAllLocation),
                    //"color" => "#d2d6de",
                    "color" => $color,
                    //"highlight" => "#d2d6de",
                    "highlight" => $color,
                    "label" => "Semua Lokasi",
                );
            }
            $ArrLocations = json_encode($Locations);

            // re-arrange months ascending
            $VacancyMonthsAsc = array();
            for($i=count($VacancyMonths)-1; $i>=0; $i--) {
                if(!empty($VacancyMonths[$i])) $VacancyMonthsAsc[] = $VacancyMonths[$i];
            }

            $VacancyPositions2 = array();
            $VacancyPositionColors2 = array();
            foreach($VacancyPositionsByMonth as $vpm) {
                // Prepare data
                $data = array();
                //foreach($VacancyMonths as $vm) {
                foreach($VacancyMonthsAsc as $vm) {
                    if(!empty($vpm[$vm])) $data[] =  $vpm[$vm];
                    else $data[] = 0;
                }

                // Prepare color
                $color = "#".random_color();
                while(in_array($color, $VacancyPositionColors2)) {
                    $color = "#".random_color();
                }
                $VacancyPositionColors2[] = $color;

                // Prepare object
                $VacancyPositions2[] = array(
                    "label" => $vpm["name"],
                    "fillColor" => $color,
                    "strokeColor" => $color,
                    "pointColor" => $color,
                    "pointStrokeColor" => $color,
                    "pointHighlightFill" => $color,
                    "pointHighlightStroke" => $color,
                    "data" => $data
                );
            }
            $ArrVacancyPositions2 = json_encode($VacancyPositions2);

            // applications related query
            $this->db->join(TBL_VACANCIES,TBL_VACANCIES.'.'.COL_VACANCYID." = ".TBL_VACANCYAPPLIES.".".COL_VACANCYID,"inner");
            $this->db->join(TBL_COMPANIES,TBL_COMPANIES.'.'.COL_COMPANYID." = ".TBL_VACANCIES.".".COL_COMPANYID,"inner");
            $this->db->join(TBL_USERINFORMATION,TBL_USERINFORMATION.'.'.COL_USERNAME." = ".TBL_VACANCYAPPLIES.".".COL_USERNAME,"inner");
            $this->db->join(TBL_EDUCATIONTYPES,TBL_EDUCATIONTYPES.'.'.COL_EDUCATIONTYPEID." = ".TBL_USERINFORMATION.".".COL_EDUCATIONID,"left");
            $this->db->join(TBL_STATUS,TBL_STATUS.'.'.COL_STATUSID." = ".TBL_VACANCYAPPLIES.".".COL_STATUSID,"inner");
            $this->db->where(TBL_COMPANIES.".".COL_COMPANYID, $ruser[COL_COMPANYID]);
            $this->db->order_by(TBL_VACANCYAPPLIES.".".COL_APPLYDATE, "desc");
            $this->db->limit(10);
            $appl = $this->db->get(TBL_VACANCYAPPLIES)->result_array();
            ?>
            <!-- VACANCIES -->
            <div class="col-sm-8">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Latest Applicants</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <?php if(count($appl) > 0) {
                            ?>
                            <div class="table-responsive">
                                <table class="table no-margin" id="applicants">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" id="appl-cekbox"/></th>
                                        <th>Name</th>
                                        <th>Education</th>
                                        <th>Vacancy</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach($appl as $dat) {
                                        $encrypt = GetEncryption($dat[COL_USERNAME]);
                                        $status = "";
                                        if($dat[COL_STATUSID] == STATUS_DIPROSES) $status = '<smal class="label label-primary pull-left">'.$dat[COL_STATUSNAME].'</smal>';
                                        if($dat[COL_STATUSID] == STATUS_DITERIMA) $status = '<smal class="label label-success pull-left">'.$dat[COL_STATUSNAME].'</smal>';
                                        if($dat[COL_STATUSID] == STATUS_DITOLAK) $status = '<smal class="label label-warning pull-left">'.$dat[COL_STATUSNAME].'</smal>';
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" class="cekbox" name="cekbox" value="<?=$dat[COL_VACANCYAPPLYID]?>" /></td>
                                            <td><a href="<?=site_url('user/detail/'.$encrypt)?>" target="_blank"><?=$dat[COL_NAME]?></a></td>
                                            <td><?=!empty($dat[COL_EDUCATIONTYPENAME])?$dat[COL_EDUCATIONTYPENAME]:"-"?></td>
                                            <td><?=$dat[COL_VACANCYTITLE]?></td>
                                            <td><?=date("d M Y H:i:s", strtotime($dat[COL_APPLYDATE]))?></td>
                                            <td><?=$status?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="col-sm-12">
                                <span class="no-data">No data available</span>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="box-footer clearfix">
                        <a data-href="<?=site_url('applicant/response')?>" data-accept="1" class="btn btn-sm btn-success btn-flat btn-response pull-left" style="margin-right: 5px"> <i class="fa fa-check"></i> Accept</a>
                        <a data-href="<?=site_url('applicant/response')?>" data-accept="0" class="btn btn-sm btn-warning btn-flat btn-response pull-left"> <i class="fa fa-close"></i> Reject</a>
                        <a href="<?=site_url('vacancy/applicants')?>" class="btn btn-sm btn-default btn-flat pull-right">View All</a>
                    </div>
                    <!-- /.box-body -->
                    <script>
                        var table = $("#applicants");
                        $('#appl-cekbox', table).click(function(){
                            if($(this).is(':checked')){
                                $('.cekbox', table).prop('checked',true);
                            }else{
                                $('.cekbox', table).prop('checked',false);
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
                    </script>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Vacancy Status</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="progress-group">
                            <span class="progress-text">Active</span>
                            <span class="progress-number"><b><?=count($activevacancies)?></b>/<?=count($vacancies)?></span>

                            <div class="progress sm">
                                <?php
                                $activeprogress = count($vacancies) > 0 ? (count($activevacancies)/count($vacancies)) : 0;
                                ?>
                                <div class="progress-bar progress-bar-green" style="width: <?=$activeprogress*100?>%"></div>
                            </div>
                        </div>
                        <div class="progress-group">
                            <span class="progress-text">Suspend</span>
                            <span class="progress-number"><b><?=count($suspendvacancies)?></b>/<?=count($vacancies)?></span>

                            <div class="progress sm">
                                <?php
                                $suspendprogress = count($vacancies) > 0 ? (count($suspendvacancies)/count($vacancies)) : 0;
                                ?>
                                <div class="progress-bar progress-bar-red" style="width: <?=$suspendprogress*100?>%"></div>
                            </div>
                        </div>
                        <div class="progress-group">
                            <span class="progress-text">Expired</span>
                            <span class="progress-number"><b><?=count($expiredvacancies)?></b>/<?=count($vacancies)?></span>

                            <div class="progress sm">
                                <?php
                                $expiredprogress = count($vacancies) > 0 ? (count($expiredvacancies)/count($vacancies)) : 0;
                                ?>
                                <div class="progress-bar progress-bar-yellow" style="width: <?=$expiredprogress*100?>%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Vacancy Statistics</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-12" style="border: 1px solid #dedede;">
                            <div class="col-sm-6">
                                <h4>Latest Vacancies</h4>
                                <?php if(count($vacancies) > 0) {
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table no-margin">
                                            <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Created On</th>
                                                <th>Status</th>
                                                <th>View</th>
                                                <th>Applicants</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            for($i=0; $i<5; $i++) {
                                                if(empty($vacancies[$i])) break;
                                                $vac = $vacancies[$i];
                                                $appls = $this->db->where(COL_VACANCYID, $vac[COL_VACANCYID])->count_all_results(TBL_VACANCYAPPLIES);
                                                ?>
                                                <tr>
                                                    <td><a href="<?=site_url('vacancy/edit/'.$vac[COL_VACANCYID])?>"><?=$vac[COL_VACANCYTITLE]?></a></td>
                                                    <td><?=date("d M Y", strtotime($vac[COL_CREATEDON]))?></td>
                                                    <td><?=$vac[COL_ISSUSPEND] ? '<smal class="label label-danger pull-left">Suspend</smal>' : (strtotime($vac[COL_ENDDATE]) > strtotime(date('Y-m-d')) ? '<small class="label label-success pull-left">Active</small>' : '<small class="label label-warning pull-left">Expired</small>')?></td>
                                                    <td><?=desimal($vac[COL_TOTALVIEW])?></td>
                                                    <td><?=desimal($appls)?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="clearfix" style="margin-top: 20px"></div>
                                    <a href="<?=site_url('vacancy/add')?>" class="btn btn-sm btn-info btn-flat pull-left">Add New</a>
                                    <a href="<?=site_url('vacancy/index')?>" class="btn btn-sm btn-default btn-flat pull-right">View All</a>
                                    <div class="clearfix" style="margin-bottom: 20px"></div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="col-sm-12">
                                        <span class="no-data">No data available</span>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="col-sm-6">
                                <?php if(count($vacancies) > 0 && $VacancyPositions && count($VacancyPositions) > 0) {
                                    ?>
                                    <div class="col-sm-12" style="padding: 10px;">
                                        <p>Positions</p>
                                        <div class="col-sm-6">
                                            <canvas id="PositionChart" style="height:250px"></canvas>
                                        </div>
                                        <div class="col-sm-6">
                                            <ul class="chart-legend clearfix">
                                                <?php
                                                foreach($VacancyPositions as $pos) {
                                                    ?>
                                                    <li>
                                                        <i class="fa fa-circle-o" style="color: <?=$pos["color"]?>"></i>
                                                        <!--<b><?=desimal(($pos["value"]/count($vacancies))*100)?>%</b>-->
                                                        <?=$pos["label"]?>
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-sm-12" style="padding: 10px;">
                                        <p>Educations</p>
                                        <div class="col-sm-6">
                                            <canvas id="EducationChart" style="height:250px"></canvas>
                                        </div>
                                        <div class="col-sm-6">
                                            <ul class="chart-legend clearfix">
                                                <?php
                                                foreach($Educations as $edu) {
                                                    ?>
                                                    <li>
                                                        <i class="fa fa-circle-o" style="color: <?=$edu["color"]?>"></i>
                                                        <!--<b><?=desimal(($edu["value"]/count($vacancies))*100)?>%</b>-->
                                                        <?=$edu["label"]?>
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-sm-12" style="padding: 10px;">
                                        <p>Locations</p>
                                        <div class="col-sm-6">
                                            <canvas id="LocationChart" style="height:250px"></canvas>
                                        </div>
                                        <div class="col-sm-6">
                                            <ul class="chart-legend clearfix">
                                                <?php
                                                foreach($Locations as $loc) {
                                                    ?>
                                                    <li>
                                                        <i class="fa fa-circle-o" style="color: <?=$loc["color"]?>"></i>
                                                        <!--<b><?=desimal(($loc["value"]/count($vacancies))*100)?>%</b>-->
                                                        <?=$loc["label"]?>
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="col-sm-12">
                                        <span class="no-data">No data available</span>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="clearfix" style="margin-bottom: 20px"></div>

                        <?php if(count($vacancies) > 0 && $VacancyPositions && count($VacancyPositions) > 0) {
                            ?>
                            <div class="col-sm-12" style="border: 1px solid #dedede; padding: 10px">
                                <p><h4 class="text-center">Monthly Statistic</h4></p>
                                <canvas id="PositionAreaChart" style="height: 250px; width: 467px;" height="250" width="467"></canvas>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /. VACANCIES -->
        <?php
        } else if($ruser[COL_ROLEID] == ROLEUSER) {
            // application-related query
            $this->db->join(TBL_VACANCIES,TBL_VACANCIES.'.'.COL_VACANCYID." = ".TBL_VACANCYAPPLIES.".".COL_VACANCYID,"inner");
            $this->db->join(TBL_COMPANIES,TBL_COMPANIES.'.'.COL_COMPANYID." = ".TBL_VACANCIES.".".COL_COMPANYID,"inner");
            $this->db->join(TBL_STATUS,TBL_STATUS.'.'.COL_STATUSID." = ".TBL_VACANCYAPPLIES.".".COL_STATUSID,"inner");
            $this->db->where(TBL_VACANCYAPPLIES.".".COL_USERNAME, $ruser[COL_USERNAME]);
            $this->db->order_by(TBL_VACANCYAPPLIES.".".COL_APPLYDATE, "desc");
            $appl = $this->db->get(TBL_VACANCYAPPLIES)->result_array();

            $dataapply = array();
            $dat = array();
            $i = 0;
            if(count($appl)> 0) {
                foreach ($appl as $d) {
                    $status = "";
                    if($d[COL_STATUSID] == STATUS_DIPROSES) $status = '<smal class="label label-primary pull-left">'.$d[COL_STATUSNAME].'</smal>';
                    if($d[COL_STATUSID] == STATUS_DITERIMA) $status = '<smal class="label label-success pull-left">'.$d[COL_STATUSNAME].'</smal>';
                    if($d[COL_STATUSID] == STATUS_DITOLAK) $status = '<smal class="label label-warning pull-left">'.$d[COL_STATUSNAME].'</smal>';

                    $appls = $this->db->where(COL_VACANCYID, $d[COL_VACANCYID])->count_all_results(TBL_VACANCYAPPLIES);
                    $dat[$i] = array(
                        anchor('vacancy/detail/'.$d[COL_VACANCYID],$d[COL_VACANCYTITLE], array('target'=>'_blank')),
                        anchor('company/detail/'.$d[COL_COMPANYID],$d[COL_COMPANYNAME], array('target'=>'_blank')),
                        date('d M Y', strtotime($d[COL_APPLYDATE])),
                        desimal($appls),
                        $status
                    );
                    $i++;
                }
            }
            $dataapply = json_encode($dat);

            // vacancy related quer
            $pref_industry = array();
            $pref_education = array();
            $pref_position = array();
            $pref_location = array();
            $pref_type = array();

            if($ruser[COL_EDUCATIONID]) $pref_education[] = $ruser[COL_EDUCATIONID];
            // preferences
            $pref = $this->db->where(COL_USERNAME, $ruser[COL_USERNAME])->get(TBL_USERPREFERENCES)->result_array();
            if($pref) {
                foreach($pref as $p) {
                    if($p[COL_PREFERENCETYPEID] == PREFERENCETYPE_INDUSTRYTYPE) $pref_industry[] = $p[COL_PREFERENCEVALUE];
                    if($p[COL_PREFERENCETYPEID] == PREFERENCETYPE_EDUCATIONTYPE) $pref_education[] = $p[COL_PREFERENCEVALUE];
                    if($p[COL_PREFERENCETYPEID] == PREFERENCETYPE_POSITION) $pref_position[] = $p[COL_PREFERENCEVALUE];
                    if($p[COL_PREFERENCETYPEID] == PREFERENCETYPE_LOCATION) $pref_location[] = $p[COL_PREFERENCEVALUE];
                    if($p[COL_PREFERENCETYPEID] == PREFERENCETYPE_VACANCYTYPE) $pref_type[] = $p[COL_PREFERENCEVALUE];
                }
            }
            $vacancies = $this->mvacancy->search(0,"", $pref_position, $pref_industry, $pref_location, $pref_type, $pref_education);
            $datavacancies = array();
            $dat = array();
            $i = 0;
            if(count($vacancies)> 0) {
                foreach ($vacancies as $d) {
                    $dat[$i] = array(
                        //'<img src="'.(!empty($d[COL_FILENAME]) ? MY_UPLOADURL.$d[COL_FILENAME] : MY_IMAGEURL.'company-icon.jpg').'" height="40">',
                        anchor('vacancy/detail/'.$d[COL_VACANCYID],$d[COL_VACANCYTITLE], array('target'=>'_blank')),
                        anchor('company/detail/'.$d[COL_COMPANYID],$d[COL_COMPANYNAME]),
                        $d[COL_VACANCYTYPENAME],
                        $d[COL_POSITIONNAME],
                        $d["Educations"],
                        $d[COL_ISALLLOCATION]?"Seluruh Indonesia":$d["Locations"],
                        //substr($d[COL_COMPANYADDRESS], 0, 25),
                        date('d M Y', strtotime($d[COL_ENDDATE]))
                    );
                    $i++;
                }
            }
            $datavacancies = json_encode($dat);
            ?>
            <div class="col-sm-12">
                <?php
                if(!$this->muser->IsProfileComplete()) {
                    ?>
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                        <h4><i class="icon fa fa-warning"></i> Peringatan</h4>
                        Profil anda belum lengkap. Silahkan lengkapi profil anda <a href="<?=site_url('user/profile')?>">disini</a>
                    </div>
                <?php
                }
                ?>

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">My Application</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <form id="appform" method="post" action="#">
                            <table id="applist" class="table table-bordered table-hover">

                            </table>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Recommended Vacancies</h3>

                        <div class="box-tools pull-right">
                            <a href="<?=site_url('user/preference')?>" class="btn btn-box-tool" title="Preferences"><i class="fa fa-cogs"></i></a>
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <form id="vacancyform" method="post" action="#">
                            <table id="vacancylist" class="table table-bordered table-hover">

                            </table>
                        </form>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                    var apptable = $('#applist').dataTable({
                        //"sDom": "Rlfrtip",
                        "aaData": <?=$dataapply?>,
                        //"bJQueryUI": true,
                        "aaSorting" : [[2,'desc']],
                        //"scrollY" : 400,
                        //"scrollX": "200%",
                        "iDisplayLength": 100,
                        "aLengthMenu": [[100, 1000, 5000, -1], [100, 1000, 5000, "Semua"]],
                        "dom":"R<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
                        "buttons": ['copyHtml5','excelHtml5','csvHtml5','pdfHtml5'],
                        "aoColumns": [
                            {"sTitle": "Vacancy"},
                            {"sTitle": "Company"},
                            {"sTitle": "Date", "width": "15%"},
                            {"sTitle": "Total Applicants", "width": "15%"},
                            {"sTitle": "Status", "width": "10%"}
                        ]
                    });

                    var vacancytable = $('#vacancylist').dataTable({
                        //"sDom": "Rlfrtip",
                        "aaData": <?=$datavacancies?>,
                        //"bJQueryUI": true,
                        "aaSorting" : [[0,'desc']],
                        //"scrollY" : 400,
                        "scrollX": "200%",
                        "iDisplayLength": 100,
                        "aLengthMenu": [[100, 1000, 5000, -1], [100, 1000, 5000, "Semua"]],
                        "dom":"R<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
                        "buttons": ['copyHtml5','excelHtml5','csvHtml5','pdfHtml5'],
                        "aoColumns": [
                            //{"sTitle": ""},
                            {"sTitle": "Nama Lowongan", "width": "20%"},
                            {"sTitle": "Perusahaan", "width": "20%"},
                            {"sTitle": "Tipe Lowongan", "width": "12%"},
                            {"sTitle": "Posisi", "width": "15%"},
                            {"sTitle": "Pendidikan Min.", "width": "15%"},
                            {"sTitle": "Penempatan", "width": "25%"},
                            {"sTitle": "Deadline", "width": "20%"}
                        ]
                    });
                });
            </script>
        <?php
        }
        ?>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<?php $this->load->view('loadjs')?>

<script>
    $(document).ready(function() {
        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieOptions = {
            //Boolean - Whether we should show a stroke on each segment
            segmentShowStroke: true,
            //String - The colour of each segment stroke
            segmentStrokeColor: "#fff",
            //Number - The width of each segment stroke
            segmentStrokeWidth: 2,
            //Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 50, // This is 0 for Pie charts
            //Number - Amount of animation steps
            animationSteps: 100,
            //String - Animation easing effect
            animationEasing: "easeOutBounce",
            //Boolean - Whether we animate the rotation of the Doughnut
            animateRotate: true,
            //Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale: true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true
        };

        var IndustryType = $("#IndustryTypeChart");
        if(IndustryType.length > 0) {
            var IndustryTypeChartCanvas = IndustryType.get(0).getContext("2d");
            var IndustryTypeChart = new Chart(IndustryTypeChartCanvas);
            var IndustryTypePieData = <?=!empty($ArrCompanyIndustries)?$ArrCompanyIndustries:json_encode(array())?>;
            IndustryTypeChart.Doughnut(IndustryTypePieData, pieOptions);
        }

        var Position = $("#PositionChart");
        if(Position.length > 0) {
            var PositionChartCanvas = Position.get(0).getContext("2d");
            var PositionChart = new Chart(PositionChartCanvas);
            var PositionPieData = <?=!empty($ArrVacancyPositions)?$ArrVacancyPositions:json_encode(array())?>;
            PositionChart.Doughnut(PositionPieData, pieOptions);
        }

        var Education = $("#EducationChart");
        if(Education.length > 0) {
            var EducationChartCanvas = Education.get(0).getContext("2d");
            var EducationChart = new Chart(EducationChartCanvas);
            var EducationPieData = <?=!empty($ArrEducations)?$ArrEducations:json_encode(array())?>;
            EducationChart.Doughnut(EducationPieData, pieOptions);
        }

        var Location = $("#LocationChart");
        if(Location.length > 0) {
            var LocationChartCanvas = Location.get(0).getContext("2d");
            var LocationChart = new Chart(LocationChartCanvas);
            var LocationPieData = <?=!empty($ArrLocations)?$ArrLocations:json_encode(array())?>;
            LocationChart.Doughnut(LocationPieData, pieOptions);
        }

        //--------------
        //- AREA CHART -
        //--------------
        var areaChartOptions = {
            //Boolean - If we should show the scale at all
            showScale: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: true,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - Whether the line is curved between points
            bezierCurve: true,
            //Number - Tension of the bezier curve between points
            bezierCurveTension: 0.3,
            //Boolean - Whether to show a dot for each point
            pointDot: false,
            //Number - Radius of each point dot in pixels
            pointDotRadius: 4,
            //Number - Pixel width of point dot stroke
            pointDotStrokeWidth: 1,
            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius: 20,
            //Boolean - Whether to show a stroke for datasets
            datasetStroke: true,
            //Number - Pixel width of dataset stroke
            datasetStrokeWidth: 2,
            //Boolean - Whether to fill the dataset with a color
            datasetFill: true,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true
        };

        var PositionArea = $("#PositionAreaChart");
        if(PositionArea.length > 0) {
            var PositionAreaChartCanvas = PositionArea.get(0).getContext("2d");
            var PositionAreaChart = new Chart(PositionAreaChartCanvas);
            var PositionAreaChartData = {
                labels: <?=!empty($VacancyMonthsAsc)?json_encode($VacancyMonthsAsc):json_encode(array())?>,
                datasets: <?=!empty($ArrVacancyPositions2)?$ArrVacancyPositions2:json_encode(array())?>
            };
            console.log(PositionAreaChartData);
            PositionAreaChart.Line(PositionAreaChartData, areaChartOptions);
        }

    });
</script>
<?php $this->load->view('footer') ?>
