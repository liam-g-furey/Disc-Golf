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

    $command = escapeshellcmd('python3 Python/totalWins.py');
    $output = shell_exec($command);
    echo  "<h2> Total Wins </h2>";
    buildTable($directory . "Total_Wins.csv", "Show");

    $command = escapeshellcmd('python3 Python/BestScore.py');
    $output = shell_exec($command);
    echo  "<h2> Best Scores </h2>";
    buildTable($directory . "Best_scores.csv", "Show");

    $command = escapeshellcmd('python3 Python/WorstScore.py');
    $output = shell_exec($command);
    echo  "<h2> Worst Scores </h2>";
    buildTable($directory . "Worst_scores.csv", "Show");
  ?>
  

  <script type="text/javascript" src="js/main.js"></script>

</body>
</html>