<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .notification-item {
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f8f9fa;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notification-item .badge {
            background-color: red;
            color: white;
        }

        .notification-item .chat-link {
            color: #007bff;
            text-decoration: none;
        }

        .notification-item .chat-link:hover {
            text-decoration: underline;
        }
        .notification-item.read {
    opacity: 0.6; /* Example: reduce opacity for read notifications */
}

.notification-item .read-info {
    font-size: 12px;
    color: #6c757d; /* Example: muted color for read info */
}

    </style>
</head>
<body>
    <div class="container mt-5">
        <h4 class="mb-4">Notifications</h4>
        <div id="notifications-container">
            @foreach($notifications as $notification)
            <div class="notification-item{{ $notification->read_at ? ' read' : '' }}">
                <div>
                    <span class="badge badge-danger">{{ __('Critical') }}</span>
                    <strong>{{ $notification->user->name }}</strong>
                </div>
                <span > {{  $notification->created_at->diffForHumans() }}</span>
                <a href="/group/{{ $notification->group_id }}" class="chat-link" data-id="{{ $notification->id }}">
                    {{ __('Go to Chat') }}
                    {{-- @if ($notification->read_at)
                    <span class="read-info">Read at {{ $notification->read_at }}</span>
                    @endif --}}
                </a>
            </div>
        @endforeach
                </div>
    </div>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });

        var channel = pusher.subscribe('status-updates');
        channel.bind('App\\Events\\StatusUpdated', function(data) {
            if (data.status === 'critical') {
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

        // document.addEventListener('click', function(event) {
        //     if (event.target.classList.contains('chat-link')) {
        //         event.preventDefault();
        //         var notificationId = event.target.getAttribute('data-id');
        //         var groupLink = event.target.href;

        //         fetch(`/notifications/read/${notificationId}`, {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //             }
        //         }).then(response => response.json())
        //           .then(data => {
        //               if (data.success) {
        //                   window.location.href = groupLink;
        //               }
        //           }).catch(error => console.error('Error:', error));
        //     }
        // });
    </script>
</body>
</html>
