<?php
// Database Figure
$severname = "123.194.176.209";
$username = "sc0210";
$password = "0936556436Sam";
$dbname = "database";
$port = "3306";
echo "Start listeneing to :$severname, $username, $dbname, $port <br>";

// Create connection
$con = new mysqli($severname, $username, $password, $dbname, $port);

// Check connection
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}


echo " Connected successfully <hr>";