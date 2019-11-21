<?php
namespace Controllers;

use DAO\MovieDAO as MovieDAO;
use DAO\GenreDAO as GenreDAO;
use DAO\APIDAO as APIDAO;
use DAO\MovieGenreDAO as MovieGenreDAO;
use DAO\MovieFunctionDAO as MovieFunctionDAO;
use Helpers\ScheduleHelper as ScheduleHelper;
use Models\Movie as Movie;
use Models\MovieGenre as MovieGenre;
use Models\Genre as Genre;

class MovieController
{
    private $movieRepo;
    private $genreRepo;
    private $apiRepo;
    private $movieGenreRepo;
    private $functionRepo;
    private $scheduleHelper;

    public function __construct()
    {
        $this->movieRepo = new movieDAO();
        $this->genreRepo = new GenreDAO();
        $this->apiRepo = new APIDAO();
        $this->movieGenreRepo = new MovieGenreDAO();
        $this->functionRepo = new MovieFunctionDAO();
        $this->scheduleHelper = new ScheduleHelper();
    }
    
    public function ShowListView()
    {
        if (isset($_SESSION["loggedUser"])) 
        {
            if ($_SESSION["loggedUser"]->getTypeId() == 1)
            {
                $movieList = $this->movieRepo->GetAll();
                require_once(VIEWS_PATH."movie-list.php");
            }
        }

        $orderFunctionList = $this->getOrderFunctionList();
        
        require_once(VIEWS_PATH."billboard.php");
    }

    private function isMovie($orderList, $movieName)
    {
        foreach($orderList as $name)
        {
            if($name == $movieName){
                return true;
            }
        }
        return false;
    }

    private function isFunction($functionList, $movieName)
    {
        foreach ($functionList as $function)
        {
            if($function->getMovie()->getName() == $movieName)
            {
                return true;
            }
        }
        return false;
    }

    private function getOrderFunctionList()
    {
        $functionList = $this->functionRepo->GetAll();
        //Ordering function movie list by name.
        $orderList = array();

        foreach ($functionList as $function)
        {
            if( ! ($this->isMovie($orderList,$function->getMovie()->getName()))){
                array_push($orderList,$function->getMovie()->getName());
            }
        }

        sort($orderList);
        $orderFunctionList = array();

        foreach($orderList as $movie)
        {
            foreach ($functionList as $function)
            {
                if($function->getMovie()->getName() == $movie)
                {
                    if( ! ($this->isFunction($orderFunctionList, $movie))){
                        array_push($orderFunctionList,$function);
                    }
                }
            }
        }
        return $orderFunctionList;
    }

    public function ShowListViewForGenre()
    {
        $genreByPost = $this->genreRepo->GetById($_POST['genre']);

        $orderFunctionList = $this->getOrderFunctionList();

        require_once(VIEWS_PATH."movie-list-for-genre.php");
    }

    public function ShowListViewForDate()
    {
        $fullDateList = $this->scheduleHelper->GetFullDateList();
        $matchDate = array();
        $orderFunctionList = array();

        foreach($fullDateList as $value)
        {
            if($value->getdate() == $_POST['date'])
            {
                array_push($matchDate,$value);
            }
        }

        foreach($matchDate as $value)
        {
            $function = $this->functionRepo->GetFunctionByScheduleId($value->getId());
            array_push($orderFunctionList, $function);
        }

        require_once(VIEWS_PATH."movie-list-for-date.php");
    }

    public function UpdateMovies()
    {
        $this->UpdateGenres();

        $this->UpdateMoviesInDAO();

        $this->ShowListView();
    }

    private function UpdateGenres()
    {
        $genreList = $this->apiRepo->UpdateAllGenres();

        foreach($genreList as $thing => $genre)
        {
            if(!$this->genreRepo->GetById($genre['id']))
            {
                $newGenre = new Genre();
                $newGenre->setId($genre['id']);
                $newGenre->setDescription($genre['name']);

                $this->genreRepo->Insert($newGenre);
            }
        }
    }

    private function UpdateMoviesInDAO()
    {
        $movieList = $this->apiRepo->UpdateAllMovies();

        if(!empty($movieList))
        {
            foreach($movieList as $thing => $movie)
            {
                if(!$this->movieRepo->GetById($movie['id']))
                {
                    $movies = new Movie
                    (
                        $movie['id'],
                        $movie['title'],
                        $movie['original_language'],
                        $this->apiRepo->RetrieveRuntime($movie['id']),
                        $movie['poster_path'],
                        $movie['overview']
                    );

                    $this->movieRepo->Insert($movies);

                    foreach($movie['genre_ids'] as $genre_id)
                    {
                        $movieGenre = new MovieGenre();
                        $movieGenre->setMovieId($movie['id']);
                        $movieGenre->setGenreId($genre_id);

                        $this->movieGenreRepo->Insert($movieGenre);
                    }
                }
            }
            echo "<script> alert('Peliculas importadas correctamente.'); </script>";
        }
        else
        {
            echo "<script> alert('Error de conección, al importar las peliculas'); </script>";
        }
        
    }
}
?>