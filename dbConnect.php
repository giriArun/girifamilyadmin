<?php
    $host = 'mysql'; // Container name, NOT localhost
    $db   = 'mydb';
    $user = 'myuser';
    $pass = 'mypass';

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully!";

?>