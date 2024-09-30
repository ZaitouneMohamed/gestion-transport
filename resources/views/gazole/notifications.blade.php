@extends('gazole.layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Notifications</h3>
                @if ($notifications->count() > 0)
                    <form action="{{ route('notifications.deleteAll') }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete All Notifications</button>
                    </form>
                @endif
            </div>
            <div class="card-body">
                @if ($notifications->count() > 0)
                    <ul class="list-group">
                        @foreach ($notifications as $notification)
                            <li class="list-group-item d-flex justify-content-between align-items-center
                                {{ $notification->read_at ? 'text-muted' : 'text-dark' }}">
                                <div>
                                    <h5 class="mb-1">{{ $notification->data['title'] ?? 'Notification' }}</h5>
                                    <p class="mb-1">{{ $notification->data['message'] ?? 'No details available' }}</p>
                                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                </div>
                                <div>
                                    @if (!$notification->read_at)
                                        <form action="{{ route('notifications.read', $notification->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success me-2">Mark as Read</button>
                                        </form>
                                    @endif
                                    <form action="{{ route('notifications.delete', $notification->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    {{ $notifications->links() }}
                @else
                    <p class="text-center">No notifications available.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
