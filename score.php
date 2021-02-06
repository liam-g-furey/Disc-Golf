<!DOCTYPE html>
<html>
<head>
  <title>Disc Golf - Score</title>
  <?php include('include/head.php'); ?>
</head>
<body>
  <?php include 'include/topnav.php'; ?>

  <h1>All Score Cards</h1>

  <?php
      $directory = 'games/';

      if (!is_dir($directory)) {
          exit('Invalid diretory path');
      }

      foreach (scandir($directory) as $file) {
          if ($file !== '.' && $file !== '..') {
              echo "<button type=\"button\" class=\"collapsible\">".$file."</button>\n\n";
              echo "<table class=\"content toggle\">\n\n";
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