<!DOCTYPE html>
<html>
<head>
  <title>Disc Golf Score Tracker</title>
  <link rel="stylesheet" type="text/css" href="css/main.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
</head>
<body>
  <?php include 'include/topnav.include.php'; ?>

  <h1>17D Disc Golf Tour</h1>

  <?php
    $directory = 'games/';

    if (!is_dir($directory)) {
        exit('Invalid diretory path');
    }

    foreach (scandir($directory) as $file) {
        if ($file !== '.' && $file !== '..') {
            $lastfile = $file;
        }
    }
    Echo "<button type=\"button\" class=\"collapsible\">Most Recent Game</button>\n\n";
    Echo "<table class=\"content toggle\">\n\n";
    $f = fopen($directory.$lastfile, "r");
    while (($line = fgetcsv($f)) !== false) {
      Echo "<tr>";
      foreach ($line as $cell) {
        Echo "<td>" . htmlspecialchars($cell) . "</td>";
      }
      Echo "</tr>\n";
    }
    fclose($f);
    Echo "\n</table>";

    $command = escapeshellcmd('Python/lastWinner.py "'.$directory.$lastfile.'"');
    $output = shell_exec($command);
    Echo  "<h2>Last Winner: ".$output."</h2>";
  ?>
<script>
window.onload = function () {

var dataPoints = [];
 
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  exportEnabled: true,
  title:{
    text: "League's Average Performance"
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
 
$.get("ScriptFiles/Averages.csv", getDataPointsFromCSV);
 
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
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
  <script type="text/javascript" src="js/main.js"></script>
</body>
</html>