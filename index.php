<?php

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require autoload file
require_once("vendor/autoload.php");
// require ('/home/greenluc/config.php');

// Start a session
session_start();

//create an instance of the base class
$f3 = Base::instance();
$dataLayer = new DataLayerBall();
$con = new ControllerBall($f3); //create a controller class
//$login = new Login($db, $f3);

//Define a default route (home page)
$f3->route('GET /', function(){
    // render home.html
    $GLOBALS['con']->home();
});

//define login route
$f3->route('GET|POST /login', function(){
    global $login;
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $login->logInUser();
    }

    // render gameSim.html
    $GLOBALS['con']->login();
});

//define game route
$f3->route('GET /game', function(){
    // render game.html
    $GLOBALS['con']->game();
});

//define leaderboard route
$f3->route('GET /leaderboard', function(){
    // render game.html
    $GLOBALS['con']->leaderboard();
});

//define simulation route
$f3->route('GET|POST /sim', function(){
    // render gameSim.html
    $GLOBALS['con']->sim();
});

//define about route
$f3->route('GET /about', function(){
    // render about.html
    $GLOBALS['con']->about();
});

//define about route
$f3->route('GET /logout', function(){

    if (!isset($_SESSION['loggedin'])) {
        header("location: login");
    }

    session_destroy();
    $_SESSION = array();
    // render debug.html
    header("Location: /Solo8Ball/");
});

//run fat free
$f3->run();