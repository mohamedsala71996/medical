<style>
    .sidebar {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .widget-title {
        color: #343a40;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .naves li {
        list-style: none;
        margin: 10px 0;
    }

    .naves li a {
        text-decoration: none;
        color: #495057;
        font-weight: 500;
        transition: color 0.3s;
    }

    .naves li a:hover {
        color: #007bff;
    }

    .naves li i {
        margin-right: 10px;
        color: #007bff;
    }

    button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }

    select {
        padding: 5px;
        border-radius: 4px;
        border: 1px solid #ced4da;
        margin-right: 10px;
    }

    .success-message {
        color: green;
        font-weight: bold;
        display: none;
        margin-top: 10px;
    }
    .nav-item {
    position: relative;
}

.nav-item .badge {
    position: absolute;
    top: -5;
    right:-5px;
    transform: translate(50%, -50%);
    background-color: red;
    color: white;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<div class="col-lg-3">
    <aside class="sidebar static">
        <div class="widget">
            <h4 class="widget-title">{{ __('Shortcuts') }}</h4>
            <ul class="naves">
                <li>
                    <i class="ti-mouse-alt"></i>
                    <a href="{{ url('/posts') }}" title="{{ __('Posts page') }}">{{ __('Posts page') }}</a>
                </li>
                <li>
                    <i class="ti-files"></i>
                    <a href="{{ url('siteProfile') }}" title="{{ __('MyProfile') }}">{{ __('MyProfile') }}</a>
                </li>
                {{-- <li class="nav-item">
                    <i class="fas fa-bell"></i>
                    <a  href="{{ url('notifications') }}" title="{{ __('Notifications') }}">
                        <span class="badge badge-danger">{{ App\Models\Notificaation::where('user_id','!=' ,Auth::id())->count() }}</span>
                        {{ __('Notifications') }}
                    </a>
                </li> --}}
                        
                @auth
                <li>
                    {{-- <form id="status-form">
                        @csrf
                        <select id="status" name="status">
                            <option value="active">{{ __('Active') }}</option>
                            <option value="critical">{{ __('Critical') }}</option>
                            <option value="inactive">{{ __('Inactive') }}</option>
                        </select>
                        <button type="button" onclick="updateStatus()">{{ __('Update status') }}</button>
                    </form>
                    <div class="success-message" id="success-message">{{ __('Status updated successfully!') }}</div>
                    <br> --}}
                    {{-- <form action="{{ route('users_location') }}" method="post"> --}}
                        {{-- @csrf --}}
                        <a href="{{ url('map') }}" class="btn btn-info" style="color: white"> {{ __('Go to Map') }}</a>
                        {{-- <button class="btn btn-info" type="submit"><i class="ti-map"></i> {{ __('Go to Map') }}</button> --}}
                    {{-- </form> --}}
                    <script src="/js/status.js"></script>
                    <script>
                        function updateStatus() {
                            document.getElementById('success-message').style.display = 'block';
                            setTimeout(() => {
                                document.getElementById('success-message').style.display = 'none';
                            }, 3000); // Hide after 3 seconds
                            var status = document.getElementById('status').value;
                            handleStatusChange(status);
                        }
                    </script>
                </li>
                <li>
                    <form action="{{ route('logout_status', auth()->user()->id) }}" method="post">
                        @csrf
                        <button type="submit" class="active">{{ __('Logout') }} <i class="ti-power-off"></i></button>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </aside>
</div>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
    });

    var channel = pusher.subscribe('status-updates');
    channel.bind('App\\Events\\StatusUpdated', function(data) {
        if (data.user_id !== {{ Auth::id() }}) { // Exclude notifications for the authenticated user
            alert(data.username + ' has updated their status to ' + data.status);

            // Update the notification badge count and content dynamically
            var badge = document.querySelector('.badge');
            var count = parseInt(badge.textContent) + 1;
            badge.textContent = count;

            // Append the new notification
            var notificationsContainer = document.getElementById('notifications-container');
            var notificationItem = document.createElement('div');
            notificationItem.classList.add('notification-item');

            var notificationContent = `
                <div>
                    <span class="badge badge-danger">Critical</span>
                    <strong>${data.username}</strong>
                </div>
                <a href="/group/${data.group_id}" class="chat-link" data-id="${data.notification_id}">Chat Group</a>
            `;

            notificationItem.innerHTML = notificationContent;
            notificationsContainer.appendChild(notificationItem);
        }
    });
</script>
