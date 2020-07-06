<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <style type="text/css">


        .highcharts-figure, .highcharts-data-table table {
          min-width: 310px;
          max-width: 800px;
          margin: 1em auto;
        }

        .highcharts-data-table table {
          font-family: Verdana, sans-serif;
          border-collapse: collapse;
          border: 1px solid #EBEBEB;
          margin: 10px auto;
          text-align: center;
          width: 100%;
          max-width: 500px;
        }
        .highcharts-data-table caption {
          padding: 1em 0;
          font-size: 1.2em;
          color: #555;
        }
        .highcharts-data-table th {
          font-weight: 600;
          padding: 0.5em;
        }
        .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
          padding: 0.5em;
        }
        .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
          background: #f8f8f8;
        }
        .highcharts-data-table tr:hover {
          background: #f1f7ff;
        }

    </style> --}}
</head>
<body>

<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="mx-1">

        <div id="container-grafica"></div>
        <p class="highcharts-description">
            {{-- hola aqui esta la grafica --}}
        </p>
</div>

<script>

    var data_users = <?php echo json_encode($data_users); ?>;

        Highcharts.chart('container-grafica', {
            chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Participação na race'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: data_users
        }]
    });

		// document.getElementByClassName('').hid
		document.getElementsByClassName('highcharts-credits')[0].style.visibility = 'hidden';


</script>

</html>
