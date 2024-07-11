<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/chat.css') }}">


<style>
    .avatar img {
        border-radius: 50%;
        width: 50px;  /* Set specific width */
        height: 50px; /* Set specific height */
        object-fit: cover; /* Ensure the image covers the container without distortion */
    }
</style>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row chat-window col-xs-5 col-md-3" id="chat_window_1" style="margin-left:10px;">
        <div class="col-xs-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading top-bar">
                    <div class="col-md-8 col-xs-8">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> {{ $group->name }}
                            group chat</h3>
                    </div>
                    <div class="col-md-4 col-xs-4" style="text-align: right;">
                        @if ($group->admin->id ==auth()->user()->id)
                        <a href="#" data-toggle="modal" data-target="#deleteChatModal"><span class="glyphicon glyphicon-trash icon_close"></span></a>
                        @endif
                        <a href="#"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>
                        <a href="#"><span class="glyphicon glyphicon-remove icon_close" data-id="chat_window_1"></span></a>
                    </div>
                
                    {{-- <div class="col-md-4 col-xs-4" style="text-align: right;">
                        <a href="#"><span id="minim_chat_window"
                                class="glyphicon glyphicon-minus icon_minim"></span></a>
                        <a href="#"><span class="glyphicon glyphicon-remove icon_close"
                                data-id="chat_window_1"></span></a>
                    </div> --}}
                </div>
                <div class="panel-body msg_container_base" id="chat_area">
                    @foreach ($messages as $message)
                        <div class="row msg_container base_sent">
                            <div class="col-md-2 col-xs-2 avatar">
                                <img src="{{ asset($message->user->image) }}" class=" img-responsive ">
                            </div>
                            <div class="col-md-10 col-xs-10">
                                <div class="messages base_sent">
                                    <p>{{ $message->message }}</p>
                                    <time datetime="{{ $message->created_at }}">{{ $message->user->name }} •
                                        {{ $message->created_at->diffForHumans() }}</time>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" name="message" class="form-control input-sm chat_input"
                            placeholder="Write your message here..." />
                        <span class="input-group-btn">
                            <button class="btn btn-primary btn-sm" id="btn-chat">Send</button>
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
                    <h5 class="modal-title" id="deleteChatModalLabel">Delete Chat</h5>
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
                // let SenderMessage = '' +
                //     '<div class="row msg_container base_receive">' +
                //         '<div class="col-md-2 col-xs-2 avatar">' +
                //             '<img src="{{ asset(auth()->user()->photo) }}" class="img-responsive ">' +
                //         '</div>' +
                //         '<div class="col-xs-10 col-md-10">' +
                //             '<div class="messages msg_receive">' +
                //                 '<p>' + message + '</p>' +
                //                 '<time datetime="2009-11-13T20:00">Just now</time>' +
                //             '</div>' +
                //         '</div>' +
                //     '</div>';

                // $('#chat_area').append(SenderMessage);
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
        let receiverMessage = '<div class="row msg_container base_sent">' +
            '<div class="col-md-2 col-xs-2 avatar">' +
            '<img src="' + '{{ asset('') }}' + data.user.image + '" class=" img-responsive ">' +
            '</div>' +
            '<div class="col-md-10 col-xs-10">' +
            '<div class="messages base_sent">' +
            '<p>' + data.message + '</p>' +
            '<time datetime="' + now.toISOString() + '">' + data.user.name + ' ' + relativeTime + '</time>' +
            '</div>' +
            ' </div>' +
            '</div>';
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
