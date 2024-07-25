<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/chat.css') }}">

@if (!$group)
<script>
    alert('This page expired');
    window.location.href = "{{ url()->previous() }}"; // Redirect to previous page
</script>
@endif
<style>
    body {
        background-color: #f7f7f7;
    }
    .container {
        margin-top: 50px;
    }
    .pin-title {
    position: fixed;
    top: 0;
    width: 100%;
    background: #0f4b8f;
    z-index: 1000;
    padding: 10px;
    border-bottom: 1px solid #ddd;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px; /* Space between text and image */
}

.pin-title h1 {
    color: #ffffff;
    font-size: 24px;
    margin: 0;
}

.pin-title img {
    width: 30px; /* Adjust size of the pin image */
    height: 30px;
}


    .avatar img {
        border-radius: 50%;
        width: 50px;
        height: 50px;
        object-fit: cover;
    }
    .chat-window {
        max-width: 500px;
        margin: 0 auto;
        /* background: #ffffff; */
        border-radius: 10px;
        overflow: hidden;
        /* box-shadow: 0 0 10px rgba(0,0,0,0.1); */
    }
    .panel {
        margin-bottom: 0;
    }
    .panel-heading {
        background-color: #439cfa !important;
        color: #fff !important;
        padding: 10px 15px;
        border-bottom: 1px solid transparent;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    .panel-title {
        font-size: 16px;
        margin: 0;
    }
    .panel-body {
        padding: 10px;
        height: 400px;
        overflow-y: auto;
        background-color: #f7f7f7;
    }
    .msg_container {
        margin-bottom: 10px;
    }
    .msg_container .avatar {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .messages {
        padding: 10px;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .messages p {
        margin: 0;
        font-size: 14px;
    }
    .messages time {
        font-size: 12px;
        color: #999999;
    }
    .panel-footer {
        padding: 10px;
        background-color: #f1f1f1;
        border-top: 1px solid #dddddd;
    }
    .chat_input {
        border: none;
        border-radius: 0;
        box-shadow: none;
        height: 40px;
    }
    .btn-chat {
        background-color: #007bff;
        color: #ffffff;
        border-radius: 0;
        height: 40px;
    }
    .btn-chat:hover {
        background-color: #0056b3;
    }
    .fa-star.checked {
        color: #FFD700;
    }
    .fa-star {
        color: gray;
    }
</style>

<div class="container">
    @if (isset($pin_message->message))
    <div class="pin-title">
        <h1>{{ $pin_message->message }}</h1>
        <img src="{{ asset('img/pin.png') }}" alt="">
    </div>
    @endif

    <div class="row chat-window" id="chat_window_1">
        <div class="col-xs-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading top-bar">
                    <div class="col-md-8 col-xs-8">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> {{ $group->name }} group chat</h3>
                    </div>
                    <div class="col-md-4 col-xs-4" style="text-align: right;">
                        @if ($group->admin->id == auth()->user()->id)
                        <a href="#" data-toggle="modal" data-target="#deleteChatModal"><span style="color: #ddd" class="glyphicon glyphicon-trash icon_close"></span></a>
                        @endif
                        <a href="#"><span style="color: #ddd" id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>
                        <a href="#"><span style="color: #ddd" class="glyphicon glyphicon-remove icon_close" data-id="chat_window_1"></span></a>
                    </div>
                </div>
                <div class="panel-body msg_container_base" id="chat_area">
                    @foreach ($messages as $message)
                    <div class="row msg_container base_sent">
                        <div class="col-md-2 col-xs-2 avatar">
                            <a href="{{ route('user.map', ['id' => $message->user->id]) }}">
                                @if ($message->user->image)
                                <img src="{{ asset($message->user->image) }}" class="img-responsive">
                                @else
                                <img src="{{ asset('img/boy2.png')}}" class="img-responsive">
                                @endif
                            </a>
                        </div>
                        <div class="col-md-10 col-xs-10">
                            <div class="messages base_sent">
                                <p>{{ $message->message }}</p>
                                <time datetime="{{ $message->created_at }}">
                                    <a href="{{ route('user.map', ['id' => $message->user->id]) }}">
                                        {{ $message->user->name }}
                                        @if ($message->user->type == 1)
                                            ({{ __('Normal user') }})
                                        @elseif ($message->user->type == 2)
                                            ({{ __('Doctor') }})
                                        @elseif ($message->user->type == 3)
                                            ({{ __('diabetes educator') }})
                                        @endif
                                    </a> <br>{{ $message->created_at->diffForHumans() }}
                                </time>
                                @for ($i = 1; $i <= 5; $i++) 
                                <span style='font-size:10px' class="fa fa-star {{ $i <= $message->user->ratings()->avg('rating') ? 'checked' : '' }}"></span>
                            @endfor
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" name="message" class="form-control input-sm chat_input" placeholder="Write your message here..." />
                        <span class="input-group-btn">
                            <button class="btn btn-primary btn-sm btn-chat" id="btn-chat">Send</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Chat Modal -->
<div class="modal fade" id="deleteChatModal" tabindex="-1" role="dialog" aria-labelledby="deleteChatModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteChatModalLabel">{{ __('Delete Chat') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ __('Are you sure you want to delete the whole chat?') }}
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                <form action="{{ route('delete_messages', $group->id) }}" method="POST">
                    @csrf
                    {{-- @method('DELETE') --}}
                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#btn-chat').click(function() {
        let message = $('#btn-input').val();
        if (message.trim() === '') return; // Prevent empty messages

        $.post("/group/{{ $group->id }}", {
                group_id: {{ $group->id }},
                message: message,
                _token: '{{ csrf_token() }}' // Ensure CSRF token is included
            },
            function(data, status) {
                console.log("Data: " + data + "\nStatus: " + status);
                $('#btn-input').val(''); // Clear the input field after sending
            });
    });

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('a6ae51eaa3567ea7e360', {
        cluster: 'eu'
    });

    var channel = pusher.subscribe("group-chat{{ $group->id }}");

    channel.bind('GroupChatSent', function(data) {
        // Get current time
        let now = dayjs();
        let relativeTime = now.fromNow();
        let userType = '';

        switch (data.user.type) {
            case 1:
                userType = "({{ __('Normal user') }})";
                break;
            case 2:
                userType = "({{ __('Doctor') }})";
                break;
            case 3:
                userType = "({{ __('diabetes educator') }})";
                break;
            default:
                userType = '';
        }
        var stars = '';
        for (var i = 1; i <= 5; i++) {
            stars += '<span style="font-size:10px" class="fa fa-star' + (i <= data.user.rating ? ' checked' : '') + '"></span>';
        }
        let userImage = data.user.image ? `{{ asset('') }}${data.user.image}` : `{{ asset('img/boy2.png') }}`;

        let receiverMessage = `
        <div class="row msg_container base_sent">
            <div class="col-md-2 col-xs-2 avatar">
                <a href="/user/${data.user.id}/map">
                    <img src="${userImage}" class="img-responsive">
                </a>
            </div>
            <div class="col-md-10 col-xs-10">
                <div class="messages base_sent">
                    <p>${data.message}</p>
                    <time datetime="${now.toISOString()}">
                        <a href="/user/${data.user.id}/map">${data.user.name} ${userType}</a><br> ${relativeTime}
                        ${stars}
                    </time>
                </div>
            </div>
        </div>`;

        $('#chat_area').append(receiverMessage);
        $('#btn-input').val(''); // Clear the input field after sending
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1/plugin/relativeTime.js"></script>
<script>
    dayjs.extend(dayjs_plugin_relativeTime);
</script>

<script src="{{ asset('js/chat.js') }}"></script>
