<li class="nav-item dropdown">
    <a class="nav-link" data-bs-toggle="dropdown" href="#">
        <i class="fa-solid fa-bell"></i>
        <span class="navbar-badge badge text-bg-warning">{{ $latest_notifications->count() }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
        <span class="dropdown-item dropdown-header">{{ $latest_notifications->count() }} Notifications</span>
        @forelse ($latest_notifications as $item)
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <i class="bi bi-envelope me-2"></i>
                {{ $item->data['message'] ?? 'No details available' }}
                <!-- Adjust this to your notification structure -->
                <span class="float-end text-secondary fs-7">{{ $item->created_at->diffForHumans() }}</span>
            </a>
        @empty
            <div class="dropdown-divider"></div>
            <span class="dropdown-item">No notifications</span>
        @endforelse
        <div class="dropdown-divider"></div>
        <a href="{{ route('notifications.index') }}" class="dropdown-item dropdown-footer">
            See All Notifications
        </a>
    </div>
</li>
