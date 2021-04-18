<?php

header('Content-Type: application/json');
// Database Figure
$severname = "127.0.0.1";
$username = "root";
$password = "0936556436Sam";
$dbname = "database";
$port = "3306";
/*echo "Start listeneing to :$severname, $username, $dbname, $port <br>";*/

// Create connection
$con = new mysqli($severname, $username, $password, $dbname, $port);

// Check connection
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
} else {

    $dataPoints = array();
    $sql_fetchdata = "SELECT * FROM demo ";
    $sql_latestdata = "SELECT * FROM `demo` ORDER BY `timestamp` DESC LIMIT 1";
    $result = mysqli_query($con, $sql_fetchdata);
    $latestresult = mysqli_query($con, $sql_latestdata);


    while ($row = mysqli_fetch_array($latestresult)) {
        $point = array("x" => $row['no'], "y" => $row['figure']);
        array_push($dataPoints, $point);
    }

    echo json_encode($dataPoints, JSON_NUMERIC_CHECK);
}

mysqli_close($con);