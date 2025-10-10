<div>
    <style>
        .card {
            border: none;
            border-radius: 10px;
        }

        .card-body {
            padding: 1.5rem;
        }

        .table th {
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-group .btn {
            margin: 0 2px;
        }

        .badge {
            padding: 0.5em 0.75em;
            font-weight: 500;
        }

        .table-responsive {
            overflow-x: auto;
        }

        @media (max-width: 768px) {
            .btn-group {
                flex-direction: column;
            }

            .btn-group .btn {
                margin: 2px 0;
                width: 100%;
            }
        }
    </style>

    <h3 class="text-center mb-4">Statistiques</h3>

    {{-- Filters Section --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="selectChaufeur" class="form-label">Chauffeur</label>
                    <select id="selectChaufeur" wire:model.live="chaufeur" class="form-select">
                        <option value="">Sélectionner un chauffeur  </option>
                        @foreach (\App\Models\Chaufeur::all() as $item)
                            <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="selectCamion" class="form-label">Camion</label>
                    <select id="selectCamion" wire:model.live="camion" class="form-select">
                        <option value="">Sélectionner un camion</option>
                        @foreach (\App\Models\Camion::all() as $item)
                            <option value="{{ $item->id }}">{{ $item->matricule }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="selectVille" class="form-label">Ville</label>
                    <select id="selectVille" wire:model.live="ville" class="form-select">
                        <option value="">Sélectionner une ville</option>
                        @foreach (\App\Models\Ville::all() as $item)
                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="dateDebut" class="form-label">Date Début</label>
                    <input type="date" id="dateDebut" wire:model.live="datedebut" class="form-control" value="{{ $datedebut }}">
                </div>

                <div class="col-md-6">
                    <label for="dateFin" class="form-label">Date Fin</label>
                    <input type="date" id="dateFin" wire:model.live="datefin" class="form-control" value="{{ $datefin }}">
                </div>
            </div>
        </div>
    </div>

    {{-- Loading Indicator --}}
    <div wire:loading class="text-center my-3">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Chargement...</span>
        </div>
        <p class="mt-2">Chargement des données...</p>
    </div>

    {{-- Results Section --}}
    @if ($chaufeur || $camion || $ville)
        <div wire:loading.remove>
            {{-- Summary Card --}}
            <div class="row mb-4">
                <div class="col-lg-6 col-xl-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title text-muted mb-3">Résumé</h5>

                            <div class="mb-3">
                                <h2 class="mb-1">{{ $trajets->count() }}</h2>
                                <p class="text-muted mb-0">Trajets</p>
                            </div>

                            @php
                                $full_price = 0;
                                $full_pricee = 0;
                                $qtyLittre = 0;

                                foreach ($trajets as $item) {
                                    $full_price += $item->Prix ?? 0;
                                    $full_pricee += $item->FullPrix ?? 0;
                                    if ($item->status == 1) {
                                        $qtyLittre += $item->QtyLittre ?? 0;
                                    }
                                }
                            @endphp

                            @if ($chaufeur == 24 || $chaufeur == 23)
                                <div class="border-top pt-3">
                                    <h3 class="mb-1">{{ number_format($full_pricee, 2) }} DH</h3>
                                    <p class="text-muted mb-0">Consommation</p>
                                </div>
                            @else
                                <div class="border-top pt-3">
                                    <h3 class="mb-1">{{ number_format($full_price, 2) }} DH</h3>
                                    <p class="text-muted mb-0">Prix Total</p>
                                </div>
                                <div class="border-top pt-3 mt-3">
                                    <h3 class="mb-1">{{ number_format($qtyLittre, 2) }} L</h3>
                                    <p class="text-muted mb-0">Consommation</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Data Table --}}
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Chauffeur</th>
                                    <th scope="col">Camion</th>
                                    <th scope="col">Ville</th>
                                    <th scope="col">Trajet Composé</th>
                                    <th scope="col">KM Total</th>
                                    <th scope="col">KM Proposé</th>
                                    <th scope="col">Taux</th>
                                    <th scope="col">Consommation</th>
                                    <th scope="col">Statut Gazole</th>
                                    <th scope="col">Statut Mission</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($trajets as $item)
                                    <tr>
                                        <td>{{ $item->chaufeur->full_name ?? 'N/A' }}</td>
                                        <td>{{ $item->camion->matricule ?? 'N/A' }}</td>
                                        <td>{{ $item->ville ?? 'N/A' }}</td>
                                        <td>
                                            @if ($item->status === 1)
                                                {{ number_format($item->QtyLittre ?? 0, 2) }} L
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status === 1)
                                                {{ number_format($item->KmTotal ?? 0, 2) }} km
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status === 1)
                                                {{ number_format($item->km_proposer ?? 0, 2) }} km
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status === 1)
                                                {{ number_format($item->Taux ?? 0, 2) }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->Camion->consommation ?? 'N/A' }}</td>
                                        <td>
                                            @if ($item->status === 1)
                                                <span class="badge {{ ($item->Statue ?? 0) > 0 ? 'bg-danger' : 'bg-success' }}">
                                                    {{ number_format($item->Statue ?? 0, 2) }}
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status === 1)
                                                @php
                                                    $difference = ($item->km_proposer ?? 0) - ($item->KmTotal ?? 0);
                                                @endphp
                                                <span class="badge {{ $difference < 0 ? 'bg-danger' : 'bg-success' }}">
                                                    {{ number_format($difference, 2) }} km
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status === 1)
                                                {{ number_format($item->Prix ?? 0, 2) }} DH
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                @if ($item->status === 0)
                                                    <a href="{{ route('createBon', $item->id) }}"
                                                       class="btn btn-sm btn-success"
                                                       title="Ajouter des bons">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                    @if ($item->Bons->where('nature', 'gazole')->count() >= 2)
                                                        <a href="{{ route('SwitchActiveModeForTrajet', $item->id) }}"
                                                           class="btn btn-sm btn-danger"
                                                           title="Marquer comme complet">
                                                            <i class="fa-solid fa-check"></i>
                                                        </a>
                                                    @endif
                                                @else
                                                    <a href="{{ route('SwitchActiveModeForTrajet', $item->id) }}"
                                                       class="btn btn-sm btn-warning"
                                                       title="Marquer comme incomplet">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </a>
                                                @endif
                                                <a href="{{ route('consomations.edit', $item->id) }}"
                                                   class="btn btn-sm btn-primary"
                                                   title="Modifier">
                                                    <i class="fa fa-pen"></i>
                                                </a>
                                                <a href="{{ route('getBons', $item->id) }}"
                                                   class="btn btn-sm btn-info"
                                                   title="Voir les détails">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <form action="{{ route('consomations.destroy', $item->id) }}"
                                                      method="post"
                                                      class="d-inline"
                                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce trajet ?')">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="13" class="text-center py-4">
                                            <i class="fa fa-inbox fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">Aucun trajet trouvé pour les critères sélectionnés</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info text-center" role="alert">
            <i class="fa fa-info-circle me-2"></i>
            Veuillez sélectionner au moins un critère de filtrage (Chauffeur, Camion ou Ville)
        </div>
    @endif
</div>
