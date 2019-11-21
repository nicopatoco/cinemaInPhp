<div class="container">
     <h1>Now playing, API</h1>
     <h2></h2>
     <?php
     foreach ($movieList as $movie) 
     {
     ?>
          <h2><?php echo $movie->getName() ?></h2>
          <h5 class="center">Duracion: <?php echo $movie->getDuration() . " min<br>" ?>
          Idioma: <?php echo $movie->getLanguage() ?> </h5>
          <div class = "center"><?php echo "<" . POSTER_ROOT . $movie->getImage() . ">"?></div>
          <h3>Descripcion</h3>
          <p>Descripcion: <?php echo $movie->getOverview() ?></p>
          <p>Genero: <?php 
          $genreList = $movie->getGenreList();
          foreach($genreList as $genre)
          {
               echo $genre;
          }
          
          ?>
          </p>
          <hr>
     <?php
     }
     ?>
</div>