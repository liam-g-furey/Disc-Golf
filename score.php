<!DOCTYPE html>
<html>
<head>
    <title>Disc Golf - Score</title>
    <script type="text/javascript" src="js/main.js"></script>
    <script src="js/libdisc.js"></script>
    <?php include('include/head.php'); ?>
</head>
<body onload="populateGames('games');">
    <?php include 'include/topnav.php'; ?>
    <div class="content">
        <h1>All Score Cards</h1>
        <div id="games"></div>
    </div>
</body>
</html>