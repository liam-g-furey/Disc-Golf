<!DOCTYPE html>
<html>
<head>
  <title>Disc Golf - Stats</title>
  <?php include('include/head.php'); ?>
</head>
<body>
  <?php include 'include/topnav.php'; ?>

  <h1>Statistics</h1>

  <?php
  include('include/display.php');
    $directory = 'ScriptFiles/';

    if (!is_dir($directory)) {
        exit('Invalid diretory path');
    }

    buildTable($directory . "stats.csv", "Show");
  ?>
  

  <script type="text/javascript" src="js/main.js"></script>

</body>
</html>