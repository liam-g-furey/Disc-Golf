<!DOCTYPE html>
<html lang="en">
<title>Disc Golf - Courses</title>
<?php include('include/head.php'); ?>
<?php include 'include/topnav.php'; ?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<style>
body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
.w3-third img{margin-bottom: -6px; opacity: 0.8; cursor: pointer}
.w3-third img:hover{opacity: 1}
</style>
<body class="w3-light-grey w3-content" style="max-width:1600px">


<h1>17D Disc Golf Tour Locations</h1>
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Push down content on small screens --> 
  <div class="w3-hide-large" style="margin-top:83px"></div>
  
  <!-- Photo grid -->
  <div class="w3-row">
    <div class="w3-third">
      <img src="https://discgolfcourses.com/CourseMaps/thumb_575f58-01ab.jpg" style="width:100%" onclick="onClick(this)" alt="Patriot's Park Disc Golf">
      <img src="https://gordon.armymwr.com/application/files/4515/5681/3029/Fort-Gordon-Disc-Golf_Army-Air-Force_map.jpg" style="width:100%" onclick="onClick(this)" alt="Army & Air Force">
      <img src="https://www.pdga.com/files/u5252/Warner_Course_Map.jpg" style="width:100%" onclick="onClick(this)" alt="Jim Warner Memorial Course">
    </div>

    <div class="w3-third">
      <img src="https://forums.ultiworld.com/uploads/default/original/3X/2/4/245ec37923100201fa92e38f96b0fa5500cb4780.jpg" style="width:100%" onclick="onClick(this)" alt="Marine & Navy">
      <img src="https://www.dgcoursereview.com/course_files/1450/aac62f70.gif" style="width:100%" onclick="onClick(this)" alt="Lake Olmstead">
      <img src="https://www.pdga.com/files/u15156/course_map_jackson_new_final.jpg" style="width:100%" onclick="onClick(this)" alt="W.R. Jackson Memorial Course">
    </div>
    
    <div class="w3-third">
      <img src="https://images.squarespace-cdn.com/content/v1/570c190ca3360c0d766321ae/1461089386959-5N7M5CR14JZZU7AF34R4/ke17ZwdGBToddI8pDm48kPOpTHs7UDy7PcoGr2BwJGR7gQa3H78H3Y0txjaiv_0fBvivNZK_6JPv8QJncOi2GYU6Te-eEE9v54chXFDSUl-LYXVbONl_hZyFpVyn4qZhOqpeNLcJ80NK65_fV7S1Ue8VJZwtOuy9pxnG7GQla8NSOyKk0gQvNdSlhQ6XGFLAoRwB-dUGsSquCnVTFQcaRg/PKP_DiscGolfMap" style="width:100%" onclick="onClick(this)" alt="Pendleton King Disc Golf Course">
      <img src="https://www.pdga.com/files/u15156/steady-ed-headrick-map-color.png" style="width:100%" onclick="onClick(this)" alt="Steady Ed Headrick Memorial Course">
    </div>
  </div>

  
  <!-- Modal for full size images on click-->
  <div id="modal01" class="w3-modal w3-black" style="padding-top:0" onclick="this.style.display='none'">
    <span class="w3-button w3-black w3-xlarge w3-display-topright">×</span>
    <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
      <img id="img01" class="w3-image">
      <p id="caption"></p>
    </div>
  </div>
  
<!-- End page content -->
</div>

<script>
// Script to open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}

// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}

</script>