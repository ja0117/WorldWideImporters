<?php
include_once("databasecon.php");
?>

<!-- HTML head -->
<?php include 'includes/head.php'; ?>

<body>
<!-- Nav bar -->
<?php include 'includes/nav.php'; ?>

<!-- Container for the image gallery -->
<div class="container">
    <h3> Product: </h3>

  <!-- Full-width images with number text -->
  <div class="column">
  <div class="mySlides">
    <div class="numbertext">1 / 6</div>
      <img src="img_avatar.jpg" style="width:100%">
  </div>
</div>

  <!-- Next and previous buttons -->
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>

  <!-- Image text -->
  <div class="caption-container">
    <p id="caption"></p>
  </div>

  <!-- Thumbnail images -->
  <div class="row">
    <div class="column">
      <img class="demo cursor" src="img_avatar.jpg" style="width:100%" onclick="currentSlide(1)" alt="The Woods">
    </div>
  </div>
</div>

<footer> Copyright &copy; 2019, Wide World Importers</footer>

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>

</body>
</html>