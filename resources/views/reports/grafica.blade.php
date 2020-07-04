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

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
    
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="mx-1">
    
        <div id="container-grafica"></div>
        <p class="highcharts-description">
            {{-- hola aqui esta la grafica --}}
        </p>
</div>

<script>

    var series_data = <?php echo json_encode($series_data['series']); ?>;
    var category_data = <?php echo json_encode($series_data['categories']); ?>;

    Highcharts.chart('container-grafica', {
		    chart: {
		        type: 'column',
		        options3d: {
		            enabled: true,
		            alpha: 2,
		            beta: 10,
		            viewDistance: 20,
		            depth: 60
		        }
		    },

		    title: {
		        text: 'Performance comercial'
		    },

		    xAxis: {
		        categories: category_data,
		        labels: {
		            // skew3d: true,
		            style: {
		                fontSize: '16px'
		            }
		        }
		    },

		    yAxis: {
		        // allowDecimals: false,
		        min: 0,
		        title: {
		            text: '',
		            skew3d: true
		        },
		        labels: {
		            formatter: function () {
		                return 'R$' + this.value;
		            }
		        }
		    },

		    tooltip: {
		        headerFormat: '<b>{point.key}</b><br>',
		        // pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: {point.y} / {point.stackTotal}'
		        pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: {point.y:.2f} R$'
		    },

		    // plotOptions: {
		    //     column: {
		    //         stacking: 'normal',
		    //         depth: 40
		    //     }
		    // },
		    plotOptions: {
		        spline: {
		            marker: {
		                radius: 4,
		                lineColor: '#666666',
		                lineWidth: 1
		            }
		        }
		    },

		    series: series_data});

		// document.getElementByClassName('').hid
		document.getElementsByClassName('highcharts-credits')[0].style.visibility = 'hidden';


</script>

</html>