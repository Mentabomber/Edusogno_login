<?php

    // $servername = "localhost";
    // $username = "root";
    // $password = "root";
    // $databasename = "db-edusogno";

    // $conn = new mysqli($servername,$username,$password,$databasename);
    // Enter your host name, database username, password, and database name.
    // If you have not set database password on localhost then set empty.
    $con = mysqli_connect("localhost","root","root","db-edusogno");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>