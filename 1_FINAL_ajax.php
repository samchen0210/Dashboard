<!DOCTYPE HTML>
<html>

<head>
    <title>AJAX Fetch data</title>

    <script type="text/javascript">
    window.onload = function() {
        var dataPoints = [];
        var chart;
        $.getJSON("data.php", function(data) {
            $.each(data, function(key, value) {
                dataPoints.push({
                    x: value["x"][0],
                    y: value["y"][0]
                });
            });
            chart = new CanvasJS.Chart("chartContainer", {
                zoomEnabled: false,
                zoomType: "xy",

                title: {
                    text: "Live Chart with dataPoints from JSON Data"
                },
                axisX: {
                    title: "Time in second"
                },
                axisY: {
                    suffix: " Nm"
                },
                data: [{
                    type: "spline",
                    markerType: "circle",
                    dataPoints: dataPoints,
                }]

            });
            chart.render();
            updateChart();
        });


        function updateChart() {
            $.getJSON("data.php", function(data) {
                $.each(data, function(key, value) {
                    dataPoints.push({
                        x: parseInt(value["x"]),
                        y: parseInt(value["y"]),
                    })
                });

                if (dataPoints.length > 10) {
                    dataPoints.shift();
                }

                chart.render();
                setTimeout(function() {
                    updateChart()
                }, 2000)
            });
        }
    }
    </script>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</head>

<body>

    <div id="chartContainer" style="width:100%; height: 500px;"></div>

</body>

</html>