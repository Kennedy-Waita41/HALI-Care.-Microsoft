<!DOCTYPE html>
<html>
<title>HALI Care</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}

body, html {
  height: 100%;
  line-height: 1.8;
}

/* Full height image header */
.bgimg-1 {
  background-position: center;
  background-size: cover;
  background-image: url("");
  min-height: 100%;
}

.w3-bar .w3-button {
  padding: 16px;
}
</style>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-card" style="background-color: #f5f6fa" id="myNavbar">
    <a href="HomePage.php" class="w3-bar-item w3-button w3-wide" ><strong>HALI Care (Logo)</strong></a>
    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small">
      <a href="AboutUs.php" target="_blank" class="w3-bar-item w3-button">ABOUT</a>
      <a href="Contact.php" target="_blank" class="w3-bar-item w3-button"></i> CONTACT </a>
      <a href="Login.php" class="w3-bar-item w3-button">LOGIN </a> 
      <a href="Register.php" class="w3-bar-item w3-button">SIGN UP</a>
    </div>
    <!-- Hide right-floated links on small screens and replace them with a menu icon -->

    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
  <a href="AboutUs.html" onclick="w3_close()" class="w3-bar-item w3-button">ABOUT</a>
  <a href="Contact.php" onclick="w3_close()" class="w3-bar-item w3-button">CONTACT</a>
  <a href="register.php" onclick="w3_close()" class="w3-bar-item w3-button">SIGN UP</a>
  <a href="login.php" onclick="w3_close()" class="w3-bar-item w3-button">LOGIN</a>
  
</nav>

<!-- Footer 
<footer class="w3-center w3-black w3-padding-64">
  <a href="HomePage.php" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
  <div class="w3-xlarge w3-section">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
  </div>
  
</footer>  -->
 
<script>
// Toggle between showing and hiding the sidebar when clicking the menu icon
var mySidebar = document.getElementById("mySidebar");

function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
  } else {
    mySidebar.style.display = 'block';
  }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
}
</script>

</body>
</html>
