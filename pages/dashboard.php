<?php


$assetsentryTb = dbAction('assetsentry', 4, '');
$assetActive = dbAction('assetsentry', 4, '', 'eqpStatus=1');
$assetInactive = dbAction('assetsentry', 4, '', 'eqpStatus=0');


$wkSechduleTb = dbAction('workorder', 4, '', 'status=1');
$wkDoneTb = dbAction('workorder', 4, '', 'status=3');


$crDate = date("Y-m-d h:i:s");
$serCloseData = dbAction('servicecall', 4, '', "YEAR(date) = YEAR('$crDate' - INTERVAL 1 MONTH)
AND MONTH(date) = MONTH('$crDate' - INTERVAL 1 MONTH) AND callStatus=0");
$serStData = dbAction('servicecall', 4, '', 'callStatus=1');
$set_2 = [];
if ($serStData->num_rows > 0) {
  foreach ($serStData as $serStRow) {
    if (!empty($serStRow['ComplaintTime'])) {
      $to_date = time();
      $from_date = strtotime($serStRow['ComplaintTime']);
      $day_diff = $to_date - $from_date;
      $PendingDays = floor($day_diff / (60 * 60 * 24));
      if ($PendingDays <= 3) {
        $set_2[] = $PendingDays;
        // $set_2=array_push($set_2,["hrs"=>$PendingDays]);
      }
      if ($PendingDays < 8 and $PendingDays > 4) {
        // echo $PendingDays.'<br>';
        $set_2[] = $PendingDays;
        // $set_2=array_push($set_2,["week"=>$PendingDays]);
      }
      if ($PendingDays > 30) {
        $set_2[] = $PendingDays;
        // $set_2=array_push($set_2,["month"=>$PendingDays]);
      }
    }
  }
}
$pmSh = dbAction('assetsentry', 4, '', 'pmSchedule!=""');
$pmPen = dbAction('assetsentry', 4, '', 'pmSchedule=""');
$pmDone = dbAction('maintenance', 4, '');

$caliSh = dbAction('assetsentry', 4, '', 'calibrationSchedule!=""');
$caliPen = dbAction('assetsentry', 4, '', 'calibrationSchedule=""');
$caliDone = dbAction('calibration', 4, '');

$stocksAlert = dbAction('stocks', 4, '', 'status=1');
?>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <?php //include_once "inc/widgets/widgets-top.php";
    ?>
    <?php include_once "inc/widgets/box.php"; ?>

  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">

        <?php include_once "inc/widgets/search.php"; ?>
      </div>
      <div class="col-md-6">
        <div class="card card-widget widget-user-2">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-danger">
            <h5><i class="fa fa-exclamation-circle"></i> Important Alerts</h5>
          </div>
          <div class="card-footer p-0">
            <ul class="nav flex-column">
              <?php

              if ($stocksAlert->num_rows > 0) {
                foreach ($stocksAlert as $stocksRow) {
                  $quantity = getRow('stockeitems', $stocksRow['id'], '', '', 2);
                  if (!empty($quantity['quantity']) and $quantity['quantity'] <= $stocksRow['alert']) {
              ?>
                    <li class="nav-item">
                      <a href="?page=stockeItems" class="nav-link text-secondary"> <i class="fa fa-exclamation-circle"></i>
                        <?php echo $stocksRow['accessoriesName']; ?> <span class="float-right badge bg-danger"><?php echo $quantity['quantity']; ?></span>
                      </a>
                    </li>
              <?php
                  }
                }
              } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <!-- AREA CHART -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Service Calls Graph</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="myChart"></canvas>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Preventive Care Graph</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="chartPm"></canvas>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
      </div>

      <!-- /.col (RIGHT) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>

<?php
$closeSt = array();
$closeSum = array();
$pendingSt = array();
$openSt = array();
for ($mnt = 1; $mnt < 13; $mnt++) {
  $subQ = "select *,month(date) as month from servicecall where callStatus=0 AND  date_FORMAT(date,'%m')=" . $mnt;
  $subData = queryRun($subQ, 3);
  if ($subData->num_rows > 0) {
    $DataRow = $subData->fetch_assoc();
    array_push($closeSt, $DataRow['month']);
    array_push($closeSum, $subData->num_rows);
  } else {
    array_push($closeSt, $mnt);
    array_push($closeSum, 0);
  }
}

for ($mnt = 1; $mnt < 13; $mnt++) {
  $subQ = "select *,month(date) as month from servicecall where callStatus=1 AND  date_FORMAT(date,'%m')=" . $mnt;
  $subData = queryRun($subQ, 3);
  if ($subData->num_rows > 0) {
    $DataRow = $subData->fetch_assoc();
    // array_push($closeSt, $DataRow['month']);
    array_push($openSt, $subData->num_rows);
  } else {
    // array_push($closeSt,$mnt);
    array_push($openSt, 0);
  }
}
for ($mnt = 1; $mnt < 13; $mnt++) {
  $subQ = "select *,month(date) as month from servicecall where CloseTime='' AND  date_FORMAT(date,'%m')=" . $mnt;
  $subData = queryRun($subQ, 3);
  if ($subData->num_rows > 0) {
    $DataRow = $subData->fetch_assoc();
    // array_push($closeSt, $DataRow['month']);
    array_push($pendingSt, $subData->num_rows);
  } else {
    // array_push($closeSt,$mnt);
    array_push($pendingSt, 0);
  }
}



// echo "<pre>";
// print_r($closeSt);
// echo "</pre>";
// echo "<pre>";
// print_r($closeSum);
// echo "</pre>";

?>
<script src="plugins/chart.js/Chart.min.js"></script>
<script type="text/javascript">
  var ctx = document.getElementById('myChart');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'App', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      datasets: [{
          label: 'Pending Calls',
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          pointRadius: true,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: [<?php echo implode(",", $pendingSt); ?>]
        },
        {
          label: 'Open Calls',
          backgroundColor: '#e53935ad',
          borderColor: '#e53935',
          pointRadius: true,
          pointColor: 'rgba(210, 214, 222, 1)',
          pointStrokeColor: '#c1c7d1',
          pointHighlightFill: '#fff',

          pointHighlightStroke: 'rgba(220,220,220,1)',
          data: [<?php echo implode(",", $openSt); ?>]
        },
        {
          label: 'Closed Calls',
          backgroundColor: '#43a047c4',
          borderColor: '#43a047',
          pointRadius: true,
          pointColor: 'rgba(210, 214, 222, 1)',
          pointStrokeColor: '#c1c7d1',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data: [<?php echo implode(",", $closeSum); ?>]
        },
      ]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
</script>

<?php
$pmDataSet  = array();
$pmSchDataSet  = array();
for ($mnt = 1; $mnt < 13; $mnt++) {
  $subQ = "select *,month(date) as month from maintenance where date_FORMAT(date,'%m')=" . $mnt;
  $subData = queryRun($subQ, 3);
  if ($subData->num_rows > 0) {
    $DataRow = $subData->fetch_assoc();
    // array_push($closeSt, $DataRow['month']);
    array_push($pmDataSet, $subData->num_rows);
  } else {
    // array_push($closeSt,$mnt);
    array_push($pmDataSet, 0);
  }
}
for ($mnt = 1; $mnt < 13; $mnt++) {
  $subQ = "select *,month(date) as month from assetsentry where pmSchedule!='' AND date_FORMAT(date,'%m')=" . $mnt;
  $subData = queryRun($subQ, 3);
  if ($subData->num_rows > 0) {
    $DataRow = $subData->fetch_assoc();
    // array_push($closeSt, $DataRow['month']);
    array_push($pmSchDataSet, $subData->num_rows);
  } else {
    // array_push($closeSt,$mnt);
    array_push($pmSchDataSet, 0);
  }
}
//print_r($pmSchDataSet);
?>
<script>
  window.chartColors = {
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(231,233,237)'
  };

  var MONTHS = ['Jan', 'Feb', 'Mar', 'App', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
  var config = {
    type: 'line',
    data: {
      labels: MONTHS,
      datasets: [{
        label: "PM Sechdule",
        backgroundColor: window.chartColors.red,
        borderColor: window.chartColors.red,
        data: [<?php echo implode(",", $pmSchDataSet); ?>],
        fill: false,
      }, {
        label: "PM Done",
        fill: false,
        backgroundColor: window.chartColors.blue,
        borderColor: window.chartColors.blue,
        data: [<?php echo implode(",", $pmDataSet); ?>],
      }]
    },
    options: {
      responsive: true,
      title: {
        display: true,
        text: 'Preventive Care Graph'
      },
      tooltips: {
        mode: 'index',
        intersect: false,
      },
      hover: {
        mode: 'nearest',
        intersect: true
      },
      scales: {
        xAxes: [{
          display: true,
          scaleLabel: {
            display: true
          }
        }],
        yAxes: [{
          display: true,
          scaleLabel: {
            display: true,
          },
        }]
      }
    }
  };

  var ctx = document.getElementById("chartPm").getContext("2d");
  var chartPm = new Chart(ctx, config);
</script>