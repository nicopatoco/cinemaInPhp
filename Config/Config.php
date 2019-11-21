<?php namespace Config;

define("ROOT", dirname(__DIR__) . "/");
//Path to your project's root folder
define("FRONT_ROOT", "/Framework/");
define("VIEWS_PATH", "Views/");
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");
define("POSTER_ROOT", "img src=https://image.tmdb.org/t/p/w500/");

//URL's and data related to API
define("MOVIE_DB_API_KEY", "2078e4cd29088b5e2e436abbb8f153d0");
define("MOVIE_DB_API_URL", "http://api.themoviedb.org/3/movie/now_playing?page=1&language=en-US&api_key=");
define("MOVIE_DB_API_GET_BY_ID_BASE_URL", "http://api.themoviedb.org/3/movie/");
define("MOVIE_DB_API_GET_BY_ID_PARAMS_URL", "?language=en-US&api_key=");
define("MOVIE_DB_API_GENRES_URL", "http://api.themoviedb.org/3/genre/movie/list?language=en-US&api_key=");

//Setting for Database connection
define("DB_HOST", "localhost");
define("DB_NAME", "MovieDB");
define("DB_USER", "root");
define("DB_PASS", "");
?>