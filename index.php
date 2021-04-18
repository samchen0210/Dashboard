<?php
include_once('dbh.php');
$sql_fetchdata = "SELECT * FROM demo ";
$sql_latestdata = "SELECT * FROM `demo` ORDER BY `timestamp` DESC LIMIT 1";
$result = mysqli_query($con, $sql_fetchdata);
$latestresult = mysqli_query($con, $sql_latestdata);

$dataPoints = array();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Fetch Data From Database </title>
    <script>
    window.onload = function() {
        <?php
            if (mysqli_num_rows($latestresult) != 0) {
                $row = mysqli_fetch_assoc($latestresult);
                $x = $row['no'];
                $y = $row['figure'];
                array_push($datapoints, array("x" => $row["no"], "y" => $row["figure"]));
            } else {
                echo "0 results!";
            }
            ?>

        var dataPoints = <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>;

        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "light2",
            title: {
                text: "Live Clinical Dashbord"
            },
            axisX: {
                title: "Time"
            },
            axisY: {
                suffix: " "
            },
            data: [{
                type: "line",
                yValueFormatString: "####",
                toolTipContent: "{y} Mbps",
                dataPoints: dataPoints
            }]
        });
        chart.render();

        var updateInterval = 1000;
        setInterval(function() {
            updateChart()
        }, updateInterval);

        var xValue = dataPoints.x;
        var yValue = dataPoints.y;


        function updateChart() {
            <?php
                $sql_latestdata =   "SELECT * FROM `demo` ORDER BY `timestamp` DESC LIMIT 1";
                $latestresult = mysqli_query($con, $sql_latestdata);
                $row = mysqli_fetch_assoc($latestresult);
                array_push($dataPoints, array("x" => $row["no"], "y" => $row["figure"]));
                ?>

            xValue = <?php $row["no"] ?>;
            yValue = <?php $row["figure"] ?>;
            dataPoints.push({
                x: xValue,
                y: yValue
            });

            chart.render();
        }
    }
    </script>
</head>

<body>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>


</html>