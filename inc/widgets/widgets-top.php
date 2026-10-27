<div class="row">
  <?php if (isModCheck("login")) {
    function widgetDash($total, $title = "", $icon, $class)
    { ?>
      <div class="info-box">
        <span class="info-box-icon bg-<?php echo $class; ?>"><i class="fa fa-<?php echo $icon; ?>"></i></span>
        <div class="info-box-content">
          <span class="info-box-text"><?php echo $title; ?></span>
          <span class="info-box-number">
            <?php if ($total > 0) {
              if ($icon == "money") {
                $total = number_format($total, 2);
                echo currency . $total;
              } else {
                echo $total;
              }
            } else {
              echo "0";
            } ?></span>
        </div>
      </div>
      <!-- /.info-box-content -->
    <?php } ?>
    <div class="col-lg-3 col-6">
      <?php widgetDash($paidTotal, "Total Payments", "money", "success"); ?>
    </div>
    <div class="col-lg-3 col-6">
      <?php widgetDash($totinvoices, "Total Invoice", "file", "primary"); ?>
    </div>
    <div class="col-lg-3 col-6">
      <?php widgetDash($salesTotal->num_rows, "Total Sales Order", "list", "warning"); ?>
    </div>
    <div class="col-lg-3 col-6">
      <?php widgetDash($totalCus->num_rows, "Total Chashiers", "users", "info"); ?>
    </div>
    
  <?php } ?>
</div>