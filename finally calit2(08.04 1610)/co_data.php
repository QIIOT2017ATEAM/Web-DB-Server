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
              <li><a  href="temperature_data.php">TEMP</a></li>
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
          <h3><i class="fa fa-angle-right"></i> AQI Air Data(CO)</h3>
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
                              <div id="chart" style="width:100%;height:300px;"></div>
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
    <script>
    var air =
    (function ()
    {
      var json = null;
      $.ajax
      (
        {
          'async': false,
          'global': false,
          // your script that outputs json data ...
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
  function initMap()
  {
    // Create the map.
    var map = new google.maps.Map(document.getElementById('map'),
    {
      zoom: 7,
      center: {lat: 32.870000, lng: -117.230000},
      mapTypeId: google.maps.MapTypeId.ROAD
    }
  );

  // Construct the circle for each value in citymap.
  // Note: We scale the area of the circle based on the population.
  for (var data in air)
  {
    // Add the circle for this city to the map.
    if(10 >= air[data].population)
    {
      var cityCircle = new google.maps.Circle(
        {
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF0000',
          fillOpacity: 0.35,
          map: map,
          center: air[data].center,
          radius: Math.sqrt(air[data].population) * 1000
        });
      }
      else if(20 >= air[data].population)
      {
        var cityCircle = new google.maps.Circle(
          {
            strokeColor: '#0000FF',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#0000FF',
            fillOpacity: 0.35,
            map: map,
            center: air[data].center,
            radius: Math.sqrt(air[data].population) * 1000
          });
        }
        else if(50 >= air[data].population)
        {
          var cityCircle = new google.maps.Circle(
            {
              strokeColor: '#00FF00',
              strokeOpacity: 0.8,
              strokeWeight: 2,
              fillColor: '#00FF00',
              fillOpacity: 0.35,
              map: map,
              center: air[data].center,
              radius: Math.sqrt(air[data].population) * 1000
            });
          }}}
          </script>
          <script async defer
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXMKBcstoboBgrHBcho5saILTBq3PHtPQ&callback=initMap">
          </script>
</body>
</html>