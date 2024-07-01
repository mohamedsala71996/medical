@extends('layouts.site.inc.layouts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>



@section('content')
    <div class="central-meta">
        @if (Auth::check())
            @if (auth()->user()->is_blocked == 0)
                <div class="new-postbox">


                    <div class="newpst-input">

                        <form method="post" action="{{ route('posts.store') }}">
                            @csrf
                            <textarea name="body" rows="3" placeholder="{{ trans('main.write_something') }}"></textarea>
                            <div class="attachments">
                                <ul>

                                    <li>
                                        <button type="submit">{{ trans('main.Create') }}</button>
                                    </li>
                                </ul>
                            </div>
                        </form>

                    </div>
                </div>
            @endif
        @endif
    </div><!-- add post new box -->

    <div class="central-meta item">
        <div class="user-post">
            <h2 class="text-center">{{ trans('main.News') }}</h2>
        </div>
    </div>
    @if ($posts->count() > 0)
        @foreach ($posts as $post)
            <div class="central-meta item">
                <div class="user-post">
                    <div class="friend-info">
                        <figure>
                            @if (!isset($post->user->image))
                                <img src="{{ url('/') }}/site/images/resources/empty.png" alt="">
                            @else
                                <img src="{{ url('/' . $post->user->image) }}" alt="">
                            @endif
                        </figure>
                        <div class="friend-name">
                            <ins><a href="#" title="">
                                    @if (isset($post->user->name))
                                        {{ $post->user->name }}
                                    @endif
                                </a>
                                @if (Auth::check() && auth()->user()->id == $post->user_id)
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">

                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#editPostModal{{ $post->id }}">Edit</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#deletePostModal{{ $post->id }}">Delete</a></li>
                                        </ul>
                                    </div>
                                    @include('site.home.edit-delete-Post')
                                @endif
                            </ins>
                            <span>{{ trans('main.published') }}: {{ $post->created_at->diffForHumans() }}</span>
                        </div>

                        <div class="post-meta">
                            <div class="description">

                                <p dir="rtl" class="text-right">

                                    {{ $post->body }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="coment-area">
                        <?php
                        $comments = \App\Models\Comment::where('post_id', $post->id)->get();
                        
                        ?>
                        <ul class="we-comet">
                            @if ($comments->count() > 0)
                                @foreach ($comments as $comment)
                                    <li>
                                        <div class="comet-avatar">
                                            @if ($post->user() && $comment->user->image == null)
                                                <img src="{{ url('/') }}/site/images/resources/empty.png"
                                                    alt="">
                                            @else
                                                <img src="{{ url('/' . $comment->user->image) }}" alt="">
                                            @endif
                                        </div>
                                        <div class="we-comment">
                                            <div class="coment-head">

                                                <h5><a href="time-line.html" title="">{{ $comment->user->name }}</a>
                                                </h5>
                                                <span>{{ $comment->created_at->diffForHumans() }}</span>
                                                <a class="we-reply" href="#" title="Reply"><i
                                                        class="fa fa-reply"></i></a>

                                            </div>
                                            <p>
                                                {{ $comment->comment }}
                                            </p>
                                            @if (Auth::check() && auth()->user()->id == $comment->user_id)
                                                <a class="btn btn-danger px-sm-1 rounded-3" href="#"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteCommentModal{{ $comment->id }}">حذف</a>
                                                @include('site.home.delete-comment')
                                            @endif
                                        </div>

                                    </li>
                                @endforeach
                            @endif
                            @if (Auth::check())
                                <li class="post-comment">
                                    <div class="comet-avatar">
                                        @if (auth()->user()->image == null)
                                            <img src="{{ url('/') }}/site/images/resources/empty.png" alt="">
                                        @else
                                            <img src="{{ url('/' . auth()->user()->image) }}" alt="">
                                        @endif
                                    </div>
                                    <div class="post-comt-box">
                                        <form action="{{ route('comments.store') }}" method="post">
                                            @csrf
                                            <textarea name="comment" rows="3" placeholder="{{ trans('main.Post_your_comment') }}"></textarea>
                                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                                            <br>

                                            <div class="friend-name" style="margin-top: 5px ">
                                                <button class="left btn  btn-outline-dark btn-sm"
                                                    type="submit">{{ trans('main.Create') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    @endif




@endsection
@section('js')
    <script src="{{ asset('admin/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/datatables.net/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin/plugins/sweetalert/sweetalert.min.js') }}"></script>

@endsection
