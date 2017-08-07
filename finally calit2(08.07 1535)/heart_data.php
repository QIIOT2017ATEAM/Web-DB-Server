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
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
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
                    <li><a class="login" href="logout.php">Logout</a></li>
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
          <h3><i class="fa fa-angle-right"></i> Real-time Heart Data</h3>
              <!-- page start-->
              <div class="tab-pane" id="chartjs">
                  <div class="row mt">
                      <div class="col-lg-6">
                          <div class="content-panel">
                          <p style="text-align: center;">
                            <img src="heart2.gif" alt="heart GIF" style="width:400px;height:400px;">
                            </p>
                          </div>
                      </div>

                      <div class="col-lg-6">
                          <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Heartbeat Value</h4>
                            <font size=7><br>
                            <P id="heartbeatvalue" style="width:400px;height:225px;text-align:center"></P>
                            <br>
                            </font>
                          </div>
                      </div>
                      <!-- <div class="col-lg-6">
                          <div class="content-panel">
                              <h4><i class="fa fa-angle-right"></i> Heartbeat Value</h4>
                              <br><br><br>
                              <font size="7";color="#26352b"><p id="heartbeatvalue" style="text-align:center"></p></FONT> -->
                              <script>

                    var heartboxes_ignore = false;
                    function heartboxes(){
                      if (heartboxes_ignore) {
                        return;
                      }
                      heartboxes_ignore = true;

                      var comics = (function () {

                        var json = null;
                        $.ajax({
                          'async': false,
                          'global': false,
                          // your script that outputs json data ...
                          'url': "/slim-api/heart-as-json",
                          'dataType': "json",
                          complete: function() {
                            heartboxes_ignore = false;
                          },
                          'success': function (data) {
                            json = data;
                          }
                        });
                        return json;
                      })();
                      for (var hero in comics) {
                        $("#heartbeatvalue").html(comics[hero].heartbeatvalue);
                      }

                      setTimeout(heartboxes, 3000);
                    }
                    heartboxes();
                    </script>
                          </div>
                      </div>

                  </div>
                </div>
              <!-- page end-->
          </section>
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
       <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              <font>2017 - A-Team Hearbeat Realtime data</font>
              <a href="co_data.php#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>

    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>


    <!--script for this page-->
    <script src="assets/js/chart-master/Chart.js"></script>
    <script src="assets/js/chartjs-conf.js"></script>
</body>
</html>
