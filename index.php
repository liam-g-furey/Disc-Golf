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
    Echo "<table class='content'>\n\n";
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

  <script type="text/javascript" src="js/main.js"></script>
</body>
</html>