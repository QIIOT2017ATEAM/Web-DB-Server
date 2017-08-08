<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>A-team chart</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo"><b>Team A IOT</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="login" href="login.php">Login</a></li>
                    <li><a class="sign_up" href="sign_up.php">Sign-up</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="index.php"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
              	  <h5 class="centered">Not Login</h5>
              	  	
                  <li class="sub-menu">
            <a href="javascript:;" >
              <i class=" fa fa-clock-o"></i>
              <span>RealTime</span>
            </a>
            <ul class="sub">
              <li><a  href="co_data.php">CO</a></li>
              <li><a  href="no2_data.php">NO2</a></li>
              <li><a  href="so2_data.php">SO2</a></li>
              <li><a  href="o3_data.php">O3</a></li>
              <li><a  href="pm25_data.php">PM25</a></li>
            </ul>  
          </li>
          <li class="mt">
              <a href="historical_data.php">
                <i class="fa fa-history"></i>
                  <span>Historical</span>
              </a>
          </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          <h3><i class="fa fa-angle-right"></i> AQI Air Data(O3)</h3>
              <!-- page start-->
              <div class="tab-pane" id="chartjs">
                  <div class="row mt">
                      <div class="col-lg-12">
                          <div class="content-panel">
                              <h4><i class="fa fa-angle-right"></i> Map</h4>
                              <div id="map" style="width:100%;height:300px;"></div>
                          </div>
                      </div>
                  </div>
                  <div class="row mt">
                      <div class="col-lg-12">
                          <div class="content-panel">
                              <h4><i class="fa fa-angle-right"></i> Chart</h4>
                              <div id="LineChart" style="width:100%;height:100%;"></div>
                          </div>
                      </div>
                   </div>
                      <!--
                      <div class="col-lg-12">
                          <div class="content-panel">
							  <h4><i class="fa fa-angle-right"></i> Chart</h4>
                          </div>
                      </div>
                      -->
                </div>
              <!-- page end-->
          </section>          
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
       <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2017 - A-Team
              <a href="co_data.php#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>

    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="assets/js/chart-master/Chart.js"></script>
    <script src="assets/js/chartjs-conf.js"></script>

    <!-- Map script -->
    <script>
      var air = (function ()
      {
        var json = null;
        $.ajax(
        {
          'async': false,
          'global': false,
          // your script that outputs json data …
          'url': "slim-api/air-as-json",
          'dataType': "json",
          'success': function (data)
          {
            json = data;
          }
        });
      return json;
      })();

      function initMap()
      {
        // Create the map.
        var map = new google.maps.Map(document.getElementById('map'),
        {
          zoom: 18,
  center: {lat: 32.882407, lng: -117.234817},
  mapTypeId: google.maps.MapTypeId.ROAD
        });
      // Construct the circle for each value in citymap.
      // Note: We scale the area of the circle based on the population.
      for (var data in air)
{
if(air[data].co <= 50)
{
var cityCircle = new google.maps.Circle
(
{
  strokeColor: '#00ff08',
  strokeOpacity: 0.8,
  strokeWeight: 2,
  fillColor: '#98f29b',
  fillOpacity: 0.35,
  map: map,
  center: air[data].center,
  radius: 25
}
);
}
else if(air[data].co <= 100)
{
var cityCircle = new google.maps.Circle
(
{
  strokeColor: '#F4F122',
  strokeOpacity: 0.8,
  strokeWeight: 2,
  fillColor: '#F7F5A0',
  fillOpacity: 0.35,
  map: map,
  center: air[data].center,
  radius: 25
}
);
}
else if(air[data].co <= 150)
{
var cityCircle = new google.maps.Circle
(
{
  strokeColor: '#ff9000',
  strokeOpacity: 0.8,
  strokeWeight: 2,
  fillColor: '#e8c276',
  fillOpacity: 0.35,
  map: map,
  center: air[data].center,
  radius: 25
}
);
}
else if(air[data].co <= 200)
{
var cityCircle = new google.maps.Circle
(
{
  strokeColor: '#FF0000',
  strokeOpacity: 0.8,
  strokeWeight: 2,
  fillColor: '#dd7575',
  fillOpacity: 0.35,
  map: map,
  center: air[data].center,
  radius: 25
}
);
}
else if(air[data].co <= 300)
{
var cityCircle = new google.maps.Circle
(
{
  strokeColor: '#a01088',
  strokeOpacity: 0.8,
  strokeWeight: 2,
  fillColor: '#ce90c4',
  fillOpacity: 0.35,
  map: map,
  center: air[data].center,
  radius: 25
}
);
}
else if(air[data].co <= 500)
{
var cityCircle = new google.maps.Circle
(
{
  strokeColor: '#9b0000',
  strokeOpacity: 0.8,
  strokeWeight: 2,
  fillColor: '#a53131',
  fillOpacity: 0.35,
  map: map,
  center: air[data].center,
  radius: 25
}
);
}


}
}
      </script>
      <!-- map ajax end -->

      <script async defer
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXMKBcstoboBgrHBcho5saILTBq3PHtPQ&callback=initMap">
      </script>

<!-- map script end -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<!-- chart script start -->
<script type="text/javascript">
// Load google charts
google.charts.load("visualization", "1", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart);

//google.charts.load('current', {'packages':['corechart']});  //필수
//google.charts.setOnLoadCallback(drawChart); //필수
// Draw the chart and set the chart values

    var drawChart_ignore = false;
    function drawChart() 
    {
      if (drawChart_ignore) 
      {
        return;
      }
      drawChart_ignore = true;

      var jsonData = $.ajax({
                url: "/slim-api/o3_dynamic_chart_json",
                dataType:"json",
                complete: function() 
                {
                  drawChart_ignore = false;
                },
                async: false
                }).responseText;

      var data = new google.visualization.DataTable(jsonData);

      // Optional; add a title and set the width and height of the chart
      var options = 
      {
        vAxis: 
              {
                title:'Unit : ppm',
                viewWindowMode: 'explicit',
                viewWindow: 
                {
                  max: 60,
                  min: 0,
                },
              },
        curveType: 'function',
        pointsVisible: true,
        //'width':1250, 
        'height':300
      };

      // Display the chart inside the <div> element with id="piechart"
      var chart = new google.visualization.LineChart(document.getElementById('LineChart'));
      chart.draw(data, options);
      setTimeout(drawChart, 3000);
    }

    $(window).resize(function(){
      drawChart();
    });

    </script>
  </body>
</html>