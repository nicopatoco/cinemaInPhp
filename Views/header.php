<!doctype html>
<html lang="en">
<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>carousel.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>login.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>singup.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>navigation.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>dropdown.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>entries.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>profile.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH ?>tableProfile.css">
    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH ?>login.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH ?>singup.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH ?>entries.js"></script>
    <title>My movies APP</title>
</head>
<body>
    <header>
<?php

use DAO\GenreDAO as GenreDAO;
use Helpers\ScheduleHelper as ScheduleHelper;

$genreRepo = new GenreDAO();
$genreList = $genreRepo->GetAll();

$scheduleHelper = new ScheduleHelper();

$dateList = $scheduleHelper->GetDateList();

if ($_SESSION) 
{
    if (isset($_SESSION["loggedUser"])) 
	{
        if ($_SESSION["loggedUser"]->getTypeId() == 1)
        {
            require_once(VIEWS_PATH . "nav-admin.php");        
        }
        else
        {
            require_once(VIEWS_PATH . "nav-logout.php");
        }
    }
    else
    {
        require_once(VIEWS_PATH . "nav.php");
    }
} 
else 
{
	require_once(VIEWS_PATH . "nav.php");
}
?>