<?php

use DAO\MovieDAO as MovieDAO;
$repo = new MovieDAO();
$movieList = $repo->GetAll();

$selectMovie = array();
foreach ($movieList as $movie) 
{
    array_push($selectMovie,"https://image.tmdb.org/t/p/w500/".$movie->getImage());
}
?>

<div class="bgColor">
  <div class="containerIMG">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <?php
        for ($i=1;$i<20;$i++) {?>
        <li data-target="#myCarousel" data-slide-to="<?php echo $i;?>"></li>
        <?php
        } 
        ?>
      </ol>
      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <div class="item active">
        <a href="<?php echo FRONT_ROOT ?>Movie/ShowListView">
          <img src="<?php echo $selectMovie[0] ?>" style="width:100%;">
        </a>
        </div>
        <?php
        for ($i=1;$i<20;$i++) {?>
        <div class="item">
        <a href="<?php echo FRONT_ROOT ?>Movie/ShowListView">
          <img src="<?php echo $selectMovie[$i] ?>" style="width:100%;">
        </a>
        </div>
        <?php
        } 
        ?>
      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
</div>