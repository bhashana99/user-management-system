<?php
require_once 'assets/php/admin-header.php';
require_once 'assets/php/admin-db.php';

$count = new Admin();
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card-deck mt-3 text-light text-center font-weight-bold">

            <div class="card bg-primary">
              <div class="card-header">Total Users</div>
              <div class="card-body">
                <h1 class="display-4">
                  <?= $count->totalCount('users'); ?>
                </h1>
              </div>
            </div>

            <div class="card bg-warning">
              <div class="card-header">Verified Users</div>
              <div class="card-body">
                <h1 class="display-4">
                  <?= $count->verified_users(1); ?>
                </h1>
              </div>
            </div>

            <div class="card bg-success">
              <div class="card-header">Unverified Users</div>
              <div class="card-body">
                <h1 class="display-4">
                <?= $count->verified_users(0); ?>
                </h1>
              </div>
            </div>

            <div class="card bg-primary">
              <div class="card-header">Website Hits</div>
              <div class="card-body">
                <h1 class="display-4">
                  <?php $data = $count->site_hits(); echo $data['hits']; ?>
                </h1>
              </div>
            </div>

        </div>
    </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card-deck mt-3 text-light text-center font-weight-bold">

      <div class="card bg-danger">
        <div class="card-header">Total Notes</div>
        <div class="card-body">
          <h1 class="display-4">
          <?= $count->totalCount('notes'); ?>
          </h1>
        </div>
      </div>

      <div class="card bg-success">
        <div class="card-header">Total Feedback</div>
        <div class="card-body">
          <h1 class="display-4">
          <?= $count->totalCount('feedback'); ?>
          </h1>
        </div>
      </div>

      <div class="card bg-info">
        <div class="card-header">Total Notification</div>
        <div class="card-body">
          <h1 class="display-4">
          <?= $count->totalCount('notification'); ?>
          </h1>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card-deck my-3">

    <div class="card border-success">
      <div class="card-header bg-success text-center text-white lead">
          Male/Female User's Percentage
      </div>
      <div id="chartOne" style="width:99%;height:400px;"></div>
    </div>  

    <div class="card border-success">
      <div class="card-header bg-success text-center text-white lead">
          Verified/Unverified User's Percentage 
      </div>
      <div id="chartTwo" style="width:99%;height:400px;"></div>
    </div>

    </div>
  </div>
</div>
<!-- Footer Area -->
    </div>
  </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

    $(document).ready(function (){

      checkNotification();
            // Check Notification
            function checkNotification(){
                $.ajax({
                    url: 'assets/php/admin-action.php',
                    method: 'post',
                    data: {action: 'checkNotification'},
                    success: function(response){
                       // console.log(response);
                       $("#checkNotification").html(response);
                    }
                });
            }
    });

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {

        var data1 = google.visualization.arrayToDataTable([
            ['Gender', 'Number'],
            <?php 
            $gender = $count->genderPer();
            foreach ($gender as $row){
                echo '["'.$row['gender'].'",'.$row['number'].'],';
            }
            ?>
        ]);

        var data2 = google.visualization.arrayToDataTable([
            ['Verified', 'Number'],
            <?php 
            $verified = $count->verifiedPer();
            foreach ($verified as $row){ 
                if($row['verified'] == 0){
                    $row['verified'] = 'Unverified';
                }
                else{
                    $row['verified'] = 'Verified';
                }
                echo '["'.$row['verified'].'",'.$row['number'].'],';
            }
            ?>
        ]);

        var options1 = {
            title: 'Gender Distribution'
        };

        var options2 = {
            pieHole: 0.3,
            title: 'Verified Status Distribution'
        };

        var chart1 = new google.visualization.ChartWrapper({
            chartType: 'PieChart',
            containerId: 'chartOne', // Make sure corresponding <div> exists
            dataTable: data1,
            options: options1
        });

        chart1.draw();

        var chart2 = new google.visualization.ChartWrapper({
            chartType: 'PieChart',
            containerId: 'chartTwo', // Make sure corresponding <div> exists
            dataTable: data2,
            options: options2
        });

        chart2.draw();
    }
</script>


</body>
</html>