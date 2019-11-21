<div class="container">
    <h1>Now playing, API</h1>
    <h2></h2>
    
    <?php
    foreach ($orderFunctionList as $function) 
    {
        if(containsMovie($function->getMovie(),$genreByPost))
        {
    ?>
        <h2><?php echo $function->getMovie()->getName() ?></h2>
        <h5 class="center">Duracion: <?php echo $function->getMovie()->getDuration() . " min<br>" ?>
        Idioma: <?php echo $function->getMovie()->getLanguage() ?> </h5>
        <div class = "center"><?php echo "<" . POSTER_ROOT . $function->getMovie()->getImage() . ">"?></div>
        <h3>Descripcion</h3>
        <p>Descripcion: <?php echo $function->getMovie()->getOverview() ?></p>
        <p>Genero: <?php 
        $genreList = $function->getMovie()->getGenreList();
        foreach($genreList as $genre)
        {
            echo $genre;
        }
        ?>
        <form action="<?php echo FRONT_ROOT ?>Entry/ShowAddView" method="post">
            <button type="submit" id="button" name='movie' value='<?php echo $function->getMovie()->getId(); ?>'> Comprar </button>
        </form>
        </p>
        <hr>
    <?php
    }
    }

    function containsMovie($movie , $genre)
    {
        foreach ($movie->getGenreList() as $value)
        {
            if($value == $genre->getDescription() ){
                return true;
            }
        }
        return false;
    }

    ?>
</div>