<?php

include "includes/autoloader.php";
?>

<?php
  require "header.php";
?>


<main>

  <div class="container-fluid " style="border-bottom: 1px solid rgba(204,205,207,0.5)">

  <div class="row no-gutters">
    <div class="col-md" style="background-color: orange">

  <img src = "images/word_cloud.png" style="width: 100%" alt="word cloud">



    </div>

    <div class="col-md">

<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
  <ol class="carousel-indicators">
  <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
  <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
  <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
</ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/auba.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption">
       <h3>Pierre Aubemeyang</h3>
       <p>Striker</p>
     </div>
    </div>
    <div class="carousel-item">
      <img src="images/xhaka.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption">
       <h3>Granit Xhaka</h3>
       <p>Midfield</p>
     </div>
    </div>
    <div class="carousel-item">
      <img src="images/ozil.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption">
       <h3>Mesut Ozil</h3>
       <p>Midfield</p>
     </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

    </div>

  </div>
</div>

<div class="container-fluid" style="background-color: #F9F9FB">
  <div class="container">
  <div class="row no-gutters" >
    <div class="col-md">

  <h3 style="text-align: center"> What is FitNinja? </h3>
    </div>

    <div class="col-md">

  <p> FitNinja is great. I love my trainer - <b>John Doe</b> </p>
  <p> I lost a shitload of weight after joining FitNinja. My trainer keeps pushing me even when I really didn't feel like working out. - <b>Jill Bagabong</b></p>

    </div>

    </div>
  </div>
</div>

</main>

<?php
  require "footer.php";
?>
