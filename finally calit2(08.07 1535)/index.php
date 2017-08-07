<?php
session_start();
if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_password']) || !isset($_SESSION['first_name']))
{
  //로그인이 되어있지 않다면 아래를 실행한다.
  //echo "<meta http-equiv='refresh' content='0;url=index.php'>";
}
else
{
  //로그인이 되어 있을경우
  echo "<meta http-equiv='refresh' content='0;url=index_already_login.php'>";
}
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
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Function"></div>
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
          <li><a class="sign_up" href="./sign_up.php">Sign-up</a></li>
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
        <div class="row">
          <div class="col-lg-9 main-chart" style="width:100%">


            <div class="row mt">
              <!-- SERVER STATUS PANELS -->
              <div class="col-md-4 col-sm-4 mb">
                <div class="white-panel pn">
                  <div class="white-header">
                    <font color="#46875b"><h3>CO(Carbon Monoxide)</h3></font>
                  </div>
                  <font size="7" color="#26352b"><p id="co"></p></FONT>
                    <script>
                    var aqiboxes_ignore = false;
                    function aqiboxes(){
                      if (aqiboxes_ignore) {
                        return;
                      }
                      aqiboxes_ignore = true;

                      var comics = (function () {

                        var json = null;
                        $.ajax({
                          'async': false,
                          'global': false,
                          // your script that outputs json data ...
                          'url': "/slim-api/air-as-json",
                          'dataType': "json",
                          complete: function() {
                            aqiboxes_ignore = false;
                          },
                          'success': function (data) {
                            json = data;
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

                      setTimeout(aqiboxes, 3000);
                    }

                    </script>

                  </div><!--/grey-panel -->
                </div><!-- /col-md-4-->

                <div class="col-md-4 col-sm-4 mb">
                  <div class="white-panel pn">
                    <div class="white-header">
                      <font color="#46875b"><h3> NO2(Nitrogen Dioxide)</h3></font>
                    </div>
                    <font size="7" color="#26352b"><p id="no2"></p></FONT>

                    </div>
                  </div><!-- /col-md-4 -->

                  <div class="col-md-4 mb">
                    <!-- WHITE PANEL - TOP USER -->
                    <div class="white-panel pn">
                      <div class="white-header">
                        <font color="#46875b"><h3>SO2(Oxygen Sturation)</h3></font>
                      </div>
                      <FONT size="7" color="#26352b"><p id="so2"></p></FONT>

                    </div>
                  </div><!-- /col-md-4 -->




                  <div class="col-md-4 mb">
                    <div class="white-panel pn">
                      <div class="white-header">
                        <font color="#46875b"><h3>O3(Ozone)</h3></font>
                      </div>
                      <font size="7" color="#26352b"><p id="o3"></p></FONT>


                      </div>
                    </div><!-- /col-md-4 -->


                    <div class="col-md-4 mb">
                      <!-- INSTAGRAM PANEL -->
                      <div class="white-panel pn">
                        <div class="white-header">
                          <font color="#46875b"><h3>PM2.5(Particular Matter)</h3></font>
                        </div>
                        <font size="7" color="#26352b"><p id="pm25"></p></FONT>


                        </div>
                      </div><!-- /col-md-4 -->


                      <div class="col-md-4 col-sm-4 mb">
                        <!-- REVENUE PANEL -->
                        <div class="white-panel pn">
                          <div class="white-header">
                            <font color="#46875b"><h3>Temperature</h3></font>
                          </div>
                          <font size="7" color="#26352b"><p id="temperature"></p></FONT>

                          </div>
                        </div><!-- /col-md-4 -->
                      </div><!-- /row -->
                    </div><!-- /col-lg-9 END SECTION MIDDLE -->
                    <button type="button" class="btn btn-round btn-primary" style="margin-left:50px">CO</button>
                    <button type="button" class="btn btn-round btn-success" style="margin-left:10px">NO2</button>
                    <button type="button" class="btn btn-round btn-info" style="margin-left:10px">SO2</button>
                    <button type="button" class="btn btn-round btn-warning" style="margin-left:10px">O3</button>
                    <button type="button" class="btn btn-round btn-danger" style="margin-left:10px">PM2.5</button>
                    <br></br>
                    <div id="map" style="width:90%;height:300px;margin-left:50px"></div>
                    <script src="comap.js"></script>
                    <!-- <script src="no2map.js"></script> -->

                    </section>

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

                  <script async defer
                  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXMKBcstoboBgrHBcho5saILTBq3PHtPQ&callback=initMap">
                  </script>
                  <!—common script for all pages—>
                  <script src="assets/js/common-scripts.js"></script>
                  <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
                  <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

                  <!—script for this page—>
                  <script src="assets/js/sparkline-chart.js"></script>
                  <script src="assets/js/zabuto_calendar.js"></script>
                </body>
                </html>
