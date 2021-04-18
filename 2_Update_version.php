<?php include "dbh.php" ?>
<?php

// SQL command //
//Fetch data from demo table //
$sql_fetchdata = "SELECT * FROM demo ";
$sql_latestdata = "SELECT * FROM `demo` ORDER BY `timestamp` DESC LIMIT 1";

$result = mysqli_query($con, $sql_fetchdata);
$latestresult = mysqli_query($con, $sql_latestdata);
$No = array();
$Time = array();
$Figure = array();


function setInterval($f, $milliseconds)
{
    $seconds = (int)$milliseconds / 1000;
        $f();
        sleep($seconds);
    }
}
function update()
{    // Database Figure
    $severname = "127.0.0.1";
    $username = "root";
    $password = "0936556436Sam";
    $dbname = "database";
    $port = "3306";
    // Create connection
    $con = new mysqli($severname, $username, $password, $dbname, $port);
    // Check connection
    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "<br>";

    $sql_latestdata = "SELECT * FROM `demo` ORDER BY `timestamp` DESC LIMIT 1";
    $latestresult = mysqli_query($con, $sql_latestdata);
    $datapoints = array();

    if (mysqli_num_rows($latestresult) != 0) {
        $row = mysqli_fetch_assoc($latestresult);
        array_push($datapoints, array("x" => $row["no"], "y" => $row["figure"]));


        echo "NO: " . $row["no"] . "--" . $row["figure"] . "----" . $row["timestamp"];
        echo "<br>";
        /*
        $No[$row["no"]] = $row["no"];
        $Time[$row["no"]] = $row["timestamp"];
        $Figure[$row["no"]] = $row["figure"];
        */
    } else {
        echo "0 results";
    }
}


setInterval(function () {
    update();
}, 1000);

?>