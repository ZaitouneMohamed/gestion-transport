@extends('gazole.layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ route('chaufeur.create') }}" class="btn btn-success">create new chaufeur</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body pb-0">
                    <div class="row">
                        @forelse ($chaufeurs as $item)
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill">
                                    <div class="card-header text-muted border-bottom-0">
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="lead"><b>{{ $item->full_name }}</b></h2>
                                                <p class="text-muted text-sm">
                                                    <b>Code: </b>{{ $item->code }}
                                                </p>
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small">
                                                        <span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                                        Address: {{ $item->adresse }}
                                                    </li>
                                                    <li class="small">
                                                        <span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                                        Phone 1: {{ $item->phone }}
                                                    </li>
                                                    <li class="small">
                                                        <span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                                        Phone 2:{{ $item->numero_2 }}
                                                    </li>
                                                </ul><br>
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small">
                                                        <span class="fa-li"><i class="fa-solid fa-envelope"></i></span>
                                                        email: {{ $item->email }}
                                                    </li>
                                                    <li class="small">
                                                        {{-- <span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> --}}
                                                        cni: {{ $item->cni }}
                                                    </li>
                                                    <li class="small">
                                                        {{-- <span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> --}}
                                                        cnss:{{ $item->cnss }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex">
                                            <a href="{{ route('chaufeur.edit', $item->id) }}" class="btn btn-warning mr-1">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            @if ($item->statue === 1)
                                                <a href="{{ route('SwitchActiveModeForChaufeur', $item->id) }}"
                                                    class="btn btn-success mr-1">
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('SwitchActiveModeForChaufeur', $item->id) }}"
                                                    class="btn btn-danger mr-1">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </a>
                                            @endif
                                            @if ($item->Consomations->count() == 0)
                                                <form action="{{ route('chaufeur.destroy', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $chaufeurs->links() }}
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
