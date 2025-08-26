@extends('gazole.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-2">
                <a href="{{ route('consomations.create') }}" class="btn btn-success">
                    <b>Create New Trajet</b>
                </a>
            </div>
            <div class="col-md-6">
                <form action="{{ route('consomations.index') }}" method="GET" class="d-flex gap-2">
                    <input type="date" name="date" value="{{ request('date', date('Y-m-d')) }}" class="form-control">
                    <button type="submit" class="btn btn-success">Filter</button>
                </form>
            </div>
            <div class="col-md-4">
                <div class="d-flex gap-2 align-items-center">
                    <span>Excel:</span>
                    <form action="{{ route('excel.exportTrajet') }}" method="POST" class="d-flex gap-2">
                        @csrf
                        <input type="date" name="date" value="{{ date('Y-m-d') }}" class="form-control">
                        <button type="submit" class="btn btn-success">Export</button>
                    </form>
                    <a href="{{ route('email') }}" class="btn btn-outline-primary">
                        <i class="fa fa-envelope-open" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead >
                    <tr>
                        <th>Chauffeur</th>
                        <th>Camion</th>
                        <th>Ville</th>
                        <th>Trajet Composé</th>
                        <th>KM Total</th>
                        <th>KM Proposé</th>
                        <th>Taux</th>
                        <th>Camion Consommation</th>
                        <th>Statut Gazole</th>
                        <th>Statut Mission</th>
                        <th>Prix</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($consomations as $item)
                        <tr>
                            <td>{{ $item->chaufeur->full_name }}</td>
                            <td>{{ $item->camion->matricule }}</td>
                            <td>{{ $item->ville }}</td>
                            <td>
                                @if ($item->status === 1 && isset($item->calculated_values['qty_littre']))
                                    {{ $item->calculated_values['qty_littre'] }}
                                @endif
                            </td>
                            <td>
                                @if ($item->status === 1 && isset($item->calculated_values['km_total']))
                                    {{ $item->calculated_values['km_total'] }}
                                @endif
                            </td>
                            <td>
                                @if ($item->status === 1)
                                    {{ $item->km_proposer }}
                                @endif
                            </td>
                            <td>
                                @if ($item->status === 1)
                                    {{ number_format($item->calculated_values['taux'], 2) }}
                                @endif
                            </td>
                            <td>
                                {{ $item->camion->consommation }}
                            </td>
                            <td>
                                @if ($item->status === 1)
                                    @php
                                        $statue = $item->calculated_values['statue'];
                                        $isNegative = $statue < 0;
                                        $displayValue = $isNegative ? abs($statue) : $statue;
                                    @endphp
                                    <span class="badge {{ $isNegative ? 'bg-success' : 'bg-danger' }}">
                                        {{ number_format($displayValue, 2) }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if ($item->status === 1 && isset($item->calculated_values['km_total']))
                                    @php
                                        $difference = $item->km_proposer - $item->calculated_values['km_total'];
                                        $isNegative = $difference < 0;
                                        $displayValue = abs($difference);
                                    @endphp
                                    <span class="badge {{ $isNegative ? 'bg-danger' : 'bg-success' }}">
                                        {{ $displayValue }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if ($item->status === 1 && isset($item->calculated_values['prix']))
                                    {{ number_format($item->calculated_values['prix'], 2) }}
                                @endif
                            </td>
                            <td>
                                {{ $item->date->format('Y-m-d') }}
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    @if ($item->status === 0)
                                        <a href="{{ route('createBon', $item->id) }}"
                                           title="Add Bons Here"
                                           class="btn btn-success btn-sm">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        @if ($item->bons->where('nature', 'gazole')->count() >= 2)
                                            <a href="{{ route('SwitchActiveModeForTrajet', $item->id) }}"
                                               title="Mark trajet as complete"
                                               class="btn btn-warning btn-sm">
                                                <i class="fa-solid fa-check"></i>
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ route('SwitchActiveModeForTrajet', $item->id) }}"
                                           title="Mark trajet as incomplete"
                                           class="btn btn-secondary btn-sm">
                                            <i class="fa-solid fa-xmark"></i>
                                        </a>
                                    @endif

                                    <a href="{{ route('consomations.edit', $item->id) }}"
                                       class="btn btn-warning btn-sm">
                                        <i class="fa fa-pen"></i>
                                    </a>

                                    <a href="{{ route('getBons', $item->id) }}"
                                       class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <form action="{{ route('consomations.destroy', $item->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this trajet?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fa fa-inbox fa-2x mb-2"></i>
                                    <p>No trajets found for the selected criteria.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $consomations->withQueryString()->links() }}
        </div>
    </div>
@endsection

@push('styles')
<style>
    .table th {
        white-space: nowrap;
    }

    .btn-group-actions {
        min-width: 200px;
    }

    .badge {
        font-size: 0.875em;
    }
</style>
@endpush
