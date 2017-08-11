<!DOCTYPE html>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
// Load google charts
//google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart); //필수

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['Work', 8],
  ['Eat', 2],
  ['TV', 4],
  ['Gym', 2],
  ['Sleep', 8]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'My Average Day', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.LineChart(document.getElementById('LineChart'));
  chart.draw(data, options);
}
</script>

<html lang="en-US">
    <body>
        <div id="LineChart"></div>
    </body>
</html>