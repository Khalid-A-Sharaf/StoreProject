<!-- Nav Item - Alerts -->
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        @if ($newCount)
            <span class="badge badge-danger badge-counter" id="nt_count">{{ $newCount }}</span>
        @endif
    </a>
    <!-- Dropdown - Alerts -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="alertsDropdown">
        <h4 class="dropdown-header">
            Notifications
        </h4>
        @forelse ($notifications as $notification)
            <a class="dropdown-item d-flex align-items-center "
                href="{{ $notification->data['url'] }}?notification_id={{ $notification->id }}">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <i class="{{ $notification->data['icon'] }} text-white"></i>
                    </div>
                </div>
                <div>
                    {{-- longAbsoluteDiffForHumans() | shortAbsoluteDiffForHumans() | diffForHumans() --}}
                    <div class="small text-gray-500">{{ $notification->created_at->longAbsoluteDiffForHumans() }}</div>
                    <span
                        class=" @if ($notification->unread()) font-weight-bold @endif">{{ $notification->data['body'] }}</span>
                </div>
            </a>
        @empty
            <a class="dropdown-item text-center small text-gray-500" href="#">
                <h6>There are no notifications</h6>
            </a>
        @endforelse
        @if ($newCount)
            <a class="dropdown-item text-center small text-gray-500" href="#">Show All
                Alerts</a>
        @endif
    </div>
</li>

<script>
    // function remove() {
    //     var span = document.getElementById('nt_count').innerText;
    //     span.innerText = span.innerText - 1;
    // }
</script>
