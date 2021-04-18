<?php
$dataPoints = array(
    array("label" => "Room 1", "y" => 0),
    array("label" => "Room 2", "y" => 0),
    array("label" => "Room 3", "y" => 0),

);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css" type="text/css" />
    <title>Prototype</title>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</head>
<script>
window.onload = function() {

    var chart = new CanvasJS.Chart("chartContainer", {
        title: {
            text: "Clinical Realtime Dashoard"
        },
        axisY: {
            minimum: 0,
            maximum: 100,
            suffix: "%"
        },
        data: [{
            type: "column",
            yValueFormatString: "#,##0.00\"%\"",
            indexLabel: "{y}",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });

    function updateChart() {
        var color, deltaY, yVal;
        var dps = chart.options.data[0].dataPoints;
        for (var i = 0; i < dps.length; i++) {
            deltaY = (2 + Math.random() * (-2 - 2));
            yVal = Math.min(Math.max(deltaY + dps[i].y,
                0), 90);
            color = yVal > 75 ? "#FF2500" : yVal >= 50 ? "#FF6000" : yVal < 50 ? "#41CF35" : null;
            dps[i] = {
                label: "Core " +
                    (i + 1),
                y: yVal,
                color: color
            };
        }
        chart.options.data[0].dataPoints = dps;
        chart.render();
    };
    updateChart();
    setInterval(function() {
        updateChart()
    }, 100);
}
</script>

<header>
    <div class="container">
        <div class="top-container">
            <h1>Clinical Dashboard</h1>
        </div>
    </div>
</header>


<body>
    <div class="center-container" style="width:auto;height: 400px;">
        <div class="text">This is a place for displing the planel</div>
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    </div>
</body>


<footer class="bottom-container">
    <div>
        <a href="index.html">
            <h1>Making life more easier is our goal</h1>
        </a>
        <a href="http://google.com">Google</a>
    </div>
</footer>


</html>