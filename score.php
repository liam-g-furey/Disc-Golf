<!DOCTYPE html>
<html>
<head>
    <title>Disc Golf - Score</title>
    <?php include('include/head.php'); ?>
</head>
<body>
    <?php include 'include/topnav.php'; ?>
    <div class="content">
        <h1>All Score Cards</h1>
        <?php
        include('include/display.php');
        $directory = 'games/';
        $files = glob("$directory*.csv");

        foreach($files as $file) {
            buildTable($file, explode("/", $file)[1]);
        }
        ?>
    </div>

    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>