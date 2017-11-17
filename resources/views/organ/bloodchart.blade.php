@extends('app')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<div id="content">
    <div class="container">
        <div class="row margin-vert-30">
            <div class="col-md-6 margin-bottom-10 animate flip">
                
                <html>
                    <head> 

                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <script type="text/javascript">
                            var visitor = <?php echo $blood; ?>;
                            console.log(visitor);
                            google.charts.load('current', {'packages': ['corechart']});
                            google.charts.setOnLoadCallback(drawChart);
                            function drawChart() {
                                var data = google.visualization.arrayToDataTable(visitor);
                                var options = {
                                    title: 'Site Visitor Line Chart',
                                    curveType: 'function',
                                    legend: {position: 'bottom'}
                                };
                                var chart = new google.visualization.LineChart(document.getElementById('linechart'));
                                chart.draw(data, options);
                            }
                        </script>
                    </head>
                    <body>
                        <div id="linechart" style="width: 900px; height: 500px"></div>
                    </body>
                    </script>
                    </head>
                </html>
               
            </div>
        </div>
    </div>
</div>

@endsection


