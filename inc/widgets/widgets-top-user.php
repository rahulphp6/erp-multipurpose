<div class="row">
  <?php
  function widgetDash($total, $title = "", $icon="", $class="")
  { ?>

    <div class="small-box bg-<?php echo $class; ?>">
      <div class="inner">
        <h3 style="font-size: 14px;"><?php if ($total > 0) {
                                        if ($icon == "money") {
                                          $total = number_format(floatval($total), 2);
                                          echo currency . $total;
                                        } else {
                                          echo $total;
                                        }
                                      } else {
                                        echo "0";
                                      } ?></h3>

        <p style="font-size: 12px;margin:0"><?php echo $title; ?></p>
      </div>
      <div class="icon" style="top:0">
        <i class="fa fa-<?php echo $icon; ?>" style="top: 10px;font-size: 40px;"></i>
      </div>
    </div>
    <!-- /.info-box-content -->
  <?php } ?>
  <div class="col-lg-3 col-6">
    <?php
    widgetDash($rtTotal, "Total Retainer", "money", "warning");
    // widgetDash($RT_total, "Total Retainer", "tasks", "warning");
    ?>
  </div>
  <div class="col-lg-3 col-6">
    <?php
    widgetDash($totalInvAmt, "Total Invoice Amt", "money", "info");
    // widgetDash($totinvoices, "Total Invoice", "line-chart", "info");
    ?>
  </div>
  <div class="col-lg-3 col-6">
    <?php
    widgetDash($totalSalesAmt, "Total Sales Order", "money", "primary");
    // widgetDash($salesTotal->num_rows, "Total Sales Order", "pie-chart", "primary"); 
    ?>
  </div>
  <div class="col-lg-3 col-6">
    <?php //widgetDash($totSaleAmt, "Total Sales Payment", "money", "info");
    widgetDash($totdayInvoiceTot, "Total Paid Amount", "money", "success");
    ?>
  </div>
</div>