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

  <h1>All Score Cards</h1>

  <?php
      $directory = 'games/';

      if (!is_dir($directory)) {
          exit('Invalid diretory path');
      }

      foreach (scandir($directory) as $file) {
          if ($file !== '.' && $file !== '..') {
              echo "<button type=\"button\" class=\"collapsible\">".$file."</button>\n\n";
              echo "<table class=\"content\">\n\n";
              $f = fopen($directory.$file, "r");
              while (($line = fgetcsv($f)) !== false) {
                echo "<tr>";
                foreach ($line as $cell) {
                  echo "<td>" . htmlspecialchars($cell) . "</td>";
                }
                echo "</tr>\n";
              }
              fclose($f);
              echo "\n</table>";
          }
      }
  ?>

  <script type="text/javascript" src="js/main.js"></script>
</body>
</html>