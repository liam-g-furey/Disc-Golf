<!DOCTYPE html>
<html>
<head>
    <title>Disc Golf - Courses</title>
    <link rel="stylesheet" href="css/courses.css">
    <script src="js/courses.js"></script>
    <?php include('include/head.php'); ?>
</head>
<body>
    <?php include('include/topnav.php'); ?>
    <div class="content w3-content">
        <h1>17D Disc Golf Tour Locations</h1>

        <!-- Course Content -->
        <div class="w3-main">

            <!-- Photo grid -->
            <div class="w3-row">
                <div class="w3-third">
                    <img src="https://discgolfcourses.com/CourseMaps/thumb_575f58-01ab.jpg" onclick="onClick(this)" alt="Patriot's Park Disc Golf">
                    <img src="https://gordon.armymwr.com/application/files/4515/5681/3029/Fort-Gordon-Disc-Golf_Army-Air-Force_map.jpg" onclick="onClick(this)" alt="Army & Air Force">
                    <img src="https://www.pdga.com/files/u5252/Warner_Course_Map.jpg" onclick="onClick(this)" alt="Jim Warner Memorial Course">
                </div>

                <div class="w3-third">
                    <img src="https://forums.ultiworld.com/uploads/default/original/3X/2/4/245ec37923100201fa92e38f96b0fa5500cb4780.jpg" onclick="onClick(this)" alt="Marine & Navy">
                    <img src="https://www.dgcoursereview.com/course_files/1450/aac62f70.gif" onclick="onClick(this)" alt="Lake Olmstead">
                    <img src="https://www.pdga.com/files/u15156/course_map_jackson_new_final.jpg" onclick="onClick(this)" alt="W.R. Jackson Memorial Course">
                </div>

                <div class="w3-third">
                    <img src="https://images.squarespace-cdn.com/content/v1/570c190ca3360c0d766321ae/1461089386959-5N7M5CR14JZZU7AF34R4/ke17ZwdGBToddI8pDm48kPOpTHs7UDy7PcoGr2BwJGR7gQa3H78H3Y0txjaiv_0fBvivNZK_6JPv8QJncOi2GYU6Te-eEE9v54chXFDSUl-LYXVbONl_hZyFpVyn4qZhOqpeNLcJ80NK65_fV7S1Ue8VJZwtOuy9pxnG7GQla8NSOyKk0gQvNdSlhQ6XGFLAoRwB-dUGsSquCnVTFQcaRg/PKP_DiscGolfMap" onclick="onClick(this)" alt="Pendleton King Disc Golf Course">
                    <img src="https://www.pdga.com/files/u15156/steady-ed-headrick-map-color.png" onclick="onClick(this)" alt="Steady Ed Headrick Memorial Course">
                </div>
            </div>

            <!-- Modal for full size images on click -->
            <div id="modal01" class="w3-modal w3-black" style="padding-top:0" onclick="this.style.display='none'">
                <span class="w3-button w3-black w3-xlarge w3-display-topright">×</span>
                <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
                    <p id="caption"></p>
                    <img id="img01" class="w3-image">
                </div>
            </div>
        </div>
    </div>
</body>
</html>
