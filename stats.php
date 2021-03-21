<!DOCTYPE html>
<html>
<head>
    <title>Disc Golf - Stats</title>
    <script src="js/libdisc.js"></script>
    <script src="js/libtable.js"></script>
    <?php include('include/head.php'); ?>
</head>
<body onload="populateStats(1, 'stats');">
    <?php include('include/topnav.php'); ?>
    <div class="content">
        <h1>Statistics</h1>
        <div class="collapsible">
            <button onclick="collapse('stats')">Toggle Stats</button>
            <div id="stats"></div>
        </div>
    </div>
</body>
</html>
