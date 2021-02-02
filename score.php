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
 <h1>All Score Cards</h1>

<?php
    $directory = 'games/';

    if (!is_dir($directory)) {
        exit('Invalid diretory path');
    }

    foreach (scandir($directory) as $file) {
        if ($file !== '.' && $file !== '..') {
            Echo "<button type='button' class='collapsible'>".$file."</button>\n\n";
            Echo "<html><body><table class='content'>\n\n";
            $f = fopen($directory.$file, "r");
            while (($line = fgetcsv($f)) !== false) {
              Echo "<tr>";
              foreach ($line as $cell) {
                Echo "<td>" . htmlspecialchars($cell) . "</td>";
              }
              Echo "</tr>\n";
            }
            fclose($f);
            Echo "\n</table></body></html>";
        }
    }
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
  padding: 0 18px;
  display: none;
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