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

  <title>Index</title>

  <!-- Bootstrap core CSS -->
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <!--external css-->
  <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
  <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">
  <!-- Custom styles for this template -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/style-responsive.css" rel="stylesheet">
  <script src="assets/js/chart-master/Chart.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>

<body>
  <section id="container" >
    <!-- **********************************************************************************************************************************************************
    TOP BAR CONTENT & NOTIFICATIONS
    *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" air-placement="right" air-original-title="Function"></div>
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
        <div class="row">
          <div class="col-lg-12">
                    <div class="content-panel">
                    <h4><i class="fa fa-angle-right"></i>&nbsp;Air_Pollution_Table</h4>
                        <section id="unseen">
                          <table class="table table-bordered table-striped table-condensed">
                            <thead>
                            <tr>
                                <th class="numeric" style="background-color:#fffbef"><font size=5 color="#1e1e1b">CO</font></th>
                                <th class="numeric" style="background-color:#fffbef"><font size=5 color="#1e1e1b">NO2</font></th>
                                <th class="numeric" style="background-color:#fffbef"><font size=5 color="#1e1e1b">SO2</font></th>
                                <th class="numeric" style="background-color:#fffbef"><font size=5 color="#1e1e1b">O3</font></th>
                                <th class="numeric" style="background-color:#fffbef"><font size=5 color="#1e1e1b">PM2.5</font></th>
                                <th class="numeric" style="background-color:#fffbef"><font size=5 color="#1e1e1b">Temp</font></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                              <th class="numeric"><font size=5 text-align:center><p id="co"></p></font></th>
                              <th class="numeric"><font size=5 text-align:center><p id="no2"></p></font></th>
                              <th class="numeric"><font size=5 text-align:center><p id="so2"></p></font></th>
                              <th class="numeric"><font size=5 text-align:center><p id="o3"></p></font></th>
                              <th class="numeric"><font size=5 text-align:center><p id="pm25"></p></font></th>
                              <th class="numeric"><font size=5 text-align:center><p id="temperature"></p></font></th>
                            </tr>
                            </tbody>
                        </table>
                        </section>
                </div><!-- /content-panel -->
             </div><!-- /col-lg-4 -->

                      </div><!-- /row -->
                    </div><!-- /col-lg-9 END SECTION MIDDLE -->
                    <br>
                    <h5>▼ Current sensor location</h5>
                    <div id="map" style="width:95%;height:400px;margin-left:27px">
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
                  var markers = [];
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
                    createMarkers(markerJson);

                    // Create the search box and link it to the UI element.

                    // Bias the SearchBox results towards current map's viewport.
                    map.addListener('bounds_changed', function() {
                    });
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

                  var aqiboxes_ignore = false;
                  function aqiboxes(){
                    if (aqiboxes_ignore) {
                      return;
                    }
                    aqiboxes_ignore = true;

                    var comics = (function () {
                      var json = null;
                      var allData = { "macaddress": save_sensor};
                      $.ajax({
                        type:'POST',
                        data: allData,
                        async: false,
                        global: false,
                        // your script that outputs json data ...
                        url: "/slim-api/air-as-json",
                        dataType: "json",
                        complete: function() {
                          aqiboxes_ignore = false;
                        },
                        'success': function (data) {
                          json = data;
                          //alert($macaddress);
                        }
                      });
                      return json;
                    })();
                    for (var hero in comics) {
                      $("#co").html(comics[hero].co);
                      $("#no2").html(comics[hero].no2);
                      $("#so2").html(comics[hero].so2);
                      $("#o3").html(comics[hero].o3);
                      $("#pm25").html(comics[hero].pm25);
                      $("#temperature").html(comics[hero].temperature);
                    }

                    window.setTimeout(aqiboxes, 2000);
                  }aqiboxes();
                  </script>
                  <!-- map ajax end -->

                  <script async defer
                  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXMKBcstoboBgrHBcho5saILTBq3PHtPQ&callback=initAutocomplete">
                  </script>

                  <!-- map script end ???-->
                  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

                </body>
                </html>
              </script>
              <!-- <script src="co.js"></script>
              <script src="no2.js"></script> -->

              <!—main content end—>
              <!—footer start—>
              <footer class="site-footer">
                <div class="text-center">
                  2017 - A-Team
                  <a href="index.php#" class="go-top">
                    <i class="fa fa-angle-up"></i>
                  </a>
                </div>
              </footer>
              <!—footer end—>
            </section>

            <!— js placed at the end of the document so the pages load faster —>
            <script src="assets/js/jquery.js"></script>
            <script src="assets/js/jquery-1.8.3.min.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>
            <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
            <script src="assets/js/jquery.scrollTo.min.js"></script>
            <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
            <script src="assets/js/jquery.sparkline.js"></script>
            <!—common script for all pages—>
            <script src="assets/js/common-scripts.js"></script>
            <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
            <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

            <!—script for this page—>
            <script src="assets/js/sparkline-chart.js"></script>
            <script src="assets/js/zabuto_calendar.js"></script>
