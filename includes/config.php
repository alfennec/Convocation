<?php

    //database configuration
    /*$host       = "localhost";
    $user       = "root";
    $pass       = "";
    $database   = "api_convocation";*/

    $host       = "localhost";
    $user       = "bermed";
    $pass       = "45619poi";
    $database   = "api_convocation";

    $connect = new mysqli($host, $user, $pass, $database);

    if (!$connect) {
        die ("connection failed: " . mysqli_connect_error());
    } else {
        $connect->set_charset('utf8');
    }

    $ENABLE_RTL_MODE = 'false';

?>