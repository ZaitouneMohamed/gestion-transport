@extends('gazole.layouts.master')

@section("title" , "Dashboard")

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
                                <h3>{{ $Counts['camion_aej_count'] }}</h3>
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
                                <h3>{{ $Counts['active_chauffeurs'] }}</h3>
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
                                <h3>{{ $Counts['station_count_index'] }}</h3>

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
                                <h3>{{ $Counts['consomationsCountIndex'] }}</h3>
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
                <!-- /.row -->
                <h5 class="mt-4 mb-2">4 papiers near to end</h5>
                <div class="row">
                    @forelse ($nearestFourPapiersToEnd as $item)
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box text-bg-primary bg-gradient">
                                <div class="info-box-content">
                                    <span class="info-box-text">{{ $item->Camion->matricule }}</span>
                                    <span class="info-box-number">{{ $item->title }}</span>
                                    <div class="progress">
                                        @php
                                            $daysUntil = $item->days_until_next_notification;
                                            // Calculate progress percentage (assuming 365 days cycle)
                                            $totalDays = $item->days_count ?? 365;
                                            $daysPassed = $totalDays - ($daysUntil ?? 0);
                                            $percentage = $totalDays > 0 ? min(100, max(0, ($daysPassed / $totalDays) * 100)) : 0;

                                            // Determine progress bar color based on days remaining
                                            if ($daysUntil <= 10) {
                                                $progressColor = 'bg-danger';
                                            } elseif ($daysUntil <= 30) {
                                                $progressColor = 'bg-warning';
                                            } else {
                                                $progressColor = 'bg-success';
                                            }
                                        @endphp
                                        <div class="progress-bar {{ $progressColor }}" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <span class="progress-description">
                                        @if($daysUntil === null)
                                            N/A
                                        @elseif($daysUntil < 0)
                                            {{ abs($daysUntil) }} days overdue
                                        @elseif($daysUntil == 0)
                                            Due today!
                                        @elseif($daysUntil == 1)
                                            Due tomorrow
                                        @else
                                            {{ $daysUntil }} days remaining
                                        @endif
                                    </span>
                                </div> <!-- /.info-box-content -->
                            </div> <!-- /.info-box -->
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info">
                                No Papiers Found
                            </div>
                        </div>
                    @endforelse
                </div> <!--end::Row-->
            </div><!-- /.container-fluid -->
        </section>
        <div class="row">
            <div class="col-lg-12 col-12">
                <canvas id="myColumnChart" width="400" height="150"></canvas>
            </div>
            <div class="col-lg-6 col-6">
                {{-- <div id="piechart" style="height: 400px;"></div> --}}
                <canvas id="myPieChart" width="200" height="150"></canvas>
            </div>
            <div class="col-lg-6 col-6">
                {{-- <div id="piechart" style="height: 400px;"></div> --}}
                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th>Chaufeur Code</th>
                            <th>Chaufeur Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($chaufeursWithSumStatues as $item)
                            @php
                                $totalStatue = 0;
                            @endphp
                            @if ($item->full_name != 'M.SAYAH' || $item->full_name != 'YOUCEF STATION' || $item->full_name != 'HAKIM')
                                <tr>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->full_name }}</td>
                                    @php
                                        $totalStatue += $item->Statue;
                                    @endphp
                                    <td>
                                        @if ($item->sum_statues < 0)
                                            <span class="badge bg-success">{{ $item->sum_statues * -1 }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ $item->sum_statues }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6 col-6">
                {{-- <div id="piechart" style="height: 400px;"></div> --}}
                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th>Station</th>
                            <th>total Mount</th>
                            <th>Statuss</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stationsData as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->factures_prix_sum ?? 0 }}</td>
                                <td>
                                    @if (($item->factures_prix_sum ?? 0) > $item->solde)
                                        <span class="badge bg-danger">{{ ($item->factures_prix_sum ?? 0) - $item->solde }}</span>
                                    @else
                                        <span class="badge bg-success">{{ $item->solde - ($item->factures_prix_sum ?? 0) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-lg-6 col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Papiers Status</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                            <tr>
                                <th>Camion</th>
                                <th>Papier</th>
                                <th>Status</th>
                                <th>Days</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($nearestPapiers as $item)
                                @php
                                    $daysUntil = $item->days_until_next_notification;

                                    // Determine badge color
                                    if ($daysUntil === null) {
                                        $badgeClass = 'badge-secondary';
                                        $statusText = 'N/A';
                                    } elseif ($daysUntil < 0) {
                                        $badgeClass = 'badge-danger';
                                        $statusText = 'Overdue';
                                    } elseif ($daysUntil == 0) {
                                        $badgeClass = 'badge-danger';
                                        $statusText = 'Due Today';
                                    } elseif ($daysUntil <= 10) {
                                        $badgeClass = 'badge-warning';
                                        $statusText = 'Urgent';
                                    } elseif ($daysUntil <= 30) {
                                        $badgeClass = 'badge-info';
                                        $statusText = 'Soon';
                                    } else {
                                        $badgeClass = 'badge-success';
                                        $statusText = 'OK';
                                    }
                                @endphp
                                <tr>
                                    <td>
                                        <strong>{{ $item->Camion->matricule }}</strong>
                                    </td>
                                    <td>{{ $item->title }}</td>
                                    <td>
                                        <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                                    </td>
                                    <td>
                                        @if($daysUntil === null)
                                            <span class="text-muted">N/A</span>
                                        @elseif($daysUntil < 0)
                                            <span class="text-danger">
                                        <i class="fas fa-exclamation-triangle"></i> {{ abs($daysUntil) }} days overdue
                                    </span>
                                        @elseif($daysUntil == 0)
                                            <span class="text-danger">
                                        <i class="fas fa-bell"></i> Today
                                    </span>
                                        @elseif($daysUntil == 1)
                                            <span class="text-warning">
                                        <i class="fas fa-clock"></i> Tomorrow
                                    </span>
                                        @else
                                            <span class="text-{{ $daysUntil <= 10 ? 'warning' : 'success' }}">
                                        {{ $daysUntil }} days
                                    </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        <i class="fas fa-info-circle"></i> No Papiers Found
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg6 col-6">
                <div id="barchart_values" style="width: 900px; height: 300px;"></div>
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
                    data: results.map(item => item.percentage_prix),
                    backgroundColor: [
                        'rgba(255, 0, 0, 0.7)',
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
        var colors = ['rgba(75, 192, 192, 0.7)', 'rgba(255, 99, 132, 0.7)', 'rgba(255, 205, 86, 0.7)',
            'rgba(54, 162, 235, 0.7)', 'rgba(153, 102, 255, 0.7)', 'rgba(255, 159, 64, 0.7)'
        ]; // Add more colors if needed

        var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
            "November", "December"
        ];

        var myColumnChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: results.map(function(item) {
                    return monthNames[item.month - 1] + ' ' + item
                        .year;
                }),
                datasets: [{
                    label: 'Total Prix',
                    data: results.map(item => item.total_prix),
                    backgroundColor: function(context) {
                        return colors[context.dataIndex % colors.length];
                    },
                }],
            },
        });
    </script>
@endsection
