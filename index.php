<!DOCTYPE html>
<html>
<head>
    <title>Disc Golf Score Tracker</title>
    <script src="js/libdisc.js"></script>
    <script src="js/libtable.js"></script>
    <?php include('include/head.php'); ?>
</head>
<body onload="populateLastGame('game');">
    <?php include('include/topnav.php'); ?>
    <div class="content">
        <h1>17D Disc Golf Tour</h1>
        <p><b>Most Recent Game</b></p>
        <div class="collapsible">
            <button onclick="collapse('game')">Show Game</button>
            <div id="game"></div>
        </div>

        <div id="chartContainer" style="width: 100%;"></div>
    </div>

    <!-- <script>
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
    </script> -->

    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
