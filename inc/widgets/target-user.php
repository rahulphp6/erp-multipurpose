<?php
$apifromdate = date('Y-' . mm . '-01');
$apitodate = date('Y-m-d');
$targetMM = mm;
$targetYY = yy;
if (isset($_POST['filterby'])) {
    extract($_POST);
    $mm = str_pad($_POST['month'], 2, "0", STR_PAD_LEFT);
    $apifromdate = date('Y-' . $mm . '-01');
    $apitodate = date("Y-m-t", strtotime($apifromdate));
    // $todate = date('Y-' . $mm . '-30');
}
$com_target = 0;
$com_incentive = 0;
$due_incentive = 0;
$tot_invoice_count = 0;
$tot_sales = 0;
$tot_sales_with_tax = 0;
$tot_cn_count = 0;
$tot_cn_sales = 0;
$tot_cn_sales_with_tax = 0;
$tot_total_sales = 0;
$tot_total_sales_with_tax = 0;
$tot_balance_due = 0;
$getTargetDb = dbAction('company_target', 4, '', "month=" . $targetMM . " AND year=" . $targetYY . " AND store=" . organizationId);
if ($getTargetDb->num_rows > 0) {
    $getTarget = $getTargetDb->fetch_object();
    // print_r($getTarget);
    $total_inc = getPercentage($com_incentive, $com_target);
    if ($total_inc > 0) {
    }
    // $zohodata = userBankApi('', "reports/salesbysalesperson", "", "https://act.optiecraft.com/api/v3/reports/salesbysalesperson?page=1&per_page=500&sort_column=salesperson_name&sort_order=A&filter_by=TransactionDate.CustomDate&from_date=$apifromdate&to_date=$apitodate&select_columns=%5B%7B%22field%22%3A%22salesperson_name%22%2C%22group%22%3A%22report%22%7D%2C%7B%22field%22%3A%22invoice_count%22%2C%22group%22%3A%22report%22%7D%2C%7B%22field%22%3A%22invoice_sales%22%2C%22group%22%3A%22report%22%7D%2C%7B%22field%22%3A%22invoice_sales_with_tax%22%2C%22group%22%3A%22report%22%7D%2C%7B%22field%22%3A%22cn_count%22%2C%22group%22%3A%22report%22%7D%2C%7B%22field%22%3A%22cn_sales%22%2C%22group%22%3A%22report%22%7D%2C%7B%22field%22%3A%22cn_sales_with_tax%22%2C%22group%22%3A%22report%22%7D%2C%7B%22field%22%3A%22total_sales%22%2C%22group%22%3A%22report%22%7D%2C%7B%22field%22%3A%22total_sales_with_tax%22%2C%22group%22%3A%22report%22%7D%2C%7B%22field%22%3A%22balance_due%22%2C%22group%22%3A%22report%22%7D%5D&response_option=1&organization_id=" . organizationId, "", 0);
    if (isset($zohodata->sales)) {
        $sales = $zohodata->sales;
        foreach ($sales as $sale) {
            $tot_invoice_count += $sale->invoice_count;
            $tot_sales += $sale->sales;
            $tot_sales_with_tax += $sale->sales_with_tax;
            $tot_cn_count += $sale->cn_count;
            $tot_cn_sales += $sale->cn_sales;
            $tot_cn_sales_with_tax += $sale->cn_sales_with_tax;
            $tot_total_sales += $sale->total_sales;
            $tot_total_sales_with_tax += $sale->total_sales_with_tax;
            $tot_balance_due += $sale->balance_due;
        }
    }
    // echo '<pre>';
    // print_r($zohodata);
    // echo '</pre>';
    // sale cash by users

    // end other fun
    $com_target = $getTarget->target;
    $com_incentive = $getTarget->incentive;
    $due_incentive = getPercentage($com_incentive, $com_target);
}
if (isset($com_target)) {
    $achive_goal = round($com_target) - $tot_total_sales_with_tax;
} else {
    $achive_goal = 0;
}
?>
<?php
$tot_user_goal = 0;
$user_percent = [];
$cn_tot = 0;
if (!empty($com_target)) { ?>
    <?php
    if (isset($sales)) {
        foreach ($sales as $sale) {
            $done = $sale->total_sales_with_tax;
            $my_percent = getPercentage($com_incentive, $done);
            $my_incentive = getPer($tot_total_sales_with_tax, $done);
            if ($sale->salesperson_name == $name) {
    ?>
                <div class="progress-group">
                    <?php echo $sale->salesperson_name; ?> <span class="float-right badge bg-warning"><?php echo $my_incentive; ?>%</span>
                    <div class="progress text-center text-white" style="height: 0.4rem;background-color: #607d8b;">
                        <div class="progress-bar" style="background: #8bc34a;width: <?php progress($done, $tot_total_sales_with_tax); ?>%"><small></small></div>
                    </div>
                </div>
                <!-- <p class="mb-0"><?php echo "Target Achieved AED.$done"; ?></p> -->
    <?php
            }
        }
    }
    ?>
    <div class="progress-group">
        Company Target Status <span class="float-right badge bg-primary"><?php echo progress($tot_total_sales_with_tax, $com_target); ?>%</span>
        <div class="progress text-center text-white" style="height: 0.4rem;background-color: #607d8b;">
            <div class="progress-bar" style="width: <?php echo progress($tot_total_sales_with_tax, $com_target); ?>%"><small></small></div>
        </div>
    </div>
    <!-- <div id="targetChart" style="height: 200px;"></div> -->
<?php } ?>
<div class="modal fade" id="filteration">
    <div class="modal-dialog">
        <div class="modal-content modal-sm">
            <div class="modal-header">
                <h6>Filteration</h6>
                <button type="button" class="btn btn-xs btn-default" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <?php //userDt("user_id", "users", "By Employee"); 
                        ?>
                    </div>
                    <p>Apply Month & Year</p>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <small class="input-group-text text-tiny">Month</small>
                                    </div>
                                    <select name="month" class="form-control form-control-sm">
                                        <?php
                                        for ($i = 1; $i < 13; $i++) {
                                            echo "<option value='$i'>".date('M', strtotime(date('1-'.$i.'-Y')))."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <small class="input-group-text text-tiny">Year</small>
                                    </div>
                                    <select name="year" class="form-control form-control-sm">
                                        <?php
                                        for ($y = 2022; $y < 2030; $y++) {
                                            echo "<option value='$y'>$y</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" name="filterby" class="btn btn-sm btn-primary">Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    Highcharts.chart('targetChart', {
        chart: {
            type: 'bar'
        },
        title: {
            text: '<?php echo date('F'); ?> Target So Far'
        },
        xAxis: {
            categories: ['Target']
        },
        yAxis: {
            min: 0,
            max: <?php echo round($com_target); ?>,
        },
        plotOptions: {
            series: {
                stacking: 'normal',
                dataLabels: {
                    // enabled: true
                }
            },
        },
        series: [{
            name: 'Target',
            data: [<?php echo $achive_goal; ?>],
            color: '#6c757d'
        }, {
            name: 'Achieved',
            data: [<?php echo $tot_total_sales_with_tax; ?>],
            color: '#8bc34a'
        }, {
            name: 'Credit Notes',
            data: [<?php echo $tot_cn_sales_with_tax; ?>],
            color: '#dc3545'
        }]
    });
</script>