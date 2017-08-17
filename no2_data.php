<?php
session_start();
?>
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
<style type = "text/css">
.bar{
    display: flex;
    flex-direction: row;
  }
  .bar div{
    display: table-cell;
    width: 18%;
    text-align: center;
    vertical-align: middle;
    padding-top: 5px;
  }
</style>

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
          <?php
          if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_password']) || !isset($_SESSION['first_name']))
          {
            //로그인이 되어있지 않다면 아래를 실행한다.
            ?>
            <li><a class="login" href="login.php">Login</a></li>
            <li><a class="sign_up" href="sign_up.php">Sign-up</a></li>
            <?php
          }
          else
          {
            //로그인이 되어 있을경우
            ?>
            <li><a class="login" href="password_change.php">Password Change</a></li>
            <li><a class="login" href="logout.php">Logout</a></li>
            <?php
          }
          ?>
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
          <h5 class="centered">
            <?php
            if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_password']) || !isset($_SESSION['first_name']))
            {
              //로그인이 되어있지 않다면 아래를 실행한다.
              ?>
              Not Logged In
              <?php
            }
            else
            {
              //로그인이 되어 있을경우
              echo $_SESSION['user_id'];
            }
            ?>
          </h5>
          <li class="sub-menu">
            <a href="javascript:;" >
              <i class=" fa fa-clock-o"></i>
              <span>Air-Pollution-Data</span>
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
          <?php
          if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_password']) || !isset($_SESSION['first_name']))
          {
            //로그인이 되어있지 않다면 아래를 실행한다.
            //echo "<meta http-equiv='refresh' content='0;url=index.php'>";
          }
          else
          {
            //로그인이 되어 있을경우
            //echo "<meta http-equiv='refresh' content='0;url=co_data_already_login.php'>";
            ?>
            <li class="sub-menu">
              <a href="javascript:;" >
                <i class=" fa fa-heartbeat"></i>
                <span>Heart</span>
              </a>
              <ul class="sub">
                <li><a  href="heart_data.php">RealTime</a></li>
                <li><a  href="heart_historical_data.php">Historical</a></li>
              </ul>
            </li>
            <?php
          }
          ?>
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
        <h3><i class="fa fa-angle-right"></i> AQI Air Data(NO2)</h3>
        <div class="bar" style="margin-top : 20px;">
            <div style="background-color:#00ff08; color:#000000; font-weight: bold;">
              Good
            </div>
            <div style="background-color:#F4F122; color:#000000; font-weight: bold;">
              Moderate
            </div>
            <div style="background-color:#ff9000; color:#000000; font-weight: bold;">
              Unhealthy for Sensitive Goups
            </div>
            <div style="background-color:#FF0000; color:#ffffff; font-weight: bold;">
              Unhealthy
            </div>
            <div style="background-color:#a01088; color:#ffffff; font-weight: bold;">
              Very Unhealthy
            </div>
            <div style="background-color:#9b0000; color:#ffffff; font-weight: bold;">
              Harzadous
            </div>
        </div>
        <!-- page start-->
        <div class="tab-pane" id="chartjs">
          <div class="row mt">
            <div class="col-lg-12">
                <div id="map" style="width:100%;height:270px;"></div>
            </div>
          </div>
          <div class="row mt">
            <div class="col-lg-12">
                <div id="LineChart" style="width:100%;height:100%;"></div>
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
var save_sensor = "";
// markerJson start
var markerJson =
(function ()
{
  var json = null;
  $.ajax({
    'async': false,
    'global': false,
    // your script that outputs json data …
    'url': "slim-api/test-air-as-json",
    'dataType': "json",
    'success': function (data)
    {
      json = data;
    }
  }
);
return json;
}
)();
// markerJson end

// map start
var map;
var circles = [];
var markers = [];
var cityCircle;
var cityMarker;

// Initialize our goo
function initAutocomplete()
{
  var options =
  {
    center:{lat: 32.882407, lng: -117.234817},
    zoom: 17,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  map = new google.maps.Map(document.getElementById("map"), options);

  // Create markers into DOM
  createMarkers();

  // Create Cricles into DOM
  createCircles2();
  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
  });

  // [START region_getplaces]
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
}

// Instantiate markers in the background and pass it back to the json object
var createMarkers_ignore = false;
function createMarkers() {
  if (createMarkers_ignore) {
    return;
  }
  createMarkers_ignore = true;
  var markerJson = (function () {
    var json = null;
    $.ajax({
      async: false,
      global: false,
      // your script that outputs json data ...
      url: "/slim-api/test-air-as-json",
      dataType: "json",
      complete: function() {
        createMarkers_ignore = false;
      },
      'success': function (data) {
        json = data;
      }
    });
    return json;
  })();

  removeAllmarkers();

  for (var id in markerJson) {
    cityMarker = new google.maps.Marker({
      map: map,
      icon:'B.png',
      id: markerJson[id].id,
      position: markerJson[id].center,
      macaddress: markerJson[id].macaddress
    });markers.push(cityMarker);

    // This attaches unique infowindows to each marker
    // You could otherwise do a global infowindow var and have it overwrite itself
    cityMarker.infowindow = new google.maps.InfoWindow({
      content: "This sensor is called " + markerJson[id].macaddress
    });

    cityMarker.addListener('click', function() {
      this.infowindow.open(map, this);
      save_sensor = this.macaddress;
    });
    markerJson[id].cityMarker = cityMarker;
  }
  window.setTimeout(createMarkers, 3000);

  function removeAllmarkers()
  {
    console.log('No Markers');
    for(var i in markers) {
      markers[i].setMap(null);
    }
    markers = []; // this is if you really want to remove them, so you reset the variable.
  }
}

var createCircles2_ignore = false;
function createCircles2(){
  if (createCircles2_ignore) {
    return;
  }
  createCircles2_ignore = true;

  var markerJson = (function () {
    var json = null;
    $.ajax({
      async: false,
      global: false,
      // your script that outputs json data ...
      url: "/slim-api/test-air-as-json",
      dataType: "json",
      complete: function() {
        createCircles2_ignore = false;
      },
      'success': function (data) {
        json = data;
      }
    });
    return json;
  })();

  removeAllcircles();

  for (var data in markerJson)
  {
    if(markerJson[data].no2 <= 50)
    {
      cityCircle = new google.maps.Circle
      (
        {
          strokeColor: '#00ff08',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#98f29b',
          fillOpacity: 0.35,
          map: map,
          center: markerJson[data].center,
          radius: 35
        }
      );circles.push(cityCircle);
    }
    else if(markerJson[data].no2 <= 100)
    {
      cityCircle = new google.maps.Circle
      (
        {
          strokeColor: '#F4F122',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#F7F5A0',
          fillOpacity: 0.35,
          map: map,
          center: markerJson[data].center,
          radius: 35
        }
      );circles.push(cityCircle);
    }
    else if(markerJson[data].no2 <= 150)
    {
      cityCircle = new google.maps.Circle
      (
        {
          strokeColor: '#ff9000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#e8c276',
          fillOpacity: 0.35,
          map: map,
          center: markerJson[data].center,
          radius: 35
        }
      );circles.push(cityCircle);
    }
    else if(markerJson[data].no2 <= 200)
    {
      cityCircle = new google.maps.Circle
      (
        {
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#dd7575',
          fillOpacity: 0.35,
          map: map,
          center: markerJson[data].center,
          radius: 35
        }
      );circles.push(cityCircle);
    }
    else if(markerJson[data].no2 <= 300)
    {
      cityCircle = new google.maps.Circle
      (
        {
          strokeColor: '#a01088',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#ce90c4',
          fillOpacity: 0.35,
          map: map,
          center: markerJson[data].center,
          radius: 35
        }
      );circles.push(cityCircle);
    }
    else if(markerJson[data].no2 <= 500)
    {
      cityCircle = new google.maps.Circle
      (
        {
          strokeColor: '#9b0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#a53131',
          fillOpacity: 0.35,
          map: map,
          center: markerJson[data].center,
          radius: 35
        }
      );circles.push(cityCircle);
    }
    else if(markerJson[data].no2 > 500)
    {
      cityCircle = new google.maps.Circle
      (
        {
          strokeColor: '#141419',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#67676d',
          fillOpacity: 0.35,
          map: map,
          center: markerJson[data].center,
          radius: 35
        }
      );circles.push(cityCircle);
    }
  }
  window.setTimeout(createCircles2, 3000);

  function removeAllcircles()
  {
    console.log('No Markers');
    for(var i in circles) {
      circles[i].setMap(null);
    }
    circles = []; // this is if you really want to remove them, so you reset the variable.
  }
}

</script>
<!-- map ajax end -->

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXMKBcstoboBgrHBcho5saILTBq3PHtPQ&callback=initAutocomplete">
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

  var allData = { "macaddress": save_sensor};
  var jsonData =
  $.ajax({
    type:'POST',
    data: allData,
    async: false,
    global: false,
    url: "/slim-api/no2_dynamic_chart_json",
    dataType:"json",
    complete: function()
    {
      drawChart_ignore = false;
    },
  }).responseText;

  var data = new google.visualization.DataTable(jsonData);

  // Optional; add a title and set the width and height of the chart
  var options =
  {
    vAxis:
    {
      viewWindowMode: 'explicit',
      viewWindow:
      {
        max: 500,
        min: 0,
      },
    },
    curveType: 'function',
    pointsVisible: true,
    //'width':1250,
    'height':250
  };

  // Display the chart inside the <div> element with id="pLineChartiechart"
  var chart = new google.visualization.LineChart(document.getElementById('LineChart'));
  chart.draw(data, options);
  window.setTimeout(drawChart, 3000);
}drawChart();

// $(window).resize(function(){
//   drawChart();
// });

</script>
</body>
</html>
