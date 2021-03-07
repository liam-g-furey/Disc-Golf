<?php

function buildTable($filename, $btnText) {
    if (($handle = fopen($filename, "r")) !== FALSE) {

        // Setup
        echo "<div class=\"collapsible\">";
        echo "<button>" . htmlspecialchars($btnText) . "</button>";
        echo "<table hidden>";

        // Parse Headers
        if (($headers = fgetcsv($handle, 512, ",")) !== FALSE) {
            echo "<thead><tr>";
            $counter = 0;
            foreach($headers as $header) {
                echo "<th onclick=\"sortTable(this, " . $counter++ . ")\">" . htmlspecialchars($header) . "</th>";
            }
            echo "</tr></thead><tbody>";
        } else {
            die('Game file is empty or not a CSV:' . $filename);
        }

        // Parse Body
        while (($data = fgetcsv($handle, 512, ",")) !== FALSE) {
            echo "<tr>";
            foreach($data as $item) {
                echo "<td>" . htmlspecialchars($item) . "</td>";
            }
            echo "</tr>";
        }

        // Cleanup
        fclose($handle);
        echo "</tbody></table></div>";
    } else {
        die('Error opening game file: ' . $filename);
    }
}

?>