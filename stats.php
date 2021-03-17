<!DOCTYPE html>
<html>
<head>
    <title>Disc Golf - Stats</title>
    <script src="js/libdisc.js"></script>
    <script src="js/libtable.js"></script>
    <?php include('include/head.php'); ?>
</head>
<body>
    <?php include('include/topnav.php'); ?>
    <div class="content">
        <h1>Statistics</h1>
        <?php

        include('include/display.php');
        $directory = 'ScriptFiles/';

        if (!is_dir($directory)) {
            exit('Invalid directory path');
        }

        buildTable($directory . 'stats.csv', 'Show');

        ?>
    </div>
</body>
</html>