<!DOCTYPE html>
<html>
<head>
  <title>Disc Golf Score Tracker</title>
  <?php include('include/head.php'); ?>
</head>
<body>
  <?php include('include/topnav.php'); ?>
  <div class="content">
    <h1>17D Disc Golf Tour</h1>
    <?php

    include('include/display.php');
    $directory = 'games/';
    $files = glob("$directory*.csv");
    $lastfile = end($files);

    if (!stripos($lastfile,"_formatted")){
      $command = "python3 Python/formatGame.py \"$lastfile\"";
      $output = shell_exec($command);
      $lastfile = ($lastfile . "_formatted.csv");
    }

    $command = "python3 Python/getWinner.py \"$lastfile\"";
    $output = shell_exec($command);
    echo  "<h2>Last Winner: ".$output."</h2>";

    buildTable($lastfile, "Show Last Game");
    ?>
  
    <div id="chartContainer" style="width: 100%;"></div>
  </div>
  

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
 
  $.get("ScriptFiles/WeightedAveragePerformance.csv?d=" + (new Date()).getTime(), getDataPointsFromCSV);
 
  //CSV Format
  //Year,Volume
  function getDataPointsFromCSV(csv) {
    var csvLines = points = [];
    csvLines = csv.split(/[\r?\n|\r|\n]+/);
    console.log(csvLines);
    for (var i = 0; i < csvLines.length; i++) {
      if (csvLines[i].length > 0) {
        points = csvLines[i].split(",");
        console.log(points)
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

  <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
