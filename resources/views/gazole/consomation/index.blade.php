@extends('gazole.layouts.master')

@section('content')
    <br>
    <div class="row">
        <div class="col-2">
            <a href="{{ route('consomations.create') }}" class="btn btn-success"><b>Create New Trajet</b></a>
        </div>
        <div class="col-6">
            <form action="{{ route('consomations.index') }}" method="POST">
                @csrf
                @method('GET')
                <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" id="">
                <input type="submit" value="submit" class="btn btn-success">
            </form>
        </div>
        <div class="col-4">
            excel
            <form action="{{ route('excel.exportTrajet') }}" method="POST">
                @csrf
                @method('POST')
                <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" id="">
                <input type="submit" value="submit" class="btn btn-success">
            </form>
            <a href="{{ route('email') }}"><i class="fa fa-envelope-open" aria-hidden="true"></i></a>
        </div>
        <br><br>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Chaufeur</th>
                <th scope="col">camion</th>
                <th scope="col">ville</th>
                <th scope="col">Trajet Compose</th>
                <th scope="col">KM Total</th>
                <th scope="col">KM proposer</th>
                <th scope="col">Taux</th>
                <th scope="col">camion consommation</th>
                <th scope="col">Statue Gazole</th>
                <th scope="col">Statue mission</th>
                <th scope="col">Prix</th>
                <th scope="col">Date</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($consomations as $item)
                @php
                    if ($item->Bons->count() > 1) {
                        $km_total = $item->Bons->last()->km - $item->Bons->first()->km;
                    }
                @endphp
                <tr>
                    <td>{{ $item->chaufeur->full_name }} </td>
                    <td>{{ $item->camion->matricule }}</td>
                    <td>{{ $item->ville }}</td>
                    <td>
                        @if ($item->status === 1)
                            {{ $item->QtyLittre }}
                        @endif
                    </td>
                    <td>
                        @if ($item->status === 1)
                            {{ $item->KmTotal }}
                        @endif
                    </td>
                    <td>
                        @if ($item->status === 1)
                            {{ $item->km_proposer }}
                        @endif
                    </td>
                    <td>
                        @if ($item->status === 1)
                            {{ number_format($item->Taux, 2) }}
                        @endif
                    </td>
                    <td>
                        {{ $item->Camion->consommation }}
                    </td>
                    <td>
                        @if ($item->status === 1)
                            <span
                                class="badge
                            @if ($item->statue > 0) bg-danger
                            @else
                            bg-success @endif
                            ">
                            @if ($item->statue > 0)
                            {{ number_format($item->Statue, 2) }}
                            @else
                            {{ number_format($item->Statue, 2) * (-1)}}
                            @endif
                        </span>
                        @endif
                    </td>
                    <td style="width: 35%">
                        @if ($item->status === 1)
                            @if ($item->km_proposer - $item->KmTotal < 0)
                                <span class="badge bg-danger">{{ ($item->km_proposer - $item->KmTotal) * (-1) }}</span>
                            @else
                                <span class="badge bg-success">{{ $item->km_proposer - $item->KmTotal }}</span>
                            @endif
                        @endif
                    </td>
                    <td>
                        @if ($item->status === 1)
                            {{ $item->Prix }}
                        @endif
                    </td>
                    <td>
                        {{ $item->date }}
                    </td>
                    <td class="d-flex">
                        @if ($item->status === 0)
                            <a href="{{ route('createBon', $item->id) }}" title="Add Bons Here"
                                class="btn btn-success mr-1"><b><i class="fa fa-plus"></i></b></a>
                            @if ($item->Bons->where('nature', 'gazole')->count() >= 2)
                                <a href="{{ route('SwitchActiveModeForTrajet', $item->id) }}"
                                    title="check that trajet is complete" class="btn btn-danger mr-1"><b><i
                                            class="fa-solid fa-xmark"></i></b></a>
                            @endif
                        @else
                            <a href="{{ route('SwitchActiveModeForTrajet', $item->id) }}"
                                title="check that trajet is not complete" class="btn btn-success mr-1"><b><i
                                        class="fa-solid fa-check"></i></b></a>
                        @endif
                        <a href="{{ route('consomations.edit', $item->id) }}" class="btn btn-warning mr-1"><i
                                class="fa fa-pen"></i></a>
                        <a href="{{ route('getBons', $item->id) }}" class="btn btn-info mr-1"><i class="fa fa-eye"></i></a>
                        <form action="{{ route('consomations.destroy', $item->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i
                                    class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $consomations->links() }}
@endsection
