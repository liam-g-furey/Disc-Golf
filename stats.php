<!DOCTYPE html>
<html> 
 <title>Disc Golf Score Tracker</title>
 <div class="topnav">
  <a  href="/index.php">Home</a>
  <a href="/score.php">Score Cards</a>
  <a href="/stats.php">Stats</a>
  <a href="/courses.php">Courses</a>
</div>
 <body>
 <h1>Statistics</h1>
<?php
    $directory = 'ScriptFiles/';

    if (!is_dir($directory)) {
        exit('Invalid diretory path');
    }

    $command = escapeshellcmd('Python/totalWins.py');
    $output = shell_exec($command);
    Echo  "<h2> Total Wins </h2>";
    Echo "<html><body><table class='content'>\n\n";
    $f = fopen($directory. "Total_Wins.csv", "r");
    while (($line = fgetcsv($f)) !== false) {
      Echo "<tr>";
      foreach ($line as $cell) {
        Echo "<td>" . htmlspecialchars($cell) . "</td>";
      }
      Echo "</tr>\n";
    }
    fclose($f);
    Echo "\n</table></body></html>";

    $command = escapeshellcmd('Python/BestScore.py');
    $output = shell_exec($command);
    Echo  "<h2> Best Scores </h2>";
    Echo "<html><body><table class='content'>\n\n";
    $f = fopen($directory. "Best_scores.csv", "r");
    while (($line = fgetcsv($f)) !== false) {
      Echo "<tr>";
      foreach ($line as $cell) {
        Echo "<td>" . htmlspecialchars($cell) . "</td>";
      }
      Echo "</tr>\n";
    }
    fclose($f);
    Echo "\n</table></body></html>";

    $command = escapeshellcmd('Python/WorstScore.py');
    $output = shell_exec($command);
    Echo  "<h2> Worst Scores </h2>";
    Echo "<html><body><table class='content'>\n\n";
    $f = fopen($directory. "Worst_scores.csv", "r");
    while (($line = fgetcsv($f)) !== false) {
      Echo "<tr>";
      foreach ($line as $cell) {
        Echo "<td>" . htmlspecialchars($cell) . "</td>";
      }
      Echo "</tr>\n";
    }
    fclose($f);
    Echo "\n</table></body></html>";
?>
<style>


.content {
  padding: 0 18px;
  overflow: hidden;
  background-color: #f1f1f1;
}
.topnav {
  background-color: #333;
  overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Add a color to the active/current link */
.topnav a.active {
  background-color: #4CAF50;
  color: white;
}
</style>
 </body>
 </html>