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
        <h3><i class="fa fa-angle-right"></i> AQI Historic Data</h3>
        <!-- page start-->
        <div class="tab-pane" id="chartjs">
          <div class="row mt">
            <div class="col-lg-12">
              <div class="content-panel">
                <h4><i class="fa fa-angle-right"></i> Chart</h4>
                <div id="LineChart" style="width:100%;height:100%;"></div>
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


  <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> -->
  <script src="jquery-csv.js"></script>
  <script src="jquery.csv.min.js"></script>
  <script type="text/javascript" src="http://www.google.com/jsapi"></script>

  <!-- chart script start -->
  <script type="text/javascript">
  // Load google charts
  // load the visualization library from Google and set a listener
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);

  // this has to be a global function
  function drawChart() {
    // grab the CSV
    $.get("csv/AQI_history.csv", function(csvString) {
      // transform the CSV string into a 2-dimensional array
      var arrayData = $.csv.toArrays(csvString, {onParseValue: $.csv.hooks.castToScalar});

      // this new DataTable object holds all the data
      var data = new google.visualization.arrayToDataTable(arrayData);

      // this view can select a subset of the data at a time
      var view = new google.visualization.DataView(data);
      //view.setColumns([0,1]);

      // set chart options
      var options = {
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
        //pointsVisible: true,
        //hAxis: {title: data.getColumnLabel(0), minValue: data.getColumnRange(0).min, maxValue: data.getColumnRange(0).max},
        //vAxis: {title: "Air Data", minValue: 0, maxValue: 500},
        height:500
      };

      // create the chart object and draw it
      var chart = new google.visualization.LineChart(document.getElementById('LineChart'));
      chart.draw(view, options);
    });
  }

  $(window).resize(function(){
    drawChart();
  });

  </script>
</body>
</html>