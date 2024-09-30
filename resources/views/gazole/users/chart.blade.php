@extends('gazole.layouts.master')

@section('content')
    <h1 class="text text-center">{{ $chauffeur->full_name }}</h1>
    <div id="qty_littre_chart" style="width: 900px; height: 500px"></div>
    <div id="prix_chart" style="width: 900px; height: 500px"></div>
@endsection

@section('style')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawQtyLittreChart);
        google.charts.setOnLoadCallback(drawPrixChart);

        function drawQtyLittreChart() {
            var chauffeurData = {!! json_encode($chauffeurData) !!};

            var dataArray = [
                ['Month', 'QtyLittre']
            ];

            Object.keys(chauffeurData).forEach(function(month) {
                dataArray.push([month, chauffeurData[month]]);
            });

            var data = google.visualization.arrayToDataTable(dataArray);

            var options = {
                title: 'Chauffeur QtyLittre Performance',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('qty_littre_chart'));

            chart.draw(data, options);
        }

        function drawPrixChart() {
            var prixData = {!! json_encode($prixData) !!};

            var dataArray = [
                ['Month', 'Prix']
            ];

            Object.keys(prixData).forEach(function(month) {
                dataArray.push([month, prixData[month]]);
            });

            var data = google.visualization.arrayToDataTable(dataArray);

            var options = {
                title: 'Chauffeur Prix Performance',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('prix_chart'));

            chart.draw(data, options);
        }
    </script>
@endsection
