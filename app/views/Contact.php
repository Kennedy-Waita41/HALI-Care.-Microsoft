<!DOCTYPE html>
<html>
<title>Contact Us</title>
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

.w3-bar .w3-button {
  padding: 16px;
}
</style>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-card" style="background-color: #f5f6fa  " id="myNavbar">
    <a href="HomePage.php" class="w3-bar-item w3-button w3-wide"><strong>HALI Care</strong></a>
    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small">
      <a href="AboutUs.php" target="_blank" class="w3-bar-item w3-button">ABOUT</a>
      <a href="Contact.php" class="w3-bar-item w3-button">CONTACT </a>
      <a href="login.php" class="w3-bar-item w3-button">LOGIN </a> 
      <a href="register.php" class="w3-bar-item w3-button">SIGN UP</a>
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

<!-- Contact Section -->
<div class="w3-container w3-light-grey" style="padding:128px 128px 128px 128px" id="contact">
  <h3 class="w3-center">CONTACT  <i class="fa fa-envelope"></i> </h3>
  <p class="w3-center w3-large">Get in touch with us. Send us a message:</p>
  <div style="margin-top:48px">
    
    <form action="/action_page.php" target="_blank">
      <p><input class="w3-input w3-border" type="text" placeholder="Name" required name="Name"></p>
      <p><input class="w3-input w3-border" type="text" placeholder="Email" required name="Email"></p>
      <p><input class="w3-input w3-border" type="text" placeholder="Subject" required name="Subject"></p>
      <p><input class="w3-input w3-border" type="text" placeholder="Message" required name="Message"></p>
      <p>
        <button class="w3-button w3-black" type="submit">
          <i class="fa fa-paper-plane"></i> SEND MESSAGE
        </button>
      </p>
    </form>
    <br>
    <p><i class="fa fa-map-marker fa-fw w3-xxlarge w3-margin-right"></i> Nairobi, KENYA</p>
    <p><i class="fa fa-phone fa-fw w3-xxlarge w3-margin-right"></i> Phone: +254 000000000</p>
    <p><i class="fa fa-envelope fa-fw w3-xxlarge w3-margin-right"> </i> Email: mail@mail.com</p>

    <!-- Image of location/map 
    <img src="" class="w3-image w3-greyscale" style="width:100%;margin-top:48px"> -->
  </div>
</div>

<!-- Footer -->
<footer class="w3-center w3-black w3-padding-64">
  <a href="Contact.php" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
  <div class="w3-xlarge w3-section">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
  </div>
</footer>
 
<script>
// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}


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
