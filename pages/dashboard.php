<div class="admin-body" id="dashboard-page">
  <?php include "./components/sidenav.php"; ?>
  <div class="content">
    <div class="topnav">
      <div class="left">
        <h4>Dashboard</h4>
      </div>
    </div>
    <div class="container">
      <div class="widget-1">
        <div class="widget-items">
          <div>
            <h4 class="widget-data"><?= $h->sc("*","user","role='customer'") ?></h4>
            <h4 class="widget-title">Total Customer</h4>
          </div>
          <i class="fad fa-users widget-icon"></i>
        </div>
        <div class="widget-items">
          <div>
            <?php
              $date = getdate();
              $y = $date["year"];
              $m = $date["mon"] < 10 ? "0".$date["mon"] : $date["mon"];
              $d = $date["mday"] < 10 ? "0".$date["mday"] : $date["mday"];
              $today = "{$y}-{$m}-{$d}";
            ?>
            <h4 class="widget-data"><?= $h->sc("*","booking","booking_date='$today'") ?></h4>
            <h4 class="widget-title">Today Booking</h4>
          </div>
          <i class="fad fa-calendar-day widget-icon"></i>
        </div>
        <div class="widget-items">
          <div>
            <h4 class="widget-data"><?= $h->sc("*","booking","booking_status='paid'") ?></h4>
            <h4 class="widget-title">Unactived Booking</h4>
          </div>
          <i class="fad fa-envelope widget-icon"></i>
        </div>
        <div class="widget-items">
          <div>
            <h4 class="widget-data"><?= $h->sc("*","booking","booking_status='actived'") ?></h4>
            <h4 class="widget-title">Actived Booking</h4>
          </div>
          <i class="fad fa-envelope-open widget-icon"></i>
        </div>
      </div>
      <canvas id="myChart" width="100%" height="30"></canvas>
    </div>
  </div>
</div>
<script>
moment().format();
const ctx = document.getElementById('myChart').getContext('2d');
let data = [];
for(let i = 9; i > -1; i--){
  var ttdate = moment().add(-i, 'days');
  var dd = ttdate.date();
  var month_name = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Des"];
  var mm = ttdate.month();
  var yyyy = ttdate.year();
  if (dd < 10) {
    dd = '0' + dd
  }
  if (mm < 10) {
    mm = '0' + mm
  }
  var ttdays = dd + " " + month_name[mm];
  data.push(ttdays);
}
console.log(data);
const myChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: data,
    datasets: [{
      label: "Total Booking",
      barPercentage: 1.0,
      data: [
        <?php
          $date = getdate();
          $d = $date['mday'];
          $m = $date['mon'];
          $y = $date['year'];
          $today = "{$m}/{$d}/{$y}";
          for ($i=9; $i > -1; $i--) { 
            $ttday =  date('Y-m-d',strtotime("-{$i} days",strtotime($today))) . PHP_EOL;
            echo $h->sc("*","booking","booking_date='$ttday'");
            echo $i != 0 ? "," : "";
          }
        ?>
      ],
      borderColor: ['#008000'],
      borderWidth: 1
    }]
  },
  options: {
    interaction: {
      mode: 'index',
      intersect: false,
    },
    scales: {
      y: {
        ticks:{ 
          stepSize: 1,
          beginAtZero: true
        }
      }
    },
    tooltips: {
      callbacks: {
        label: function(tooltipItem) {
          return tooltipItem.yLabel;
        }
      }
    }
  }
});

</script>