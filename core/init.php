<?php

// include 'database/connection.php' ;
include 'classes/connection.php' ;
include 'classes/User.php' ;
include 'classes/Follow.php' ;
include 'classes/tweet.php' ;

session_start();
 
global $pdo;

// instead of using objects and decide to user static function
// $User = new User();
// $getFormFollow = new Follow($conn);
// $getFormtweet = new tweet($conn);


define("BASE_URL" , "http://localhost/twitterclone/");



