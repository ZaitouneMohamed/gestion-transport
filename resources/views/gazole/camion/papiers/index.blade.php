@extends('gazole.layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- Statistics Cards -->
        <div class="row mb-4">
            @php
                $urgent = $data->filter(fn($item) => $item->days_until_next_notification !== null && $item->days_until_next_notification <= 10)->count();
                $overdue = $data->filter(fn($item) => $item->days_until_next_notification !== null && $item->days_until_next_notification < 0)->count();
                $total = $data->total();
            @endphp


                <div class="container-fluid">
                    <!-- Header Section -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card shadow-sm">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3 class="mb-1">
                                            <i class="fas fa-file-alt text-primary"></i> Papiers Management
                                        </h3>
                                        <p class="text-muted mb-0">Manage and track all document expiration dates</p>
                                    </div>
                                    <a href="{{ route('papiers.create') }}" class="btn btn-primary btn-lg">
                                        <i class="fas fa-plus-circle"></i> Create New Papier
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3 col-sm-6">
                            <div class="info-box bg-gradient-info">
                                <span class="info-box-icon"><i class="fas fa-file-alt"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Papiers</span>
                                    <span class="info-box-number">{{ $papierStats['total'] }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="info-box bg-gradient-warning">
                                <span class="info-box-icon"><i class="fas fa-exclamation-triangle"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Urgent (≤10 days)</span>
                                    <span class="info-box-number">{{ $papierStats['urgent'] }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="info-box bg-gradient-danger">
                                <span class="info-box-icon"><i class="fas fa-bell"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Overdue</span>
                                    <span class="info-box-number">{{ $papierStats['overdue'] }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="info-box bg-gradient-success">
                                <span class="info-box-icon"><i class="fas fa-check-circle"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Up to Date</span>
                                    <span class="info-box-number">{{ $papierStats['upToDate'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rest of your table... -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow-sm">
                                <!-- Table Section -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card shadow-sm">
                                            <div class="card-header bg-white">
                                                <h4 class="card-title mb-0">
                                                    <i class="fas fa-list"></i> All Papiers
                                                </h4>
                                            </div>
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-striped mb-0">
                                                        <thead class="bg-light">
                                                        <tr>
                                                            <th scope="col" class="border-0">
                                                                <i class="fas fa-tag"></i> Titre
                                                            </th>
                                                            <th scope="col" class="border-0">
                                                                <i class="fas fa-truck"></i> Camion
                                                            </th>
                                                            <th scope="col" class="border-0">
                                                                <i class="fas fa-calendar-alt"></i> Next Due Date
                                                            </th>
                                                            <th scope="col" class="border-0">
                                                                <i class="fas fa-hourglass-half"></i> Days Remaining
                                                            </th>
                                                            <th scope="col" class="border-0 text-center">
                                                                <i class="fas fa-cog"></i> Actions
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @forelse ($data as $item)
                                                            @php
                                                                $daysUntil = $item->days_until_next_notification;
                                                                $rowClass = '';
                                                                if ($daysUntil !== null) {
                                                                    if ($daysUntil < 0) {
                                                                        $rowClass = 'table-danger';
                                                                    } elseif ($daysUntil <= 10) {
                                                                        $rowClass = 'table-warning';
                                                                    }
                                                                }
                                                            @endphp
                                                            <tr class="{{ $rowClass }}">
                                                                <td>
                                                                    <strong>{{ $item->title }}</strong>
                                                                </td>
                                                                <td>
                                                                    <span class="badge badge-info badge-lg">
                                                                        {{ $item->Camion->matricule }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <strong>
                                                                        <i class="fas fa-flag text-primary"></i>
                                                                        {{ $item->target_date_formatted }}
                                                                    </strong>
                                                                </td>
                                                                <td>
                                                                    @if($daysUntil === null)
                                                                        <span class="badge badge-secondary badge-lg">
                                                    <i class="fas fa-question-circle"></i> N/A
                                                </span>
                                                                    @elseif($daysUntil < 0)
                                                                        <span class="badge badge-danger badge-lg">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ abs($daysUntil) }} days overdue
                                                </span>
                                                                    @elseif($daysUntil == 0)
                                                                        <span class="badge badge-danger badge-lg pulse">
                                                    <i class="fas fa-bell"></i> Due Today!
                                                </span>
                                                                    @elseif($daysUntil == 1)
                                                                        <span class="badge badge-warning badge-lg">
                                                    <i class="fas fa-clock"></i> Tomorrow
                                                </span>
                                                                    @elseif($daysUntil <= 10)
                                                                        <span class="badge badge-warning badge-lg">
                                                    <i class="fas fa-hourglass-half"></i> {{ $daysUntil }} days
                                                </span>
                                                                    @elseif($daysUntil <= 30)
                                                                        <span class="badge badge-info badge-lg">
                                                    <i class="fas fa-clock"></i> {{ $daysUntil }} days
                                                </span>
                                                                    @else
                                                                        <span class="badge badge-success badge-lg">
                                                    <i class="fas fa-check"></i> {{ $daysUntil }} days
                                                </span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    <div class="btn-group" role="group">
                                                                        <a href="{{ route('papiers.show', $item->id) }}"
                                                                           class="btn btn-sm btn-info"
                                                                           title="View Details">
                                                                            <i class="fas fa-eye"></i>
                                                                        </a>
                                                                        <a href="{{ route('papiers.edit', $item->id) }}"
                                                                           class="btn btn-sm btn-warning"
                                                                           title="Edit">
                                                                            <i class="fas fa-edit"></i>
                                                                        </a>
                                                                        <form action="{{ route('papiers.destroy', $item->id) }}"
                                                                              method="post"
                                                                              class="d-inline delete-form">
                                                                            @csrf
                                                                            @method('delete')
                                                                            <button type="button"
                                                                                    class="btn btn-sm btn-danger"
                                                                                    onclick="confirmDelete(this);"
                                                                                    title="Delete">
                                                                                <i class="fas fa-trash"></i>
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="6" class="text-center py-5">
                                                                    <div class="text-muted">
                                                                        <i class="fas fa-inbox fa-3x mb-3"></i>
                                                                        <h5>No Papiers Found</h5>
                                                                        <p>Start by creating your first papier</p>
                                                                        <a href="{{ route('papiers.create') }}" class="btn btn-primary">
                                                                            <i class="fas fa-plus"></i> Create Papier
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            @if($data->hasPages())
                                                <div class="card-footer bg-white">
                                                    <div class="d-flex justify-content-center">
                                                        {{ $data->links() }}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
        </div>


@endsection

@section('styles')
    <style>
        .info-box {
            box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
            border-radius: .25rem;
            padding: 1rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .info-box-icon {
            border-radius: .25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            width: 70px;
            height: 70px;
            color: white;
        }

        .info-box-content {
            flex: 1;
            padding-left: 1rem;
        }

        .info-box-text {
            display: block;
            font-size: 0.875rem;
            color: rgba(255,255,255,0.9);
            text-transform: uppercase;
        }

        .info-box-number {
            display: block;
            font-size: 1.75rem;
            font-weight: 700;
            color: white;
        }

        .bg-gradient-info {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            color: white;
        }

        .bg-gradient-warning {
            background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
            color: white;
        }

        .bg-gradient-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
        }

        .bg-gradient-success {
            background: linear-gradient(135deg, #28a745 0%, #218838 100%);
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0,0,0,.035);
            transition: all 0.2s ease;
        }

        .badge-lg {
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .btn-group {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
            border-radius: 0.25rem;
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
            }
        }

        .card {
            border: none;
            border-radius: 0.5rem;
        }

        .card-header {
            border-bottom: 2px solid #f0f0f0;
            padding: 1rem 1.5rem;
        }

        thead th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            color: #495057;
        }

        .table-danger {
            background-color: rgba(220, 53, 69, 0.1) !important;
        }

        .table-warning {
            background-color: rgba(255, 193, 7, 0.1) !important;
        }
    </style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(button) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        }

        // Optional: Add tooltips
        $(function () {
            $('[title]').tooltip();
        });
    </script>
@endsection
