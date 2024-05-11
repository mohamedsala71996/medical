@extends('layouts.site.inc.layouts')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3> مجموعة: {{$group->name}} </h3>
                    {{-- <span class="text-danger">Code to join: {{$group->code}}</span> --}}
                    {{-- @if ($group->admin_id == auth()->user()->id)

                        <div class="row">
                            <div class="col-md-4">
                                <p>
                                    <a class="btn btn-info" href="/group/edit/{{$group->id}}" style="color:white;">Edit</a>
                                </p>
                            </div>

                            <div class="col-md-4">
                                <form action="/group/delete/{{$group->id}}" method="POST">
                                    @csrf
                                    @method('Delete')

                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete group</button>
                                </form>
                            </div>

                            <div class="col-md-4">
                                <p>
                                    <a class="btn btn-warning" href="/group/members_list/{{$group->id}}" style="color:white;">Remove users</a>
                                </p>
                            </div>
                        </div>
                    @endif --}}

                </div>

                <div class="card-body container">
                    <ul class="chatting-area" style="overflow-y: scroll;max-height: 500px;">
                        @foreach ($messages as $message)

                            <li class="left message">
                                <figure><img src="{{asset($message->user->image)}}" width="20px" alt="Avatar"></figure>
                                <p>{{$message->message}}</p>
                            </li>
                        @endforeach

                    </ul>
                </div>
                <div class="bottom">
                    <form id='chatform' class="row">
                        <div class="form-group col-md-9">
                            <input type="text" class="form-control" id="message" name="message" placeholder="...أدخل الرسالة" autocomplete="off">
                        </div>
                      <button type="submit" class="btn btn-primary right">إرسال</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    const pusher  = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster: 'eu'});
    const channel = pusher.subscribe('groupchat-' + '{{$group->id}}');
    var messageReceivedSound = new Audio('{{asset("audio/message-received.mp3")}}'); // Replace with the actual path to your sound file

    //Receive messages
    channel.bind('chat', function (data) {
        console.log(data);
      $.post("/receive", {
        _token:  '{{csrf_token()}}',
        message: data.message,
        user:data.user
      })
       .done(function (res) {
         $(".chatting-area > .message").last().after(res);
         messageReceivedSound.play();
        //  $(document).scrollTop($(document).height());
       });
    });

    //Broadcast messages
    $("#chatform").submit(function (event) {
      event.preventDefault();

      $.ajax({
        url:     "/broadcast",
        method:  'POST',
        headers: {
          'X-Socket-Id': pusher.connection.socket_id
        },
        data:    {
          _token:  '{{csrf_token()}}',
          message: $("form #message").val(),
          group_id : '{{$group->id}}',
          user_id: '{{auth()->user()->id}}',
          user_image: '{{auth()->user()->image}}',
        }
      }).done(function (res) {
        $(".chatting-area > .message").removeClass('left').addClass('right').last().after(res);
        $("#chatform #message").val('');
        // $(document).scrollTop($(document).height());
      });
    });

  </script>

@endsection
