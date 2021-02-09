<!DOCTYPE html>
<html>
<head>
  <title>Disc Golf Score Tracker</title>
  <?php include('include/head.php'); ?>
</head>
<body>
  <?php include('include/topnav.php'); ?>
  
  <h1>17D Disc Golf Tour</h1>
  <button class="collapsible">Most Recent Game</button>
  <table class="content toggle">

  <?php
    $directory = 'games/';

    $files = glob("$directory*.csv");
    $lastfile = end($files);
    $f = fopen($lastfile, "r");
    while (($line = fgetcsv($f)) !== false) {
      echo "<tr>";
      foreach ($line as $cell) {
        echo "<td>" . htmlspecialchars($cell) . "</td>";
      }
      echo "</tr>\n";
    }
    fclose($f);
    echo "</table>";

    $command = "python3 Python/getWinner.py \"$lastfile\"";
    $output = shell_exec($command);
    echo  "<h2>Last Winner: ".$output."</h2>";
  ?>
<script>
window.onload = function () {

var dataPoints = [];
 
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  exportEnabled: true,
  title:{
    text: "Weighted Average Performance"
  },
  axisY: {
    title: "Strokes"
  },
  data: [{
    type: "column",
    toolTipContent: "{y} strokes over",
    dataPoints: dataPoints
  }]
});
 
$.get("ScriptFiles/WeightedAveragePerformance.csv", getDataPointsFromCSV);
 
//CSV Format
//Year,Volume
function getDataPointsFromCSV(csv) {
  var csvLines = points = [];
  csvLines = csv.split(/[\r?\n|\r|\n]+/);
  for (var i = 0; i < csvLines.length; i++) {
    if (csvLines[i].length > 0) {
      points = csvLines[i].split(",");
      dataPoints.push({
        label: points[0],
        y: parseFloat(points[1])
      });
    }
  }
  chart.render();
}
 
}
</script>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
