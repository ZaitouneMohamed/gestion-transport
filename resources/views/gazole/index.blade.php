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
                <!-- /.content -->
            </div>

@endsection
