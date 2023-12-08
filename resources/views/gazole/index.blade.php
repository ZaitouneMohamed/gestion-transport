@extends('gazole.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ App\Models\Camion::count() }}</h3>
                                <p>Camion</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-truck"></i>
                            </div>
                            <a href="{{ route('camions.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ App\Models\Chaufeur::count() }}</h3>
                                <p>Chaufeur</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <a href="{{ route('chaufeur.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ App\Models\Station::count() }}</h3>

                                <p>Station</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-charging-station"></i>
                            </div>
                            <a href="{{ route('stations.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{ App\Models\Consomation::count() }}</h3>
                                <p>Trajet</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-flag"></i>
                            </div>
                            <a href="{{ route('consomations.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <div class="row">
            <div class="col-lg-12 col-12">
                <canvas id="myColumnChart" width="400" height="400"></canvas>
            </div>
            <div class="col-lg-6 col-6">
                {{-- <div id="piechart" style="height: 400px;"></div> --}}
                <canvas id="myPieChart" width="200" height="200"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('scripts')
    <script>
        var results = @json($results);

        var ctx = document.getElementById('myPieChart').getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: results.map(item => item.name),
                datasets: [{
                    data: results.map(item => item.total_prix),
                    backgroundColor: [
                        'rgba(255, 0, 0, 0.7)', // Red
                        'rgba(0, 255, 0, 0.7)', // Green
                        'rgba(0, 0, 255, 0.7)', // Blue
                        'rgba(255, 255, 0, 0.7)', // Yellow
                        'rgba(128, 0, 128, 0.7)', // Purple
                        'rgba(0, 128, 128, 0.7)', // Teal
                        'rgba(128, 128, 0, 0.7)', // Olive
                        'rgba(128, 128, 128, 0.7)', // Gray
                    ],
                }],
            },
        });
    </script>
    <script>
        var results = @json($results_2);

        var ctx = document.getElementById('myColumnChart').getContext('2d');
        var myColumnChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: results.map(function(item) {
                    return item.year + '-' + ('0' + item.month).slice(-2);
                }),
                datasets: [{
                    label: 'Total Prix',
                    data: results.map(item => item.total_prix),
                    backgroundColor: 'rgba(75, 192, 192, 0.7)', // Adjust the color as needed
                }],
            },
        });
    </script>
    {{-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> --}}
    {{-- <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Work', 11],
                ['Eat', 2],
                ['Commute', 2],
                ['Watch TV', 2],
                ['Sleep', 7]
            ]);
            var options = {
                title: 'SI Youssef'
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
    <script>
        google.charts.load('current', {
            packages: ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawStacked);

        function drawStacked() {
            var data = new google.visualization.DataTable();
            data.addColumn('timeofday', 'Time of Day');
            data.addColumn('number', 'Motivation Level');
            data.addColumn('number', 'Energy Level');

            data.addRows([
                [{
                    v: [8, 0, 0],
                    f: '8 am'
                }, 1, .25],
                [{
                    v: [9, 0, 0],
                    f: '9 am'
                }, 2, .5],
                [{
                    v: [10, 0, 0],
                    f: '10 am'
                }, 3, 1],
                [{
                    v: [11, 0, 0],
                    f: '11 am'
                }, 4, 2.25],
                [{
                    v: [12, 0, 0],
                    f: '12 pm'
                }, 5, 2.25],
                [{
                    v: [13, 0, 0],
                    f: '1 pm'
                }, 6, 3],
                [{
                    v: [14, 0, 0],
                    f: '2 pm'
                }, 7, 4],
                [{
                    v: [15, 0, 0],
                    f: '3 pm'
                }, 8, 5.25],
                [{
                    v: [16, 0, 0],
                    f: '4 pm'
                }, 9, 7.5],
                [{
                    v: [17, 0, 0],
                    f: '5 pm'
                }, 10, 10],
            ]);

            var options = {
                title: 'Motivation and Energy Level Throughout the Day',
                isStacked: true,
                hAxis: {
                    title: 'Time of Day',
                    format: 'h:mm a',
                    viewWindow: {
                        min: [7, 30, 0],
                        max: [17, 30, 0]
                    }
                },
                vAxis: {
                    title: 'Rating (scale of 1-10)'
                }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script> --}}
@endsection
