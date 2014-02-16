@layout('layouts/main')
@section('content')
@include('layouts/user_dashboard_menu')
<div class="span9">
  <h1>Hello {{$user->first_name}}</h1>
  <canvas id="demoLineChart" width="900" height="300"></canvas>
  <canvas id="demoBarChart" width="900" height="300"></canvas>
  <canvas id="demoRadarChart" width="900" height="300"></canvas>
  <canvas id="demoPolarChart" width="900" height="300"></canvas>
  <canvas id="demoPieChart" width="900" height="300"></canvas>
  <canvas id="demoDoughnutChart" width="900" height="300"></canvas>

  <script type="text/javascript">
    var demoData = {
      labels   : ["January - March", "April - June", "July - September", "Octover - December"],
      datasets : [
        {
          fillColor : "rgba(220,220,220,0.5)",
          strokeColor : "rgba(220,220,220,1)",
          pointColor : "rgba(220,220,220,1)",
          pointStrokeColor : "#fff",
          data : [1, 2, 3, 4]
        },
        {
          fillColor : "rgba(151,187,205,0.5)",
          strokeColor : "rgba(151,187,205,1)",
          pointColor : "rgba(151,187,205,1)",
          pointStrokeColor : "#fff",
          data : [250, 1000, 750, 320]
        }
      ]
    }

    var roundData = [
  {
    value: 30,
    color:"#F38630"
  },
  {
    value : 50,
    color : "#E0E4CC"
  },
  {
    value : 100,
    color : "#69D2E7"
  }
]

    var demoLineChart = new Chart(document.getElementById("demoLineChart").getContext("2d")).Line(demoData);
    var demoBarChart = new Chart(document.getElementById("demoBarChart").getContext("2d")).Bar(demoData);
    var demoRadarChart = new Chart(document.getElementById("demoRadarChart").getContext("2d")).Radar(demoData);
    var demoPolarChart = new Chart(document.getElementById("demoPolarChart").getContext("2d")).PolarArea(roundData);
    var demoPieChart = new Chart(document.getElementById("demoPieChart").getContext("2d")).Pie(roundData);
    var demoDoughnutChart = new Chart(document.getElementById("demoDoughnutChart").getContext("2d")).Doughnut(roundData);
  </script>
</div>
@endsection