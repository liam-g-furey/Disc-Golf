<!DOCTYPE html>
<html> 
<head>
    <link rel="stylesheet" type="text/css" href="css/tables.css" media="screen"/>

 <title>Disc Golf Score Tracker</title>
 <div class="topnav">
  <a  href="/index.php">Home</a>
  <a href="/score.php">Score Cards</a>
  <a href="/stats.php">Stats</a>
  <a href="/courses.php">Courses</a>
</div>
 <body>
 <h1>17D Disc Golf Tour</h1>
 

<?php
    $directory = 'games/';

    if (!is_dir($directory)) {
        exit('Invalid diretory path');
    }

    
    Echo "<button type='button' class='collapsible'>Most Recent Game</button>\n\n";
    Echo "<html><body><table class='styled-table'>\n\n";



    Echo "<thead class='Table_THEAD'>\n";

    Echo "<tr class='Table_TR'>\n";
    Echo "<th class='Table_TH'> POS </th>\n";
    Echo "<th class='Table_TH'> PLAYER </th>\n";
    Echo "<th class='Table_TH'> TO PAR </th>\n";
    Echo "<th class='Table_TH'> FR </th>\n";
    Echo "<th class='Table_TH'> BK </th>\n";
    Echo "<th class='Table_TH'> TOT </th>\n";

    Echo "</tr>\n";

    Echo "</thead>\n";

    foreach (scandir($directory) as $file) {
        if ($file !== '.' && $file !== '..') {
            $lastfile = $file;
        }
    }

    if (!str_contains($lastfile,"_formatted")){
      $command = escapeshellcmd('Python/formatGame.py "'.$directory.$lastfile.'"');
      $output = shell_exec($command);
      $lastfile = ($lastfile . "_formatted.csv");
    }


    $f = fopen($directory.$lastfile, "r");
    if ($f){
      while (($line = fgetcsv($f)) !== false) {
        Echo "<tr>";
        foreach ($line as $cell) {
          Echo "<td class='Table_TD'>" . htmlspecialchars($cell) . "</td>";
        }
        Echo "</tr>\n";
      }
    fclose($f);
    } else {
      die("Unable to open $directory.$lastfile");
    }
    
    Echo "\n</table></body></html>";

    $command = escapeshellcmd('Python/lastWinner.py "'.$directory.$lastfile.'"');
    $output = shell_exec($command);
    Echo  "<h2>Last Winner: ".$output."</h2>";
?>
<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>

<style>


.content {
  border-collapse: collapse;
  margin: 25px 0;
  font-size: 0.9em;
  display: none;
  font-family: sans-serif;
  min-width: 400px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);

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