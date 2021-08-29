<?php

    session_start();

    define('SITEURL', 'http://localhost/projects/E-C-jako/');
    define('LOCALHOST'  , 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'clothes_order');

    // Create The constants to Stor to No repeating your self
    $conn      = mysqli_connect(LOCALHOST , DB_USERNAME , DB_PASSWORD); 
    //or die(mysqli_error()); // Database Connection
    $db_select = mysqli_select_db($conn, DB_NAME); 
    //or die(mysqli_error());                      // Database Select



    //http://localhost/projects/E-C-jako/
